<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

// React front end: JSON answers for its form submits (hooks/React_bridge.php)
$hook['display_override'] = array(
	'class' => 'React_bridge',
	'function' => 'display',
	'filename' => 'React_bridge.php',
	'filepath' => 'hooks',
);
