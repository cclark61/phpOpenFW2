<?php
//************************************************************************************
//************************************************************************************
/**
 * Plugins Class
 *
 * @package        phpOpenFW
 * @author         Christian J. Clark
 * @copyright    Copyright (c) Christian J. Clark
 * @license        https://mit-license.org
 **/
//************************************************************************************
//************************************************************************************

namespace phpOpenFW\Framework\Core;

//**************************************************************************************
/**
 * Plugins Class
 */
//**************************************************************************************
class Plugins
{
    //************************************************************************
    //************************************************************************
    /**
    * Set External Plugin Folder
    * @param string File path to plugin folder
    */
    //************************************************************************
    //************************************************************************
    public static function SetPluginFolder($dir)
    {
        //=================================================================
        // Validate Directory
        //=================================================================
        if (!$dir || !is_dir($dir)) {
            trigger_error('Error: SetPluginFolder(): Invalid directory passed.');
            return false;
        }

        //=================================================================
        // Get the MD5 Hash for indexing
        //=================================================================
        $pf_hash = md5($dir);

        //=================================================================
        // Does App Plugin Index Exist?
        //=================================================================
        if (!isset($_SESSION['app_plugin_folder'])) {
            $_SESSION['app_plugin_folder'] = array();
        }
        //=================================================================
        // Check if plugin folder is already set
        //=================================================================
        else if (isset($_SESSION['app_plugin_folder'][$pf_hash])) {
            return true;
        }

        //=================================================================
        // Addd New Plugin Folder
        //=================================================================
        $_SESSION['app_plugin_folder'][$pf_hash] = $dir;
        return true;
    }

    //************************************************************************
    //************************************************************************
    /**
    * Unset External Plugin Folder
    * @param string File path to plugin folder
    */
    //************************************************************************
    //************************************************************************
    public static function UnsetPluginFolder($dir)
    {
        //=================================================================
        // Validate Directory
        //=================================================================
        if (!$dir || !is_dir($dir)) {
            trigger_error('Error: UnsetPluginFolder(): Invalid directory passed.');
            return false;
        }

        //=================================================================
        // Get the MD5 Hash for indexing
        //=================================================================
        $pf_hash = md5($dir);

        //=================================================================
        // Does App Plugin Index Exist?
        //=================================================================
        if (!isset($_SESSION['app_plugin_folder'])) {
            return false;
        }
        //=================================================================
        // Check if plugin folder is already set
        //=================================================================
        else if (isset($_SESSION['app_plugin_folder'][$pf_hash])) {
            unset($_SESSION['app_plugin_folder'][$pf_hash]);
            return true;
        }

        return false;
    }

    //************************************************************************
    //************************************************************************
    /**
    * Load Plugin Function
    * @param string The Name of the plugin
    */
    //************************************************************************
    //************************************************************************
    public static function Load($plugin)
    {
        //=================================================================
        // Are there plugin folders defined?
        //=================================================================
        if (empty($_SESSION['app_plugin_folder'])) {
            //trigger_error("Error: Load(): No plugin folders are set!");
            return false;
        }

        //=================================================================
        // Create a plugin hash
        // Adjust plugin for Namespaces
        //=================================================================
        $plugin_hash = md5($plugin);
        $plugin = str_replace('\\', '/', $plugin);

        //=================================================================
        // Is the location of the plugin cached?
        //=================================================================
        if (isset($_SESSION['app_plugin_folder_cache'][$plugin_hash])) {
            require_once($_SESSION['app_plugin_folder_cache'][$plugin_hash]);
            return true;
        }

        //=================================================================
        // Attempt to locate and load the plugin
        //=================================================================
        foreach ($_SESSION['app_plugin_folder'] as $pf) {
            $plugin_opts = array(
                "{$pf}/{$plugin}.inc.php",
                "{$pf}/{$plugin}.php",
                "{$pf}/{$plugin}.class.php"
            );
            foreach ($plugin_opts as $tmp_plugin) {
                if (file_exists($tmp_plugin)) {
                    $_SESSION['app_plugin_folder_cache'][$plugin_hash] = $tmp_plugin;
                    require_once($tmp_plugin);
                    return true;
                }
            }
        }

        //=================================================================
        // Does the plugin exist as a full qualified file path?
        //=================================================================
        if (file_exists($plugin)) {
            $_SESSION['app_plugin_folder_cache'][$plugin_hash] = $plugin;
            require_once($plugin);
            return true;
        }

        //=================================================================
        // Plugin Not Found
        //=================================================================
        //trigger_error("Error: Load(): Plugin \"{$plugin}\" does not exist!");
        return false;
    }

}
