<?php
//*****************************************************************************
/**
* Load Global Core Functions Plugin
*
* @package		phpOpenFW
* @subpackage	Globals
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		https://mit-license.org
* @version 		Started: 12/28/2016, Updated: 12/28/2016
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
if (!in_array('load_plugin', $excluded)) {
	function load_plugin() { return call_user_func_array('\phpOpenFW\Framework\Core::load_plugin', func_get_args()); }
}

