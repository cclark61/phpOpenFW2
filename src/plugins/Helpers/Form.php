<?php
//*****************************************************************************
//*****************************************************************************
/**
* Form Helper Object
*
* @package		phpOpenPlugins
* @subpackage	Helper
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @link			http://www.emonlade.net/phpopenplugins/
* @version 		Started: 8/25/2015, Last updated: 8/27/2015
**/
//*****************************************************************************
//*****************************************************************************

namespace phpOpenFW\Helpers;

//*******************************************************************************
//*******************************************************************************
// Form Helper Object
//*******************************************************************************
//*******************************************************************************
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
