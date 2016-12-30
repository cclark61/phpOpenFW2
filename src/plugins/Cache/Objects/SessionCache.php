<?php
//*****************************************************************************
//*****************************************************************************
/**
* Session Data Cache Object
*
* @package		phpOpenFW
* @subpackage	Utilities
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		https://mit-license.org
* @version 		Started: 1/28/2012, Updated: 2/23/2012
**/
//*****************************************************************************
//*****************************************************************************

//*******************************************************************************
//*******************************************************************************
// Session Level Data Cache Object
//*******************************************************************************
//*******************************************************************************
class SessionCache extends Core
{

	//*************************************************************************
	// Constructor Function
	//*************************************************************************
    public function __construct($key)
    {
    	if (!$key) {
    		trigger_error('You must specify a valid cache key to be used as a cache reference.');
    		return false;
    	}
    	$this->key = (string)$key;
    	$this->existed = true;
    	if (!isset($_SESSION['dco'][$this->key])) {
    		$_SESSION['dco'][$this->key] = array();
    		$this->existed = false;
    	}
        $this->container =& $_SESSION['dco'][$this->key];
        $this->scope = 'session';
    }

}
