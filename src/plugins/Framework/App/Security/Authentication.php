<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Authentication Class
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
use phpOpenFW\Database\DataTrans;

//**************************************************************************************
/**
 * Authentication Class
 */
//**************************************************************************************
class Authentication
{

    //***********************************************************************    
    // Class variables
    //***********************************************************************
    /**
    * @var bool status of the current authentication process
    **/
    private $status;
    
    /**
    * @var string data source (from main config file) to use for authentication
    **/
    private $data_src;
    
    /**
    * @var string data source type (pulled from data source)
    **/
    private $data_type;
    
    /**
    * @var string table or directory where users are stored (pulled from data source)
    **/
    private $user_table;
    
    /**
    * @var string userid to use in authentication
    **/
    private $user;
    
    /**
    * @var string userid field in, $user_table, to use for authentication
    **/
    private $user_field;
    
    /**
    * @var string password to use in authentication
    **/
    private $pass;
    
    /**
    * @var string Add to where clause
    **/
    private $add_to_where;

    /**
    * Constructor function
    * Performs Authentication
    **/
    //************************************************************************
    // Constructor function
    //************************************************************************
    public function __construct()
    {
        //***********************************************************
        // Set class variables
        //***********************************************************
        $this->status = false;
        $this->data_src = (isset($_SESSION['auth_data_source'])) ? (strtolower($_SESSION['auth_data_source'])) : ('none');

        //***********************************************************
        // Set this local file path
        //***********************************************************
        $local_path = dirname(__FILE__);

        //***********************************************************
        // Load and Set Authentication Parameters
        //***********************************************************
        if ($this->data_src != 'none' && $this->data_src != 'custom') {
            $this->data_type = $_SESSION['auth_data_type'];
            $this->user_table = $_SESSION['auth_user_table'];
            $this->user_field = $_SESSION['auth_user_field'];
            $this->add_to_where = (isset($_SESSION['auth_add_to_where'])) ? ($_SESSION['auth_add_to_where']) : ('');

            //-----------------------------------------------------
            // Password Security
            //-----------------------------------------------------
            $valid_pass_sec_types = array(
                'clear' => 'clear', 
                'md5' => 'md5', 
                'sha1' => 'sha1'
            );
            $this->auth_pass_security = (isset($_SESSION['auth_pass_security'])) ? (strtolower($_SESSION['auth_pass_security'])) : ('clear');
            if (!isset($valid_pass_sec_types[$this->auth_pass_security])) {
                $this->auth_pass_security = 'clear';
            }

            //-----------------------------------------------------
            // Set User ID and Password
            //-----------------------------------------------------
            if (isset($_POST['user']) && isset($_POST['pass'])) {
                $this->user = addslashes($_POST['user']);
                switch ($this->auth_pass_security) {
                    case 'md5':
                        $this->pass = md5($_POST['pass']);
                        break;
    
                    case 'sha1':
                        $this->pass = sha1($_POST['pass']);
                        break;
    
                    case 'sha256':
                        $this->pass = hash('sha256', $_POST['pass']);
                        break;
    
                    default:
                        $this->pass = $_POST['pass'];
                        break;
                }
            }
        }
        else if ($this->data_src == 'custom') {
            $this->data_type = 'custom';
        }
        else {
            $this->data_type = 'none';
        }

        //***********************************************************
        // Setup the Query
        //***********************************************************
        switch ($this->data_type) {

            case 'mysql':
            case 'pgsql':
            case 'mysqli':
            case 'oracle':
            case 'sqlite':
            case 'mssql':
            case 'sqlsrv':
            case 'sqlite':
            case 'db2':
                $query = "select * from {$this->user_table} where {$this->user_field} = '{$this->user}'";
                if ($this->add_to_where != '') { $query .= " and {$this->add_to_where}"; }
                break;

            case 'custom':
                break;

            default:
                //-----------------------------------------------------
                // Kerberos or other SSO Authentication
                //-----------------------------------------------------
                if (isset($_SERVER['REMOTE_USER']) && !empty($_SERVER['REMOTE_USER'])) {
                    $_SESSION['userid'] = $_SERVER['REMOTE_USER'];
                }
                //-----------------------------------------------------
                // HTTP Basic Authentication
                //-----------------------------------------------------
                else if (isset($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_USER'])) {
                    $_SESSION['userid'] = $_SERVER['PHP_AUTH_USER'];
                }
                //-----------------------------------------------------
                // No Authentication
                //-----------------------------------------------------
                else {
                    $_SESSION['userid'] = 'none';
                }
                $this->status = true;
                break;
        }

        //***********************************************************
        // Perform Authentication
        //***********************************************************
        if ($this->data_src != 'none' && $this->data_src != 'custom') {
            $data_auth = new DataTrans($this->data_src);
            $data_auth->data_query($query);
            $user_info = $data_auth->data_assoc_result();
            $num_rows = $data_auth->data_num_rows();

            if ($num_rows <= 0) {
                $this->status = false;
                return false;
            }

            //-----------------------------------------------------
            // Set Session Vars
            //-----------------------------------------------------
            $_SESSION['userid'] = $this->user;
            $_SESSION['passwd'] = sha1($this->pass);
            $_SESSION['first_name'] = (isset($user_info[0][$_SESSION['auth_fname_field']])) ? ($user_info[0][$_SESSION['auth_fname_field']]) : ('');
            $_SESSION['last_name'] = (isset($user_info[0][$_SESSION['auth_lname_field']])) ? ($user_info[0][$_SESSION['auth_lname_field']]) : ('');
            $_SESSION['name'] = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
            
            $this->status = true;
        }
        //***********************************************************
        // Custom Login
        //***********************************************************
        else if ($this->data_src == 'custom') {

            //-----------------------------------------------------
            // Configured Custom Login Method
            //-----------------------------------------------------
            if (isset($_SESSION['custom_login_function']) && is_callable($_SESSION['custom_login_function'])) {
                $custom_ret_val = call_user_func($_SESSION['custom_login_function']);
                $this->status = (bool)$custom_ret_val;
                if ($this->status) { $_SESSION['userid'] = (string)$custom_ret_val; }
            }
            //-----------------------------------------------------
            // "custom_login()" function found?
            //-----------------------------------------------------
            else if (function_exists('custom_login')) {
                $custom_ret_val = call_user_func('custom_login');
                $this->status = (bool)$custom_ret_val;
                if ($this->status) { $_SESSION['userid'] = (string)$custom_ret_val; }
            }
            //-----------------------------------------------------
            // No Custom Login Handler found. FAIL.
            //-----------------------------------------------------
            else {
                trigger_error('Custom login handler function is not defined. Authentication automatically failed.');
            }

            //-----------------------------------------------------
            // Set Session Vars if successful login
            //-----------------------------------------------------
            if ($this->status) {
                if (!isset($_SESSION['first_name'])) { $_SESSION['first_name'] = ''; }
                if (!isset($_SESSION['last_name'])) { $_SESSION['last_name'] = ''; }
                if (!isset($_SESSION['name'])) { $_SESSION['name'] = ''; }
            }
        }
    }
    
    /**
    * Return the status of the authentication (true or false)
    * @return bool status of the authentication (true or false)
    **/
    //************************************************************************
    // Authentication Status Function
    //************************************************************************
    public function status() { return $this->status; }

}
