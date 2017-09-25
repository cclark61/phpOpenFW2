<?php
//**************************************************************************************
//**************************************************************************************
/**
 * LDAP Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 */
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Database;

//**************************************************************************************
/**
 * LDAP Class
 */
//**************************************************************************************
class LDAP {

    //*****************************************************************************
    // Traits
    //*****************************************************************************
    use Traits\DataSource;

	//*****************************************************************************
	// Class Members
	//*****************************************************************************
    protected $records = false;
    protected $num_recs = false;
    protected $fetch_pos = 0;
    protected $row_resource = false;

	//*****************************************************************************
	//*****************************************************************************
	// Constructor Function
	//*****************************************************************************
	//*****************************************************************************
	public function __construct($data_src='')
	{
    	$this->data_src_data = $this->GetDataSource($data_src);
    	if (!$this->data_src_data) {
        	throw new \Exception("Invalid Data Source '{$data_src}'.");
    	}
        $this->data_src = $data_src;

        //--------------------------------------------------------------------
        // Set Connection Parameters
        //--------------------------------------------------------------------
        $this->SetConnectionParameters();

        //--------------------------------------------------------------------
        // Get or Open Connection to LDAP Server
        //--------------------------------------------------------------------
    	$this->handle = $this->GetConnectionHandle();
    	if (!$this->handle) {
            if (!$this->Open()) {
                throw new \Exception("Unable to connect to LDAP Server.");
            }
        }
    }

	//*****************************************************************************
	//*****************************************************************************
	// Destructor Function
	//*****************************************************************************
	//*****************************************************************************
	public function __destruct()
	{
        $this->Close();
    }

	//*****************************************************************************
	//*****************************************************************************
	// Reset Function
	//*****************************************************************************
	//*****************************************************************************
	public function Reset()
	{
        $this->records = false;
        $this->num_recs = false;
        $this->fetch_pos = 0;
        $this->row_resource = false;
    }

	//*****************************************************************************
    /**
	* Opens LDAP Connection
	**/
	//*****************************************************************************
	public function Open()
	{
        $this->handle = ldap_connect($this->server, $this->port);
        if (!$this->handle){
            trigger_error("LDAP Connection Error.");
            return false;
        }

        //--------------------------------------------------------------------
        // Set Options
        //--------------------------------------------------------------------
        ldap_set_option($this->handle, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->handle, LDAP_OPT_REFERRALS, 0);

        //--------------------------------------------------------------------
        // Bind To LDAP Directory
        //--------------------------------------------------------------------
        $this->Bind($this->user, $this->pass);

        //--------------------------------------------------------------------
        // Save the Connection Handle
        //--------------------------------------------------------------------
        $this->SetDataSourceHandle();

		return true;
	}
	
	//*****************************************************************************
	//*****************************************************************************
	/**
	* Close LDAP Connection
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function Close()
	{
		if (!$this->persistent && $this->handle && !$this->data_result) {
			return ldap_close($this->handle);
		}
        return false;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Bind
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function Bind($user, $pass)
	{
        if (!empty($user)) {
            return ldap_bind($this->handle, $this->user, $this->pass);
        }
        else {
            return ldap_bind($this->handle);
        }
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Unbind
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function Unbind($user, $pass)
	{
        return ldap_unbind($this->handle);
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Search
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function Search(Array $query)
	{
    	if (!$this->handle) { return false; }

        //--------------------------------------------------------------------
        // Scope (subtree (Default), onelevel, base)
        //--------------------------------------------------------------------
    	if (!isset($query['scope'])) {
        	$query['scope'] = 'subtree';
    	}
    	$query['scope'] = strtolower($query['scope']);
    	if (!in_array($query['scope'], ['subtree', 'onelevel', 'base'])) {
        	$query['scope'] = 'subtree';
    	}

        //--------------------------------------------------------------------
        // Reset
        //--------------------------------------------------------------------
        $this->Reset();

        //--------------------------------------------------------------------
        // Build Search Parameters
        //--------------------------------------------------------------------
    	$args = $this->BuildSearchParams($query);
    	if ($args) { extract($args); }
    	else { return false; }

        //--------------------------------------------------------------------
        // Search
        //--------------------------------------------------------------------
        if ($query['scope'] = 'subtree') {
        	$this->resource = ldap_search($this->handle, $base_dn, $filter, $attributes);
        }
        else if ($query['scope'] = 'onelevel') {
            $this->resource = ldap_list($this->handle, $base_dn, $filter, $attributes);
        }
        else if ($query['scope'] = 'base') {
            $this->resource = ldap_read($this->handle, $base_dn, $filter, $attributes);
        }

        //--------------------------------------------------------------------
        // Set Number of Rows
        //--------------------------------------------------------------------
    	if ($this->resource) {
        	$this->SetNumRows();
    	}

        //--------------------------------------------------------------------
        // Check For Error
        //--------------------------------------------------------------------
        $this->CheckAndPrintError();

        //--------------------------------------------------------------------
        // Sort?
        //--------------------------------------------------------------------
        if ($this->resource && isset($sort)) {
            foreach ($sort as $eachSortAttribute) {
                ldap_sort($this->handle, $this->resource, $eachSortAttribute);
            }
        }

        return $this->resource;
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Search One Level
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function SearchOneLevel(Array $query)
	{
    	$query['scope'] = 'onelevel';
    	return $this->Search($query);
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Get Entry
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function GetEntry(Array $query)
	{
    	$query['scope'] = 'base';
    	return $this->Search($query);
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Build LDAP Search Parameters
	**/
	//*****************************************************************************
	//*****************************************************************************
    protected function BuildSearchParams(Array $query)
	{
        $params = [];
        if (isset($query['base_dn'])) {
            $params['base_dn'] = $query['base_dn'];
            if ($this->source) {
                $params['base_dn'] = $params['base_dn'] . ',' . $this->source;
            }
        }
        $params['filter'] = (isset($query['filter'])) ? ($query['filter']) : ('*');
        $params['attributes'] = (!isset($query['attributes']) || !is_array($query['attributes'])) ? (array('*')) : ($query['attributes']);
        return $params;
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Check for and Print Error Function
	**/
	//*****************************************************************************
	//*****************************************************************************
    protected function CheckAndPrintError()
    {
        $error = false;

        //--------------------------------------------------------------------
        // Check for Error
        //--------------------------------------------------------------------
        if (ldap_errno($this->handle)) {
            $error = ldap_error($this->handle);
        }

        //--------------------------------------------------------------------
        // Error Found
        //--------------------------------------------------------------------
    	if ($error) {
	    	trigger_error("LDAP Error: {$error}");
	    	return true;
		}

        return false;
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Set the Number of Rows in the current result set
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function SetNumRows()
	{
    	if (!$this->handle) { return false; }
        if ($this->resource) {
    		$this->num_recs = ldap_count_entries($this->handle, $this->resource);
        }
        else {
            $this->num_recs = 0;
        }
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Get the Number of Rows in the current result set
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function GetNumRows()
	{
    	if (!$this->handle) { return false; }
		return $this->num_recs;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Set Result Pointer
	*
	* @param integer The numeric position to set the pointer at.
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function SetResultPointer($offset=0)
	{
		$this->fetch_pos = $offset;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Fetch a row from the result set
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function FetchRow()
	{
    	if (!$this->handle) { return false; }
		if ($this->fetch_pos) {
    		if ($this->row_resource) {
    			$this->row_resource = ldap_next_entry($this->handle, $this->row_resource);
            }
		}
		else {
			$this->row_resource = ldap_first_entry($this->handle, $this->resource);
		}
		if ($this->row_resource) {
    		$row = ldap_get_attributes($this->handle, $this->row_resource);
            $this->fetch_pos++;
            return $row;
        }

		return false;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Fetch all rows in a result
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function FetchAllRows()
	{
    	if (!$this->handle) { return false; }
		if (!$this->records) {

            //--------------------------------------------------------------------
			// Reset Result Pointer
			//--------------------------------------------------------------------
			$this->SetResultPointer();

            //--------------------------------------------------------------------
            // Get All Records
            //--------------------------------------------------------------------
            if ($this->resource) {
    			$this->records = ldap_get_entries($this->handle, $this->resource);
            }

            //--------------------------------------------------------------------
            // Count Records
            //--------------------------------------------------------------------
		    if ($this->records) {
		    	$this->num_recs = count($this->records);
		    }
	    }

	    return $this->records;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Add Method
	* @param string The DN to add
	* @param array Key / Value pairs of vaules to add
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function Add($dn, $values)
	{
    	if (!$this->handle) { return false; }
        $result = ldap_add($this->handle, $dn, $values);
        $this->CheckAndPrintError();
        return $result;
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Update Method
	* @param string The DN to update
	* @param array Key / Value pairs of vaules to update
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function Update($dn, $values)
	{
    	if (!$this->handle) { return false; }
        $result = ldap_modify($this->handle, $dn, $values);
        $this->CheckAndPrintError();
        return $result;
    }

	//*****************************************************************************
	//*****************************************************************************
	/**
	* LDAP Delete Method
	* @param string The DN to delete
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function Delete($dn)
	{
    	if (!$this->handle) { return false; }
        $result = ldap_delete($this->handle, $dn);
        $this->CheckAndPrintError();
        return $result;
    }
}
