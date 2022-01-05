<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Button Form Class
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
 * Button Class
 */
//**************************************************************************************
class button extends \phpOpenFW\XML\Element
{    
    //************************************************************************
    // Constructor Function
    //************************************************************************
    public function __construct($content, $type=false)
    {
        $this->element = 'button';
        if ($type) { $this->set_attribute('type', $type); }
        $this->inset($content);
    }

}
