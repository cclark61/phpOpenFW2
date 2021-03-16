<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Session Messages Class
 *
 * @package        phpOpenFW
 * @author         Christian J. Clark
 * @copyright    Copyright (c) Christian J. Clark
 * @license        https://mit-license.org
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
    // Message Types
    //*************************************************************************
    static $message_types = [
        'error_message',
        'warn_message',
        'action_message',
        'success_message',
        'gen_message',
        'info_message',
        'page_message',
        'bottom_message',
        'timer_message'
    ];

    //*************************************************************************
    //*************************************************************************
    // Add Session Message
    //*************************************************************************
    //*************************************************************************
    public static function AddMessage($msg, $type='gen')
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
    public static function AddBottomMessage($msg) { self::AddMessage($msg, 'bottom'); }
    public static function AddPageMessage($msg) { self::AddMessage($msg, 'page'); }
    public static function AddActionMessage($msg) { self::AddMessage($msg, 'action'); }
    public static function AddSuccessMessage($msg) { self::AddMessage($msg, 'success'); }
    public static function AddWarnMessage($msg) { self::AddMessage($msg, 'warn'); }
    public static function AddErrorMessage($msg) { self::AddMessage($msg, 'error'); }
    public static function AddGenMessage($msg) { self::AddMessage($msg, 'gen'); }
    public static function AddInfoMessage($msg) { self::AddMessage($msg, 'info'); }
    public static function AddTimerMessage($msg) { self::AddMessage($msg, 'timer'); }

    //*************************************************************************
    //*************************************************************************
    // Get Messages
    //*************************************************************************
    //*************************************************************************
    public static function GetMessages(Array $args=[])
    {
        //=============================================================
        // Defaults
        //=============================================================
        $xml_escape = false;
        $clear = true;

        //=============================================================
        // Extract Args
        //=============================================================
        extract($args);

        //=============================================================
        // Search For Messages
        //=============================================================
        $messages = [];
        foreach (self::$message_types as $msg_type) {
            $formatted_messages = false;
            if (!empty($_SESSION[$msg_type])) {
                if ($xml_escape) {
                    $formatted_messages = self::FormatEscapeMessages($_SESSION[$msg_type]);
                }
                else {
                    $formatted_messages = self::FormatMessages($_SESSION[$msg_type]);
                }
                if ($clear) {
                    unset($_SESSION[$msg_type]);
                }
            }
            if ($formatted_messages) {
                $messages[$msg_type] = $formatted_messages;
            }
        }

        return $messages;
    }

    //*************************************************************************
    //*************************************************************************
    // Clear Messages
    //*************************************************************************
    //*************************************************************************
    public static function ClearMessages(Array $args=[])
    {
        //=============================================================
        // Defaults
        //=============================================================
        $message_type = false;

        //=============================================================
        // Extract Args
        //=============================================================
        extract($args);

        //=============================================================
        // Search For Messages
        //=============================================================
        foreach (self::$message_types as $tmp_msg_type) {
            if (!$message_type || ($message_type && $tmp_msg_type == $message_type)) {
                if (isset($_SESSION[$tmp_msg_type])) {
                    unset($_SESSION[$tmp_msg_type]);
                }
            }
        }
    }

    //*************************************************************************
    //*************************************************************************
    // Format Messages
    //*************************************************************************
    //*************************************************************************
    public static function FormatMessages()
    {
        $messages = [];
        $args = func_get_args();
        foreach ($args as $arg) {
            if (is_array($arg) && count($arg) > 0) {
                foreach ($arg as $key => $arg_msg) {
                    $messages[] = $arg_msg;
                }
            }
            else if ((string)$arg != '') {
                $messages[] = $arg;
            }
        }
    
        return $messages;
    }

    //*************************************************************************
    //*************************************************************************
    // Format and XML Escape Messages
    //*************************************************************************
    //*************************************************************************
    public static function FormatEscapeMessages()
    {
        $messages = [];
        $args = func_get_args();
        foreach ($args as $arg) {
            if (is_array($arg) && count($arg) > 0) {
                foreach ($arg as $key => $arg_msg) {
                    $messages[] = \phpOpenFW\XML\Format::xml_escape($arg_msg);
                }
            }
            else if ((string)$arg != '') {
                $messages[] = \phpOpenFW\XML\Format::xml_escape($arg);
            }
        }
    
        return $messages;
    }

}
