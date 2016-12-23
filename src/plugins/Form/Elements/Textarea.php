<?php
//**************************************************************************
//**************************************************************************
/**
* Textarea Form Class
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
 * Textarea Class
 * @package		phpOpenFW
 * @subpackage	Forms\Elements
 */
//**************************************************************************
class Textarea extends element
{	
	//************************************************************************
	// Constructor Function
	//************************************************************************
	public function __construct($name, $value='', $cols=20, $rows=3)
	{
		$this->element = 'textarea';
		$this->set_attribute('name', $name);
		$this->inset_val = $value;
		$this->attributes['cols'] = $cols;
		$this->attributes['rows'] = $rows;
		$this->endtag = true;
	}

}
