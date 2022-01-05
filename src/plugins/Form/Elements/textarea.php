<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Textarea Form Class
 *
 * @package         phpOpenFW
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
 * Textarea Class
 */
//**************************************************************************************
class textarea extends \phpOpenFW\XML\Element
{    
    //************************************************************************
    // Constructor Function
    //************************************************************************
    public function __construct($name, $value='', $cols=20, $rows=3)
    {
        $this->element = 'textarea';
        $this->set_attribute('name', $name);
        $this->inset_val = $value;
        $this->attributes['cols'] = $cols;
        $this->attributes['rows'] = $rows;
        $this->endtag = true;
    }

}
