<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Image Form Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Form\Elements;

//**************************************************************************************
/**
 * Image Class
 */
//**************************************************************************************
class image extends \phpOpenFW\XML\Element
{	
	//***********************************************************************
	// Constructor Function
	//***********************************************************************
	public function __construct($source, $name=false)
	{
		$this->element = 'input';
		$this->set_attribute('type', 'image');
		$this->set_attribute('src', $source);
		if ($name) { $this->set_attribute('name', $name); }
	}

}
