<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Page Controller Class
 *
 * @package         phpOpenFW
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Framework\Site;

//**************************************************************************************
/**
 * Page Controller Class
 */
//**************************************************************************************
class PageController
{
    //=========================================================================
    //=========================================================================
    // Execute Page Controller
    //=========================================================================
    //=========================================================================
    public static function Execute(&$page, $args=false)
    {
        //============================================================
        // Controller Parameters
        //============================================================
        if (is_array($args)) { extract($args); }
    
        //============================================================
        // Site Configuration Parameters
        //============================================================
        if (!empty($_SESSION['config']) && is_array($_SESSION['config'])) {
            extract($_SESSION['config']);
        }
    
        //============================================================
        // Current Pages
        // Page Arguments
        //============================================================
        if (!empty($curr_pages)) { extract($curr_pages); }
        if (!empty($page_args)) { extract($page_args); }
    
        //============================================================
        // Page Setup
        // Default Settings
        //============================================================
        $page_status = 200;                    // Default Status Code
        $content_layout = 'page';            // Set default content layout
        $throw_404 = false;
        $throw_500 = false;
    
        //============================================================
        // Extract $_POST and $_GET
        //============================================================
        extract($_POST, EXTR_PREFIX_SAME, 'post_');
        extract($_GET, EXTR_PREFIX_SAME, 'get_');
    
        //============================================================
        // Action variable
        //============================================================
        $action = (isset($_GET['action'])) ? ($_GET['action']) : ('');
        if (isset($_POST['action'])) { $action = $_POST['action']; }
    
        //============================================================
        // Include Pre-page Include File
        //============================================================
        if (file_exists(FILE_PATH . '/pre_page.inc.php')) {
            include(FILE_PATH . '/pre_page.inc.php');
        }
    
        //============================================================
        // Content Level Controller
        //============================================================
        if (!$page->get_data('skip-controller')) {
    
            //============================================================
            // Controller Exists
            //============================================================
            if (file_exists($controller)) {
                include($controller);
            }
            //============================================================
            // Throw 404
            //============================================================
            else {
                $throw_404 = true;
            }
        }
    
        //============================================================
        // Display: "Page Not Found"
        //============================================================
        if ($throw_404) {
            $controller_404 = "{$controller_path}/error/controller_404.php";
            if (file_exists($controller_404)) { include($controller_404); }
            else {
                if (BUFFER_PAGE) { ob_end_clean(); }
                die('404 controller not found.');
            }
            
            //---------------------------------------------
            // Flag Status Code
            //---------------------------------------------
            $page_status = 404;
        }
        //============================================================
        // Display: "Page Error"
        //============================================================
        else if ($throw_500 || isset($_SESSION['throw_500'])) {
            $controller_500 = "{$controller_path}/error/controller_500.php";
            if (file_exists($controller_500)) { include($controller_500); }
            else {
                if (BUFFER_PAGE) { ob_end_clean(); }
                die('500 controller not found.');
            }
            
            //---------------------------------------------
            // Flag Status Code
            //---------------------------------------------
            $page_status = 500;
        }
    
        //============================================================
        // Include Post-controller Include File
        //============================================================
        if (file_exists(FILE_PATH . '/post_controller.inc.php')) {
            include(FILE_PATH . '/post_controller.inc.php');
        }
    
        return $page_status;
    }
    
    //=========================================================================
    //=========================================================================
    // Error Handler
    //=========================================================================
    //=========================================================================
    public static function ErrorHandler($errno, $errstr, $errfile, $errline, $errcontext)
    {
        if (!empty($_SESSION['min_allowable_error_level'])) {
            $min_error_level = (int)$_SESSION['min_allowable_error_level'];
        }
        else {
            $min_error_level = 2048;
        }
    
        $tmp = array();
        $tmp['errno'] = $errno;
        $tmp['errstr'] = $errstr;
        $tmp['errfile'] = $errfile;
        $tmp['errline'] = $errline;
        $_SESSION['page_errors'][] = $tmp;
    
        if ($errno < $min_error_level) {
            $_SESSION['throw_500'] = true;
        }
    }   
}

