<?php
/*
 * Settings for app/index.php. Copy this file to config.php (next to
 * index.php) and fill in the values. config.php is not in git; on the server,
 * do not overwrite it when uploading.
 *
 * Use the same values as the PHP site's application/config/database.php and
 * application/config/config.php.
 */
return array(
	'DB_HOST' => 'localhost',
	'DB_USER' => 'root',
	'DB_PASSWORD' => 'root',
	'DB_NAME' => 'velloreads',
	// 'DB_PORT' => 3306,
	// 'DB_SOCKET' => '',

	// the site's address; leave empty to use the address the request came to
	// 'APP_BASE_URL' => 'https://velloreads.com/',

	// folder of the PHP site (its index.php, assets/ and application/);
	// empty = the folder above this one, which is right when this is <site>/app/
	// 'SITE_ROOT' => '',

	// session: must match the PHP site ('sess_cookie_name', 'sess_expiration', 'sess_save_path')
	// 'SESSION_COOKIE' => 'ci_session',
	// 'SESSION_EXPIRATION' => 7200,
	// 'SESSION_SAVE_PATH' => '',

	// show error details in responses (never on the live site)
	// 'DEBUG' => true,
);
