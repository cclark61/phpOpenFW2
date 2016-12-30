<?php
//*****************************************************************************
//*****************************************************************************
/**
* File System Formatting Class
*
* @package		phpOpenFW
* @subpackage	Format
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		https://mit-license.org
* @version 		Started: 7/17/2012, Updated: 6/7/2016
**/
//*****************************************************************************
//*****************************************************************************

//*****************************************************************************
/**
 * File System Formatting Class
 * @package		phpOpenFW
 * @subpackage	Format
 */
//*****************************************************************************
class FileSystem
{
	//=============================================================================
	//=============================================================================
	// Function to clean slashes from directory paths
	//=============================================================================
	//=============================================================================
	public static function CleanDir(&$dir, $front_slashes=false, $rear_slashes=true)
	{
		if (strlen($dir) > 0) {
			// Remove Trailing Slashes
			while ($rear_slashes && substr($dir, strlen($dir) - 1, 1) == "/") {
				$dir = substr($dir, 0, strlen($dir) - 1);
			}
	
			// Remove Front Slashes
			while ($front_slashes && substr($dir, 0, 1) == "/") {
				$dir = substr($dir, 1, strlen($dir));
			}
		}
	}

	//=============================================================================
	//=============================================================================
	// Load File Content Function
	//=============================================================================
	//=============================================================================
	public static function LoadFileContent($dir, $file)
	{
		$full_file = "{$dir}/{$file}";
		if (file_exists($full_file)) {
			ob_start();
			include($full_file);
			return ob_get_clean();
			
		}
		else { return false; }
	}

}
