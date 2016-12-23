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
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @version 		Started: 3-20-2006 Updated: 12-29-2011
**/
//**************************************************************************
//**************************************************************************

//**************************************************************************
/**
 * Submit Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class Submit extends element
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
