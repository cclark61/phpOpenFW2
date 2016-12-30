<?php
//*****************************************************************************
//*****************************************************************************
/**
* Global Data Cache Object
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
// Global Level Data Cache Object
//*******************************************************************************
//*******************************************************************************
class GlobalCache extends Core
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
    	if (!isset($GLOBALS['dco'][$this->key])) {
    		$GLOBALS['dco'][$this->key] = array();
	    	$this->existed = false;
    	}
        $this->container =& $GLOBALS['dco'][$this->key];
        $this->scope = 'global';
    }

}
