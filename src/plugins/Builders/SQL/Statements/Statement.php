<?php
//**************************************************************************************
//**************************************************************************************
/**
 * SQL Statement Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Builders\SQL\Statements;

//**************************************************************************************
/**
 * SQL Statement Class
 */
//**************************************************************************************
abstract class Statement extends Core
{
    //=========================================================================
    // Traits
    //=========================================================================

    //=========================================================================
	// Class Memebers
    //=========================================================================
    protected $sql_type = false;
	protected $data_source = false;
	protected $table = false;

    //=========================================================================
    //=========================================================================
    // Constructor Method
    //=========================================================================
    //=========================================================================
    public function __construct($table, $data_source=false)
    {
        //-------------------------------------------------------
        // Validate Table
        //-------------------------------------------------------
        if (!$table || !is_scalar($table)) {
            throw new \Exception("Invalid database table name passed.");
	        return false;
	    }
	    $this->table = $table;

        //-------------------------------------------------------
        // Data Source Specified?
        //-------------------------------------------------------
        $this->SetDataSource($data_source);
    }

    //=========================================================================
    //=========================================================================
    // Get Instance Method
    //=========================================================================
    //=========================================================================
    public static function Instance($table, $data_source=false)
    {
        return new static($table, $data_source);
    }

    //=========================================================================
    //=========================================================================
    // To String Method
    //=========================================================================
    //=========================================================================
    public function __toString()
    {
		return $this->GetSQL();
	}

    //=========================================================================
    //=========================================================================
    // Set Data Source Method
    //=========================================================================
    //=========================================================================
    public function SetDataSource($ds)
    {
        if ($ds != '') {
            $ds_info = \phpOpenFW\Framework\Core\DataSources::GetOne($ds);
            if ($ds_info && isset($ds_info['type'])) {
                if ($this->SetDbType($ds_info['type'])) {
                    $this->data_source = $ds;
                    return true;
                }
            }
        }
        return false;
    }

    //=========================================================================
    //=========================================================================
    // Get SQL Method
    //=========================================================================
    //=========================================================================
    public function GetSQL()
    {
        throw new \Exception("The GetSQL() method has not been implemented.");
		return false;
	}

    //=========================================================================
    //=========================================================================
    // Execute Method
    //=========================================================================
    //=========================================================================
    public function Execute(Array $args=[])
    {
	    $data_source = $this->data_source;
	    $return_format = false;
	    $return_handle = false;
	    extract($args);
	    $sql = $this->GetSQL();
	    if ($return_handle) {
		    return \phpOpenFW\Database\QDB::qdb_result($data_source, $sql, $this->bind_params);
	    }
	    else {
			return \phpOpenFW\Database\QDB::qdb_exec($data_source, $sql, $this->bind_params, $return_format);
		}
	}

    //##################################################################################
    //##################################################################################
    //##################################################################################
    // Protected / Internal Methods
    //##################################################################################
    //##################################################################################
    //##################################################################################

}
