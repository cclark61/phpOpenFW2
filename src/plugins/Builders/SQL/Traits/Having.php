<?php
//**************************************************************************************
//**************************************************************************************
/**
 * SQL Having Trait
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
 * SQL Having Trait
 */
//**************************************************************************************
trait Having
{
    //=========================================================================
	// Trait Memebers
    //=========================================================================
	protected $having = [];

    //=========================================================================
    //=========================================================================
	// Having Clause Method
    //=========================================================================
    //=========================================================================
	public function Having($condition)
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
	// Format Having Clause Method
    //=========================================================================
    //=========================================================================
	protected function FormatHaving()
	{

	}

}
