<?php
//*****************************************************************************
//*****************************************************************************
/**
* A Core plugin for classes used with static functions
*
* @package		phpOpenFW
* @subpackage	Core
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		https://mit-license.org
* @version 		Started: 8/25/2015, Updated: 8/25/2015
**/
//*****************************************************************************
//*****************************************************************************

namespace phpOpenFW\Cores;

abstract class StaticCore
{
	//========================================================================
	/**
	* Display Error Function
	**/
	//========================================================================
	protected static function display_error($function, $msg)
	{
		trigger_error("Error: {$function}(): {$msg}");
	}

}
