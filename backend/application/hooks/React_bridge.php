<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'helpers/react_helper.php';

/**
 * display_override hook (config/hooks.php): for a request of the React app
 * whose handler rendered a page instead of redirecting (validation failed,
 * upload error ...), answer { ok: false, errors, messages }. JSON output
 * (api_data, AJAX handlers) and every other request are sent as they are.
 */
class React_bridge
{
	public function display()
	{
		$CI =& get_instance();
		$output = $CI->output->get_output();
		if (!react_request() || $this->isJson($output)) {
			$CI->output->_display();
			return;
		}
		$errors = react_validation_errors();
		$messages = react_messages();
		if (!$errors && !$messages) {
			$messages[] = array('key' => '', 'type' => 'danger', 'text' => 'Some problem occurred, please try again.');
		}
		react_send_json(array('ok' => false, 'errors' => $errors, 'messages' => $messages));
	}

	private function isJson($output)
	{
		$output = ltrim((string) $output);
		if ($output === '' || ($output[0] !== '{' && $output[0] !== '[')) {
			return false;
		}
		json_decode($output);
		return json_last_error() === JSON_ERROR_NONE;
	}
}
