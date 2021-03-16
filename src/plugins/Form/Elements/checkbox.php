<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Checkbox Form Class
 *
 * @package        phpOpenFW
 * @author         Christian J. Clark
 * @copyright    Copyright (c) Christian J. Clark
 * @license        https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Form\Elements;

//**************************************************************************************
/**
 * Checkbox Class
 */
//**************************************************************************************
class checkbox extends \phpOpenFW\XML\Element
{    
    //************************************************************************
    // Constructor Function
    //************************************************************************
    public function __construct($name, $value, $checked=false)
    {
        $this->element = 'input';
        $this->set_attribute('type', 'checkbox');
        $this->set_attribute('name', $name);
        $this->set_attribute('value', $value);
        if ($checked) { $this->set_attribute('checked', 'checked'); }
    }

}
