<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Form Helper Object
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Helpers;

//**************************************************************************************
/**
 * Form Class
 */
//**************************************************************************************
class Form
{
    //=============================================================================
    //=============================================================================
    // Check and Clear Form Key Function
    //=============================================================================
    //=============================================================================
    public static function check_and_clear_form_key($obj, $mod_var_index, $form_key)
    {
        $do_trans = false;
        $form_key_sess = $obj->get_mod_var($mod_var_index);
        if (isset($form_key) && $form_key_sess && $form_key && $form_key == $form_key_sess) {
            $do_trans = true;
            $obj->clear_mod_var($mod_var_index);
        }
        return $do_trans;
    }
}
