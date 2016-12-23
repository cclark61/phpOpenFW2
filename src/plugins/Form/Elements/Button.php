<?php
//**************************************************************************
//**************************************************************************
/**
* Button Form Class
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
 * Button Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class Button extends element
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
