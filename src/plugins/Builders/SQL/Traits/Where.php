<?php
//**************************************************************************************
//**************************************************************************************
/**
 * SQL Where Trait
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Builders\SQL\Traits;

//**************************************************************************************
/**
 * SQL Where Trait
 */
//**************************************************************************************
trait Where
{
    //=========================================================================
	// Trait Memebers
    //=========================================================================
	protected $where = [0 => []];
	protected $where_pos = 0;

    //=========================================================================
    //=========================================================================
	// Where Clause Method
    //=========================================================================
    //=========================================================================
	public function Where()
	{
    	$args = func_get_args();
    	if (count($args) == 1 && $args[0] == '') {
        	return $this;
    	}
    	foreach ($args as $arg) {
        	if (!is_array($arg)) {
            	trigger_error('Each Where() method parameter must be passed as an array.', E_USER_ERROR);
        	}
        	if (!$arg) { continue; }

    	}
        return $this;
	}

    //=========================================================================
    //=========================================================================
	// And Where Clause Method
    //=========================================================================
    //=========================================================================
	public function AndWhere($field, $op, $val)
	{
    	
        return $this;
	}

    //=========================================================================
    //=========================================================================
	// OrWhere Clause Method
    //=========================================================================
    //=========================================================================
	public function OrWhere($field, $op, $val)
	{
    	
        return $this;
	}

    //=========================================================================
    //=========================================================================
	// Where Group Clause Method
    //=========================================================================
    //=========================================================================
	public function WhereGroup($field, $op, $val)
	{
    	
        return $this;
	}

    //##################################################################################
    //##################################################################################
    //##################################################################################
    // Protected / Internal Methods
    //##################################################################################
    //##################################################################################
    //##################################################################################

    //=========================================================================
    //=========================================================================
	// Format Where Clause Method
    //=========================================================================
    //=========================================================================
	protected function FormatWhere()
	{

	}

}
