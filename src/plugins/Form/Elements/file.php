<?php
//**************************************************************************
//**************************************************************************
/**
* File Form Class
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
 * File Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
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
