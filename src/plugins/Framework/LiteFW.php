<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Lite Framework Class
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
 * Lite Framework Class
 */
//**************************************************************************************
class LiteFW
{

    //*************************************************************************
    /**
    * Run Method
    **/
    //*************************************************************************
    public static function Run($file_path=false)
    {
        //============================================================
        // Bootstrap the Core
        //============================================================
        \phpOpenFW\Framework\Core::Bootstrap($file_path);

    }

}
