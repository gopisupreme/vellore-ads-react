<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * The listing / matrimony / spa / post-ad forms of the React app (listing
 * owner area and admin panel): the tables of each kind and an item's fields
 * as the edit forms show them.
 */

if (!function_exists('listing_form_kind')) {
	/** kind => [table, category table, sub category table, cover image folder, service image folder, owner list page]. */
	function listing_form_kind($kind)
	{
		$kinds = array(
			'listing' => array('listing', 'category', 'sub_category', 'assets/images/list-deta/', 'assets/images/services/', 'users/db_all_listing'),
			'matrimony' => array('matrimony', 'category_matrimony', 'sub_category_matrimony', 'assets/images/matrimony-data/', 'assets/images/matrimony-services/', 'users/db_all_matrimony'),
			'spa' => array('spa', 'category_spa', 'sub_category_spa', 'assets/images/spa-data/', 'assets/images/spa-services/', 'users/db_all_spa'),
			'post' => array('post_ad', 'category', 'sub_category', 'assets/images/post-data/', 'assets/images/post-services/', 'users/db_all_post'),
		);
		return $kinds[$kind];
	}
}

if (!function_exists('listing_form_item')) {
	/** The fields of the edit form for an item row of `$kind`. */
	function listing_form_item($kind, $row)
	{
		$CI =& get_instance();
		list(, $cateTable, , $coverDir, $serviceDir) = listing_form_kind($kind);
		$name = explode(' ', (string) $row['l_fullname']);
		$loc = $CI->db->get_where('location', array('loc_id' => $row['l_loc_id']))->row_array();
		$cate = $CI->db->get_where($cateTable, array('c_name' => $row['l_category']))->row_array();
		$timing = explode(' to ', (string) $row['l_timing']);
		$image = function ($dir, $file) {
			return $file != '' ? base_url() . $dir . $file : base_url() . 'assets/images/services/default.png';
		};
		$services = array();
		for ($i = 1; $i <= 6; $i++) {
			$services[] = array(
				'name' => (string) $row["l_serviceName$i"],
				'image' => $image($serviceDir, (string) $row["l_serviceImage$i"]),
			);
		}
		return array(
				'l_id' => $row['l_id'],
				'fname' => $name[0],
				'lname' => isset($name[1]) ? $name[1] : '',
				'title' => $row['l_title'],
				'phone' => $row['l_phone'],
				'landline' => isset($row['l_landline']) ? $row['l_landline'] : '',
				'whatsapp' => isset($row['l_whatsapp']) ? $row['l_whatsapp'] : '',
				'email' => $row['l_email'],
				'website' => $row['l_website'],
				'address' => $row['l_address'],
				'location' => $loc ? $loc['loc_name'] : '',
				'cate' => $cate ? $cate['c_name'] : '',
				// the edit page printed every sub category joined with nothing between them
				'subcate' => str_replace(', ', '', (string) $row['l_subcategory']),
				'opendays' => array_values(array_filter(explode(' : ', (string) $row['l_opendays']), 'strlen')),
				'opentime' => $timing[0],
				'closetime' => isset($timing[1]) ? $timing[1] : '',
				'desc' => $row['l_desc'],
				'key' => $row['l_key'],
				'job_apply' => isset($row['l_job_apply']) && $row['l_job_apply'] == 1,
				'facebook' => $row['l_facebook'],
				'google' => $row['l_google'],
				'twitter' => $row['l_twitter'],
				'googleMap' => $row['l_googleMap'],
				'degreeView' => $row['l_degreeView'],
				'coverImage' => $row['l_coverImage'] != '' ? base_url() . $coverDir . $row['l_coverImage'] : base_url() . 'assets/images/services/default.png',
				'services' => $services,
			);
	}
}
