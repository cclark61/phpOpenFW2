<?php
//**************************************************************************
//**************************************************************************
/**
* Secret Form Class
*
* @package		phpOpenFW
* @subpackage	Forms\Elements
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		https://mit-license.org
* @version 		Started: 3-20-2006 Updated: 12-29-2011
**/
//**************************************************************************
//**************************************************************************

namespace phpOpenFW\Form\Elements;

//**************************************************************************
/**
 * Secret Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
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
