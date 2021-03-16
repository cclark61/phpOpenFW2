<?php
//**************************************************************************************
//**************************************************************************************
/**
 * A class to construct a message page
 *
 * @package        phpOpenFW
 * @author         Christian J. Clark
 * @copyright    Copyright (c) Christian J. Clark
 * @license        https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Framework\App\Flow;
use phpOpenFW\XML\GenElement;

//**************************************************************************************
/**
 * Message Page Class
 */
//**************************************************************************************
class Message extends Page
{

    //*********************************************************************    
    // Class variables
    //*********************************************************************    

    // General variables
    /**
    * @var mixed code of the message to be displayed
    **/
    private $msg_code;
    
    /**
    * Message constructor function
    * @param mixed code of the message to be displayed
    **/
    //*********************************************************************    
    // Message constructor function
    //*********************************************************************    
    public function __construct($msg)
    {
        parent::initialize();
        $this->msg_code = $msg;
        parent::set_page_type('msg_page');
    }
    
    /**
    * Message destructor function
    **/
    //*********************************************************************    
    // Basic destructor function
    //*********************************************************************    
    public function __destruct()
    {
        parent::render();
    }
    
    /**
    * Message render function
    **/
    //*********************************************************************    
    // Message render function
    //*********************************************************************    
    public function render()
    {
        //----------------------------------------------------------
        // Pre-message Include Script (pre_message.inc.php)
        //----------------------------------------------------------
        $pre_msg_inc = "{$this->file_path}/{$this->mods_dir}/pre_message.inc.php";
        if (file_exists($pre_msg_inc)) { require_once($pre_msg_inc); }

        //----------------------------------------------------------
        // Start building message page
        //----------------------------------------------------------
        $tmp = new GenElement('message');
        $tmp->add_child(new GenElement('code', $this->msg_code));
        $tmp->add_child(new GenElement('login_link', $this->html_path . '/'));
        $tmp->add_child(new GenElement('back_link', 'javascript: history.go(-1)'));
        ob_start();
        include("{$this->templates_dir}/messages.xml");
        $tmp->add_child(ob_get_clean());
        $this->content_xml[] = $tmp;
            
        switch ($this->msg_code) {
            case 1:
            case 3:
            case 4:
            case 5:
            case 7:
            case 8:
            case 'login':
                if (isset($_SESSION['login_url'])) { $tmp_login_url = $_SESSION['login_url']; }
                session_unset();
                session_destroy();

                //--------------------------------------------------------
                // Login URL
                //--------------------------------------------------------
                if (isset($tmp_login_url)) {
                    session_start();
                    $_SESSION['login_url'] = $tmp_login_url;
                }
                break;
        }

        //----------------------------------------------------------
        // Post-message Include Script (post_message.inc.php)
        //----------------------------------------------------------
        $post_msg_inc = $this->file_path . '/' . $this->mods_dir . '/post_message.inc.php';
        if (file_exists($post_msg_inc)) { require_once($post_msg_inc); }
    }
}

