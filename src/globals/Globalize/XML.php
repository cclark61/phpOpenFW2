<?php
//*****************************************************************************
/**
* Load Global XML Functions Plugin
*
* @package		phpOpenFW
* @subpackage	Plugin
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @version 		Started: 12/28/2016, Last updated: 12/28/2016
**/
//*****************************************************************************

//=============================================================================
// Check for Excluded Functions Array
//=============================================================================
if (!isset($excluded)) {
	$excluded = [];
}

//=============================================================================
// Function Declarations
//=============================================================================
if (!in_array('xml_escape', $excluded)) {
	function xml_escape() { return call_user_func_array('\phpOpen\XML\Format::xml_escape', func_get_args()); }
}
if (!in_array('xml_escape_array', $excluded)) {
	function xml_escape_array() { return call_user_func_array('\phpOpen\XML\Format::xml_escapeArray', func_get_args()); }
}
if (!in_array('strip_cdata_tags', $excluded)) {
	function strip_cdata_tags() { return call_user_func_array('\phpOpen\XML\Format::strip_cdata_tags', func_get_args()); }
}
if (!in_array('array2xml', $excluded)) {
	function array2xml() { return call_user_func_array('\phpOpen\XML\Format::array2xml', func_get_args()); }
}
if (!in_array('xhe', $excluded)) {
	function xhe() { return call_user_func_array('\phpOpen\XML\Format::xhe', func_get_args()); }
}

//=============================================================================
// Class Aliases
//=============================================================================
if (!in_array('gen_element', $excluded)) {
	class_alias('\phpOpen\XML\GenElement', '\gen_element');
}
