<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Per-server settings shared by the PHP site and the React server file
 * (app/index.php): an environment variable, else app/config.php (copy
 * app/config.example.php), else the default given here.
 *
 * So the code can be uploaded as it is: the live database login and address
 * live only in app/config.php on the server.
 */
if (!function_exists('site_setting')) {
	function site_setting($name, $default = null)
	{
		static $file = null;
		if ($file === null) {
			$path = FCPATH . 'app/config.php';
			$file = is_file($path) ? (array) include $path : array();
		}
		$env = getenv($name);
		if ($env !== false) {
			return $env;
		}
		return array_key_exists($name, $file) ? $file[$name] : $default;
	}
}

/** The site's address: APP_BASE_URL, else the address the request came to. */
if (!function_exists('site_base_url')) {
	function site_base_url()
	{
		$base = (string) site_setting('APP_BASE_URL', '');
		if ($base !== '') {
			return rtrim($base, '/') . '/';
		}
		$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
			|| (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		return ($https ? 'https' : 'http') . '://' . $host . '/';
	}
}
