<?php
// Router for PHP's built-in server (local development only):
//   php -S localhost:8888 -t ../vellore-ads tools/php-dev-router.php
// Serves real files from the document root and sends everything else to
// CodeIgniter's front controller, like the Apache .htaccess does.
$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($path !== '/' && is_file($root . $path)) {
    return false;
}
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = $root . '/index.php';
chdir($root);
require $root . '/index.php';
