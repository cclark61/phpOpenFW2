<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Load Global Core Functions / Classes Plugin
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

//=============================================================================
// Check for Excluded Classes / Functions Array
//=============================================================================
if (!isset($excluded)) {
	$excluded = [];
}

//=============================================================================
// Function Declarations
//=============================================================================
if (!in_array('get_url_path', $excluded)) {
	function get_url_path() { return call_user_func_array('\phpOpenFW\Framework\Core::get_url_path', func_get_args()); }
}
if (!in_array('get_html_path', $excluded)) {
	function get_html_path() { return call_user_func_array('\phpOpenFW\Framework\Core::get_html_path', func_get_args()); }
}
if (!in_array('load_db_config', $excluded)) {
	function load_db_config() { return call_user_func_array('\phpOpenFW\Framework\Core::load_db_config', func_get_args()); }
}
if (!in_array('session_kill', $excluded)) {
	function session_kill() { return call_user_func_array('\phpOpenFW\Framework\Core::session_kill', func_get_args()); }
}
if (!in_array('reg_data_source', $excluded)) {
	function reg_data_source() { return call_user_func_array('\phpOpenFW\Framework\Core::reg_data_source', func_get_args()); }
}
if (!in_array('default_data_source', $excluded)) {
	function default_data_source() { return call_user_func_array('\phpOpenFW\Framework\Core::default_data_source', func_get_args()); }
}
if (!in_array('set_plugin_folder', $excluded)) {
	function set_plugin_folder() { return call_user_func_array('\phpOpenFW\Framework\Core::set_plugin_folder', func_get_args()); }
}
if (!in_array('unset_plugin_folder', $excluded)) {
	function unset_plugin_folder() { return call_user_func_array('\phpOpenFW\Framework\Core::unset_plugin_folder', func_get_args()); }
}
if (!in_array('load_plugin', $excluded)) {
	function load_plugin() { return call_user_func_array('\phpOpenFW\Framework\Core::load_plugin', func_get_args()); }
}

