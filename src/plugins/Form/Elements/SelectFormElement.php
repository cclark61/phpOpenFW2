<?php
//**************************************************************************************
//**************************************************************************************
/**
 * An abstract core classes for constructing complex form elements
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Form\Elements;

//**************************************************************************************
/**
 * Select Form Element Class (Abstract)
 */
//**************************************************************************************
abstract class SelectFormElement extends \phpOpenFW\XML\Element
{
    /**
    * @var array An array of arrays. The attributes for elements by key.
    **/
    protected $elements_attrs;

    /**
    * @var mixed The selected value.
    **/
    protected $select_value;

    /**
    * @var Array An array of values to be prepended to the list of added items.
    **/
    protected $blank;

    //*************************************************************************
    // String Conversion Function
    //*************************************************************************
    public function __toString()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }

    //*************************************************************************
    // Set the selected value
    //*************************************************************************
    public function selected_value($value)
    {
        if (is_array($value)) {
            $this->select_value = array_flip($value);        
        }
        else {
            $this->select_value = (string)$value;
        }
    }
    
    //*************************************************************************
    // Add a Blank or Default Select Option
    //*************************************************************************
    public function add_blank($value='', $desc='')
    {
        $this->blank[] = array($value, $desc);
    }

    //*************************************************************************
    /**
    * Add Elements Attributes
    * @param array An array of arrays containing the key/value attributes, indexed by the key of the items.
    **/
    //*************************************************************************
    // Add Elements Attributes
    //*************************************************************************
    public function elements_attrs($elem_attrs)
    {
        if (!is_array($elem_attrs)) {
            trigger_error(__FUNCTION__ . ': Non-array value passed.');
            return false;
        }
        $this->elements_attrs = $elem_attrs;
        return true;
    }

}
