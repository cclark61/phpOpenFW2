<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Load Global phpOpenPlugins Functions Plugin
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

use \phpOpenFW\Format\Arrays;

//=============================================================================
// Defaults
//=============================================================================
$POP_TB = 3;

//=============================================================================
// Extract Args
// Check for Excluded Classes / Functions Array
//=============================================================================
extract($args);
if (!isset($excluded)) {
	$excluded = [];
}

//=============================================================================
//=============================================================================
// Function Declarations
//=============================================================================
//=============================================================================

//********************************************************************
// phpOpenFW\Content\FilterOptions
//********************************************************************
if (!in_array('save_and_return_filter_data', $excluded)) {
	function save_and_return_filter_data() { return call_user_func_array('\phpOpenFW\Content\FilterOptions::save_and_return_filter_data', Arrays::RefValues(func_get_args())); }
}
if (!in_array('create_select_filter', $excluded)) {
	function create_select_filter() { return call_user_func_array('\phpOpenFW\Content\FilterOptions::create_select_filter', func_get_args()); }
}
if (!in_array('print_list_filter', $excluded)) {
	function print_list_filter() { return call_user_func_array('\phpOpenFW\Content\FilterOptions::print_list_filter', Arrays::RefValues(func_get_args())); }
}

//********************************************************************
// phpOpenFW\Format\Content
//********************************************************************
if (!in_array('html_sanitize', $excluded)) {
	function html_sanitize() { return call_user_func_array('\phpOpenFW\Format\Content::html_sanitize', func_get_args()); }
}
if (!in_array('html_escape', $excluded)) {
	function html_escape() { return call_user_func_array('\phpOpenFW\Format\Content::html_escape', func_get_args()); }
}
if (!in_array('fill_if_empty', $excluded)) {
	function fill_if_empty(&$data, $empty_val='--') {
		\phpOpenFW\Format\Content::fill_if_empty($data, $empty_val);
	}
}
if (!in_array('css_icon', $excluded)) {
	function css_icon() { return call_user_func_array('\phpOpenFW\Format\Content::css_icon', func_get_args()); }
}
if (!in_array('display_error', $excluded)) {
	function display_error() { return call_user_func_array('\phpOpenFW\Format\Content::display_error', func_get_args()); }
}
if (!in_array('format_filesize', $excluded)) {
	function format_filesize() { return call_user_func_array('\phpOpenFW\Format\Content::format_filesize', func_get_args()); }
}
if (!in_array('get_saveable_password', $excluded)) {
	function get_saveable_password() { return call_user_func_array('\phpOpenFW\Format\Content::get_saveable_password', func_get_args()); }
}
if (!in_array('print_code', $excluded)) {
	function print_code() { return call_user_func_array('\phpOpenFW\Format\Content::print_code', func_get_args()); }
}
if (!in_array('GUID', $excluded)) {
	function GUID() { return call_user_func_array('\phpOpenFW\Format\Content::GUID', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Format\Data
//********************************************************************
if (!in_array('format_records', $excluded)) {
	function format_records(&$recs, $fields) {
		return \phpOpenFW\Format\Data::format_records($recs, $fields);
	}
}

//********************************************************************
// phpOpenFW\Format\DateTime
//********************************************************************
if (!in_array('mystamp_pretty', $excluded)) {
	function mystamp_pretty() { return call_user_func_array('\phpOpenFW\Format\DateTime::mystamp_pretty', func_get_args()); }
}
if (!in_array('gen_format_date', $excluded)) {
	function gen_format_date() { return call_user_func_array('\phpOpenFW\Format\DateTime::gen_format_date', func_get_args()); }
}
if (!in_array('format_date_sql', $excluded)) {
	function format_date_sql() { return call_user_func_array('\phpOpenFW\Format\DateTime::format_date_sql', func_get_args()); }
}
if (!in_array('format_date_pretty', $excluded)) {
	function format_date_pretty() { return call_user_func_array('\phpOpenFW\Format\DateTime::format_date_pretty', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Format\FileSystem
//********************************************************************
if (!in_array('clean_dir', $excluded)) {
	function clean_dir(&$dir, $front_slashes=false, $rear_slashes=true) {
		return \phpOpenFW\Format\DateTime::clean_dir($dir, $front_slashes, $rear_slashes);
	}
}
if (!in_array('load_file_content', $excluded)) {
	function load_file_content() { return call_user_func_array('\phpOpenFW\Format\DateTime::load_file_content', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Format\Form
//********************************************************************
if (!in_array('sql_escape_values', $excluded)) {
	function sql_escape_values(&$in_val, $ignore_indices=false) {
		return \phpOpenFW\Format\Form::sql_escape_values($in_val, $ignore_indices); 
	}
}
if (!in_array('set_category', $excluded)) {
	function set_category(&$cat, $new_cat) {
		return \phpOpenFW\Format\Form::set_category($cat, $new_cat);
	}
}

//********************************************************************
// phpOpenFW\Format\Image
//********************************************************************
if (!in_array('img_resize_save', $excluded)) {
	function img_resize_save() { return call_user_func_array('\phpOpenFW\Format\Image::img_resize_save', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Format\Output
//********************************************************************
if (!in_array('print_array', $excluded)) {
	function print_array() { return call_user_func_array('\phpOpenFW\Format\Output::print_array', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Format\URL
//********************************************************************
if (!in_array('add_url_params', $excluded)) {
	function add_url_params() { return call_user_func_array('\phpOpenFW\Format\URL::add_url_params', func_get_args()); }
}
if (!in_array('seo_friendly_str', $excluded)) {
	function seo_friendly_str() { return call_user_func_array('\phpOpenFW\Format\URL::URLFriendly', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Helpers\Form
//********************************************************************
if (!in_array('check_and_clear_form_key', $excluded)) {
	function check_and_clear_form_key() { return call_user_func_array('\phpOpenFW\Helpers\Form::check_and_clear_form_key', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Helpers\HTTP
//********************************************************************
if (!in_array('redirect', $excluded)) {
	function redirect() { return call_user_func_array('\phpOpenFW\Helpers\HTTP::redirect', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Utility\Remote
//********************************************************************
if (!in_array('is_service_available', $excluded)) {
	function is_service_available() { return call_user_func_array('\phpOpenFW\Utility\Remote::is_service_available', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Validate\DateTime
//********************************************************************
if (!in_array('is_valid_date', $excluded)) {
	function is_valid_date() { return call_user_func_array('\phpOpenFW\Validate\DateTime::is_valid_date', func_get_args()); }
}
if (!in_array('is_valid_sql_date', $excluded)) {
	function is_valid_sql_date() { return call_user_func_array('\phpOpenFW\Validate\DateTime::is_valid_sql_date', func_get_args()); }
}
if (!in_array('is_valid_time', $excluded)) {
	function is_valid_time() { return call_user_func_array('\phpOpenFW\Validate\DateTime::is_valid_time', func_get_args()); }
}

//********************************************************************
// phpOpenFW\Validate\General
//********************************************************************
if (!in_array('is_valid_userid', $excluded)) {
	function is_valid_userid() { return call_user_func_array('\phpOpenFW\Validate\General::is_valid_userid', func_get_args()); }
}
if (!in_array('is_function', $excluded)) {
	function is_function() { return call_user_func_array('\phpOpenFW\Validate\General::is_function', func_get_args()); }
}

//=============================================================================
//=============================================================================
// Class Aliases
//=============================================================================
//=============================================================================

//********************************************************************
// phpOpenFW\Cache
//********************************************************************
if (!in_array('POP_memcache', $excluded)) {
	class_alias('\phpOpenFW\Cache\Memcache', '\POP_memcache');
}

//********************************************************************
// phpOpenFW\Content
//********************************************************************
if (!in_array('POP_TB', $excluded)) {
	if ($POP_TB == 2) {
		class_alias('\phpOpenFW\Content\Bootstrap2', '\POP_TB');
	}
	else {
		class_alias('\phpOpenFW\Content\Bootstrap3', '\POP_TB');
	}
}
if (!in_array('POP_content_template', $excluded)) {
	class_alias('\phpOpenFW\Content\ContentTemplate', '\POP_content_template');
}
if (!in_array('POP_cdn', $excluded)) {
	class_alias('\phpOpenFW\Content\CDN', '\POP_cdn');
}

//********************************************************************
// phpOpenFW\Cores
//********************************************************************
if (!in_array('POP_base', $excluded)) {
	class_alias('\phpOpenFW\Cores\Base', '\POP_base');
}
if (!in_array('POP_static_core', $excluded)) {
	class_alias('\phpOpenFW\Cores\StaticCore', '\POP_static_core');
}
if (!in_array('SERVICE_API_CORE', $excluded)) {
	class_alias('\phpOpenFW\Cores\ServiceAPI', '\SERVICE_API_CORE');
}

//********************************************************************
// phpOpenFW\Helpers
//********************************************************************
if (!in_array('POP_dio', $excluded)) {
	class_alias('\phpOpenFW\Helpers\Database\DIO', '\POP_dio');
}
if (!in_array('POP_mongodb', $excluded)) {
	class_alias('\phpOpenFW\Helpers\Database\MongoDB', '\POP_mongodb');
}
if (!in_array('POP_MySQL', $excluded)) {
	class_alias('\phpOpenFW\Helpers\Database\MySQL', '\POP_MySQL');
}
