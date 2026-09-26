<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'helpers/react_helper.php';

/**
 * JSON data of a controller's React pages (see app/pages.json):
 *
 *   GET <controller>/api_data/<page>[/<args>...]  ->  $this->_data_<page>($args)
 *
 * Each _data_<page>() returns what the PHP view used to query, or
 * array('redirect' => url) (not signed in ...). The session's flash messages
 * are added as `messages`, so a page shows what the last form handler said.
 */
trait React_pages
{
	public function api_data()
	{
		// read from the URL: routes such as users/(:any)/(:any) => users/$1 drop the later segments
		$page = (string) $this->uri->segment(3);
		$name = strtolower(preg_replace('/[^A-Za-z0-9_]/', '', str_replace('-', '_', $page)));
		$method = '_data_' . $name;
		$args = array_slice(array_values($this->uri->segment_array()), 3);
		if ($page !== '' && method_exists($this, $method)) {
			$data = $this->$method($args);
		} elseif ($page !== '' && method_exists($this, '_data_page')) {
			$data = $this->_data_page($name, $args); // pages built from one pattern (see Connect_pages)
		} else {
			$data = null;
		}
		if ($data === null) {
			$this->output->set_status_header(404);
			return $this->_react_json(array('error' => 'Unknown page'));
		}
		if (!isset($data['redirect'])) {
			$data['messages'] = array_merge(isset($data['messages']) ? $data['messages'] : array(), react_messages());
		}
		$this->_react_json($data);
	}

	protected function _react_json($data)
	{
		$this->output
			->set_header('Cache-Control: no-store')
			->set_content_type('application/json', 'utf-8')
			->set_output(react_json_body($data));
	}
}
