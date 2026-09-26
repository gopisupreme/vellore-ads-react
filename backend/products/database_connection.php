<?php
//database_connection.php
// The shop's PDO connection. The login comes from app/config.php (the same
// settings as the rest of the site; see app/config.example.php) or environment
// variables with the same names -- never from this file.
$vellore_settings = is_file(__DIR__ . '/../app/config.php') ? (array) include __DIR__ . '/../app/config.php' : array();
$vellore_setting = function ($name, $default) use ($vellore_settings) {
	$env = getenv($name);
	if ($env !== false) {
		return $env;
	}
	return array_key_exists($name, $vellore_settings) ? $vellore_settings[$name] : $default;
};
$vellore_socket = (string) $vellore_setting('DB_SOCKET', '');
$vellore_dsn = $vellore_socket !== ''
	? 'mysql:unix_socket=' . $vellore_socket
	: 'mysql:host=' . $vellore_setting('DB_HOST', 'localhost') . ';port=' . (int) $vellore_setting('DB_PORT', 3306);
$connect = new PDO(
	$vellore_dsn . ';dbname=' . $vellore_setting('DB_NAME', 'velloreads') . ';charset=utf8',
	$vellore_setting('DB_USER', 'root'),
	$vellore_setting('DB_PASSWORD', 'root')
);
