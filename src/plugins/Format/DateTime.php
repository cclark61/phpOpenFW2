<?php
//*****************************************************************************
/**
* Date / Time Class
*
* @package		phpOpenFW
* @subpackage	Format
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @version 		Started: 1-4-2005 Updated: 4-2-2013
**/
//*****************************************************************************

//*****************************************************************************
/**
 * Date / Time Class
 * @package		phpOpenFW
 * @subpackage	Format
 */
//*****************************************************************************
class DateTime
{

	//=============================================================================
	//=============================================================================
	// Make a MySQL Timestamp Look Pretty
	//=============================================================================
	//=============================================================================
	public static function MystampPretty($mysql_stamp, $format='n/j/Y g:i a')
	{
		$unix_stamp = strtotime($mysql_stamp);
		if ($unix_stamp > 0) {
			return date($format, $unix_stamp);
		}
		else {
			return false;
		}
	}

	//=============================================================================
	//=============================================================================
	// Generic Date Format Function
	//=============================================================================
	//=============================================================================
	public static function FormatDate($stamp, $def_ret_val=false, $format="n/j/Y")
	{
		if ($stamp == '0000-00-00') { return $def_ret_val; }
		$unix_stamp = strtotime($stamp);
		if ($unix_stamp !== false) { return date($format, $unix_stamp); }
		else { return $def_ret_val; }
	}
	
	//=============================================================================
	//=============================================================================
	// Convert Date to SQL Format Function
	//=============================================================================
	//=============================================================================
	public static function FormatDateSQL($stamp, $def_ret_val=false, $format="Y-m-d")
	{
		return self::FormatDate($stamp, $def_ret_val, $format);
	}
	
	//=============================================================================
	//=============================================================================
	// Convert Date to Viewable Format Function
	//=============================================================================
	//=============================================================================
	public static function FormatDatePretty($stamp, $def_ret_val=false, $format="n/j/Y")
	{
		return self::FormatDate($stamp, $def_ret_val, $format);
	}
	
}
