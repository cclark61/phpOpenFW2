<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Class for Globalizing Functions
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Helpers;

//**************************************************************************************
/**
 * Globalizing Class
 */
//**************************************************************************************
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
	public static function All(Array $excluded=[], Array $args=[])
	{
		self::Bootstrap();
		self::XML($excluded, $args);
		self::Core($excluded, $args);
		self::UPN($excluded, $args);
		self::phpOpenPlugins($excluded, $args);
		if (!isset($excluded['LoadHTMLHelpers'])) {
			self::LoadHTMLHelpers($excluded, $args);
		}
		if (!isset($excluded['LoadSessionMessageHelpers'])) {
			self::LoadSessionMessageHelpers($excluded, $args);
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
	 * Globalize phpOpenPlugins Functions
	 */
	//*****************************************************************************
	public static function phpOpenPlugins(Array $excluded=[], Array $args=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/phpOpenPlugins.php');
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
