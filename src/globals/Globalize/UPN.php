<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Register UPN Functions
 *
 * @package        phpOpenFW
 * @author         Christian J. Clark
 * @copyright    Copyright (c) Christian J. Clark
 * @license        https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Helpers;

//=============================================================================
//=============================================================================
// Register _() and upn() Functions for use as UPN Shortcuts
//=============================================================================
//=============================================================================
if (!function_exists('__')) {
    function __() { return call_user_func_array(['\phpOpenFW\Helpers\UPN', '_'], func_get_args()); }
}
if (!function_exists('upn')) {
    function upn() { return call_user_func_array(['\phpOpenFW\Helpers\UPN', '_'], func_get_args()); }
}

