<?php
//**************************************************************************************
//**************************************************************************************
/**
 * A Core plugin for classes used with static functions
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Cores;

//**************************************************************************************
/**
 * Static Core Class
 */
//**************************************************************************************
abstract class StaticCore
{
    //========================================================================
    /**
    * Display Error Function
    **/
    //========================================================================
    protected static function display_error($function, $msg)
    {
        trigger_error("Error: {$function}(): {$msg}");
    }

}
