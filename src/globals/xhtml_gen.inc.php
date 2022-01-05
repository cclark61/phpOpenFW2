<?php
//**************************************************************************************
//**************************************************************************************
/**
 * XHTML Generator Plugin
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

use \phpOpenFW\XML\GenElement;

//**************************************************************************************
//**************************************************************************************
// Common XHTML Elements
//**************************************************************************************
//**************************************************************************************

//**************************************************************************************
/**
* XHTML element functions
*/
//**************************************************************************************
if (!function_exists('div')) { function div($c, $a=false) { return \phpOpenFW\XML\Format::xhe('div', $c, $a); } }
if (!function_exists('p')) { function p($c, $a=false) { return \phpOpenFW\XML\Format::xhe('p', $c, $a); } }
if (!function_exists('span')) { function span($c, $a=false) { return \phpOpenFW\XML\Format::xhe('span', $c, $a); } }
if (!function_exists('pre')) { function pre($c, $a=false) { return \phpOpenFW\XML\Format::xhe('pre', $c, $a); } }
if (!function_exists('strong')) { function strong($c, $a=false) { return \phpOpenFW\XML\Format::xhe('strong', $c, $a); } }
if (!function_exists('em')) { function em($c, $a=false) { return \phpOpenFW\XML\Format::xhe('em', $c, $a); } }
if (!function_exists('u')) { function u($c, $a=false) { return \phpOpenFW\XML\Format::xhe('u', $c, $a); } }
if (!function_exists('small')) { function small($c, $a=false) { return \phpOpenFW\XML\Format::xhe('small', $c, $a); } }

if (!function_exists('li')) { function li($c, $a=false) { return \phpOpenFW\XML\Format::xhe('li', $c, $a); } }
if (!function_exists('dt')) { function dt($c, $a=false) { return \phpOpenFW\XML\Format::xhe('dt', $c, $a); } }
if (!function_exists('dd')) { function dd($c, $a=false) { return \phpOpenFW\XML\Format::xhe('dd', $c, $a); } }

if (!function_exists('form')) { function form($c, $a=false) { return \phpOpenFW\XML\Format::xhe('form', $c, $a); } }
if (!function_exists('label')) { function label($c, $a=false) { return \phpOpenFW\XML\Format::xhe('label', $c, $a); } }
if (!function_exists('option')) { function option($c, $a=false) { return \phpOpenFW\XML\Format::xhe('option', $c, $a); } }
if (!function_exists('button')) { function button($c, $a=false) { return \phpOpenFW\XML\Format::xhe('button', $c, $a); } }

if (!function_exists('fieldset')) { function fieldset($c, $a=false) { return \phpOpenFW\XML\Format::xhe('fieldset', $c, $a); } }
if (!function_exists('legend')) { function legend($c, $a=false) { return \phpOpenFW\XML\Format::xhe('legend', $c, $a); } }

if (!function_exists('h1')) { function h1($c, $a=false) { return \phpOpenFW\XML\Format::xhe('h1', $c, $a); } }
if (!function_exists('h2')) { function h2($c, $a=false) { return \phpOpenFW\XML\Format::xhe('h2', $c, $a); } }
if (!function_exists('h3')) { function h3($c, $a=false) { return \phpOpenFW\XML\Format::xhe('h3', $c, $a); } }
if (!function_exists('h4')) { function h4($c, $a=false) { return \phpOpenFW\XML\Format::xhe('h4', $c, $a); } }
if (!function_exists('h5')) { function h5($c, $a=false) { return \phpOpenFW\XML\Format::xhe('h5', $c, $a); } }
if (!function_exists('h6')) { function h6($c, $a=false) { return \phpOpenFW\XML\Format::xhe('h6', $c, $a); } }

if (!function_exists('input')) { function input($attrs) { return \phpOpenFW\XML\Format::xhe('input', false, $attrs); } }
if (!function_exists('img')) { function img($attrs) { return \phpOpenFW\XML\Format::xhe('img', false, $attrs); } }
if (!function_exists('br')) { function br($attrs=false) { return \phpOpenFW\XML\Format::xhe('br', false, $attrs); } }
if (!function_exists('hr')) { function hr($attrs=false) { return \phpOpenFW\XML\Format::xhe('hr', false, $attrs); } }

//*****************************************************************************
//*****************************************************************************
/**
* Creates an XHTML "ul" element
*/
//*****************************************************************************
//*****************************************************************************
if (!function_exists('ul')) {
    function ul($lis, $attrs=false)
    {
        if ($attrs !== false && !is_array($attrs)) {
            trigger_error('Attributes must be an array.');
            return false;
        }

        $inset = '';
        if (!is_array($lis)) { $inset = $lis; }
        else { foreach ($lis as $val) { $inset .= $val; } }

        return \phpOpenFW\XML\Format::xhe('ul', $inset, $attrs);
    }
}

//*****************************************************************************
//*****************************************************************************
/**
* Creates an XHTML "ol" element
*/
//*****************************************************************************
//*****************************************************************************
if (!function_exists('ol')) {
    function ol($lis, $attrs=false)
    {
        if ($attrs !== false && !is_array($attrs)) {
            trigger_error('Attributes must be an array.');
            return false;
        }

        $inset = '';
        if (!is_array($lis)) { $inset = $lis; }
        else { foreach ($lis as $val) { $inset .= $val; } }

        return \phpOpenFW\XML\Format::xhe('ol', $inset, $attrs);
    }
}

//*****************************************************************************
//*****************************************************************************
/**
* Creates an XHTML "select" element
*/
//*****************************************************************************
//*****************************************************************************
if (!function_exists('select')) {
    function select($opts, $attrs=false)
    {
        if ($attrs !== false && !is_array($attrs)) {
            trigger_error('Attributes must be an array.');
            return false;
        }

        $inset = '';
        if (!is_array($opts)) { $inset = $opts; }
        else { foreach ($opts as $val) { $inset .= $val; } }

        return \phpOpenFW\XML\Format::xhe('select', $inset, $attrs);
    }
}

//*****************************************************************************
//*****************************************************************************
/**
* Creates an XHTML <a> element
* @param string Anchor "href" attribute
* @param string Content inside of anchor
* @param array An array, in the form of [key] => [value], of attributes
*/
//*****************************************************************************
//*****************************************************************************
if (!function_exists('anchor')) {
    function anchor($href, $content, $attrs=false)
    {
        if (!is_array($attrs)) { $attrs = array(); }
        $attrs['href'] = $href;
        $element = new GenElement('a', $content, $attrs);
        
        ob_start();
        $element->render();
        return ob_get_clean();
    }
}

//*****************************************************************************
//*****************************************************************************
/**
* Creates an XHTML <img> element
* @param string Anchor "href" attribute
* @param string Content inside of anchor
* @param array An array, in the form of [key] => [value], of attributes
*/
//*****************************************************************************
//*****************************************************************************
if (!function_exists('image')) {
    function image($src, $alt=false, $attrs=false)
    {
        if (!is_array($attrs)) { $attrs = array(); }
        $attrs['src'] = $src;
        if ($alt) { $attrs['alt'] = $alt; }
        $element = new GenElement('img', false, $attrs);
        
        ob_start();
        $element->render();
        return ob_get_clean();
    }
}
