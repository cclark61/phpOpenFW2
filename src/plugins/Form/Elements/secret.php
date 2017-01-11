<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Secret Form Class
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
 * Secret Class
 */
//**************************************************************************************
class secret extends \phpOpenFW\XML\Element
{	
	//***********************************************************************
	// Constructor Function
	//***********************************************************************
	public function __construct($name, $value='', $size=20)
	{
		$this->element = 'input';
		$this->set_attribute('type', 'password');
		$this->set_attribute('name', $name);
		$this->set_attribute('value', $value);
		$this->attributes['size'] = $size;
	}

}
