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
* @license		https://mit-license.org
* @version 		Started: 3-20-2006 Updated: 12-29-2011
**/
//**************************************************************************
//**************************************************************************

namespace phpOpenFW\Form\Elements;

//**************************************************************************
/**
 * Button Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class button extends \phpOpenFW\XML\Element
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
