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
