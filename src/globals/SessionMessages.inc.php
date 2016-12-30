<?php
//*****************************************************************************
//*****************************************************************************
/**
* Session Messages Functions Plugin
*
* @package		phpOpenFW
* @subpackage	Globals
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		https://mit-license.org
* @version 		Started: 7/17/2012, Updated: 5/3/2016
**/
//*****************************************************************************
//*****************************************************************************

//====================================================================
//====================================================================
// Add Message in Session Function
//====================================================================
//====================================================================
function add_message_session($msg, $type='gen')
{
	$index = strtolower("{$type}_message");
	if (isset($_SESSION[$index])) {
		if (!is_array($_SESSION[$index])) {
			$tmp = $_SESSION[$index];
			$_SESSION[$index] = array($tmp);
		}
	}
	else {
		$_SESSION[$index] = array();
	}
	$_SESSION[$index][] = (string)$msg;
	return true;
}

//====================================================================
//====================================================================
// Shortcut Message Functions
//====================================================================
//====================================================================
if (!function_exists('add_bottom_message')) {
	function add_bottom_message($msg) { add_message_session($msg, 'bottom'); }
}
if (!function_exists('add_page_message')) {
	function add_page_message($msg) { add_message_session($msg, 'page'); }
}
if (!function_exists('add_action_message')) {
	function add_action_message($msg) { add_message_session($msg, 'action'); }
}
if (!function_exists('add_warn_message')) {
	function add_warn_message($msg) { add_message_session($msg, 'warn'); }
}
if (!function_exists('add_error_message')) {
	function add_error_message($msg) { add_message_session($msg, 'error'); }
}
if (!function_exists('add_gen_message')) {
	function add_gen_message($msg) { add_message_session($msg, 'gen'); }
}
if (!function_exists('add_timer_message')) {
	function add_timer_message($msg) { add_message_session($msg, 'timer'); }
}
