<?php
//**************************************************************************
//**************************************************************************
/**
* Hidden Form Class
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
 * Hidden Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class Hidden extends element
{	
	//***********************************************************************
	// Constructor Function
	//***********************************************************************
	public function __construct($name, $value)
	{
		$this->element = 'input';
		$this->set_attribute('type', 'hidden');
		$this->set_attribute('name', $name);
		$this->set_attribute('value', $value);
	}

}
