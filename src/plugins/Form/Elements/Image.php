<?php
//**************************************************************************
//**************************************************************************
/**
* Image Form Class
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
 * Image Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
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
