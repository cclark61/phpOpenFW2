<?php
//*******************************************************************************
//*******************************************************************************
/**
 * Class for Globalizing Functions
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//*******************************************************************************
//*******************************************************************************

namespace phpOpenFW\Format;

//*******************************************************************************
/**
 * Globalizing Class
 */
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
		if (!isset($excluded['LoadHTMLHelpers'])) {
			self::LoadHTMLHelpers();
		}
		if (!isset($excluded['LoadSessionMessageHelpers'])) {
			self::LoadSessionMessageHelpers();
		}
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

	//*****************************************************************************
	/**
	 * Load Global HTML Helper Functions
	 */
	//*****************************************************************************
	public static function LoadHTMLHelpers()
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/xhtml_gen.inc.php');
	}

	//*****************************************************************************
	/**
	 * Load Session Messages Helper Functions
	 */
	//*****************************************************************************
	public static function LoadSessionMessageHelpers()
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/SessionMessages.inc.php');
	}

}
