<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Site Framework Class
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 */
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Framework;

//**************************************************************************************
/**
 * Site Framework Class
 */
//**************************************************************************************
class Site
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
            die('You must give a valid site path.');
        }

        //============================================================
        // Capture page start time
        //============================================================
        $page_start_time = microtime();

        //============================================================
        // Check if user is logged in
        //============================================================
        $logged_in = (isset($_SESSION['userid'])) ? (true) : (false);

        //============================================================
        // POST Authentication Redirect
        //============================================================
        if ($logged_in && !empty($_SESSION['post_auth_redirect_url'])) {
            $tmp_url = $_SESSION['post_auth_redirect_url'];
            unset($_SESSION['post_auth_redirect_url']);
            header("Location: {$tmp_url}");
            exit;
        }

        //============================================================
        // Regular Redirect
        //============================================================
        if (!empty($_SESSION['redirect_url'])) {
            $tmp_url2 = $_SESSION['redirect_url'];
            unset($_SESSION['redirect_url']);
            header("Location: {$tmp_url2}");
            exit;
        }

        //============================================================
        // Bootstrap the Core
        //============================================================
        \phpOpenFW\Framework\Core::Bootstrap($file_path);

        //============================================================
        // Include Application Logic
        // Start Page Data
        // Create new Page Object
        //============================================================
        $page = new \phpOpenFW\Framework\Site\Page();
        $controller_args = array();

        //============================================================
        // Server Name / HTTP Host / SSL ?
        //============================================================
        $server_name = $_SERVER['SERVER_NAME'];
        $http_host = (!empty($_SERVER['HTTP_HOST'])) ? ($_SERVER['HTTP_HOST']) : ('');
        $https = (!empty($_SERVER['HTTPS'])) ? (1) : (0);

        //============================================================
        // Settings
        //============================================================
        $base_url = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        if (!$base_url) { $base_url = '/'; }
        $base_path = $file_path;
        $templates = $file_path . '/templates';
        $nav_dir = $file_path . '/navs';
        $controller_path = "{$file_path}/controllers";
        $http_prefix = ($https) ? ('https://') : ('http://');
        $site_home_url = ($http_host) ? ($http_host) : ($server_name);
        $site_home_url = $http_prefix . $site_home_url . $base_url;
        $catch_errors = (!empty($_SESSION['config']['catch_errors'])) ? (1) : (0);
        $buffer_page = (!empty($_SESSION['config']['buffer_page'])) ? (1) : (0);
        $mode = (isset($_SESSION['config']['mode'])) ? ($_SESSION['config']['mode']) : (false);

        //============================================================
        // Defined Constants
        //============================================================
        define('BASE_URL', $base_url);
        define('SERVER_NAME', $server_name);
        define('HTTP_HOST', $http_host);
        define('HTTPS', $https);
        define('HTTP_PREFIX', $http_prefix);
        define('SITE_MODE', $mode);
        define('FILE_PATH', $file_path);
        define('SITE_HOME_URL', $site_home_url);
        define('BUFFER_PAGE', $buffer_page);
        define('CATCH_ERRORS', $catch_errors);
        define('LOGGED_IN', $logged_in);
        define('CONTROLLER_PATH', $controller_path);

        //============================================================
        // Set Local Plugin Folder
        //============================================================
        if (is_dir(FILE_PATH . '/plugins')) {
            \phpOpenFW\Framework\Core::set_plugin_folder(FILE_PATH . '/plugins');
        }

        //============================================================
        // Load Database Config
        //============================================================
        \phpOpenFW\Framework\Core::load_config(false, ['session_index' => 'config']);

        //============================================================
        // Load Database Config
        //============================================================
        //\phpOpenFW\Framework\Core::load_db_config();

        //************************************************************************
        //************************************************************************
        // Page Content Settings
        //************************************************************************
        //************************************************************************

        //============================================================
        // Server Name / HTTP Host / HTTPS
        //============================================================
        $page->set_data('mode', $mode);
        $page->set_data('server_name', $server_name);
        $page->set_data('http_host', $http_host);
        $page->set_data('https', $https);

        //============================================================
        // Set User Info
        //============================================================
        $tmp = ($logged_in) ? ('yes') : ('no');
        $page->set_data('logged_in', $tmp);
        if ($logged_in && isset($_SESSION['user_info'])) {
            $page->set_data('user_info', $_SESSION['user_info']);
        }

        //============================================================
        // Messages to Capture
        //============================================================
        // -> Generic Message
        // -> Action Message
        // -> Warn Message
        // -> Error Message
        // -> Bottom Message
        // -> Page Message
        // -> Timer Message
        //============================================================
        $message_types = 'gen_message action_message warn_message error_message bottom_message page_message timer_message';
        foreach (explode(' ', $message_types) as $mtype) {
            if (isset($_SESSION[$mtype])) {
                $page->set_data($mtype, $_SESSION[$mtype]);
                unset($_SESSION[$mtype]);
            }
        }

        //============================================================
        // Error Handler
        //============================================================
        if (CATCH_ERRORS) {
            $_SESSION['page_errors'] = array();
            set_error_handler('POFW_SiteController::error_handler');
        }

        //************************************************************************
        //************************************************************************
        // Handle Page Control
        //************************************************************************
        //************************************************************************

        //============================================================
        // Build URL Path and Parts
        //============================================================
        $module_url_path = \phpOpenFW\Framework\Core::get_url_path();
        if ($base_url != '/') {
            $module_url_path = str_replace($base_url, '', $module_url_path);
        }
        if (strlen($module_url_path) > 0) {

            //---------------------------------------------
            // Remove Trailing Slashes
            //---------------------------------------------
            while (substr($module_url_path, strlen($module_url_path) - 1, 1) == "/") {
                $module_url_path = substr($module_url_path, 0, strlen($module_url_path) - 1);
            }

            //---------------------------------------------
            // Remove Front Slashes
            //---------------------------------------------
            while (substr($module_url_path, 0, 1) == "/") {
                $module_url_path = substr($module_url_path, 1, strlen($module_url_path));
            }
        }

        if ($module_url_path == '') { $module_url_path = 'home'; }
        $url_parts = explode('/', $module_url_path);
        if (count($url_parts) == 1 && $url_parts[0] == '') { $url_parts[0] = 'home'; }

        //============================================================
        // Set current pages / page arguments
        //============================================================
        $index_num = count($url_parts);
        $curr_pages = array();
        $page_args = array();
        $tmp_page_args = array();
        $controller = false;
        for ($i = count($url_parts) - 1; $i >= 0 ; $i--) {

            //---------------------------------------------
            // Set Current Page
            //---------------------------------------------
            $index_name = 'curr_page' . $index_num;
            $curr_pages[$index_name] = $url_parts[$i];

            if (!$controller) {
                if (!is_numeric($url_parts[$i]) && substr($url_parts[$i], strlen($url_parts[$i]) - 5, 5) != '.html') {
                    $tmp = implode('/', array_slice($url_parts, 0, $i + 1));
                    $tmp_controller = "{$controller_path}/{$tmp}/controller.php";
                    if (file_exists($tmp_controller)) {
                        $controller = $tmp_controller;
                    }
                }

                if (!$controller) { $tmp_page_args[] = $url_parts[$i]; }
            }

            $index_num--;
        }

        $index = count($tmp_page_args);
        foreach ($tmp_page_args as $arg) {
            $index_name = 'page_arg' . $index;
            $page_args[$index_name] = $arg;
            $index--;
        }
        $page->set_data('curr_pages', $curr_pages);
        $page->set_data('page_args', $page_args);

        //************************************************************************
        //************************************************************************
        // Execute Page Level Controller
        //************************************************************************
        //************************************************************************

        //============================================================
        // Start output buffering if using page buffering turned on
        //============================================================
        if (BUFFER_PAGE) { ob_start(); }

        //============================================================
        // Set Controller Parameters
        //============================================================
        $controller_args['logged_in'] = $logged_in;
        $controller_args['base_path'] = $base_path;
        $controller_args['file_path'] = $file_path;
        $controller_args['templates'] = $templates;
        $controller_args['nav_dir'] = $nav_dir;
        $controller_args['curr_pages'] = $curr_pages;
        $controller_args['page_args'] = $page_args;
        $controller_args['controller_path'] = $controller_path;
        $controller_args['controller'] = $controller;
        $controller_args['site_home_url'] = $site_home_url;

        //============================================================
        // Execute Page Controller
        //============================================================
        $page_status = \phpOpenFW\Framework\Site\PageController::Execute($page, $controller_args);

        //============================================================
        // End output buffering if using page buffering turned on
        //============================================================
        if (BUFFER_PAGE) { ob_end_clean(); }

        //************************************************************************
        //************************************************************************
        // Render Page
        //************************************************************************
        //************************************************************************
        if (BUFFER_PAGE) { print $page; }
        else { $page->render(); }

        //************************************************************************
        //************************************************************************
        // Page Finish and Cleanup
        //************************************************************************
        //************************************************************************

        //============================================================
        // Capture Page end time
        //============================================================
        $page_end_time = microtime();

        //============================================================
        // Include Post-page Include File
        //============================================================
        if (file_exists(FILE_PATH . '/post_page.inc.php')) {
            include(FILE_PATH . '/post_page.inc.php');
        }

        //============================================================
        // Unset Page / Session Errors
        //============================================================
        if (isset($_SESSION['page_errors'])) { unset($_SESSION['page_errors']); }
        if (isset($_SESSION['throw_500'])) { unset($_SESSION['throw_500']); }
    }

}
