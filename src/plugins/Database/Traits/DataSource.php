<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Data Source Trait
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Database\Traits;

//**************************************************************************************
/**
 * Data Source Trait
 */
//**************************************************************************************
trait DataSource
{

    //*****************************************************************************
    // Class Members
    //*****************************************************************************
    protected $data_src = '';
    protected $data_src_data = false;
    protected $handle = false;
    protected $resource = false;
    protected $server = '127.0.0.1';
    protected $port = false;
    protected $source = false;
    protected $user = false;
    protected $pass = false;
    protected $persistent = true;

    //*****************************************************************************
    //*****************************************************************************
    // Get Object Instance
    //*****************************************************************************
    //*****************************************************************************
    public static function Instance($data_src='')
    {
        return new static($data_src);
    }

    //*****************************************************************************
    //*****************************************************************************
    // Is Data Source Valid
    //*****************************************************************************
    //*****************************************************************************
    public function IsDataSourceValid($data_src='')
    {
        $data_src_data = self::GetDataSource($data_src);
        return (is_array($data_src_data)) ? (true) : (false);
    }

    //*****************************************************************************
    //*****************************************************************************
    // Get Data Source
    //*****************************************************************************
    //*****************************************************************************
    public function GetDataSource($data_src='')
    {
        if ($data_src != '') {
            if (isset($_SESSION[$data_src])) {
                return $_SESSION[$data_src];
            }
        }
        else {
            if (isset($_SESSION['default_data_source'])) {
                return $_SESSION[$_SESSION['default_data_source']];
            }
        }

        return false;
    }

    //*****************************************************************************
    //*****************************************************************************
    // Set Connection Parameters
    //*****************************************************************************
    //*****************************************************************************
    public function SetConnectionParameters()
    {
        $data_src_data = $this->GetDataSource($this->data_src);
        if (!$data_src_data) {
            return false;
        }
        $this->handle = (!isset($data_src_data['handle'])) ? (false) : ($data_src_data['handle']);
        $this->server = (!isset($data_src_data['server'])) ? ('127.0.0.1') : ($data_src_data['server']);
        $this->port = (!isset($data_src_data['port'])) ? (389) : ($data_src_data['port']);
        $this->source = (!isset($data_src_data['source'])) ? ('') : ($data_src_data['source']);
        $this->user = (!isset($data_src_data['user'])) ? ('') : ($data_src_data['user']);
        $this->pass = (!isset($data_src_data['pass'])) ? ('') : ($data_src_data['pass']);
        $this->persistent = (!isset($data_src_data['persistent'])) ? (true) : ($data_src_data['persistent']);
    }

    //*****************************************************************************
    //*****************************************************************************
    // Set Connection Parameters
    //*****************************************************************************
    //*****************************************************************************
    public function SetDataSourceHandle()
    {
        $_SESSION[$this->data_src]['handle'] = $this->handle;
    }

    //*****************************************************************************
    //*****************************************************************************
    // Get Connection Handle
    //*****************************************************************************
    //*****************************************************************************
    public function GetConnectionHandle()
    {
        return $this->handle;
    }

    //*****************************************************************************
    //*****************************************************************************
    // Get Query Resource
    //*****************************************************************************
    //*****************************************************************************
    public function GetResource()
    {
        return $this->resource;
    }

}
