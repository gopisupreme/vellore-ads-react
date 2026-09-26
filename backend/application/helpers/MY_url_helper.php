<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'helpers/react_helper.php';

/**
 * redirect() of the url helper; for the React app (helpers/react_helper.php)
 * it answers { ok: true, redirect } instead, so the app goes there itself.
 */
if (!function_exists('redirect')) {
	function redirect($uri = '', $method = 'auto', $code = NULL)
	{
		if (!preg_match('#^(\w+:)?//#i', $uri)) {
			$uri = site_url($uri);
		}
		if (react_request()) {
			// a form handler that sends the visitor back after failed validation: the
			// app keeps its form on screen and shows the errors (they were lost before)
			$errors = react_validation_errors();
			if ($errors && strtoupper((string) $_SERVER['REQUEST_METHOD']) === 'POST') {
				$messages = array_values(array_filter(react_messages(), function ($m) use ($errors) {
					return !in_array($m['text'], $errors, true) && $m['text'] !== implode(' ', $errors);
				}));
				react_send_json(array('ok' => false, 'errors' => $errors, 'messages' => $messages));
				exit;
			}
			react_send_json(array('ok' => true, 'redirect' => $uri));
			exit;
		}

		// IIS environment likely? Use 'refresh' for better compatibility
		if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE) {
			$method = 'refresh';
		} elseif ($method !== 'refresh' && (empty($code) or !is_numeric($code))) {
			if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
				$code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
					? 303 // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
					: 307;
			} else {
				$code = 302;
			}
		}

		switch ($method) {
			case 'refresh':
				header('Refresh:0;url=' . $uri);
				break;
			default:
				header('Location: ' . $uri, TRUE, $code);
				break;
		}
		exit;
	}
}
