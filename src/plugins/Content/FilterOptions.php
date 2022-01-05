<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Filter Options Object
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Content;
use \phpOpenFW\XML\Format;

//**************************************************************************************
/**
 * Filter Options Class
 */
//**************************************************************************************
class FilterOptions
{

    //=============================================================================
    //=============================================================================
    // Save and Return Filter Data Function
    //=============================================================================
    //=============================================================================
    public static function save_and_return_filter_data(&$current_page, $request_index, $cookie_index, $default)
    {
        $in_var = (isset($_REQUEST[$request_index])) ? ($_REQUEST[$request_index]) : (null);
    
        if (is_null($in_var)) {
            $in_var = $current_page->get_mod_var($cookie_index);
            if ($in_var === false) {
                if (isset($_COOKIE[$cookie_index])) { $in_var = $_COOKIE[$cookie_index]; }
                else { $in_var = $default; }
            }
        }
        else {
            $current_page->set_mod_var($cookie_index, $in_var);
            setcookie($cookie_index, $in_var, time() + 604800);
        }
        
        return $in_var;
    }
    
    //=============================================================================
    //=============================================================================
    // Create Select Filter Function
    //=============================================================================
    //=============================================================================
    public static function create_select_filter($select_vals, $url_stub, $selected="-1", $label="")
    {
        //---------------------------------------------------------
        // Label
        //---------------------------------------------------------
        if ((string)$label !== "") {
            print Format::xhe("label", $label);
        }

        //---------------------------------------------------------
        // Select
        //---------------------------------------------------------
        ob_start();
        foreach ($select_vals as $key => $display) {
            $url = $url_stub . $key;
            $o_attrs = array("value" => $url);
            if ($selected == $key) { $o_attrs["selected"] = "selected"; }
            print Format::xhe("option", $display, $o_attrs);
        }
        
        print Format::xhe("select", ob_get_clean(), array("class" => "filter"));    
    }
    
    //=============================================================================
    //=============================================================================
    // Print a List Filter Select Dropdown Function
    //=============================================================================
    //=============================================================================
    public static function print_list_filter(&$page, $base_url, $options, $get_var, $cookie_mod_var, $label)
    {
        $ret_vals = array();
        $tmp_val = false;

        //---------------------------------------------------------
        // Is filter set in a GET parameter?
        //---------------------------------------------------------
        if (array_key_exists($get_var, $_GET) && $_GET[$get_var] != '') {
            $tmp_val = $_GET[$get_var];
        }

        //---------------------------------------------------------
        // Is filter saved in the Session?
        //---------------------------------------------------------
        if ($tmp_val == '') {
            $tmp_val = $page->get_mod_var($cookie_mod_var);
        }

        //---------------------------------------------------------
        // Is filter saved in a Cookie?
        //---------------------------------------------------------
        if ($tmp_val == '') {
            if (array_key_exists($cookie_mod_var, $_COOKIE) && $_COOKIE[$cookie_mod_var] != '') {
                $tmp_val = $_COOKIE[$cookie_mod_var];
            }
            else {
                $tmp_val = 0;
            }
        }

        //---------------------------------------------------------
        // Save Filter to Session and Cookie
        //---------------------------------------------------------
        if ($tmp_val != '') {
            $page->set_mod_var($cookie_mod_var, $tmp_val);
            setcookie($cookie_mod_var, $tmp_val, time() + 604800);
        }

        //---------------------------------------------------------
        // Output Filter
        //---------------------------------------------------------
        ob_start();
        print Format::xhe('label', $label) . "\n";
        ob_start();
        foreach ($options as $key => $option) {
            $url = add_url_params($base_url, array($get_var => $key));
            $o_attrs = array("value" => $url);
            if ($tmp_val != '' && $tmp_val == $key) {
                $o_attrs["selected"] = "selected";
                if (isset($option["group_by"])) {
                    $ret_vals['group_by'] = $option["group_by"];
                }
            }
            print Format::xhe("option", $option["display"], $o_attrs);
        }

        print Format::xhe("select", ob_get_clean(), array("class" => "filter"));
        print Format::xhe('span', ob_get_clean(), array('class' => 'filter_wrapper'));

        //---------------------------------------------------------
        // Return Results / Selected Value
        //---------------------------------------------------------
        $ret_vals[$get_var] = $tmp_val;
        return $ret_vals;
    }
    
}
