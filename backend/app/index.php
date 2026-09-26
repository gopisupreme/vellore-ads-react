<?php
/**
 * Server side of the React front end, in one file: <site root>/app/index.php.
 *
 * The site root (backend/ in the repository, public_html on the server) is the
 * PHP site (CodeIgniter), which still serves /assets, sign-in, dashboards,
 * payments and the enquiry/review forms. The site's .htaccess sends the public
 * pages and /api here:
 *
 *  - /api/*        JSON for the React app (see App::api)
 *  - other URLs    the React page (app/index.html from `npm run build`) with
 *                  its data and SEO tags already in the HTML; URLs the React
 *                  app has no page for are handed to the site's index.php
 *
 * It uses the same MySQL database and the same session files as the PHP site,
 * so the visitor's city and sign-in are shared.
 *
 * Settings: app/config.php (copy config.example.php) or environment variables
 * with the same names. The defaults suit MAMP.
 *
 * Works on PHP 7.3+.
 */

namespace VelloreApp;

error_reporting(E_ALL);
ini_set('display_errors', '0');

/* ======================================================================== */
/* Settings                                                                 */
/* ======================================================================== */

final class Config
{
	private static $values;

	const DEFAULTS = array(
		'DB_HOST' => 'localhost',
		'DB_USER' => 'root',
		'DB_PASSWORD' => 'root',
		'DB_NAME' => 'velloreads',
		'DB_PORT' => 3306,
		'DB_SOCKET' => '',
		// "https://velloreads.com/"; empty = the address the request came to
		'APP_BASE_URL' => '',
		// folder of the PHP site (CodeIgniter index.php, assets/, application/); empty = the folder above this one
		'SITE_ROOT' => '',
		// must match the PHP site's session settings (application/config/config.php)
		'SESSION_COOKIE' => 'ci_session',
		'SESSION_EXPIRATION' => 7200,
		'SESSION_SAVE_PATH' => '',
		// only when this PHP and the site's PHP use different php.ini files (local development)
		'SESSION_SID_LENGTH' => '',
		'SESSION_SID_BITS' => '',
		'DEBUG' => false,
	);

	public static function get($name)
	{
		if (self::$values === null) {
			$file = __DIR__ . '/config.php';
			self::$values = array_merge(self::DEFAULTS, is_file($file) ? (array) include $file : array());
		}
		$env = getenv($name);
		return $env !== false ? $env : self::$values[$name];
	}

	public static function siteRoot()
	{
		$root = (string) self::get('SITE_ROOT');
		return rtrim($root !== '' ? $root : dirname(__DIR__), '/\\');
	}

	public static function baseUrl()
	{
		$base = (string) self::get('APP_BASE_URL');
		if ($base !== '') {
			return rtrim($base, '/') . '/';
		}
		$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
			|| (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
		return ($https ? 'https' : 'http') . '://' . $host . '/';
	}
}

/* ======================================================================== */
/* Database                                                                 */
/* ======================================================================== */

final class Db
{
	private $link;

	public function __construct()
	{
		mysqli_report(MYSQLI_REPORT_OFF);
		$socket = (string) Config::get('DB_SOCKET');
		$this->link = @new \mysqli(
			Config::get('DB_HOST'), Config::get('DB_USER'), Config::get('DB_PASSWORD'), Config::get('DB_NAME'),
			(int) Config::get('DB_PORT'), $socket !== '' ? $socket : null
		);
		if ($this->link->connect_errno) {
			throw new \RuntimeException('Database connection failed: ' . $this->link->connect_error);
		}
		$this->link->set_charset('utf8'); // as the site's database.php
	}

	/** A value for SQL: quoted and escaped (NULL for null). */
	public function q($value)
	{
		if ($value === null) {
			return 'NULL';
		}
		if (is_bool($value)) {
			return $value ? '1' : '0';
		}
		return "'" . $this->link->real_escape_string((string) $value) . "'";
	}

	/** A quoted LIKE pattern: %text% with the text's own % and _ taken literally. */
	public function like($text, $before = true, $after = true)
	{
		$text = addcslashes((string) $text, '%_\\');
		return $this->q(($before ? '%' : '') . $text . ($after ? '%' : ''));
	}

	private function run($sql)
	{
		$result = $this->link->query($sql);
		if ($result === false) {
			throw new \RuntimeException('Query failed: ' . $this->link->error . (Config::get('DEBUG') ? " -- $sql" : ''));
		}
		return $result;
	}

	public function rows($sql)
	{
		$result = $this->run($sql);
		$rows = array();
		while (($row = $result->fetch_assoc()) !== null) {
			$rows[] = $row;
		}
		$result->free();
		return $rows;
	}

	/** The first row, or null. */
	public function row($sql)
	{
		$rows = $this->rows($sql);
		return $rows ? $rows[0] : null;
	}

	public function count($sql)
	{
		$result = $this->run($sql);
		$n = $result->num_rows;
		$result->free();
		return $n;
	}

	public function exec($sql)
	{
		$this->run($sql);
	}

	public function tableExists($table)
	{
		return $this->count('SHOW TABLES LIKE ' . $this->like($table, false, false)) > 0;
	}

	public function close()
	{
		$this->link->close();
	}
}

/* ======================================================================== */
/* Session shared with the PHP site                                          */
/* ======================================================================== */

/**
 * Reads and writes the PHP site's session files, the way CodeIgniter's
 * "files" session driver does: <save path>/ci_session<id>, locked while in use.
 */
final class SessionFiles implements \SessionHandlerInterface, \SessionUpdateTimestampHandlerInterface
{
	private $prefix;
	private $handle;
	private $id;

	#[\ReturnTypeWillChange]
	public function open($savePath, $name)
	{
		$this->prefix = rtrim($savePath, '/\\') . DIRECTORY_SEPARATOR . $name;
		return true;
	}

	#[\ReturnTypeWillChange]
	public function read($id)
	{
		$this->release();
		$file = $this->prefix . $id;
		$isNew = !is_file($file);
		$this->handle = @fopen($file, 'c+b');
		if ($this->handle === false) {
			$this->handle = null;
			return '';
		}
		flock($this->handle, LOCK_EX);
		$this->id = $id;
		if ($isNew) {
			@chmod($file, 0600);
			return '';
		}
		clearstatcache(true, $file);
		$data = stream_get_contents($this->handle);
		return $data === false ? '' : $data;
	}

	#[\ReturnTypeWillChange]
	public function write($id, $data)
	{
		if ($id !== $this->id) {
			$this->read($id); // the id changed: lock the new file
		}
		if (!$this->handle) {
			return false;
		}
		ftruncate($this->handle, 0);
		rewind($this->handle);
		return $data === '' || fwrite($this->handle, $data) !== false;
	}

	#[\ReturnTypeWillChange]
	public function close()
	{
		$this->release();
		return true;
	}

	#[\ReturnTypeWillChange]
	public function destroy($id)
	{
		$this->release();
		@unlink($this->prefix . $id);
		return true;
	}

	#[\ReturnTypeWillChange]
	public function gc($maxLifetime)
	{
		return 0; // the PHP site cleans up old sessions
	}

	#[\ReturnTypeWillChange]
	public function validateId($id)
	{
		return is_file($this->prefix . $id);
	}

	#[\ReturnTypeWillChange]
	public function updateTimestamp($id, $data)
	{
		return @touch($this->prefix . $id);
	}

	private function release()
	{
		if ($this->handle) {
			flock($this->handle, LOCK_UN);
			fclose($this->handle);
		}
		$this->handle = null;
		$this->id = null;
	}
}

final class Session
{
	/** Opens the visitor's session (CodeIgniter's cookie and files). */
	public static function start()
	{
		if (session_status() === PHP_SESSION_ACTIVE) {
			return;
		}
		$name = (string) Config::get('SESSION_COOKIE');
		$expiration = (int) Config::get('SESSION_EXPIRATION');
		$savePath = (string) Config::get('SESSION_SAVE_PATH');
		if ($savePath === '') {
			$savePath = ini_get('session.save_path') ?: sys_get_temp_dir();
		}

		// session ids exactly as CodeIgniter makes them (Session::_configure_sid_length), or it would reject ours
		if (Config::get('SESSION_SID_BITS') !== '') {
			@ini_set('session.sid_bits_per_character', (string) Config::get('SESSION_SID_BITS'));
		}
		if (Config::get('SESSION_SID_LENGTH') !== '') {
			@ini_set('session.sid_length', (string) Config::get('SESSION_SID_LENGTH'));
		}
		$bitsPerChar = (int) ini_get('session.sid_bits_per_character') ?: 4;
		$length = (int) ini_get('session.sid_length') ?: 32;
		if (($bits = $length * $bitsPerChar) < 160) {
			$length += (int) ceil((160 % $bits) / $bitsPerChar);
			@ini_set('session.sid_length', (string) $length);
		}
		$chars = $bitsPerChar === 5 ? '[0-9a-v]' : ($bitsPerChar === 6 ? '[0-9a-zA-Z,-]' : '[0-9a-f]');
		if (isset($_COOKIE[$name]) && (!is_string($_COOKIE[$name]) || !preg_match('#\A' . $chars . '{' . $length . '}\z#', $_COOKIE[$name]))) {
			unset($_COOKIE[$name]);
		}

		session_set_save_handler(new SessionFiles(), true);
		session_name($name);
		session_save_path($savePath);
		session_set_cookie_params($expiration, '/', '', false, true);
		ini_set('session.use_trans_sid', '0');
		ini_set('session.use_strict_mode', '1');
		ini_set('session.use_cookies', '1');
		ini_set('session.use_only_cookies', '1');
		ini_set('session.gc_maxlifetime', (string) $expiration);
		session_start();
		// CodeIgniter renews the cookie on every request
		setcookie($name, session_id(), time() + $expiration, '/', '', false, true);
	}

	public static function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
}

/* ======================================================================== */
/* Site data                                                                */
/* ======================================================================== */

/**
 * What the PHP views queried for themselves, as plain arrays for JSON, and
 * the routing of the PHP site's Pages controller (which page a URL shows,
 * with the same session changes, visit counting and SEO tags).
 */
final class Site
{
	/** Pages the React app renders; keep in step with src/pages/registry.js. */
	const REACT_PAGES = array(
		'index', 'about-us', 'contact-us', 'services', 'pricing', 'how-it-work', 'franchise-partner',
		'privacy-policy', 'infringement-policy', 'customer-reviews', 'trendings', 'nearby-listings',
		'new-business', 'news', 'news-content', 'events', 'events-content', 'blog', 'sitemap', 'advertise',
		'local-services', 'countries',
	);

	/**
	 * Sign-in pages the React app renders although their section (users/,
	 * recruiter/) belongs to the PHP site: URL -> [view, title, session
	 * messages the PHP page showed]. Their forms post to the JSON actions
	 * in controllers/Users.php (api_login ...). Keep in step with src/config/site.js.
	 */
	const ACCOUNT_PAGES = array(
		'users/login' => array('login', 'Sign In', array('user_registered', 'login_failed')),
		'users/register' => array('register', 'Register', array('_registered', 'user_registered', 'emessage')),
		'users/forgot_pass' => array('forgot-password', 'Forgot Password', array('forgot_failed', 'forgot_success', 'error_message')),
		'users/recruiter_login' => array('recruiter-login', 'Sign In', array('user_registered', 'login_failed')),
		'recruiter/login' => array('recruiter-login', 'Sign In', array('user_registered', 'login_failed')),
		'users/recruiter_register' => array('recruiter-register', 'Register', array('_registered', 'user_registered', 'emessage')),
		'recruiter/register' => array('recruiter-register', 'Register', array('_registered', 'user_registered', 'emessage')),
	);

	/** First URL segments that belong to the PHP site (src/config/site.js PHP_PREFIXES). */
	const PHP_PREFIXES = array(
		'api', 'app', 'assets', 'assetsa', 'uploads', 'images', 'js', 'css', 'public', 'products', 'investor',
		'matrimony_html', 'vlrbk', 'cgi-bin', 'index.php', 'sw.js', 'my-stripe', 'stripepost', 'payucontroller',
		'payustatuscontroller', 'user_authentication', 'paytm', 'payment_by_paytm', 'paypalpayment', 'paypal',
		'paypal_two', 'instatwo', 'cart', 'razor', 'recruiter', 'tamil-calendar', 'comments', 'categories', 'posts',
		'product', 'matrimony', 'spa', 'resume', 'job', 'users', 'users2', 'connect', 'post-free-ads', 'pages',
		'manage_ajax', 'custom404', 'customer', 'cinema', 'review', 'administrator', 'pages2', 'shopping',
		'tamil_calendar',
	);

	private $db;
	private $companyRow;

	public function __construct(Db $db)
	{
		$this->db = $db;
	}

	/* ---- helpers the PHP site had (url helper, Company_Model, User_Model) ---- */

	private function baseUrl()
	{
		return Config::baseUrl();
	}

	/** CodeIgniter's url_title(): "Sri Hospital & Co." -> "Sri-Hospital-Co". */
	public static function urlTitle($str)
	{
		$u = extension_loaded('mbstring') ? 'u' : '';
		$str = strip_tags((string) $str);
		foreach (array('&.+?;' => '', '[^\w\d _-]' => '', '\s+' => '-', '(-)+' => '-') as $pattern => $with) {
			$str = preg_replace('#' . $pattern . '#i' . $u, $with, $str);
		}
		return trim(trim($str, '-'));
	}

	/** A file of the PHP site exists (image fallbacks in the views). */
	private function siteFile($path)
	{
		return is_file(Config::siteRoot() . '/' . $path);
	}

	/** Company_Model::get_categroy_thumbnail_url() */
	private function thumbnailUrl($cateName, $cateImg)
	{
		$default = $this->baseUrl() . 'assets/uploads/listing-default-img.webp';
		if ($cateName != '') {
			$cate = $this->db->row("SELECT * FROM `category` WHERE `c_name` = " . $this->db->q($cateName));
			if ($cate) {
				if ($cate['c_wideImage'] != '' && $this->siteFile('assets/advertise/' . $cate['c_wideImage'])) {
					return $this->baseUrl() . 'assets/advertise/' . $cate['c_wideImage'];
				}
				if ($cateImg != '' && $this->siteFile('assets/uploads/' . $cateImg)) {
					return $this->baseUrl() . 'assets/uploads/' . $cateImg;
				}
				return $default;
			}
		}
		return $default;
	}

	/** Company_Model::get_categroy_wide_url() */
	private function wideUrl($cateName)
	{
		$default = $this->baseUrl() . 'assets/advertise/s1.png ';
		if ($cateName != '') {
			$cate = $this->db->row("SELECT * FROM `category` WHERE `c_name` = " . $this->db->q($cateName));
			if ($cate && $cate['c_wideImage'] != '' && $this->siteFile('assets/advertise/' . $cate['c_wideImage'])) {
				return $this->baseUrl() . 'assets/advertise/' . $cate['c_wideImage'];
			}
		}
		return $default;
	}

	public function company()
	{
		if ($this->companyRow === null) {
			$this->companyRow = $this->db->row("SELECT * FROM `companyinfo` WHERE `id` = '1'");
		}
		return $this->companyRow;
	}

	/** $city in the views: the session city, else the company's. */
	private function currentCity()
	{
		$city = Session::get('city');
		return $city != '' ? $city : $this->company()['city'];
	}

	/* ---- site-wide data ---- */

	/** Everything templates/header*.php and footer.php used on every page. */
	public function bootstrap()
	{
		$page = $this->db->row("SELECT * FROM `page` WHERE `id` = '1'");
		return array(
			'company' => $this->company(),
			// only what the header menu and footer link to (full rows carry kilobytes of SEO text each)
			'categories' => $this->db->rows("SELECT `c_id`, `c_name` FROM `category` WHERE `c_status` = 'active' ORDER BY `c_id`"),
			'locations' => $this->db->rows("SELECT `loc_id`, `loc_name` FROM `location` WHERE `loc_status` = 'active' ORDER BY `loc_name` ASC"),
			'pageOpens' => $page ? $page['page_opens'] : 0,
			'reactPages' => self::REACT_PAGES,
			'session' => $this->session(),
		);
	}

	/** The session values the templates read, plus the signed-in user's row. */
	public function session()
	{
		$uid = Session::get('uid');
		return array(
			'city' => (string) Session::get('city'),
			'title' => (string) Session::get('title'),
			'login' => (bool) Session::get('login'),
			'type' => (string) Session::get('type'),
			'email' => (string) Session::get('email'),
			'username' => (string) Session::get('username'),
			'user' => $uid ? $this->db->row("SELECT * FROM `users` WHERE `u_id` = " . $this->db->q($uid)) : null,
		);
	}

	/* ---- routing ---- */

	/**
	 * The page for a URL: `resolved` (view name, route, params, query, SEO tags)
	 * and the page's `data`; `status` is the HTTP status the PHP site answered with.
	 * View "legacy" = a page only the PHP site has; "redirect" = go to `redirect`.
	 */
	public function resolve($pathWithQuery)
	{
		$parts = explode('?', (string) $pathWithQuery, 2);
		$query = array();
		if (isset($parts[1])) {
			parse_str($parts[1], $query);
		}
		$segs = array_map('urldecode', array_values(array_filter(explode('/', $parts[0]), 'strlen')));

		$account = strtolower(implode('/', $segs));
		if (count($segs) === 0) {
			$page = $this->resolveView('index');
		} elseif (isset(self::ACCOUNT_PAGES[$account])) {
			list($view, $title) = self::ACCOUNT_PAGES[$account];
			Session::set('city', $this->company()['city']); // Users::__construct()
			$page = array('view' => $view, 'route' => 'account', 'params' => array('page' => $account), 'title' => $title);
		} elseif (in_array(strtolower($segs[0]), self::PHP_PREFIXES, true) || count($segs) > 3
			|| preg_match('/\.(php|html?|xml|txt|js|css|png|jpe?g|gif|webp|svg|ico|pdf|json)$/i', end($segs))) {
			$page = array('view' => 'legacy');
		} elseif ($segs[0] === 'blog' && count($segs) === 3) {
			$page = array('view' => 'blog-details', 'route' => 'blog', 'params' => array('listingId' => $segs[2]), 'title' => 'Blog Details');
		} elseif (count($segs) === 1) {
			$page = $this->resolveView($segs[0]);
		} else {
			$page = $this->resolveCity($segs[0], $segs[1], isset($segs[2]) ? $segs[2] : '');
		}

		$status = isset($page['status']) ? $page['status'] : 200;
		unset($page['status']);
		$resolved = array_merge(array('route' => 'view', 'params' => new \stdClass(), 'query' => $query), $page);
		if (isset($page['title'])) {
			$resolved['meta'] = $this->meta(
				$page['title'],
				isset($page['descriptionsName']) ? $page['descriptionsName'] : '',
				isset($page['keywordsName']) ? $page['keywordsName'] : ''
			);
		}
		$data = new \stdClass();
		if (!in_array($resolved['view'], array('legacy', 'redirect'), true)) {
			$data = $this->pageData($resolved, $query);
			// listing-details.php sent visitors of a missing listing to the category page
			if (is_array($data) && isset($data['redirect'])) {
				$resolved['view'] = 'redirect';
				$resolved['redirect'] = $data['redirect'];
				$data = new \stdClass();
			}
		}
		return array('status' => $status, 'resolved' => $resolved, 'data' => $data);
	}

	/** Pages::view(): content pages, locations and the home page. */
	private function resolveView($seg)
	{
		Session::set('city', $this->company()['city']);
		if ($seg === 'listing-details.php' || $seg === 'list.php') {
			return array('view' => 'legacy');
		}
		$location = $this->db->row("SELECT * FROM `location` WHERE `loc_name` = " . $this->db->q($seg));
		if ($location) {
			Session::set('city', $location['loc_name']);
			return array('view' => 'index', 'title' => ucfirst($seg));
		}
		if (in_array($seg, self::REACT_PAGES, true)) {
			return array('view' => $seg, 'title' => ucfirst($seg === 'index' ? 'Post Free Ads in vellore' : $seg));
		}
		if ($this->siteFile('application/views/pages/' . $seg . '.php')) {
			return array('view' => 'legacy');
		}
		// Custom404::index()
		Session::set('city', $this->company()['city']);
		return array('view' => 'error404', 'title' => ucfirst('page not found'), 'status' => 404);
	}

	/** Pages::city(): /{city}/{category-or-listing}[/{listing id}]. */
	private function resolveCity($page, $categoryNm, $lastNo)
	{
		$db = $this->db;
		$title2 = str_replace(' ', '-', $categoryNm);
		$title3 = str_replace('-', ' ', $title2);
		$city = str_replace('-', ' ', $page);
		Session::set('title', $title2);
		Session::set('city', $page);
		$params = array('categoryId' => $title2, 'cityId' => $city);
		$e3 = $db->q($title3);

		$isCategory = $db->count("SELECT * FROM `category` WHERE `c_name` = $e3 AND `c_status` = 'active'") > 0;
		$isSubCategory = $db->count("SELECT * FROM `sub_category` WHERE `name` = $e3 AND `status` = '1'") > 0;

		$site = $this;
		$listPage = function ($countWhere, $sep) use ($db, $title3, $city, $params) {
			$cCity = $db->row("SELECT * FROM `location` WHERE `loc_name` = " . $db->q($city) . " AND `loc_city` = " . $db->q($city));
			$titleName = "List of $title3 in $city - near me in $city - " . ($cCity ? $cCity['loc_country'] : '');
			$cate = $db->row("SELECT * FROM `category` WHERE `c_name` = " . $db->q($title3) . " AND `c_status` = 'active'");
			$where = $countWhere !== null ? $countWhere : "`l_category` = " . $db->q($cate ? $cate['c_name'] : '');
			$count = $db->count("SELECT * FROM `listing` WHERE $where AND `l_city` = " . $db->q($city) . " AND `l_status` = 'active'");
			$desc = $cate ? $cate['c_description'] : '';
			$keys = $cate ? $cate['c_keywords'] : '';
			return array(
				'view' => 'list', 'route' => 'city', 'params' => $params,
				'title' => "Top 100 $title3 in $city - near me in $city$sep" . $titleName,
				'descriptionsName' => "$count $title3 in $city - near me in $city  $desc  $city",
				'keywordsName' => "List of $title3 in $city, Reviews, Map, Address, Phone Number, Contact Number, local, popular $title3, $title3 near me in $city  $keys $city",
			);
		};
		$detailsPage = function ($listing, $lastId) use ($db, $title3, $params) {
			$lCity = $db->row("SELECT * FROM `location` WHERE `loc_id` = " . $db->q($listing['l_loc_id']) . " AND `loc_city` = " . $db->q($listing['l_city']));
			$titleName = "$title3 in " . ($lCity ? $lCity['loc_name'] : '') . " -  " . ($lCity ? $lCity['loc_country'] : '');
			return array(
				'view' => 'listing-details', 'route' => 'city', 'params' => $params + array('lastId' => $lastId),
				'title' => ucfirst($titleName),
				'descriptionsName' => $titleName . ' ' . $listing['l_desc'],
				'keywordsName' => $titleName . ' ' . $listing['l_key'],
			);
		};
		$homePage = array(
			'view' => 'index', 'route' => 'city', 'params' => $params,
			'title' => "Top 100 $title3 in $city - near me in $city - List of $title3 in $city",
		);

		if ($lastNo !== '') {
			$params['lastId'] = $lastNo;
			$listing = $db->row("SELECT * FROM `listing` WHERE `l_id` = " . $db->q($lastNo) . " AND `l_status` = 'active'");
			if ($isCategory || $isSubCategory) {
				$site->countVisit($title3, 1);
				return $listPage($isCategory ? null : "FIND_IN_SET(l_subcategory, $e3) > 0", ' ');
			}
			if ($listing) {
				$site->countVisit($title3, 3, $listing['l_id']);
				return $detailsPage($listing, $lastNo);
			}
			$site->countVisit($title3, 1);
			return $homePage;
		}

		$listing = $db->row("SELECT * FROM `listing` WHERE `l_title` = $e3 AND `l_status` = 'active'");
		if ($isCategory) {
			$site->countVisit($title3, 1);
			return $listPage(null, '');
		}
		if ($listing) {
			$site->countVisit($title3, 2);
			return $detailsPage($listing, $listing['l_id']);
		}
		$byKeyword = $db->count("SELECT * FROM `listing` WHERE (`l_key` LIKE " . $db->like($title3) . " OR `l_desc` LIKE " . $db->like($title3) . ") AND `l_status` = 'active'") > 0;
		$site->countVisit($title3, 1);
		return ($isSubCategory || $byKeyword) ? $listPage(null, '') : $homePage;
	}

	/** Pages::add_visitor_count() + Company_Model::visitor_counter(): one view per visitor per day. */
	public function countVisit($slug, $view, $lastNo = '')
	{
		$db = $this->db;
		$cookie = urldecode(str_replace(' ', '-', $slug));
		if (!empty($_COOKIE[$cookie])) {
			return;
		}
		@setcookie($cookie, isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '', time() + 86400, '/');
		$name = str_replace('-', ' ', $cookie);
		$today = (new \DateTime('now', new \DateTimeZone('Asia/Kolkata')))->format('Y-m-d');
		if ($view == 1) {
			$db->exec("UPDATE `category` SET `c_visitor` = `c_visitor` + 1 WHERE `c_name` = " . $db->q($name) . " AND `c_status` = 'active'");
			$db->exec("UPDATE `sub_category` SET `visitor` = `visitor` + 1 WHERE `name` = " . $db->q($name) . " AND `status` = '1'");
		} elseif ($view == 2) {
			$listing = $db->row("SELECT `l_id` FROM `listing` WHERE `l_title` = " . $db->q($name));
			$db->exec("UPDATE `listing` SET `l_visitor` = `l_visitor` + 1 WHERE `l_title` = " . $db->q($name));
			if ($listing) {
				$db->exec("INSERT INTO `visitor_counter` (`list_id`, `date`) VALUES (" . $db->q($listing['l_id']) . ", " . $db->q($today) . ")");
			}
		} elseif ($view == 3) {
			$db->exec("UPDATE `listing` SET `l_visitor` = `l_visitor` + 1 WHERE `l_id` = " . $db->q($lastNo));
			$db->exec("INSERT INTO `visitor_counter` (`list_id`, `date`) VALUES (" . $db->q($lastNo) . ", " . $db->q($today) . ")");
		}
	}

	/** The <title>, description and keywords templates/header.php printed. */
	private function meta($pageTitle, $pageDes, $pageKey)
	{
		$c = $this->company();
		$newTitle = "Local Search, Order Food, Travel booking, Movies, Online Shopping, Free Classifieds Ads in $c[cName] $c[city], Online Classified Advertising, Post Ads Online, Free Ads Posting Classifieds $c[city] | ads $c[city] - $c[domain]";
		return array(
			'title' => $pageTitle != '' ? "$pageTitle | $c[cName] | $newTitle | $pageTitle" : "$c[cName] |  Classifieds",
			'description' => ($pageDes != '' ? $pageDes : $c['description']) . " | $c[cName] Classifieds",
			'keywords' => ($pageKey != '' ? $pageKey : $c['keywords']) . " | $c[cName] Classifieds",
			'pageTitle' => $pageTitle,
		);
	}

	/* ---- page data ---- */

	private function pageData($resolved, $query)
	{
		$params = (array) $resolved['params'];
		$get = function ($key, $default) use ($query) {
			return isset($query[$key]) ? $query[$key] : $default;
		};
		if (isset($params['page'], self::ACCOUNT_PAGES[$params['page']])) {
			return array('messages' => $this->takeFlash(self::ACCOUNT_PAGES[$params['page']][2]));
		}
		switch ($resolved['view']) {
			case 'index':
				return $this->homeData();
			case 'list':
				return $this->listData($params['categoryId']);
			case 'listing-details':
				return $this->listingDetailsData($params['categoryId'], $params['lastId']);
			case 'trendings':
				return $this->trendingsData($get('pageno', 1));
			case 'nearby-listings':
			case 'new-business':
				return $this->latestListingsData($resolved['view'], $get('page', 1));
			case 'customer-reviews':
				return $this->customerReviewsData($get('page', 1));
			case 'pricing':
				return array('plans' => $this->db->rows("SELECT * FROM `premium` WHERE `status` = '1'"));
			case 'blog':
				return array('posts' => $this->blogPosts(true));
			case 'events':
				return array('posts' => $this->blogPosts(false));
			case 'blog-details':
				return array('post' => $this->blogPost($params['listingId'], true));
			case 'events-content':
				return array('post' => $this->blogPost($get('id', ''), false));
			case 'countries':
				return array('countries' => $this->db->tableExists('countries')
					? $this->db->rows("SELECT * FROM `countries` WHERE `status` = 'active' AND `code` != ''")
					: array());
			case 'sitemap':
				return array('categories' => $this->sitemapCategories());
			case 'advertise':
				return array('ads' => $this->advertisePrices());
			default:
				return new \stdClass();
		}
	}

	/**
	 * CodeIgniter flash messages (set_flashdata) for this page, removed once
	 * read like flashdata(): [{ type: success|danger|info, text }].
	 */
	private function takeFlash($keys)
	{
		$messages = array();
		foreach ($keys as $key) {
			if (!isset($_SESSION[$key])) {
				continue;
			}
			$html = (string) $_SESSION[$key];
			unset($_SESSION[$key], $_SESSION['__ci_vars'][$key]);
			$text = trim(html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8'));
			if ($text === '') {
				continue;
			}
			$type = strpos($html, 'alert-success') !== false ? 'success' : (strpos($html, 'alert-danger') !== false ? 'danger' : 'info');
			$messages[] = array('type' => $type, 'text' => $text);
		}
		return $messages;
	}

	/** number_format() of the average active review rating, as the views printed it. */
	private function rating($listingId)
	{
		$row = $this->db->row("SELECT avg(r_rating) AS avg_rating FROM `reviews` WHERE `r_postid` = " . $this->db->q($listingId) . " AND `r_status` = 'active'");
		return number_format((float) $row['avg_rating'], 1);
	}

	private function reviewCount($listingId)
	{
		return $this->db->count("SELECT * FROM `reviews` WHERE `r_postid` = " . $this->db->q($listingId) . " AND `r_status` = 'active'");
	}

	private function likeCount($listingId)
	{
		return $this->db->count("SELECT * FROM `favorites_likes` WHERE `l_id` = " . $this->db->q($listingId));
	}

	/** Paid ads from ads_with_us that are running today. */
	private function ads($adsPage, $adsType, $adsCate = null)
	{
		$cate = $adsCate === null ? '' : " AND `adsCate` = " . $this->db->q($adsCate);
		return $this->db->rows("SELECT * FROM `ads_with_us` WHERE `adsPage` = '$adsPage'$cate AND `adsType` = '$adsType' AND DATE(NOW()) BETWEEN `fromDate` AND `toDate` ORDER BY `view` DESC");
	}

	/** "Title that is too long..." the way the views cut text: at the last space. */
	private static function shorten($text, $max)
	{
		$text = (string) $text;
		if (strlen($text) <= $max) {
			return $text;
		}
		$part = substr($text, 0, $max);
		$space = strrpos($part, ' ');
		return substr($part, 0, $space === false ? 0 : $space) . '...';
	}

	/** Cover image of a listing card (nearby-listings.php / listing-details.php). */
	private function coverImage($row, $checkCategoryFile)
	{
		if (!empty($row['l_coverImage'])) {
			return $this->siteFile('assets/images/list-deta/' . $row['l_coverImage']) ? $row['l_coverImage'] : 'bg.jpg';
		}
		if (!empty($row['l_category'])) {
			$cate = $this->db->row("SELECT * FROM `category` WHERE `c_name` = " . $this->db->q($row['l_category']));
			$img = $cate ? $cate['c_img'] : '';
			if ($img != '' && (!$checkCategoryFile || $this->siteFile('assets/images/list-deta/' . $img))) {
				return $img;
			}
		}
		return 'bg.jpg';
	}

	private function withCategory($blogRow)
	{
		$cate = $this->db->row("SELECT * FROM `category` WHERE `c_id` = " . $this->db->q($blogRow['b_cate']));
		return $blogRow + array('c_name' => $cate ? $cate['c_name'] : null);
	}

	/** views/pages/index.php */
	private function homeData()
	{
		$db = $this->db;
		$city = $this->currentCity();

		$headlines = array();
		foreach ($db->rows("SELECT `b_id`, `b_title`, `b_cate` FROM `blog` WHERE `b_status` = '1'") as $row) {
			$headlines[] = $this->withCategory($row);
		}
		if (!$headlines && ($row = $db->row("SELECT `b_id`, `b_title`, `b_cate` FROM `blog` WHERE `b_id` = '1'"))) {
			$headlines[] = $this->withCategory($row) + array('fallback' => true);
		}

		$loc = $db->q($this->company()['city']);
		$counts = array();
		foreach (array(
			'Hotel' => "l_category LIKE '%Hotel%' or l_category LIKE '%Resort%' AND l_city = $loc",
			'Hospital' => "l_category LIKE '%Hospital%' AND l_city = $loc",
			'Transportation' => "l_category LIKE '%Transport%' AND l_city = $loc",
			'Property' => "l_category LIKE '%Property%' AND l_city = $loc",
			'Automobile' => "l_category LIKE '%Automobile%' AND l_city = $loc",
			'Electronics' => "l_category LIKE '%Electronics%' AND l_city = $loc",
			'Education' => "l_category LIKE '%Education%' AND l_city = $loc",
			'Sport' => "l_category LIKE '%Sport%' AND l_city = $loc",
		) as $name => $where) {
			$counts[$name] = $db->count("SELECT * FROM `listing` WHERE $where");
		}

		$trending = array();
		foreach ($db->rows("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = " . $db->q($city) . " ORDER BY `l_visitor` DESC LIMIT 8") as $row) {
			$trending[] = $row + array(
				'urlTitle' => self::urlTitle($row['l_title']),
				'cateImage' => $this->thumbnailUrl($row['l_category'], $row['l_img']),
				'rating' => $this->rating($row['l_id']),
				'reviews' => $this->reviewCount($row['l_id']),
				'likes' => $this->likeCount($row['l_id']),
			);
		}

		return array(
			'headlines' => $headlines,
			'ads' => $this->ads(1, 1),
			'cinemas' => $db->rows("SELECT * FROM `cinemas`"),
			'blogs' => $db->rows("SELECT `b_id`, `b_title`, `b_image` FROM `blog` WHERE `b_status` = '1' ORDER BY b_id DESC LIMIT 6"),
			'serviceCounts' => $counts,
			'trending' => $trending,
			'videos' => $db->rows("SELECT * FROM `youtube_videos` WHERE `yv_status` = '1' ORDER BY yv_id desc"),
			'attractions' => $db->rows("SELECT * FROM `top_attractions` WHERE `ta_status` = '1' ORDER BY RAND()"),
		);
	}

	/** views/pages/list.php (the results themselves come from listings()). */
	private function listData($categoryId)
	{
		$db = $this->db;
		$catee = htmlspecialchars($categoryId);
		$cateeShow = str_replace('-', ' ', $catee);
		$locName = $this->currentCity();

		$premium = array();
		foreach ($db->rows("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = " . $db->q($locName) . " AND `l_category` LIKE " . $db->like($catee) . " ORDER BY RAND() LIMIT 10") as $row) {
			$premium[] = $row + array('rating' => $this->rating($row['l_id']));
		}
		$cate = $db->row("SELECT * FROM `category` WHERE `c_name` = " . $db->q($cateeShow));

		return array(
			'catee' => $catee,
			'cateeShow' => $cateeShow,
			'locName' => $locName,
			'premium' => $premium,
			'adsLeft' => $this->ads(2, 3),
			'adsRight' => $this->ads(2, 2),
			'cateWideUrl' => $this->wideUrl($cateeShow),
			'subCategories' => $db->rows("SELECT * FROM `sub_category` WHERE `c_id` = " . $db->q($cate ? $cate['c_id'] : '')),
		);
	}

	/**
	 * One page of list results (Pages::getCategoryList() / Company_Model::listingData()):
	 * category, sub category (subcate), feature (feas) and rating filters.
	 */
	public function listings($post)
	{
		$db = $this->db;
		$get = function ($key) use ($post) {
			return isset($post[$key]) ? (string) $post[$key] : '';
		};
		$subCate = $get('subcate');
		$feas = $get('feas');
		$ratings = $get('ratings');
		$start = max(0, (int) $get('start'));
		$limit = (int) $get('limit');
		if ($limit < 1 || $limit > 100) {
			$limit = 10;
		}
		$cateeShow = str_replace('-', ' ', htmlspecialchars($get('categoryName')));
		$company = $this->company();

		$inPlace = $company['city'] != ''
			? "`l_city` = " . $db->q($company['city'])
			: "`l_loc_id` = " . $db->q(($loc = $db->row("SELECT * FROM `location` WHERE `loc_name` = " . $db->q($get('cityName')))) ? $loc['loc_id'] : '');
		$subCateWhere = "FIND_IN_SET(l_subcategory, " . $db->q(urldecode(str_replace('-', ' ', $subCate))) . ") > 0";
		$features = '';
		foreach (explode(',', $feas) as $feature) {
			$map = array(
				'trusted' => " AND l_trusted = '1'", 'premium' => " AND l_type != 'free'", 'verified' => " AND l_verified = '1'",
				'trending' => " AND l_visitor != '0'", 'offers' => " AND l_visitor != '0'", 'latest' => " AND l_visitor != '0'",
				'likes' => " AND l_visitor != '0'",
			);
			$features .= isset($map[$feature]) ? $map[$feature] : '';
		}
		$rating = (int) $ratings; // the first ticked rating ("5,4" -> 5)
		$ratingBand = array(5 => '`l_rating` >= 4', 4 => '`l_rating` BETWEEN 3 AND 4', 3 => '`l_rating` BETWEEN 2 AND 3', 2 => '`l_rating` BETWEEN 1 AND 2', 1 => '`l_rating` = 1');
		$category = "(`l_category` LIKE " . $db->like($cateeShow) . ")";
		$active = "AND `l_status` = 'active'";

		if ($subCate !== '' && $feas !== '' && $ratings !== '') {
			$where = "$category OR ($subCateWhere) AND $inPlace $active $features";
		} elseif ($subCate !== '' && $feas === '' && $ratings !== '') {
			$where = "$category OR ($subCateWhere) AND $inPlace $active AND `l_rating` >= $rating";
		} elseif ($subCate !== '' && $feas === '' && $ratings === '') {
			$where = "$category OR ($subCateWhere) AND $inPlace $active";
		} elseif ($subCate === '' && $feas === '' && $ratings !== '') {
			$band = isset($ratingBand[$rating]) ? $ratingBand[$rating] : '1 = 1';
			$where = "$category AND $inPlace $active AND $band";
		} elseif ($subCate === '' && $feas !== '' && $ratings === '') {
			$where = "$category AND $inPlace $active $features";
		} else {
			$like = $db->like($cateeShow);
			$where = "(`l_category` LIKE $like OR `l_subcategory` LIKE $like OR `l_title` LIKE $like) AND $inPlace $active";
		}

		$rows = array();
		foreach ($db->rows("SELECT * FROM `listing` WHERE $where ORDER BY `l_show` DESC, `l_id` DESC LIMIT $start, $limit") as $row) {
			$rows[] = $row + array(
				'urlTitle' => self::urlTitle($row['l_title']),
				'cateImage' => $this->thumbnailUrl($row['l_category'], $row['l_img']),
				'rating' => $this->rating($row['l_id']),
				'reviews' => $this->reviewCount($row['l_id']),
			);
		}
		return $rows;
	}

	/** views/pages/listing-details.php */
	private function listingDetailsData($categoryId, $lastId)
	{
		$db = $this->db;
		$locName = str_replace('-', ' ', $this->currentCity());
		$listing = $db->row("SELECT * FROM `listing` WHERE `l_id` = " . $db->q($lastId));
		if (!$listing) {
			return array('redirect' => $this->baseUrl() . $locName . '/' . urlencode($categoryId));
		}
		$id = $listing['l_id'];
		$eid = $db->q($id);

		$area = $db->rows("SELECT * FROM `location` WHERE `loc_id` = " . $db->q($listing['l_loc_id']));
		$locRows = $area ?: $db->rows("SELECT * FROM `location` WHERE `loc_city` = " . $db->q($this->company()['city']));

		$cateNo = $db->row("SELECT * FROM `category` WHERE `c_name` = " . $db->q($listing['l_category'] != '' ? $listing['l_category'] : 'Education'));
		$cateId = $cateNo ? $cateNo['c_id'] : '';
		$adsCate = $db->row("SELECT * FROM `category` WHERE `c_id` = " . $db->q($cateId) . " AND `c_adsImage` != ''");

		$uid = Session::get('uid');
		$liked = $uid && $db->count("SELECT * FROM `favorites_likes` WHERE `l_id` = $eid AND `user_id` = " . $db->q($uid)) > 0;
		$reviewed = $uid && $db->count("SELECT * FROM `reviews` WHERE `r_postid` = $eid AND `r_reviewid` = " . $db->q($uid)) > 0;

		$byStar = array();
		foreach (array(5, 4, 3, 2, 1) as $star) {
			$byStar[$star] = $db->count("SELECT * FROM `reviews` WHERE `r_postid` = $eid AND `r_status` = 'active' AND `r_rating` = '$star'");
		}

		// "You Might Like this": same first category, this city
		$firstCategory = explode(', ', (string) $listing['l_category']);
		$related = array();
		foreach ($db->rows("SELECT * FROM `listing` WHERE `l_category` LIKE " . $db->like($firstCategory[0]) . " AND `l_id` != $eid AND `l_status` = 'active' AND `l_city` = " . $db->q($locName) . " ORDER BY `l_show` DESC LIMIT 15") as $row) {
			$loc = $db->rows("SELECT * FROM `location` WHERE `loc_id` = " . $db->q($row['l_loc_id']));
			$locRow = $loc ? end($loc) : null;
			$related[] = $row + array(
				'urlTitle' => self::urlTitle($row['l_title']),
				'rating' => $this->rating($row['l_id']),
				'locFound' => (bool) $locRow,
				'loc_name' => $locRow ? $locRow['loc_name'] : null,
				'loc_city' => $locRow ? $locRow['loc_city'] : null,
			);
		}

		return array(
			'listing' => $listing,
			'locName' => $locName,
			'locRow' => $locRows ? end($locRows) : null,
			'area' => $area ? end($area) : null,
			'rating' => $this->rating($id),
			'reviewCount' => $this->reviewCount($id),
			'likes' => $this->likeCount($id),
			'liked' => $liked,
			'alreadyReviewed' => $reviewed,
			'coverImage' => $this->coverImage($listing, true),
			'adsTop' => $this->ads(3, 2, $cateId),
			'adsSide' => $this->ads(3, 3, $cateId),
			'cateAdsImage' => $adsCate ? $adsCate['c_adsImage'] : null,
			'cateWideUrl' => $this->wideUrl($cateNo ? $cateNo['c_name'] : ''),
			'products' => $db->rows("SELECT * FROM `product` WHERE `list_id` = $eid"),
			'reviews' => $this->reviews($id, 0, 'r_id'),
			'reviewsByStar' => $byStar,
			'related' => $related,
		);
	}

	/** Five reviews as the review list shows them (the reviewer's own name/photo, or the signed-in user's). */
	public function reviews($listingId, $offset, $orderBy = 'r_date')
	{
		$db = $this->db;
		$orderBy = $orderBy === 'r_id' ? 'r_id' : 'r_date';
		$offset = max(0, (int) $offset);
		$out = array();
		foreach ($db->rows("SELECT * FROM `reviews` WHERE `r_postid` = " . $db->q($listingId) . " AND `r_status` = 'active' ORDER BY `$orderBy` DESC LIMIT $offset, 5") as $r) {
			$name = $r['r_fullname'];
			$image = $r['r_image'];
			if ($r['r_reviewid'] != 0) {
				$user = $db->row("SELECT * FROM `users` WHERE `u_id` = " . $db->q($r['r_reviewid']));
				$name = $user ? $user['u_fullname'] : '';
				$image = $user ? $user['u_img'] : '';
			}
			$out[] = array(
				'r_id' => $r['r_id'],
				'name' => $name,
				'image' => $image,
				'r_rating' => $r['r_rating'],
				'r_message' => $r['r_message'],
				'date' => date('d F Y', strtotime($r['r_date'])),
			);
		}
		return $out;
	}

	/** trendings.php: the most visited paid listings, 10 per page. */
	private function trendingsData($pageno)
	{
		$city = $this->currentCity();
		$pageno = max(1, (int) $pageno);
		$totalPages = 10;
		$listings = array();
		foreach ($this->db->rows("SELECT * FROM `listing` WHERE `l_type` != 'free' AND `l_status` = 'active' AND `l_city` = " . $this->db->q($city) . " ORDER BY `l_visitor` DESC LIMIT " . (($pageno - 1) * 10) . ", 10") as $row) {
			$listings[] = $row + array(
				'title2' => str_replace(' ', '-', $row['l_title']),
				'stringSocial' => self::shorten($row['l_title'], 35),
				'stringSocialL' => self::shorten($row['l_category'], 40),
				'stringSocialA' => self::shorten($row['l_address'], 50),
				'cateImage' => $this->thumbnailUrl($row['l_category'], $row['l_img']),
				'rating' => $this->rating($row['l_id']),
				'reviews' => $this->reviewCount($row['l_id']),
				'likes' => $this->likeCount($row['l_id']),
			);
		}

		$html = '<li class="' . ($pageno <= 1 ? 'disabled' : '') . '"><a href="' . ($pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1)) . '"><i class="material-icons">chevron_left</i></a> </li>';
		$skipped = false;
		for ($i = 1; $i <= $totalPages; $i++) {
			$html .= '<li class="waves-effect ' . ($pageno == $i ? 'active' : '') . ' ';
			if ($i < 2 || $totalPages - $i < 2 || abs($pageno - $i) < 2) {
				$html .= '">' . ($skipped ? '<a><span> ... </span></a>' : '') . ' <a href="?pageno=' . $i . '" >' . $i . '</a>';
				$skipped = false;
			} else {
				$skipped = true;
			}
			$html .= '</li>';
		}
		$html .= '<li class="' . ($pageno >= $totalPages ? 'disabled' : '') . ' waves-effect"><a href="' . ($pageno >= $totalPages ? '#' : '?pageno=' . ($pageno + 1)) . '"><i class="material-icons">chevron_right</i></a> </li>';

		return array('city' => $city, 'listings' => $listings, 'pagination' => $html);
	}

	/** Page links of nearby-listings.php, new-business.php and customer-reviews.php (5 pages of 12). */
	private function numberedPages($page, $slug)
	{
		$html = '';
		for ($i = max(1, $page - 5); $i <= min(5, $page + 5); $i++) {
			$html .= $i == $page
				? '<li class="active"><a href="#!"> ' . $i . '</a>'
				: "<li class='waves-effect'><a href=" . $this->baseUrl() . $slug . '?page=' . $i . '>' . $i . '</a></li>';
		}
		return $html;
	}

	/** nearby-listings.php / new-business.php: the newest listings, 12 per page. */
	private function latestListingsData($slug, $page)
	{
		$page = max(1, (int) $page);
		$listings = array();
		foreach ($this->db->rows("SELECT * FROM `listing` WHERE `l_status` = 'active' ORDER BY `l_id` DESC LIMIT " . (($page - 1) * 12) . ", 12") as $row) {
			$listings[] = $row + array(
				'title2' => str_replace(' ', '-', $row['l_title']),
				'coverImage' => $this->coverImage($row, false),
				'rating' => $this->rating($row['l_id']),
			);
		}
		return array('city' => $this->currentCity(), 'listings' => $listings, 'pagination' => $this->numberedPages($page, $slug));
	}

	/** customer-reviews.php: the newest reviews, 12 per page. */
	private function customerReviewsData($page)
	{
		$db = $this->db;
		$page = max(1, (int) $page);
		$reviews = array();
		foreach ($db->rows("SELECT * FROM `reviews` WHERE `r_status` = 'active' ORDER BY `r_id` DESC LIMIT " . (($page - 1) * 12) . ", 12") as $r) {
			$listing = $db->row("SELECT * FROM `listing` WHERE `l_id` = " . $db->q($r['r_postid'])) ?: array();
			$user = $db->row("SELECT * FROM `users` WHERE `u_id` = " . $db->q($r['r_userid'])) ?: array();
			$rate = $db->row("SELECT avg(r_rating) AS avg_rating FROM `reviews` WHERE `r_id` = " . $db->q($r['r_id']));
			$title = isset($listing['l_title']) ? $listing['l_title'] : '';
			$reviews[] = array(
				'r_id' => $r['r_id'],
				'r_fullname' => $r['r_fullname'],
				'u_img' => isset($user['u_img']) ? $user['u_img'] : '',
				'u_fullname' => isset($user['u_fullname']) ? $user['u_fullname'] : '',
				'userReviews' => $r['r_userid'] == '0' ? '1' : $db->count("SELECT * FROM `reviews` WHERE `r_userid` = " . $db->q($r['r_userid'])),
				'rating' => number_format((float) $rate['avg_rating'], 1),
				'message' => self::shorten($r['r_message'], 120),
				'l_img' => isset($listing['l_img']) ? $listing['l_img'] : '',
				'l_title' => $title,
				'listingTitle' => $title != '' ? self::shorten($title, 25) : 'NONE',
				'l_city' => isset($listing['l_city']) ? $listing['l_city'] : '',
			);
		}
		return array('reviews' => $reviews, 'pagination' => $this->numberedPages($page, 'customer-reviews'));
	}

	/** blog.php / events.php: the latest 25 posts with a 300-character excerpt. */
	private function blogPosts($withCategory)
	{
		$posts = array();
		foreach ($this->db->rows("SELECT * FROM `blog` WHERE `b_status` = '1' ORDER BY `b_id` DESC LIMIT 25") as $row) {
			$excerpt = self::shorten($row['b_message'], 300);
			$post = $row + array(
				'date' => date('M d, Y', strtotime($row['b_date'])),
				'excerpt' => $excerpt,
				'excerptDecoded' => html_entity_decode($excerpt),
			);
			$posts[] = $withCategory ? $this->withCategory($post) : $post;
		}
		return $posts;
	}

	/** blog-content.php / events-content.php */
	private function blogPost($id, $withCategory)
	{
		$row = $this->db->row("SELECT * FROM `blog` WHERE `b_id` = " . $this->db->q($id));
		if (!$row) {
			return null;
		}
		$post = $row + array(
			'date' => date('M d, Y', strtotime($row['b_date'])),
			'messageDecoded' => html_entity_decode($row['b_message']),
		);
		return $withCategory ? $this->withCategory($post) : $post;
	}

	/** sitemap.php: every category with its listing count in the company city (one query). */
	private function sitemapCategories()
	{
		$city = $this->db->q($this->company()['city']);
		$categories = $this->db->rows("SELECT * FROM category ORDER BY `c_name` asc");
		$listings = $this->db->rows("SELECT `l_category` FROM `listing` WHERE `l_city` = $city AND `l_status` = 'active'");
		foreach ($categories as &$cate) {
			$count = 0;
			foreach ($listings as $l) {
				if ($cate['c_name'] === '' || stripos((string) $l['l_category'], $cate['c_name']) !== false) {
					$count++;
				}
			}
			$cate['count'] = $count;
		}
		return $categories;
	}

	/** advertise.php: banner sizes with a price per page (100 when none is set). */
	private function advertisePrices()
	{
		$db = $this->db;
		$pages = $db->rows("SELECT * FROM `ads_pagename` WHERE `status` = '1'");
		$ads = array();
		foreach ($db->rows("SELECT * FROM `advertise` WHERE `status` = '1'") as $ad) {
			$prices = array();
			foreach ($pages as $page) {
				$amount = $db->row("SELECT * FROM `ads_withpage` WHERE `adsId` = " . $db->q($ad['id']) . " AND `pageId` = " . $db->q($page['id']));
				$prices[] = array('name' => $page['name'], 'amount' => $amount ? $amount['amount'] : '100');
			}
			$ads[] = $ad + array('prices' => $prices);
		}
		return $ads;
	}

	/* ---- search and likes ---- */

	/** Autocomplete (pages/response.php): listings/categories for "title", area names for "city". */
	public function suggest($type, $q)
	{
		$db = $this->db;
		if ($type === 'city') {
			$like = $db->like($q, false, true);
			$rows = $db->rows("SELECT `loc_state` AS `area` FROM `location` WHERE `loc_state` LIKE $like GROUP BY `loc_state` UNION ALL SELECT `loc_city` AS `area` FROM `location` WHERE `loc_city` LIKE $like GROUP BY `loc_city` UNION ALL SELECT `loc_name` AS `area` FROM `location` WHERE `loc_name` LIKE $like ORDER BY `area` ASC LIMIT 10");
			return array_column($rows, 'area');
		}
		$like = $db->like(urldecode($q));
		return $db->rows("SELECT `c_name` AS fullname, `c_visitor` AS visitor, `c_id` AS id, 'category' AS table_name FROM `category` WHERE `c_name` LIKE $like UNION ALL SELECT `name` AS fullname, `s_id` AS id, `visitor` AS visitor, 'sub_category' AS table_name FROM `sub_category` WHERE `name` LIKE $like UNION ALL SELECT `l_title` AS fullname, `l_visitor` AS visitor, `l_id` AS id, 'listing' AS table_name FROM `listing` WHERE `l_title` LIKE $like AND l_status = 'active' ORDER BY `visitor` DESC LIMIT 10");
	}

	/** Where a search goes (pages/list-ajax.php); stores the choice in the session. */
	public function searchRedirect($categoryNm, $cityNm)
	{
		$db = $this->db;
		$title2 = $categoryNm != '' ? str_replace(' ', '-', $categoryNm) : 'Education';
		$title3 = $categoryNm != '' ? str_replace('-', ' ', $title2) : '';
		$city2 = str_replace(' ', '-', $cityNm != '' ? $cityNm : $this->company()['city']);
		Session::set('title', $title2);
		Session::set('city', $city2);
		Session::set('cate', '');

		if ($title3 === '') {
			return $this->baseUrl() . $city2;
		}
		$isCategory = $db->count("SELECT * FROM `category` WHERE `c_name` = " . $db->q($title3) . " AND `c_status` = 'active'") > 0
			|| $db->count("SELECT * FROM `sub_category` WHERE `name` = " . $db->q($title3) . " AND `status` = '1'") > 0;
		$listing = $isCategory ? null : $db->row("SELECT * FROM `listing` WHERE `l_title` = " . $db->q($title3) . " AND `l_status` = 'active'");
		if ($listing && $listing['l_loc_id'] != '') {
			$loc = $db->row("SELECT * FROM `location` WHERE `loc_id` = " . $db->q($listing['l_loc_id']));
			return $this->baseUrl() . ($loc ? $loc['loc_name'] : '') . '/' . $title2;
		}
		return $this->baseUrl() . $city2 . '/' . $title2;
	}

	/** Pages::post_like() for the signed-in visitor. */
	public function like($listingId)
	{
		$db = $this->db;
		$uid = Session::get('uid');
		if (!$uid) {
			return 'Please login to like';
		}
		if ($db->count("SELECT * FROM `favorites_likes` WHERE `user_id` = " . $db->q($uid) . " AND `l_id` = " . $db->q($listingId)) > 0) {
			return 'Already Liked';
		}
		$db->exec("INSERT INTO `favorites_likes` (`user_id`, `l_id`) VALUES (" . $db->q(trim($uid)) . ", " . $db->q(trim($listingId)) . ")");
		return 'Successfully Liked';
	}
}

/* ======================================================================== */
/* HTTP                                                                     */
/* ======================================================================== */

final class App
{
	/**
	 * Handles the request. Returns the path of the PHP site's index.php when
	 * that site should answer instead (it is run at the end of this file, in
	 * the global scope CodeIgniter expects).
	 */
	public static function run()
	{
		$path = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH) ?: '/';
		$isApi = (bool) preg_match('#^/api/([A-Za-z]+)/?$#', $path, $m);

		try {
			if ($isApi) {
				self::api($m[1]);
			} else {
				return self::page($path);
			}
		} catch (\Throwable $e) {
			error_log('[vellore-app] ' . $e->getMessage());
			$message = Config::get('DEBUG') ? $e->getMessage() : 'Server error';
			if ($isApi) {
				self::json(array('error' => $message), 500);
			} else {
				http_response_code(500);
				header('Content-Type: text/plain; charset=utf-8');
				echo $message;
			}
		}
		return null;
	}

	/**
	 *   GET  /api/bootstrap                  site data + session
	 *   GET  /api/state?path=/Vellore/Hotel  page for a URL: { resolved, data, session }
	 *   GET  /api/suggest?type=title|city&q= search autocomplete
	 *   POST /api/search                     categoryNm, cityNm -> { redirect }
	 *   POST /api/listings                   list page results
	 *   GET  /api/reviews?listing=&offset=   next 5 reviews
	 *   POST /api/like                       listing -> { message }
	 */
	private static function api($endpoint)
	{
		$get = function ($key) {
			return isset($_GET[$key]) ? (string) $_GET[$key] : '';
		};
		$post = function ($key) {
			return isset($_POST[$key]) ? (string) $_POST[$key] : '';
		};
		$db = new Db();
		$site = new Site($db);
		Session::start();

		switch ($endpoint) {
			case 'bootstrap':
				self::json($site->bootstrap());
				break;
			case 'state':
				$page = $site->resolve($get('path') !== '' ? $get('path') : '/');
				self::json(array('resolved' => $page['resolved'], 'data' => $page['data'], 'session' => $site->session()), $page['status']);
				break;
			case 'suggest':
				self::json($site->suggest($get('type'), $get('q')));
				break;
			case 'search':
				self::json(array('redirect' => $site->searchRedirect($post('categoryNm'), $post('cityNm'))));
				break;
			case 'listings':
				self::json($site->listings($_POST));
				break;
			case 'reviews':
				self::json($site->reviews($get('listing'), $get('offset')));
				break;
			case 'like':
				self::json(array('message' => $site->like($post('listing'))));
				break;
			default:
				self::json(array('error' => 'Unknown endpoint'), 404);
		}
		session_write_close();
		$db->close();
	}

	/** A page load: the React app with this URL's data, or the PHP site's page. */
	private static function page($path)
	{
		$db = new Db();
		$site = new Site($db);
		Session::start();
		$query = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? '?' . $_SERVER['QUERY_STRING'] : '';
		$page = $site->resolve($path . $query);
		$resolved = $page['resolved'];

		if ($resolved['view'] === 'legacy') {
			session_write_close();
			$db->close();
			return self::phpSiteFrontController();
		}
		if ($resolved['view'] === 'redirect') {
			session_write_close();
			header('Location: ' . $resolved['redirect'], true, 302);
			return null;
		}

		$state = array('bootstrap' => $site->bootstrap(), 'resolved' => $resolved, 'data' => $page['data']);
		$company = $site->company();
		session_write_close();
		$db->close();

		$template = __DIR__ . '/index.html';
		if (!is_file($template)) {
			throw new \RuntimeException('index.html is missing: upload the whole dist/ folder (npm run build).');
		}
		$html = file_get_contents($template);
		$html = str_replace('<!--app-head-->', self::headTags($resolved['meta'], $company, $path), $html);
		// "<" is escaped, so text in the data cannot close the script tag
		$json = json_encode($state, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_INVALID_UTF8_SUBSTITUTE);
		$html = str_replace('<!--app-state-->', '<script>window.__VELLORE_STATE__ = ' . $json . ';</script>', $html);

		http_response_code($page['status']);
		header('Content-Type: text/html; charset=utf-8');
		echo $html;
		return null;
	}

	/** Prepares this request for the PHP site's own front controller (CodeIgniter index.php). */
	private static function phpSiteFrontController()
	{
		$root = Config::siteRoot();
		$front = $root . '/index.php';
		if (!is_file($front)) {
			throw new \RuntimeException("The PHP site's index.php was not found in $root (set SITE_ROOT in config.php).");
		}
		$_SERVER['SCRIPT_NAME'] = '/index.php';
		$_SERVER['PHP_SELF'] = '/index.php';
		$_SERVER['SCRIPT_FILENAME'] = $front;
		chdir($root);
		return $front;
	}

	/** The per-page tags templates/header.php printed. */
	private static function headTags($meta, $c, $path)
	{
		$e = function ($s) {
			return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
		};
		$segs = array_values(array_filter(explode('/', $path), 'strlen'));
		$canonical = Config::baseUrl() . implode('/', array_slice($segs, 0, 2));
		return implode("\n\t", array(
			'<title>' . $e($meta['title']) . '</title>',
			'<meta name="description" content="' . $e($meta['description']) . '" />',
			'<meta name="keywords" content="' . $e($meta['keywords']) . '" />',
			'<link rel="alternate" href="' . $e($c['web']) . '" hreflang="en-us" />',
			'<meta name="author" content="' . $e($c['domain']) . '" />',
			'<meta name="copyright" content="' . $e($c['domain']) . '" />',
			'<meta name="Redback Studios" content="' . $e($c['cName']) . '">',
			'<meta property="og:site_name" content="' . $e($c['domain']) . '"/>',
			'<meta property="og:title" content="' . $e($meta['pageTitle']) . '"/>',
			'<meta property="og:description" content="' . $e($c['description']) . '"/>',
			'<meta property="og:image" content="' . $e($c['web']) . '/assets/images/logo-header.png">',
			'<meta property="og:url" content="' . $e($c['web']) . '"/>',
			'<meta property="al:ios:url" content="' . $e($c['web']) . '/" />',
			'<link rel="canonical" href="' . $e($canonical) . '">',
			'<meta name="twitter:url" content="' . $e($c['web']) . '/" >',
			'<meta name="twitter:site" content="@' . $e($c['cName']) . '"/>',
			'<meta name="twitter:title" content="' . $e($meta['pageTitle']) . '" >',
			'<meta name="twitter:description" content="' . $e($c['description']) . '"/>',
			'<meta name="twitter:image" content="' . $e($c['web']) . '/assets/images/logo.png" >',
			'<meta name="twitter:domain" content="' . $e($c['cName']) . '"/>',
			'<meta name="Publisher" content="' . $e($c['cName']) . ' (' . $e($c['website']) . ')" />',
		));
	}

	private static function json($value, $status = 200)
	{
		http_response_code($status);
		header('Content-Type: application/json; charset=utf-8');
		header('Cache-Control: no-store');
		echo json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
	}
}

$phpSiteFrontController = App::run();
if ($phpSiteFrontController !== null) {
	// a page only the PHP site has: let it answer, exactly as it did before
	require $phpSiteFrontController;
}
