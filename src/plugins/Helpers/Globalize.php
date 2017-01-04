<?php
//*******************************************************************************
//*******************************************************************************
/**
 * Class for Globalizing Functions
 *
 * @package		phpOpenFW
 * @subpackage	Helpers
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 * @version 	Started: 12/28/2016, Updated: 12/28/2016
 **/
//*******************************************************************************
//*******************************************************************************

namespace phpOpenFW\Helpers;

//*******************************************************************************
//*******************************************************************************
/**
 * Globalizing Class
 * @package		phpOpenFW2
 * @subpackage	Globalize
 */
//*******************************************************************************
//*******************************************************************************
class Globalize
{

	//*****************************************************************************
	/**
	 * Bootstrap Method
	 */
	//*****************************************************************************
	protected static function Bootstrap()
	{
		//============================================================
		// Bootstrap the Core?
		//============================================================
		if (!defined('PHPOPENFW_FRAME_PATH')) {
			\phpOpenFW\Framework\Core::Bootstrap();
		}
	}

	//*****************************************************************************
	/**
	 * Globalize ALL Functions
	 */
	//*****************************************************************************
	public static function All(Array $excluded=[])
	{
		self::Bootstrap();
		self::XML($excluded);
		self::Core($excluded);
		self::UPN($excluded);
	}

	//*****************************************************************************
	/**
	 * Globalize XML Functions
	 */
	//*****************************************************************************
	public static function XML(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/XML.php');
	}

	//*****************************************************************************
	/**
	 * Globalize Core Functions
	 */
	//*****************************************************************************
	public static function Core(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/Core.php');
	}

	//*****************************************************************************
	/**
	 * Globalize UPN Functions
	 */
	//*****************************************************************************
	public static function UPN(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/UPN.php');
	}

}
