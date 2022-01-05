<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Load Global XML Functions / Classes Plugin
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
if (!in_array('xml_escape', $excluded)) {
    function xml_escape() { return call_user_func_array('\phpOpenFW\XML\Format::xml_escape', func_get_args()); }
}
if (!in_array('xml_escape_array', $excluded)) {
    function xml_escape_array() { return call_user_func_array('\phpOpenFW\XML\Format::xml_escape_array', func_get_args()); }
}
if (!in_array('strip_cdata_tags', $excluded)) {
    function strip_cdata_tags() { return call_user_func_array('\phpOpenFW\XML\Format::strip_cdata_tags', func_get_args()); }
}
if (!in_array('array2xml', $excluded)) {
    function array2xml() { return call_user_func_array('\phpOpenFW\XML\Format::array2xml', func_get_args()); }
}
if (!in_array('xhe', $excluded)) {
    function xhe() { return call_user_func_array('\phpOpenFW\XML\Format::xhe', func_get_args()); }
}
if (!in_array('xml_transform', $excluded)) {
    function xml_transform() { return call_user_func_array('\phpOpenFW\XML\Transform::XSL', func_get_args()); }
}

//=============================================================================
// Class Aliases
//=============================================================================
if (!in_array('element', $excluded)) {
    class_alias('\phpOpenFW\XML\Element', '\element');
}
if (!in_array('gen_element', $excluded)) {
    class_alias('\phpOpenFW\XML\GenElement', '\gen_element');
}
