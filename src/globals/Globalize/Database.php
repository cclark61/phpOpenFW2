<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Load Global Database Functions / Classes Plugin
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
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
if (!in_array('rs_trim', $excluded)) {
    function rs_trim() { return call_user_func_array('\phpOpenFW\Database\QDB::rs_trim', func_get_args()); }
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
if (!in_array('database_interface_object', $excluded)) {
    class_alias('\phpOpenFW\Database\DIO', '\database_interface_object');
}
