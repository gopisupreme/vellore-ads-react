<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/React_pages.php';
require_once APPPATH . 'helpers/listing_form_helper.php';

/**
 * JSON data of the admin panel's React pages (connect/api_data/<page>, see
 * app/pages.json "connect"). Each _data_<page>() runs the queries the PHP
 * view (views/connect/<page>.php) ran; the forms still post to Connect's
 * handlers. Every page is for administrators only.
 */
trait Connect_pages
{
	use React_pages;

	/** The signed-in administrator's row, or null. */
	private function _admin()
	{
		if (!$this->session->userdata('login') || $this->session->userdata('type') != 'admin') {
			return null;
		}
		$user = $this->User_Model->getuserInfo($this->session->userdata('uid'));
		if ($user) {
			unset($user['u_password'], $user['u_token']); // never sent to the browser
		}
		return $user;
	}

	/** What every admin page shows around its content (views/admin/header.php): the user and the menu's counts. */
	private function _admin_page($data)
	{
		$count = function ($sql) {
			return (int) $this->db->query($sql)->row()->n;
		};
		$company = $this->db->query("SELECT adminLogo FROM `companyinfo` WHERE `id` = '1'")->row_array();
		$data['admin'] = array(
			'logo' => $company ? $company['adminLogo'] : '',
			'counts' => array(
				'users' => $count("SELECT COUNT(*) n FROM `users`"),
				'category' => $count("SELECT COUNT(*) n FROM `category`"),
				'listing' => $count("SELECT COUNT(*) n FROM `listing`"),
				'matrimony' => $count("SELECT COUNT(*) n FROM `matrimony`"),
				'matrimonyCategory' => $count("SELECT COUNT(*) n FROM `category_matrimony`"),
				'spa' => $count("SELECT COUNT(*) n FROM `spa`"),
				'spaCategory' => $count("SELECT COUNT(*) n FROM `category_spa`"),
				'reviews' => $count("SELECT COUNT(*) n FROM `reviews`"),
				'location' => $count("SELECT COUNT(*) n FROM `location`"),
				'post' => $count("SELECT COUNT(*) n FROM `post_ad`"),
				'customers' => $count("SELECT COUNT(*) n FROM `users` WHERE `u_type`='customer'"),
			),
		);
		return $data;
	}

	/** Sends anyone but an administrator to the sign-in page (redirect() exits). */
	private function _admin_only()
	{
		if (!$this->session->userdata('login') || $this->session->userdata('type') != 'admin') {
			redirect('users/login');
		}
	}

	/**
	 * POST connect/action_category (and _matrimony, _spa, action_job_category):
	 * action=<status>&id=<id> switches the status and answers
	 * {"action": new status, "id"}; deletelisting=<id> deletes and answers the id
	 * (views/connect/action-category.php did this without any sign-in check).
	 */
	private function _category_action($table)
	{
		$this->_admin_only();
		$action = $this->input->post('action');
		$id = $this->input->post('id');
		$delete = $this->input->post('deletelisting');
		if ($action !== null && $id !== null) {
			$next = $action === 'active' ? 'inactive' : ($action === 'inactive' ? 'active' : null);
			$result = array();
			if ($next) {
				$this->db->where('c_id', $id)->update($table, array('c_status' => $next));
				$result = array('action' => $next, 'id' => $id);
			}
			echo json_encode($result);
		}
		if ($delete !== null && $delete !== '') {
			if ($this->db->where('c_id', $delete)->delete($table)) {
				echo $delete;
			}
		}
	}

	/** Runs `$build($user)` for an administrator; others go to the sign-in page, as the PHP pages did. */
	private function _admin_data($build)
	{
		if (!($user = $this->_admin())) {
			return array('redirect' => base_url() . 'users/login');
		}
		$data = $build($user);
		if (isset($data['redirect'])) {
			return $data;
		}
		$data['user'] = $user;
		return $this->_admin_page($data);
	}

	private function _q($sql)
	{
		return $this->db->query($sql)->result_array();
	}

	private function _row($sql)
	{
		$row = $this->db->query($sql)->row_array();
		return $row ?: null;
	}

	private function _e($value)
	{
		return $this->db->escape((string) $value);
	}

	/* ------------------------------------------------------------------ */

	/** connect/dashboard (views/connect/dashboard.php). */
	private function _data_dashboard($args)
	{
		return $this->_admin_data(function () {
			date_default_timezone_set('Asia/Calcutta');
			$today = $this->_e(date('Y-m-d'));
			$count = function ($sql) {
				return (int) $this->db->query($sql)->row()->n;
			};
			return array(
				'stats' => array(
					'listings' => $count("SELECT COUNT(*) n FROM listing"),
					'users' => $count("SELECT COUNT(*) n FROM users"),
					'categories' => $count("SELECT COUNT(*) n FROM category WHERE c_status = 'active'"),
					'reviews' => $count("SELECT COUNT(*) n FROM reviews"),
					'customers' => $count("SELECT COUNT(*) n FROM `users` WHERE `u_type`='customer'"),
					'posts' => $count("SELECT COUNT(*) n FROM post_ad"),
					'postReviews' => $count("SELECT COUNT(*) n FROM reviews_post"),
					'todayListings' => $count("SELECT COUNT(*) n FROM listing WHERE DATE(l_adddate) = $today"),
					'newUsers' => $count("SELECT COUNT(*) n FROM `users` WHERE DATE(u_date) = $today"),
					'todayViews' => $count("SELECT COUNT(*) n FROM `visitor_counter` WHERE DATE(date) = $today"),
				),
				'listings' => $this->_listing_rows('listing', "WHERE l.`l_status` = 'active' ORDER BY l.`l_visitor` DESC LIMIT 100"),
			);
		});
	}

	/**
	 * Rows of the admin listing tables (listing, matrimony, spa, post_ad):
	 * the listing, its plan's name and who added it (admin or user).
	 */
	private function _listing_rows($table, $where)
	{
		$rows = $this->_q("SELECT l.l_id, l.l_title, l.l_city, l.l_category, l.l_visitor, l.l_adddate, l.l_phone, l.l_type,
				l.l_status, l.l_verified, l.l_trusted, l.l_userid, p.name AS plan, u.u_type AS owner_type, u.u_fullname AS owner_name
			FROM `$table` l
			LEFT JOIN `premium` p ON p.name = l.l_type
			LEFT JOIN `users` u ON u.u_id = l.l_userid
			$where");
		foreach ($rows as &$r) {
			$r['added'] = $r['l_adddate'] ? date('d M Y', strtotime($r['l_adddate'])) : '';
			$phone = explode(',', (string) $r['l_phone']);
			$r['phone'] = $phone[0];
			unset($r['l_phone']);
		}
		return $rows;
	}

	/** kind => table of the admin listing tables (all_listing, all_matrimony, all_spa, all_post). */
	private static $itemTables = array('listing' => 'listing', 'matrimony' => 'matrimony', 'spa' => 'spa', 'post' => 'post_ad');

	/**
	 * The newest 25 items, or with ?after=<id>&limit=<n> the next n older ones
	 * (views/connect/get-all-<kind>.php, "start" and "fetch" / Load More).
	 */
	private function _items_page($kind)
	{
		return $this->_admin_data(function () use ($kind) {
			$after = (int) $this->input->get('after');
			$limit = (int) $this->input->get('limit');
			if (!in_array($limit, array(25, 50, 75, 100, 250, 500, 1000), true)) {
				$limit = 25;
			}
			$where = $after > 0 ? "WHERE l.l_id < $after " : '';
			return array('rows' => $this->_listing_rows(self::$itemTables[$kind], $where . "ORDER BY l.l_id DESC LIMIT $limit"));
		});
	}

	private function _data_all_listing($args)
	{
		return $this->_items_page('listing');
	}

	private function _data_all_matrimony($args)
	{
		return $this->_items_page('matrimony');
	}

	private function _data_all_spa($args)
	{
		return $this->_items_page('spa');
	}

	private function _data_all_post($args)
	{
		return $this->_items_page('post');
	}

	/** kind => [review table, item table] (views/connect/all-reviews*.php). */
	private static $reviewKinds = array(
		'listing' => array('reviews', 'listing'),
		'post' => array('reviews_post', 'post_ad'),
		'matrimony' => array('reviews_matri', 'matrimony'),
		'spa' => array('reviews_spa', 'spa'),
	);

	/** The latest 50 reviews of a kind (or all of one user's listing reviews) with their listing. */
	private function _review_rows($kind, $where = '', $limit = 'LIMIT 50')
	{
		list($table, $items) = self::$reviewKinds[$kind];
		return $this->_q("SELECT r.r_id, r.r_date, r.r_fullname, r.r_mobile, r.r_email, r.r_message, r.r_rating, r.r_status, r.r_postid,
				l.l_title, l.l_city
			FROM `$table` r LEFT JOIN `$items` l ON l.l_id = r.r_postid
			$where ORDER BY r.r_id DESC $limit");
	}

	private function _data_all_reviews($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_review_rows('listing'));
		});
	}

	private function _data_all_reviews_post($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_review_rows('post'));
		});
	}

	private function _data_all_reviews_matrimony($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_review_rows('matrimony'));
		});
	}

	private function _data_all_reviews_spa($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_review_rows('spa'));
		});
	}

	/** connect/all_user_review/<user id>: the reviews the user wrote. */
	private function _data_all_user_review($args)
	{
		return $this->_admin_data(function () use ($args) {
			$id = $this->_e(isset($args[0]) ? $args[0] : '');
			return array('rows' => $this->_review_rows('listing', "WHERE r.r_userid = $id", ''));
		});
	}

	/** connect/add_review: the form only. */
	private function _data_add_review($args)
	{
		return $this->_admin_data(function () {
			return array();
		});
	}

	/**
	 * Users of a type (views/connect/all-users.php, all-customers.php,
	 * all-new-users.php) with their listing, enquiry and review counts. The
	 * search forms' fields come as GET parameters (do=doRange|doName|doEmail|doMobile).
	 */
	private function _user_rows($type, $today = false)
	{
		$where = '`u_type` = ' . $this->_e($type);
		$order = 'ORDER BY `u_id` DESC LIMIT 100';
		$get = function ($name) {
			return (string) $this->input->get($name);
		};
		if ($today) {
			$where .= ' AND DATE(`u_date`) = ' . $this->_e(date('Y-m-d'));
			$order = 'ORDER BY `u_id` DESC';
		} elseif ($get('do') === 'doRange') {
			$where .= ' AND `u_date` BETWEEN ' . $this->_e($get('fromDate')) . ' AND ' . $this->_e($get('toDate'));
			$order = 'ORDER BY `u_date` ASC';
		} elseif ($get('do') === 'doName') {
			$where .= " AND `u_fullname` LIKE '%" . $this->db->escape_like_str($get('fullName')) . "%' ESCAPE '!'";
			$order = 'ORDER BY `u_date` ASC';
		} elseif ($get('do') === 'doEmail') {
			$where .= ' AND `u_email` = ' . $this->_e($get('email'));
			$order = 'ORDER BY `u_date` ASC';
		} elseif ($get('do') === 'doMobile') {
			$where .= ' AND `u_mobile` = ' . $this->_e($get('mobile'));
			$order = '';
		}
		$rows = $this->_q("SELECT u_id, u_fullname, u_email, u_mobile, u_img, u_date FROM `users` WHERE $where $order");
		$ids = array_map(function ($r) {
			return (int) $r['u_id'];
		}, $rows);
		$emails = array_map(function ($r) {
			return $this->_e($r['u_email']);
		}, $rows);
		$listings = $enquiries = $reviews = array();
		if ($ids) {
			$in = implode(',', $ids);
			foreach ($this->_q("SELECT l_userid k, COUNT(*) n FROM `listing` WHERE l_userid IN ($in) GROUP BY l_userid") as $r) {
				$listings[$r['k']] = (int) $r['n'];
			}
			foreach ($this->_q("SELECT r_userid k, COUNT(*) n FROM `reviews` WHERE r_userid IN ($in) GROUP BY r_userid") as $r) {
				$reviews[$r['k']] = (int) $r['n'];
			}
			foreach ($this->_q("SELECT email k, COUNT(*) n FROM `quick_service` WHERE email IN (" . implode(',', $emails) . ") GROUP BY email") as $r) {
				$enquiries[strtolower($r['k'])] = (int) $r['n'];
			}
		}
		foreach ($rows as &$r) {
			$r['listings'] = isset($listings[$r['u_id']]) ? $listings[$r['u_id']] : 0;
			$r['reviews'] = isset($reviews[$r['u_id']]) ? $reviews[$r['u_id']] : 0;
			$key = strtolower((string) $r['u_email']);
			$r['enquiries'] = isset($enquiries[$key]) ? $enquiries[$key] : 0;
		}
		return $rows;
	}

	private function _data_all_users($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_user_rows('listing'), 'me' => $this->session->userdata('email'));
		});
	}

	private function _data_new_users($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_user_rows('listing', true), 'me' => $this->session->userdata('email'));
		});
	}

	private function _data_all_customers($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_user_rows('customer'), 'me' => $this->session->userdata('email'));
		});
	}

	/** connect/all_user_listing/<user id>: the user's listings. */
	private function _data_all_user_listing($args)
	{
		return $this->_admin_data(function () use ($args) {
			$id = $this->_e(isset($args[0]) ? $args[0] : '');
			return array('rows' => $this->_listing_rows('listing', "WHERE l.`l_userid` = $id"));
		});
	}

	private function _data_add_user($args)
	{
		return $this->_admin_data(function () {
			return array();
		});
	}

	private function _data_add_customer($args)
	{
		return $this->_data_add_user($args);
	}

	/** connect/edit_user/<id> (and edit_customer): the user's row, without password or token. */
	private function _data_edit_user($args)
	{
		return $this->_admin_data(function () use ($args) {
			$row = $this->_row("SELECT u_id, u_fullname, u_email, u_mobile, u_dob, u_gender, u_address, u_img, u_type FROM `users` WHERE `u_id` = "
				. $this->_e(isset($args[0]) ? $args[0] : ''));
			return $row ? array('row' => $row) : array('redirect' => base_url() . 'connect/all_users');
		});
	}

	private function _data_edit_customer($args)
	{
		return $this->_data_edit_user($args);
	}

	/** connect/all_location: the locations with their active listing counts. */
	private function _data_all_location($args)
	{
		return $this->_admin_data(function () {
			$counts = array();
			foreach ($this->_q("SELECT l_loc_id k, COUNT(*) n FROM `listing` WHERE `l_status` = 'active' GROUP BY l_loc_id") as $r) {
				$counts[$r['k']] = (int) $r['n'];
			}
			$rows = $this->_q("SELECT loc_id, loc_name, loc_city, loc_state, loc_country FROM `location` ORDER BY `loc_name` ASC");
			foreach ($rows as &$r) {
				$r['listings'] = isset($counts[$r['loc_id']]) ? $counts[$r['loc_id']] : 0;
			}
			return array('rows' => $rows);
		});
	}

	private function _data_edit_location($args)
	{
		return $this->_admin_data(function () use ($args) {
			$row = $this->_row("SELECT * FROM `location` WHERE `loc_id` = " . $this->_e(isset($args[0]) ? $args[0] : ''));
			return $row ? array('row' => $row) : array('redirect' => base_url() . 'connect/all_location');
		});
	}

	/** Pages whose PHP view only showed a form: add_location, upload_listing ... */
	private function _data_form_only($args)
	{
		return $this->_admin_data(function () {
			return array();
		});
	}

	private function _data_add_location($args)
	{
		return $this->_data_form_only($args);
	}

	private function _data_upload_listing($args)
	{
		return $this->_data_form_only($args);
	}

	private function _data_upload_location($args)
	{
		return $this->_data_form_only($args);
	}

	/** connect/profile, profile_edit, change_password: the admin's own row (`user`) is all they show. */
	private function _data_profile($args)
	{
		return $this->_data_form_only($args);
	}

	private function _data_profile_edit($args)
	{
		return $this->_data_form_only($args);
	}

	private function _data_change_password($args)
	{
		return $this->_data_form_only($args);
	}

	/** connect/admin_setting: the company row the form edits. */
	private function _data_admin_setting($args)
	{
		return $this->_admin_data(function () {
			return array('company' => $this->_row("SELECT * FROM `companyinfo` WHERE `id` = '1'"));
		});
	}

	/** Tables edited in dialogs on their list page: premium plans, ad types, ad pages; and the contact messages. */
	private function _data_all_premium($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_q("SELECT * FROM `premium` ORDER BY `id` ASC"));
		});
	}

	private function _data_admin_ads_type($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_q("SELECT * FROM `advertise` ORDER BY `id` ASC"));
		});
	}

	private function _data_admin_ads_page($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_q("SELECT * FROM `ads_pagename` ORDER BY `id` ASC"));
		});
	}

	private function _data_all_contact($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_q("SELECT * FROM `contact_us` ORDER BY `date` DESC LIMIT 100"));
		});
	}

	/** connect/admin_ads and quick_ads (views/connect/admin-ads.php, quick-ads.php): the latest 50 ads. */
	private function _ads_rows($quick)
	{
		return $this->_q("SELECT a.id, a.date, a.title, a.fromDate, a.toDate, a.payment, a.status, p.name AS pageName, t.name AS typeName
			FROM `ads_with_us` a
			LEFT JOIN `ads_pagename` p ON p.id = a.adsPage
			LEFT JOIN `advertise` t ON t.id = a.adsType
			" . ($quick ? "WHERE a.`quick` = '1' " : '') . "ORDER BY a.`id` DESC LIMIT 50");
	}

	private function _data_admin_ads($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_ads_rows(false));
		});
	}

	private function _data_quick_ads($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_ads_rows(true));
		});
	}

	/** The choices of the ad forms (admin-ads-add.php / -edit.php); the edit form lists inactive pages and types too. */
	private function _ads_options($all)
	{
		$active = $all ? '' : "WHERE `status` = '1' ";
		return array(
			'users' => $this->_q("SELECT u_id, u_fullname, u_email FROM `users` ORDER BY `u_fullname` ASC"),
			'pages' => $this->_q("SELECT id, name FROM `ads_pagename` {$active}ORDER BY `id` ASC"),
			'showPages' => $this->_q("SELECT id, name FROM `ads_withpage` ORDER BY `id` ASC"),
			'types' => $this->_q("SELECT id, name, banner_size FROM `advertise` {$active}ORDER BY `id` ASC"),
			'receivers' => $this->_q("SELECT u_id, u_fullname FROM `users` WHERE `u_type` = 'admin'"),
			'paymentTypes' => $this->_q("SELECT id, name FROM `payment_type` WHERE `status` = '1'"),
		);
	}

	private function _data_admin_ads_add($args)
	{
		return $this->_admin_data(function () {
			return $this->_ads_options(false);
		});
	}

	private function _data_quick_ads_add($args)
	{
		return $this->_data_form_only($args);
	}

	/** An ad with its payment entry (accounts.insertId). */
	private function _ads_edit($args, $options, $back)
	{
		return $this->_admin_data(function () use ($args, $options, $back) {
			$id = $this->_e(isset($args[0]) ? $args[0] : '');
			$row = $this->_row("SELECT * FROM `ads_with_us` WHERE `id` = $id");
			if (!$row) {
				return array('redirect' => base_url() . $back);
			}
			$data = array('row' => $row, 'account' => $this->_row("SELECT * FROM `accounts` WHERE `insertId` = $id AND `description` = 'Advertisement' ORDER BY `aid` DESC LIMIT 1"));
			return $options ? $data + $this->_ads_options(true) : $data;
		});
	}

	private function _data_admin_ads_edit($args)
	{
		return $this->_ads_edit($args, true, 'connect/admin_ads');
	}

	private function _data_quick_ads_edit($args)
	{
		return $this->_ads_edit($args, false, 'connect/quick_ads');
	}

	/** connect/all_jobs (views/connect/all-jobs.php): the latest 100 jobs. */
	private function _data_all_jobs($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_q("SELECT id, company_name, position, job_desc, status, created_date FROM `job` ORDER BY `id` DESC LIMIT 100"));
		});
	}

	private function _data_add_job($args)
	{
		return $this->_data_form_only($args);
	}

	/** connect/edit_job/<id>: the job and the companies to choose from. */
	private function _data_edit_job($args)
	{
		return $this->_admin_data(function () use ($args) {
			$row = $this->_row("SELECT * FROM `job` WHERE `id` = " . $this->_e(isset($args[0]) ? $args[0] : ''));
			if (!$row) {
				return array('redirect' => base_url() . 'connect/all_jobs');
			}
			return array('row' => $row, 'companies' => $this->_q("SELECT id, company_name FROM `job_company`"));
		});
	}

	/** connect/all_applied_jobs: the job applications with the listing they were sent to. */
	private function _data_all_applied_jobs($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_q("SELECT a.*, l.l_title FROM `job_apply` a LEFT JOIN `listing` l ON l.l_id = a.job_post ORDER BY a.`id` DESC"));
		});
	}

	/** connect/all_product: every shop product (the owner page, src/pages/app/users/Products.jsx, shows them). */
	private function _data_all_product($args)
	{
		return $this->_admin_data(function () {
			$products = $this->_q("SELECT p_id, p_name, p_img, p_adddate, p_status FROM `product` ORDER BY p_id DESC");
			foreach ($products as &$r) {
				$r['added'] = $r['p_adddate'] ? date('d M Y', strtotime($r['p_adddate'])) : '';
			}
			return array('products' => $products);
		});
	}

	/** The choices of the product form (views/connect/add-product.php), and the product being edited. */
	private function _admin_product_form($productId = null)
	{
		return $this->_admin_data(function () use ($productId) {
			$data = array(
				'today' => date('Y-m-d'),
				'listings' => $this->_q("SELECT l_id, l_title FROM listing WHERE l_shopping = '1' ORDER BY l_adddate DESC"),
				'groups' => $this->_q("SELECT g_title FROM `groups` WHERE g_status = '1'"),
				'categories' => $this->_q("SELECT c_id, c_title FROM `categories` WHERE c_status = '1'"),
				'subcategories' => $this->_q("SELECT s_category, s_title FROM `sub_categories` WHERE s_status = '1' GROUP BY s_category, s_title ORDER BY MAX(s_id) DESC"),
				'brands' => $this->_q("SELECT b_title FROM `brand` WHERE b_status = '1'"),
			);
			if ($productId !== null) {
				$product = $this->db->get_where('product', array('p_id' => $productId))->row_array();
				if (!$product) {
					return array('redirect' => base_url() . 'connect/all_product');
				}
				foreach (array('p_color', 'p_stock', 'p_specification_label', 'p_specification_desc') as $json) {
					$product[$json] = json_decode((string) $product[$json], true) ?: array();
				}
				$data['product'] = $product;
			}
			return $data;
		});
	}

	private function _data_add_product($args)
	{
		return $this->_admin_product_form();
	}

	private function _data_edit_product($args)
	{
		return $this->_admin_product_form(isset($args[0]) ? $args[0] : '');
	}

	/** connect/all_order: paid or cash-on-delivery orders of every shop. */
	private function _data_all_order($args)
	{
		return $this->_admin_data(function () {
			return array('orders' => $this->_q("SELECT order_id, fname, lname, email, phone, total, payment_opt, created_dt FROM `rb_order_master_data`
				WHERE payment_opt = 'cod' OR (payment_opt = 'online' AND paid = '1') ORDER BY order_id DESC LIMIT 100"));
		});
	}

	private function _data_view_order($args)
	{
		return $this->_admin_data(function () use ($args) {
			$order = $this->db->get_where('rb_order_master_data', array('order_id' => isset($args[0]) ? $args[0] : ''))->row_array();
			if (!$order) {
				return array('redirect' => base_url() . 'connect/all_order');
			}
			return array('order' => $order, 'items' => $this->db->get_where('rb_order_details', array('order_id' => $order['order_id']))->result_array());
		});
	}

	/** Add forms of listings, matrimony, spa and post ads (views/connect/add-list.php ...): the plans to choose from. */
	private function _item_add_data()
	{
		return $this->_admin_data(function () {
			return array('premiums' => $this->_q("SELECT name FROM `premium` WHERE `status` = '1'"));
		});
	}

	/** Edit forms (views/connect/edit-list.php ...): any item, with the admin-only plan, shopping and online delivery fields. */
	private function _item_edit_admin($kind, $args)
	{
		return $this->_admin_data(function () use ($kind, $args) {
			list($table) = listing_form_kind($kind);
			$row = $this->db->get_where($table, array('l_id' => isset($args[0]) ? $args[0] : ''))->row_array();
			if (!$row) {
				return array('redirect' => base_url() . 'connect/all_' . ($kind === 'listing' ? 'listing' : $kind));
			}
			$item = listing_form_item($kind, $row);
			$item['type'] = $row['l_type'];
			$item['category'] = $row['l_category'];
			foreach (array('l_shopping', 'l_onlineLink1', 'l_onlineLink2', 'l_onlineLink3', 'l_onlineImage3') as $column) {
				$item[$column] = isset($row[$column]) ? $row[$column] : '';
			}
			return array('item' => $item, 'premiums' => $this->_q("SELECT name FROM `premium` WHERE `status` = '1'"));
		});
	}

	private function _data_add_list($args)
	{
		return $this->_item_add_data();
	}

	private function _data_add_matrimony($args)
	{
		return $this->_item_add_data();
	}

	private function _data_add_spa($args)
	{
		return $this->_item_add_data();
	}

	private function _data_add_post($args)
	{
		return $this->_item_add_data();
	}

	private function _data_edit_list($args)
	{
		return $this->_item_edit_admin('listing', $args);
	}

	private function _data_edit_matrimony($args)
	{
		return $this->_item_edit_admin('matrimony', $args);
	}

	private function _data_edit_spa($args)
	{
		return $this->_item_edit_admin('spa', $args);
	}

	private function _data_edit_post($args)
	{
		return $this->_item_edit_admin('post', $args);
	}

	/**
	 * connect/search_listing (and search_matrimony, search_spa, search_post):
	 * the search forms, and with ?do=formListing|formContact|formWebsite|formLocation
	 * the matching items (Connect_Model::formListingData() ..., which the
	 * search<Kind>List pages showed). Every filled field narrows the search;
	 * with none, the first 100 by date.
	 */
	private function _search_page($kind)
	{
		return $this->_admin_data(function () use ($kind) {
			$data = array('premiums' => $this->_q("SELECT name FROM `premium` WHERE `status` = '1'"));
			$get = function ($name) {
				return trim((string) $this->input->get($name));
			};
			$do = $get('do');
			if (!in_array($do, array('formListing', 'formContact', 'formWebsite', 'formLocation'), true)) {
				return $data;
			}
			$where = array();
			$like = function ($column, $value) {
				return "l.`$column` LIKE '" . $this->db->escape_like_str($value) . "%' ESCAPE '!'";
			};
			if ($do === 'formListing') {
				if ($get('fromDate') !== '' && $get('toDate') !== '') {
					$where[] = 'l.`l_adddate` BETWEEN ' . $this->_e($get('fromDate')) . ' AND ' . $this->_e($get('toDate'));
				}
				if ($get('premium') !== '' && $get('premium') !== 'ALL') {
					$where[] = 'l.`l_type` = ' . $this->_e($get('premium'));
				}
				if ($get('cate') !== '') {
					$where[] = $like('l_category', $get('cate'));
				}
				if ($get('title') !== '') {
					$where[] = $like('l_title', $get('title'));
				}
			} elseif ($do === 'formContact') {
				if ($get('phone') !== '') {
					$where[] = 'l.`l_phone` = ' . $this->_e($get('phone'));
				}
				if ($get('email') !== '') {
					$where[] = 'l.`l_email` = ' . $this->_e($get('email'));
				}
			} elseif ($do === 'formWebsite' && $get('website') !== '') {
				$where[] = $like('l_website', $get('website'));
			} elseif ($do === 'formLocation' && $get('location') !== '') {
				$loc = $this->_row('SELECT loc_id FROM `location` WHERE `loc_name` = ' . $this->_e($get('location')));
				$where[] = 'l.`l_loc_id` = ' . $this->_e($loc ? $loc['loc_id'] : '');
			}
			$data['results'] = $this->_listing_rows(self::$itemTables[$kind],
				($where ? 'WHERE ' . implode(' AND ', $where) . ' ORDER BY l.`l_adddate` ASC' : 'ORDER BY l.`l_adddate` ASC LIMIT 100'));
			return $data;
		});
	}

	private function _data_search_listing($args)
	{
		return $this->_search_page('listing');
	}

	private function _data_search_matrimony($args)
	{
		return $this->_search_page('matrimony');
	}

	private function _data_search_spa($args)
	{
		return $this->_search_page('spa');
	}

	private function _data_search_post($args)
	{
		return $this->_search_page('post');
	}

	/**
	 * connect/users_listing: the form, and with ?fromDate=&toDate=[&users=]
	 * how many listings each user added in those days (usersListingList.php).
	 */
	private function _data_users_listing($args)
	{
		return $this->_admin_data(function () {
			$data = array('users' => $this->_q("SELECT u_id, u_fullname, u_email FROM `users` ORDER BY `u_fullname` ASC"));
			$from = (string) $this->input->get('fromDate');
			$to = (string) $this->input->get('toDate');
			if ($from === '' || $to === '') {
				return $data;
			}
			$user = (string) $this->input->get('users');
			$counts = array();
			foreach ($this->_q("SELECT l_userid k, COUNT(*) n FROM `listing` WHERE `l_adddate` BETWEEN " . $this->_e($from) . ' AND ' . $this->_e($to) . ' GROUP BY l_userid') as $r) {
				$counts[$r['k']] = (int) $r['n'];
			}
			$rows = $this->_q("SELECT u_id, u_fullname, u_email FROM `users` " . ($user !== '' ? 'WHERE `u_id` = ' . $this->_e($user) : 'ORDER BY `u_fullname` ASC'));
			foreach ($rows as &$r) {
				$r['count'] = isset($counts[$r['u_id']]) ? $counts[$r['u_id']] : 0;
			}
			$data['results'] = $rows;
			return $data;
		});
	}

	/** connect/usersListingDataView/<from>/<to>/<user>: that user's listings of those days (usersListingData.php). */
	private function _data_userslistingdataview($args)
	{
		return $this->_admin_data(function () use ($args) {
			list($from, $to, $user) = array_pad($args, 3, '');
			return array('rows' => $this->_listing_rows('listing', 'WHERE l.`l_adddate` BETWEEN ' . $this->_e($from) . ' AND ' . $this->_e($to)
				. ' AND l.`l_userid` = ' . $this->_e($user) . ' ORDER BY l.`l_adddate` ASC'));
		});
	}

	/** Most viewed listings of a period (visitor_counter), as the report pages listed them. */
	private function _visit_rows($where, $limit = 'LIMIT 100')
	{
		return $this->_q("SELECT v.list_id, COUNT(*) AS visits, l.l_title, l.l_city, l.l_id
			FROM `visitor_counter` v LEFT JOIN `listing` l ON l.l_id = v.list_id
			WHERE $where GROUP BY v.list_id ORDER BY visits DESC $limit");
	}

	private function _data_today_listing_report($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_visit_rows('v.date >= ' . $this->_e(date('Y-m-d')) . ' AND v.date < ' . $this->_e(date('Y-m-d', strtotime('+1 day')))));
		});
	}

	private function _data_weekly_listing_report($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_visit_rows('v.date >= NOW() + INTERVAL -7 DAY AND v.date < NOW() + INTERVAL 0 DAY'));
		});
	}

	private function _data_monthly_listing_report($args)
	{
		return $this->_admin_data(function () {
			return array('rows' => $this->_visit_rows('v.date >= NOW() + INTERVAL -30 DAY AND v.date < NOW() + INTERVAL 0 DAY'));
		});
	}

	/**
	 * connect/custom_listing_report: the two forms; ?fromDate=&toDate= lists the
	 * most viewed listings of those days (customreport.php), with &title= the
	 * views of the listings whose title starts so (customlistreport.php).
	 */
	private function _data_custom_listing_report($args)
	{
		return $this->_admin_data(function () {
			$from = (string) $this->input->get('fromDate');
			$to = (string) $this->input->get('toDate');
			if ($from === '' || $to === '') {
				return array();
			}
			// the days from..to, written so the date index of visitor_counter is used
			$range = 'v.date >= ' . $this->_e(date('Y-m-d', strtotime($from))) . ' AND v.date < ' . $this->_e(date('Y-m-d', strtotime($to . ' +1 day')));
			$title = trim((string) $this->input->get('title'));
			if ($title === '') {
				return array('rows' => $this->_visit_rows($range, ''), 'mode' => 'range');
			}
			$listings = $this->_q("SELECT l_id AS list_id, l_title, l_city, l_id FROM `listing` WHERE `l_title` LIKE '" . $this->db->escape_like_str($title) . "%' ESCAPE '!'");
			$visits = array();
			if ($listings) {
				$ids = implode(',', array_map(function ($r) {
					return (int) $r['l_id'];
				}, $listings));
				foreach ($this->_q("SELECT v.list_id, COUNT(*) n FROM `visitor_counter` v WHERE v.list_id IN ($ids) AND $range GROUP BY v.list_id") as $v) {
					$visits[$v['list_id']] = (int) $v['n'];
				}
			}
			foreach ($listings as &$r) {
				$r['visits'] = isset($visits[$r['l_id']]) ? $visits[$r['l_id']] : 0;
			}
			$rows = $listings;
			return array('rows' => $rows, 'mode' => 'title');
		});
	}

	/* ------------------------------------------------------------------ */
	/* Content tables with the same list / add / edit pages               */
	/* ------------------------------------------------------------------ */

	/** kind => [table, key, prefix, order by, limit] (views/connect/all-<kind>.php, add-<kind>.php, edit-<kind>.php). */
	private static $simpleKinds = array(
		'groups' => array('groups', 'g_id', 'g', 'g_id', 100),
		'brand' => array('brand', 'b_id', 'b', 'b_id', 100),
		'categories' => array('categories', 'c_id', 'c', 'c_id', 0),
		'sub_categories' => array('sub_categories', 's_id', 's', 's_id', 100),
		'blog' => array('blog', 'b_id', 'b', 'b_id', 100),
		'major_city' => array('major_city', 'mc_id', 'mc', 'mc_id', 100),
		'major_district' => array('major_district', 'md_id', 'md', 'md_id', 100),
		'our_services' => array('our_services', 'os_id', 'os', 'os_id', 100),
		'partner_services' => array('partner_services', 'ps_id', 'ps', 'ps_id', 100),
		'popular_services' => array('popular_services', 'pos_id', 'pos', 'pos_id', 100),
		'top_attractions' => array('top_attractions', 'ta_id', 'ta', 'ta_id', 100),
		'youtube_videos' => array('youtube_videos', 'yv_id', 'yv', 'yv_id', 100),
	);

	/** Pages built from one pattern (content tables, categories); null for other names. */
	private function _data_page($name, $args)
	{
		if (preg_match('/^(all|add|edit)_(category(?:_matrimony|_spa)?|job_category)$/', $name, $m)) {
			return $this->_category_page($m[1], $m[2], $args);
		}
		if (preg_match('/^all_sub_(category(?:_matrimony|_spa)?)$/', $name, $m)) {
			return $this->_sub_category_page($m[1], $args);
		}
		return $this->_simple_page($name, $args);
	}

	/** kind => [table, sub category table, listing table, cover image folder, order] (views/connect/all-category*.php ...). */
	private static $categoryKinds = array(
		'category' => array('category', 'sub_category', 'listing', 'assets/images/list-deta/', 'c_visitor DESC'),
		'category_matrimony' => array('category_matrimony', 'sub_category_matrimony', 'matrimony', 'assets/images/matrimony-data/', 'c_id DESC'),
		'category_spa' => array('category_spa', 'sub_category_spa', 'spa', 'assets/images/spa-data/', 'c_id DESC'),
		'job_category' => array('category_job', null, null, 'assets/images/list-deta/', 'c_visitor DESC'),
	);

	/** all_category (and its matrimony, spa, job twins): the categories with their counts; add / edit: the form's row. */
	private function _category_page($action, $kind, $args)
	{
		list($table, $subTable, $itemTable, $folder, $order) = self::$categoryKinds[$kind];
		return $this->_admin_data(function () use ($action, $kind, $table, $subTable, $itemTable, $folder, $order, $args) {
			$data = array('folder' => $folder);
			if ($action === 'all') {
				$subs = $items = array();
				if ($subTable) {
					foreach ($this->_q("SELECT c_id, COUNT(*) n FROM `$subTable` WHERE `status` = '1' GROUP BY c_id") as $r) {
						$subs[$r['c_id']] = (int) $r['n'];
					}
				}
				if ($itemTable) {
					foreach ($this->_q("SELECT l_category, COUNT(*) n FROM `$itemTable` WHERE `l_status` = 'active' GROUP BY l_category") as $r) {
						$items[$r['l_category']] = (int) $r['n'];
					}
				}
				$rows = $this->_q("SELECT c_id, c_name, c_img, c_adsImage, c_wideImage, c_status, c_visitor FROM `$table` ORDER BY $order");
				foreach ($rows as &$r) {
					$r['subs'] = $subTable ? (isset($subs[$r['c_id']]) ? $subs[$r['c_id']] : 0) : null;
					$r['listings'] = $itemTable ? (isset($items[$r['c_name']]) ? $items[$r['c_name']] : 0) : null;
				}
				$data['rows'] = $rows;
			} elseif ($action === 'edit') {
				$data['row'] = $this->_row("SELECT * FROM `$table` WHERE `c_id` = " . $this->_e(isset($args[0]) ? $args[0] : ''));
				if (!$data['row']) {
					return array('redirect' => base_url() . "connect/all_$kind");
				}
			}
			return $data;
		});
	}

	/** all_sub_category/<category id> (and matrimony, spa): the category's sub categories. */
	private function _sub_category_page($kind, $args)
	{
		list($table, $subTable) = self::$categoryKinds[$kind];
		return $this->_admin_data(function () use ($kind, $table, $subTable, $args) {
			$id = $this->_e(isset($args[0]) ? $args[0] : '');
			$category = $this->_row("SELECT c_id, c_name FROM `$table` WHERE `c_id` = $id");
			if (!$category) {
				return array('redirect' => base_url() . "connect/all_$kind");
			}
			return array('category' => $category, 'rows' => $this->_q("SELECT * FROM `$subTable` WHERE `c_id` = $id ORDER BY `s_id` ASC"));
		});
	}

	/** all_<kind>, add_<kind>, edit_<kind>/<id> of the content tables; null for other names. */
	private function _simple_page($name, $args)
	{
		if (!preg_match('/^(all|add|edit)_(.+)$/', $name, $m) || !isset(self::$simpleKinds[$m[2]])) {
			return null;
		}
		list(, $action, $kind) = $m;
		list($table, $key, , $order, $limit) = self::$simpleKinds[$kind];
		return $this->_admin_data(function () use ($action, $kind, $table, $key, $order, $limit, $args) {
			if ($action === 'all') {
				$rows = $this->_q("SELECT * FROM `$table` ORDER BY `$order` DESC" . ($limit ? " LIMIT $limit" : ''));
				if ($kind === 'blog') {
					$names = array();
					foreach ($this->_q("SELECT c_id, c_name FROM `category`") as $c) {
						$names[$c['c_id']] = $c['c_name'];
					}
					foreach ($rows as &$r) {
						$r['category'] = isset($names[$r['b_cate']]) ? $names[$r['b_cate']] : '';
					}
				}
				return array('rows' => $rows);
			}
			$data = array();
			if (in_array($kind, array('categories', 'sub_categories'), true)) {
				$data['groups'] = $this->_q("SELECT g_id, g_title FROM `groups` WHERE `g_status` = '1'");
			}
			if ($kind === 'sub_categories') {
				$data['categories'] = $this->_q("SELECT c_id, c_title FROM `categories` WHERE `c_status` = '1'");
			}
			if ($kind === 'blog') {
				$data['categories'] = $this->_q("SELECT c_id, c_name FROM `category` WHERE `c_status` = 'active'");
			}
			if ($action === 'edit') {
				$id = isset($args[0]) ? $args[0] : '';
				$data['row'] = $this->_row("SELECT * FROM `$table` WHERE `$key` = " . $this->_e($id));
				if (!$data['row']) {
					return array('redirect' => base_url() . "connect/all_$kind");
				}
			}
			return $data;
		});
	}
}
