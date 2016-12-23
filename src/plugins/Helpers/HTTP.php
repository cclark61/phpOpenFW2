<?php
//*****************************************************************************
//*****************************************************************************
/**
* HTTP Helper Object
*
* @package		phpOpenPlugins
* @subpackage	Helper
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @link			http://www.emonlade.net/phpopenplugins/
* @version 		Started: 8/25/2015, Last updated: 8/27/2015
**/
//*****************************************************************************
//*****************************************************************************

//*******************************************************************************
//*******************************************************************************
// HTTP Helper Object
//*******************************************************************************
//*******************************************************************************
class HTTP
{

	//=============================================================================
	//=============================================================================
	/**
	 * This method will redirect the user to the given page and also send
	 * a message with it if wanted
	 *
	 * @param string $location The location to send the user, if empty $_SERVER['REDIRECT_URL'] is used
	 * @param string $message. The message to display once redirected
	 * @param mixed $message_type The message type. Options are:
	 * 		'error_message', 'warn_message', 'action_message' (default), 'gen_message', 'page_message'
	 */
	//=============================================================================
	//=============================================================================
	function redirect($location=false, $message=false, $message_type='action_message')
	{
		//-----------------------------------------------------
		// Set flag to stop page render
		//-----------------------------------------------------
		define('POFW_SKIP_RENDER', 1);

		//-----------------------------------------------------
		// Set the location
		//-----------------------------------------------------
		if (empty($location)) {
			$qs_start = strpos($_SERVER['REQUEST_URI'], '?');
			if ($qs_start === false) {
				$location = $_SERVER['REQUEST_URI'];
			}
			else {
				$location = substr($_SERVER['REQUEST_URI'], 0, $qs_start);
			}
		}

		//-----------------------------------------------------
		// Add a Message?
		//-----------------------------------------------------
		$msg_func = 'add_' . $message_type;
		if (!empty($message) && function_exists($msg_func)) {
			call_user_func($msg_func, $message);
		}
	
		//-----------------------------------------------------
		// Redirect
		//-----------------------------------------------------
		header("Location: {$location}");
		exit;
	}

}
