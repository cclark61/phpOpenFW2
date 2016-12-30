<?php
//**************************************************************************
//**************************************************************************
/**
* Radio Form Class
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
 * Radio Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class radio extends \phpOpenFW\XML\Element
{	
	//***********************************************************************
	// Constructor Function
	//***********************************************************************
	public function __construct($name, $value, $checked=false)
	{
		$this->element = 'input';
		$this->set_attribute('type', 'radio');
		$this->set_attribute('name', $name);
		$this->set_attribute('value', $value);
		if ($checked) { $this->set_attribute('checked', 'checked'); }
	}

}
