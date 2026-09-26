<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Bridge between the React front end (src/) and this CodeIgniter site.
 *
 * React pages load their data from JSON actions (api_data/...) and submit
 * their forms to the site's existing handlers with the header
 * "X-Vellore-App: 1". For those requests:
 *   - redirect() answers { ok: true, redirect } instead of a Location header
 *     (helpers/MY_url_helper.php)
 *   - a handler that renders a page instead (validation failed ...) answers
 *     { ok: false, errors, messages } (hooks/React_bridge.php)
 * so every form keeps its rules, uploads, e-mails and flash messages.
 */

if (!function_exists('react_request')) {
	/** The request comes from the React app. */
	function react_request()
	{
		return !empty($_SERVER['HTTP_X_VELLORE_APP']);
	}
}

if (!function_exists('react_json_body')) {
	function react_json_body($data)
	{
		return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | (defined('JSON_INVALID_UTF8_SUBSTITUTE') ? JSON_INVALID_UTF8_SUBSTITUTE : 0));
	}
}

if (!function_exists('react_send_json')) {
	/** Sends JSON now (for redirect(), which ends the request). */
	function react_send_json($data, $status = 200)
	{
		if (!headers_sent()) {
			http_response_code($status);
			header('Content-Type: application/json; charset=utf-8');
			header('Cache-Control: no-store');
		}
		echo react_json_body($data);
	}
}

if (!function_exists('react_message')) {
	/** A flash message (HTML such as <div class="alert alert-success">...) as { type, text }. */
	function react_message($html)
	{
		$html = (string) $html;
		$text = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8')));
		if ($text === '') {
			return null;
		}
		$lower = strtolower($html);
		$type = strpos($lower, 'danger') !== false || strpos($lower, 'error') !== false || strpos($lower, 'color:red') !== false || strpos($lower, 'color: red') !== false
			? 'danger'
			: (strpos($lower, 'success') !== false || strpos($lower, 'green') !== false ? 'success' : 'info');
		return array('type' => $type, 'text' => $text);
	}
}

if (!function_exists('react_messages')) {
	/**
	 * The session's flash messages as [{ key, type, text }], removed once read
	 * (a page shows them once, as flashdata() did).
	 */
	function react_messages()
	{
		$messages = array();
		if (empty($_SESSION['__ci_vars']) || !is_array($_SESSION['__ci_vars'])) {
			return $messages;
		}
		foreach ($_SESSION['__ci_vars'] as $key => $mark) {
			if (is_int($mark) || !isset($_SESSION[$key])) {
				continue; // tempdata, not flashdata
			}
			$value = $_SESSION[$key];
			unset($_SESSION[$key], $_SESSION['__ci_vars'][$key]);
			if (is_string($value) && ($m = react_message($value))) {
				$messages[] = array('key' => $key) + $m;
			}
		}
		return $messages;
	}
}

if (!function_exists('react_validation_errors')) {
	/** The form validation errors of this request, as plain messages. */
	function react_validation_errors()
	{
		$CI =& get_instance();
		if (!isset($CI->form_validation)) {
			return array();
		}
		return array_values(array_filter(array_map(function ($e) {
			return trim(html_entity_decode(strip_tags($e), ENT_QUOTES, 'UTF-8'));
		}, $CI->form_validation->error_array())));
	}
}
