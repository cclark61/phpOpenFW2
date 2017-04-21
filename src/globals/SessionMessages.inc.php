<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Session Messages Functions Plugin
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

//====================================================================
//====================================================================
// Shortcut Message Functions
//====================================================================
//====================================================================
if (!function_exists('add_bottom_message')) {
	function add_bottom_message($msg) { \phpOpenFW\Session\Messages::AddBottomMessage($msg); }
}
if (!function_exists('add_page_message')) {
	function add_page_message($msg) { \phpOpenFW\Session\Messages::AddPageMessage($msg); }
}
if (!function_exists('add_action_message')) {
	function add_action_message($msg) { \phpOpenFW\Session\Messages::AddActionMessage($msg); }
}
if (!function_exists('add_warn_message')) {
	function add_warn_message($msg) { \phpOpenFW\Session\Messages::AddWarnMessage($msg); }
}
if (!function_exists('add_error_message')) {
	function add_error_message($msg) { \phpOpenFW\Session\Messages::AddErrorMessage($msg); }
}
if (!function_exists('add_gen_message')) {
	function add_gen_message($msg) { \phpOpenFW\Session\Messages::AddGenMessage($msg); }
}
if (!function_exists('add_timer_message')) {
	function add_timer_message($msg) { \phpOpenFW\Session\Messages::AddMessage($msg); }
}
