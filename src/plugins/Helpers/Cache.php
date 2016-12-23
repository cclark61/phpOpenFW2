<?php
//*****************************************************************************
//*****************************************************************************
/**
* Cache Helper Methods Plugin
*
* @package		phpOpenPlugins
* @subpackage	Database
* @author 		Christian J. Clark
* @copyright	Copyright (c) Christian J. Clark
* @license		http://www.gnu.org/licenses/gpl-2.0.txt
* @link			http://www.emonlade.net/phpopenplugins/
* @version 		Started: 8/25/2015, Last updated: 8/31/2015
**/
//*****************************************************************************
//*****************************************************************************

//*******************************************************************************
//*******************************************************************************
// Cache Helper Object
//*******************************************************************************
//*******************************************************************************
class Cache
{

	//=============================================================================
	//=============================================================================
	/**
	* Create and return a cache key for use in MemCache for example.
	*
	* @param string Cache Key Stub
	* @param array The parameters passed to the original function.
	*
	* @return string A unique cache key.
	*/
	//=============================================================================
	//=============================================================================
	public static function MakeCacheKey($stub, $args)
	{
		if (empty($stub) || empty($args)) { return false; }
		$cache_key = (defined('MC_KEY_STUB')) ? (MC_KEY_STUB . ':' . $stub) : ($stub);

		if (is_array($args)) {
			foreach ($args as $arg) {
				if (is_array($arg)) {
					$cache_key .= ':' . serialize($arg);
				}
				else {
					$cache_key .= ":{$arg}";
				}
			}
		}
		else {
			$cache_key .= ":{$args}";
		}

		return md5($cache_key);
	}

}
