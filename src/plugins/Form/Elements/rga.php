<?php
//**************************************************************************************
//**************************************************************************************
/**
 * A class for constructing a Radio Group from Array (RGA)
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
 * Radio Group from Array Class
 */
//**************************************************************************************
class rga extends GroupFormElement
{
    /**
    * @var string Name of the Radio buttons
    **/
    private $name;            // Name :)
    
    /**
    * @var array An associative array of radio buttons where each element is in the form ["value => "desc"]
    **/
    private $buttons;        // Array: [value] => [desc]

    //*************************************************************************
    /**
    * RGA constructor function
    * @param string Name of the radio buttons
    * @param array A properly formatted array representing the radio buttons
    **/
    //*************************************************************************
    // Constructor Function
    //*************************************************************************
    public function __construct($name, $buttons)
    {
        $this->name = $name;
        $this->buttons = is_array($buttons) ? ($buttons) : (array());
        $this->style = 'newline';
    }
    
    //*************************************************************************
    /**
    * RGA class render function
    **/
    //*************************************************************************
    // Construct and output the RGA.
    //*************************************************************************
    public function render($buffer=false)
    {
        foreach($this->buttons as $value => $desc) {
            $is_checked = false;

            //-----------------------------------------
            // Is Checked?
            //-----------------------------------------
            if (isset($this->checked_value) && $this->checked_value == $value) {
                $is_checked = true;
            }

            //-----------------------------------------
            // Create Radio Button
            //-----------------------------------------
            $r = new radio($this->name, $value, $is_checked);

            //-----------------------------------------
            // Element Attributes
            //-----------------------------------------
            if (isset($this->elements_attrs[$value])) {
                $r->attrs($this->elements_attrs[$value]);
            }

            //-----------------------------------------
            // Output
            //-----------------------------------------
            print $r . '&nbsp;' . $desc;
            if ($this->style == 'newline') { print '<br/>'; }
            else if ($this->style == 'custom') { print $this->custom_style; }
        }            
    }    

}

