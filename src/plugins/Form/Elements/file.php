<?php
//**************************************************************************************
//**************************************************************************************
/**
 * File Form Class
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
 * File Class
 */
//**************************************************************************************
class file extends \phpOpenFW\XML\Element
{
    //************************************************************************
    // Constructor Function
    //************************************************************************
    public function __construct($name, $size=20)
    {
        $this->element = 'input';
        $this->set_attribute('type', 'file');
        $this->set_attribute('name', $name);
        $this->attributes['size'] = $size;
    }

}
