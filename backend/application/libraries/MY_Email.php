<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SMTP servers (Hostinger, Gmail) only let a mailbox send as itself.
 * The controllers use the company address (or a visitor's address) as "From",
 * so when sending through SMTP the From is replaced by the authenticated
 * mailbox (smtp_user) and the address the controller asked for becomes Reply-To.
 */
class MY_Email extends CI_Email {

	public function from($from, $name = '', $return_path = NULL)
	{
		if ($this->protocol === 'smtp'
			&& filter_var($this->smtp_user, FILTER_VALIDATE_EMAIL)
			&& strcasecmp(trim($from), $this->smtp_user) !== 0)
		{
			$this->reply_to($from, $name);
			return parent::from($this->smtp_user, $name, NULL);
		}

		return parent::from($from, $name, $return_path);
	}
}
