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

namespace phpOpenFW\Builders\SQL\Statements\Traits;

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
	protected $where = [];

    //=========================================================================
    //=========================================================================
	// Where Clause Method
    //=========================================================================
    //=========================================================================
	public function Where($field, $op=null, $val=false, $type='s')
	{

        return $this;
	}

    //=========================================================================
    //=========================================================================
	// Or Where Clause Method
    //=========================================================================
    //=========================================================================
	public function OrWhere($field, $op=null, $val=false, $type='s')
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
	// Add Clause Method
    //=========================================================================
    //=========================================================================
	protected function AddClause()
	{
        
	}

    //=========================================================================
    //=========================================================================
	// Format Where Clause Method
    //=========================================================================
    //=========================================================================
	protected function FormatWhere()
	{

	}

}