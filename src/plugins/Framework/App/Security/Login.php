<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Login Class
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 * @access          private
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Framework\App\Security;
use phpOpenFW\Framework\App\Flow as Flow;

//**************************************************************************************
/**
 * Login Class
 */
//**************************************************************************************
class Login
{

    /**
    * @var bool status of the current login process (true = success, false = failure)
    **/
    private $status;

    /**
    * @var string Authentication Data Source
    **/
    private $auth_data_source;
    
    /**
    * Constructor function
    * Performs Login operation (new authentication)
    **/
    //************************************************************************
    // Constructor function
    //************************************************************************
    public function __construct()
    {
        //****************************************************
        // Set Authentication Data Source
        //****************************************************
        $this->auth_data_source = strtolower($_SESSION['auth_data_source']);

        //****************************************************
        // Set login status to false by default
        //****************************************************
        $this->status = false;

        //****************************************************
        // Build Array NAVs        
        //****************************************************
        $modules_dir = (isset($_SESSION['modules_dir'])) ? ($_SESSION['modules_dir']) : ('modules');
        $modules_path = PHPOPENFW_APP_FILE_PATH . '/' . $modules_dir;
        if (file_exists($modules_path) && is_dir($modules_path)) {
            $nav = new Nav($modules_path);
        }
        $_SESSION['menu_array'] = (isset($nav)) ? ($nav->export()) : (array());
        $_SESSION['menu_array2'] = (isset($nav)) ? ($nav->export2()) : (array());

        //**************************************
        // Authenticate
        //**************************************
        $authen = new Authentication();

        //**************************************
        // Authentication Success
        //**************************************
        if ($authen->status()) {

            //-----------------------------------------------------
            // Build XML Nav
            //-----------------------------------------------------
            $module_xml = new XMLNav($_SESSION['menu_array']);
            $_SESSION['menu_xml'] = $module_xml->export();

            //-----------------------------------------------------
            // Login Success
            //-----------------------------------------------------
            $this->status = true;
        }
        //**************************************
        // Authentication Failed
        //**************************************
        else { $this->fail_login('1'); } 
    }

    /**
    * Displays message page upon failed authentication
    * @param mixed message code
    **/
    //*************************************************************************
    // Failed Login Function
    //*************************************************************************
    private function fail_login($msg)
    {
        if (isset($_SESSION['failed_login_function']) && function_exists($_SESSION['failed_login_function'])) {
            $fail_ret_val = call_user_func($_SESSION['failed_login_function']);
        }
        else if (function_exists('failed_login')) {
            $fail_ret_val = call_user_func('failed_login');
        }
        if (!empty($fail_ret_val)) {
            $msg = $fail_ret_val;
        }
        $page = new Flow\Message($msg);
        $page->render();
        exit(0);
    }
    
    /**
    * Return the status of the current login process
    **/
    //*************************************************************************
    // Return the status of the current login process
    //*************************************************************************
    public function status() { return $this->status; }
    
}
