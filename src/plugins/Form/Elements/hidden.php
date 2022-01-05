<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Hidden Form Class
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
 * Hidden Class
 */
//**************************************************************************************
class hidden extends \phpOpenFW\XML\Element
{    
    //***********************************************************************
    // Constructor Function
    //***********************************************************************
    public function __construct($name, $value)
    {
        $this->element = 'input';
        $this->set_attribute('type', 'hidden');
        $this->set_attribute('name', $name);
        $this->set_attribute('value', $value);
    }

}
