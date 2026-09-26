<?php
/**
 * Router for PHP's built-in server that follows backend/.htaccess, so the
 * site runs without Apache (local development only):
 *
 *   npm run php     (php -S localhost:8890 -t backend tools/dev-router.php)
 *
 * Database and other settings: backend/app/config.php or environment variables.
 */
$root = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$rel = ltrim(urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');
$phpSections = '#^(assetsA|public|products|investor|matrimony_html|vlrbk|cgi-bin|my-stripe|stripePost|PayuController|PayuStatusController'
	. '|User_Authentication|paytm|payment_by_paytm|paypalpayment|paypal|paypal_two|instatwo|cart|razor|recruiter|tamil-calendar|comments'
	. '|categories|posts|product|matrimony|spa|Resume|job|users|users2|connect|post-free-ads|pages|Manage_Ajax|custom404|customer|cinema'
	. '|review|administrator|pages2|shopping|Tamil_calendar)(/.*)?$#i';

if ($rel === '') {
	$target = "$root/app/index.php";
} elseif (is_file("$root/$rel")) {
	if (substr($rel, -4) !== '.php') {
		return false; // a file: served as it is
	}
	$target = "$root/$rel";
} elseif (is_dir("$root/$rel")) {
	return false;
} elseif (preg_match('#^(index\.php|assets|images|js|css|uploads|favicon\.png)(/|$)#', $rel)) {
	if (strpos($rel, 'index.php') !== 0) {
		http_response_code(404);
		return true;
	}
	$target = "$root/index.php";
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('#^(users(/(?!api_).*)?|recruiter/(login|register)/?)$#i', $rel)) {
	$target = "$root/app/index.php"; // React pages of users/ (see backend/.htaccess)
} elseif (preg_match($phpSections, $rel)) {
	$target = "$root/index.php";
} else {
	$target = "$root/app/index.php";
}
$_SERVER['SCRIPT_FILENAME'] = $target;
$_SERVER['SCRIPT_NAME'] = $_SERVER['PHP_SELF'] = substr($target, strlen($root));
chdir(dirname($target));
require $target;
