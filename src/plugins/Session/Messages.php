<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Session Messages Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Session;

//**************************************************************************************
/**
 * Session Messages Class
 */
//**************************************************************************************
class Messages
{

	//*************************************************************************
	//*************************************************************************
	// Add Session Message
	//*************************************************************************
	//*************************************************************************
	public static function AddMessageSession($msg, $type='gen')
	{
		$type = (string)$type;
		if ($type == '') { return false; }
		$index = strtolower("{$type}_message");
		if (isset($_SESSION[$index])) {
			if (!is_array($_SESSION[$index])) {
				$tmp = $_SESSION[$index];
				$_SESSION[$index] = array($tmp);
			}
		}
		else {
			$_SESSION[$index] = array();
		}
		$_SESSION[$index][] = (string)$msg;
		return true;
	}
	
	//*************************************************************************
	//*************************************************************************
	// Shortcut Message Functions
	//*************************************************************************
	//*************************************************************************
	public static function AddBottomMessage($msg) { self::AddMessageSession($msg, 'bottom'); }
	public static function AddPageMessage($msg) { self::AddMessageSession($msg, 'page'); }
	public static function AddActionMessage($msg) { self::AddMessageSession($msg, 'action'); }
	public static function AddSuccessMessage($msg) { self::AddMessageSession($msg, 'success'); }
	public static function AddWarnMessage($msg) { self::AddMessageSession($msg, 'warn'); }
	public static function AddErrorMessage($msg) { self::AddMessageSession($msg, 'error'); }
	public static function AddGenMessage($msg) { self::AddMessageSession($msg, 'gen'); }
	public static function AddInfoMessage($msg) { self::AddMessageSession($msg, 'info'); }
	public static function AddTimerMessage($msg) { self::AddMessageSession($msg, 'timer'); }

}
