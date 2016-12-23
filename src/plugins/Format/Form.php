<?php
//*****************************************************************************
//*****************************************************************************
/**
* Form Formatting Class
*
* @package		phpOpenPlugins
* @subpackage	Format
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @link			http://www.emonlade.net/phpopenplugins/
* @version 		Started: 7/17/2012, Last updated: 6/7/2016
**/
//*****************************************************************************
//*****************************************************************************

//*****************************************************************************
/**
 * Form Formatting Class
 * @package		phpOpenFW
 * @subpackage	Format
 */
//*****************************************************************************
class Form
{

	//=============================================================================
	//=============================================================================
	// SQL Escape Values Function
	//=============================================================================
	//=============================================================================
	public static function SQLEscapeValues(&$in_val, $ignore_indices=false)
	{
		//---------------------------------------------------------
		// Indices set to be ignored
		//---------------------------------------------------------
		$tmp_ii = array();
		if (is_array($ignore_indices) && count($ignore_indices) > 0) {
			foreach ($ignore_indices as $key => $value) { $tmp_ii[$value] = $value; }
		}
		
		if (is_array($in_val)) {
			foreach ($in_val as $key => $val) {
				if (!isset($tmp_ii[$key])) { sql_escape_values($in_val[$key]); }
			}
		}
		else { $in_val = addslashes($in_val); }
	}
	
	//=============================================================================
	//=============================================================================
	// Set Category Function
	//=============================================================================
	//=============================================================================
	public static function SetCategory(&$cat, $new_cat)
	{
		if ($cat == "[+]" && $new_cat != "") { $cat = $new_cat; }
		else if ($cat == "[+]" && $new_cat == "") { $cat = ""; }
	}

}
