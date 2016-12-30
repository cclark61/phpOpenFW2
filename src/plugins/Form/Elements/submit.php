<?php
//**************************************************************************
//**************************************************************************
/**
* Submit Form Class
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
 * Submit Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class submit extends \phpOpenFW\XML\Element
{	
	//************************************************************************
	// Constructor Function
	//************************************************************************
	public function __construct($name, $value)
	{
		$this->element = 'input';
		$this->set_attribute('type', 'submit');
		$this->set_attribute('value', $value);
	}

}
