<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Class for Globalizing Functions
 *
 * @package		phpOpenFW
 * @subpackage	Helpers
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		http://www.gnu.org/licenses/gpl-2.0.txt
 * @version 	Started: 12/28/2016, Last updated: 12/28/2016
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpen\Helpers;

//**************************************************************************************
/**
 * Globalizing Class
 * @package		phpOpenFW
 * @subpackage	Globalize
 */
//**************************************************************************************
class Globalize
{

	//*****************************************************************************
	/**
	 * Globalize XML Functions
	 */
	//*****************************************************************************
	public static function XML(Array $excluded=[])
	{
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/XML.php');
	}

	//*****************************************************************************
	/**
	 * Globalize Core Functions
	 */
	//*****************************************************************************
	public static function Core(Array $excluded=[])
	{
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/Core.php');
	}

	//*****************************************************************************
	/**
	 * Globalize UPN Functions
	 */
	//*****************************************************************************
	public static function UPN(Array $excluded=[])
	{
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/UPN.php');
	}

}
