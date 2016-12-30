<?php
//*****************************************************************************
/**
* Load Global Database Functions Plugin
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
if (!in_array('qdb_exec', $excluded)) {
	function qdb_exec() { return call_user_func_array('\phpOpenFW\Database\QDB::qdb_exec', func_get_args()); }
}
if (!in_array('qdb_result', $excluded)) {
	function qdb_result() { return call_user_func_array('\phpOpenFW\Database\QDB::qdb_result', func_get_args()); }
}
if (!in_array('qdb_list', $excluded)) {
	function qdb_list() { return call_user_func_array('\phpOpenFW\Database\QDB::qdb_list', func_get_args()); }
}
if (!in_array('qdb_lookup', $excluded)) {
	function qdb_lookup() { return call_user_func_array('\phpOpenFW\Database\QDB::qdb_lookup', func_get_args()); }
}
if (!in_array('qdb_first_row', $excluded)) {
	function qdb_first_row() { return call_user_func_array('\phpOpenFW\Database\QDB::qdb_first_row', func_get_args()); }
}
if (!in_array('qdb_row', $excluded)) {
	function qdb_row() { return call_user_func_array('\phpOpenFW\Database\QDB::qdb_row', func_get_args()); }
}

//=============================================================================
// Class Aliases
//=============================================================================
if (!in_array('data_trans', $excluded)) {
	class_alias('\phpOpenFW\Database\DataTrans', '\data_trans');
}
if (!in_array('data_result', $excluded)) {
	class_alias('\phpOpenFW\Database\DataResult', '\data_result');
}
if (!in_array('data_query', $excluded)) {
	class_alias('\phpOpenFW\Database\DataQuery', '\data_query');
}
if (!in_array('data_query', $excluded)) {
	class_alias('\phpOpenFW\Database\DataQuery', '\data_query');
}
if (!in_array('database_interface_object', $excluded)) {
	class_alias('\phpOpenFW\Database\DIO', '\database_interface_object');
}
