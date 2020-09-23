<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Application Framework Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 */
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Framework;
use phpOpenFW\Framework\App\Security as Security;

//**************************************************************************************
/**
 * Application Framework Class
 */
//**************************************************************************************
class App
{

	//*************************************************************************
	/**
	* Run Method
	**/
	//*************************************************************************
	public static function Run($file_path)
	{
		//============================================================
		// Must specify an applciation directory
		//============================================================
		if (!is_dir($file_path)) {
			die('You must give a valid application path.');
		}

		//============================================================
		// Bootstrap the Core
		//============================================================
		\phpOpenFW\Framework\Core::Bootstrap($file_path);

		//============================================================
		// Load Config if not logged in
		//============================================================
		if (!isset($_SESSION['userid'])) {
		    \phpOpenFW\Framework\Core::load_config();
		    self::Configure();
		}

		//============================================================
		// Set module
		//============================================================
		$mod = (isset($_GET['mod'])) ? ( $_GET['mod'] ) : ( '-1' );
		$in_mod = $mod;
		
		//============================================================
		// If not logged in
		//============================================================
		if (!isset($_SESSION['userid'])) {
			$mod = 'login';
		
		    //--------------------------------------------------------
			// Set Login URL if needed
		    //--------------------------------------------------------
			if ($_SERVER['REQUEST_URI'] != '/' && $in_mod != 'logout' && !isset($_SESSION['login_url'])) { 
				$_SESSION['login_url'] = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			}
		}
		
		//============================================================
		// Login: Check for a passed user
		//============================================================
		if ($mod == 'login' && !isset($_POST['user'])) { $mod = '-1'; } 
		
		//============================================================
		// Logout: Check that the user is logged in
		//============================================================
		if ($mod == 'logout' && !isset($_SESSION['userid'])) { $mod = '-1'; } 
		
		//============================================================
		// Choose page action
		//============================================================
		switch ($mod) {
		
			//************************************************************
			// * Login
			//************************************************************
			case 'login':

		        //=============================================================
				// Perform Login Operation
				//=============================================================
				if (!isset($_SESSION['userid'])) {
					$login = new Security\Login();

		            //--------------------------------------------------------
					// If login.inc.php exists include it
		            //--------------------------------------------------------
					if (file_exists(PHPOPENFW_APP_FILE_PATH . '/login.inc.php')) {
		    			require_once(PHPOPENFW_APP_FILE_PATH . '/login.inc.php');
		            }

		            //--------------------------------------------------------
					// If previous URL given go there after login
		            //--------------------------------------------------------
					if (isset($_SESSION['login_url'])) {
						$url_prefix = (!empty($_SERVER['HTTPS'])) ? ('https://') : ('http://');
						$login_url = $_SESSION['login_url'];
						unset($_SESSION['login_url']);
						header("Location: {$url_prefix}{$login_url}");
						exit;
					}
				}
				$page = new App\Flow\Module();
				break;
		
			//************************************************************
			// * Logout
			//************************************************************
			case 'logout':
				$page = new App\Flow\Message('7');
				break;
		
			//************************************************************
			// * Normal Page
			//************************************************************
			default:
		
				//************************************************************
				// ** User is NOT Logged in
				//************************************************************
				if (!isset($_SESSION['userid'])) {
					switch ($_SESSION['auth_data_type']) {
						case 'mysql':
						case 'pgsql':
						case 'mysqli':
						case 'oracle':
						case 'mssql':
						case 'sqlsrv':
						case 'sqlite':
						case 'db2':
						case 'custom':
							//============================================================
		                    // Show Login Page
							//============================================================
							$page = new App\Flow\Message('login');
							break;
							
						case 'error';
							$page = new App\Flow\Message('8');
							break;
							
						default:
						    //=============================================================
							// Perform Login Operation
							//=============================================================
							$login = new Security\Login();

		                    //=============================================================
							// If login.inc.php exists include it
		                    //=============================================================
							if (file_exists(PHPOPENFW_APP_FILE_PATH . '/login.inc.php')) {
		    					require_once(PHPOPENFW_APP_FILE_PATH . '/login.inc.php');
		    				}
		
		                    //=============================================================
							// If previous URL given go there after login
							//=============================================================
							if (isset($_SESSION['login_url'])) {
								$url_prefix = (!empty($_SERVER['HTTPS'])) ? ('https://') : ('http://');
								header("Location: $url_prefix" . $_SESSION['login_url']);
								unset($_SESSION['login_url']);
								die();
							}
							
							$page = new App\Flow\Module();
							break;
					}
				}
				//************************************************************
				// ** User is Logged in
				//************************************************************
				else {
					$page = new App\Flow\Module();
				}
				break;
		}
		
		//============================================================
		// Render Page
		//============================================================
		$page->render();
	}

	//************************************************************************
	//************************************************************************
    /**
    * Load Configuration Function
    */
	//************************************************************************
    // Load Configuration Function
	//************************************************************************
	//************************************************************************
    protected static function Configure()
    {
    	//*************************************************************
    	// Set Authentication Data Source
    	//*************************************************************
    	if (!isset($_SESSION['auth_data_source']) || empty($_SESSION['auth_data_source'])) {
    		$_SESSION['auth_data_source'] = 'none';
    	}

    	//*************************************************************
    	// Set Authentication Data Type
    	//*************************************************************
    	if ($_SESSION['auth_data_source'] != 'none' && $_SESSION['auth_data_source'] != 'custom') {
    		 if (!array_key_exists($_SESSION['auth_data_source'], $_SESSION['data_sources']) && $_SESSION['auth_data_source'] != 'none') {
    		 	$_SESSION['auth_data_type'] = 'error';
    		 }
    		 else {
    		 	$_SESSION['auth_data_type'] = $_SESSION[$_SESSION['auth_data_source']]['type'];
    		 }
    	}
    	else if ($_SESSION['auth_data_source'] == 'custom') {
    		$_SESSION['auth_data_type'] = 'custom';
    	}
    	else {
    		$_SESSION['auth_data_type'] = 'none';
    	}
    }

}
