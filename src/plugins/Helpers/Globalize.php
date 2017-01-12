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
	 * Globalize ALL Functions / Classes
	 */
	//*****************************************************************************
	public static function All(Array $excluded=[], Array $args=[])
	{
		self::Bootstrap();
		self::Core($excluded, $args);
		self::XML($excluded, $args);
		self::Database($excluded, $args);
		self::Form($excluded, $args);
		self::HTML($excluded, $args);
		if (!empty($args['Utility'])) {
			self::Utility($excluded, $args);
		}
		if (!empty($args['App'])) {
			self::App($excluded, $args);
		}
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
	 * Globalize Core Functions / Classes
	 */
	//*****************************************************************************
	public static function Core(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/Core.php');
	}

	//*****************************************************************************
	/**
	 * Globalize XML Functions / Classes
	 */
	//*****************************************************************************
	public static function XML(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/XML.php');
	}

	//*****************************************************************************
	/**
	 * Globalize Database Functions / Classes
	 */
	//*****************************************************************************
	public static function Database(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/Database.php');
	}

	//*****************************************************************************
	/**
	 * Globalize Database Functions / Classes
	 */
	//*****************************************************************************
	public static function Form(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/Form.php');
	}

	//*****************************************************************************
	/**
	 * Globalize HTML Functions / Classes
	 */
	//*****************************************************************************
	public static function HTML(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/HTML.php');
	}

	//*****************************************************************************
	/**
	 * Globalize Utility Functions / Classes
	 */
	//*****************************************************************************
	public static function Utility(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/Utility.php');
	}

	//*****************************************************************************
	/**
	 * Globalize App Functions / Classes
	 */
	//*****************************************************************************
	public static function App(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/App.php');
	}

	//*****************************************************************************
	/**
	 * Globalize UPN Functions / Classes
	 */
	//*****************************************************************************
	public static function UPN(Array $excluded=[])
	{
		self::Bootstrap();
		include_once(PHPOPENFW_FRAME_PATH . '/src/globals/Globalize/UPN.php');
	}

	//*****************************************************************************
	/**
	 * Globalize phpOpenPlugins Functions / Classes
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
