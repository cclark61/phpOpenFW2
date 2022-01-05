<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Creates a generic xml element with content
 *
 * @param string Element Name (ie. "div", "data", "p", etc.) Can be XML or XHTML
 * @param string Content inside of element
 * @param array An array, in the form of [key] => [value], of attributes
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\XML;

//**************************************************************************************
/**
 * Generic (XML) Element Class
 */
//**************************************************************************************
class GenElement extends Element
{
    public function __construct($element, $content=false, $attrs=false)
    {
        $this->element = $element;
        $this->tabs = 0;
        if ($content !== false && $content !== '') { $this->inset_val = $content; }
        if (is_array($attrs)) {
            foreach ($attrs as $key => $val) { $this->set_attribute($key, $val); }
        }
    }
}
