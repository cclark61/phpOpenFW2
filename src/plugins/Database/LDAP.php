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
    	$this->handle = GetDataSourceHandle();
    	if (!$this->handle) {
            if (!$this->open()) {
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
        $this->close();
    }

	//*****************************************************************************
    /**
	* Opens LDAP Connection
	**/
	//*****************************************************************************
	public function open()
	{
        $this->handle = @ldap_connect($this->server, $this->port);
        if (!$this->handle){
            trigger_error("LDAP Connection Error.");
            return false;
        }
        else {
            if (!ldap_set_option($this->handle, LDAP_OPT_PROTOCOL_VERSION, 3)){
                trigger_error("Failed to set LDAP protocol version to 3.");
                return false;
            }
            $this->SetDataSourceHandle();
	  	}

		return true;
	}
	
	//*****************************************************************************
	//*****************************************************************************
	/**
	* Close LDAP Connection
	**/
	//*****************************************************************************
	//*****************************************************************************
    public function close()
	{
		if (!$this->persistent && $this->handle && !$this->data_result) {
			return ldap_close($this->handle);
		}
        return false;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Executes a query based on the data source type
	* @param mixed LDAP: properly formatted and filled array
	* @param string "anon" - Anonymous Bind, "user" - User Bind, "admin" - Admin Bind
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function query($query)
	{
		$ret_val = false;

        if (!is_array($query)) {
        	$this->resource = false;
        }
        else {
			$this->curr_query = $query;

            switch ($this->trans_type) {

	            //*********************************************************
	            // Query
	            //*********************************************************
                case 'qry':
                case 'qry1':

                    //====================================================
                    // LDAP Query Parts
                    //====================================================
                    $search_dn = $query[0] . $this->source;
                    $ldapFilter = (isset($query[1])) ? ($query[1]) : ('*');
                    $selectAttrs = (!isset($query[2]) || !is_array($query[2])) ? (array('*')) : ($query[2]);

                    //====================================================
                    // Query Type
                    //====================================================
                    if ($this->trans_type == 'qry1') {
                        $this->resource = @ldap_list($this->handle, $search_dn, $ldapFilter, $selectAttrs);
                    }
                    else {
                        $this->resource = @ldap_search($this->handle, $search_dn, $ldapFilter, $selectAttrs);
                    }

                    //====================================================
                    // Check for Error
                    //====================================================
                    if (ldap_errno($this->handle)) {
                        $this->gen_error(ldap_error($this->handle));
                    }
		
                    //====================================================
                    // Sort
                    //====================================================
                    if (isset($query['ldapSortAttributes'])) {
                        foreach ($query['ldapSortAttributes'] as $eachSortAttribute) {
                            ldap_sort($this->handle, $this->resource, $eachSortAttribute);
                        }
                    }

                    //====================================================
                    // Create Data Result Object if Necessary
                    //====================================================
			    	if ($this->resource && gettype($this->resource) != 'boolean') {
			        	$this->data_result = new data_result($this->resource, $this->data_src, array('handle' => $this->handle));
			        }

                    break;
            }
        }

		//----------------------------------------------
		// Return Data Result Object if it exists
		//----------------------------------------------
		if ($this->data_result) {
        	$this->num_rows = $this->data_result->num_rows();
			$ret_val = $this->data_result;
		}

        return $ret_val;
	}

	//*****************************************************************************
	//*****************************************************************************
	/**
	* Set the Number of Rows in the current result set
	**/
	//*****************************************************************************
	//*****************************************************************************
	public function set_num_rows()
	{
		$this->num_recs = ldap_count_entries($this->handle, $this->resource);
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
    	$this->fetch_pos++;
		if ($this->fetch_pos) {
			return ldap_next_entry($this->handle, $this->resource);
		}
		else {
			return ldap_first_entry($this->handle, $this->resource);
		}
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
		if (!$this->records) {

            //--------------------------------------------------------------------
			// Reset Result Pointer
			//--------------------------------------------------------------------
			$this->SetResultPointer();

			$this->records = ldap_get_entries($this->handle, $this->resource);

		    if ($this->records) {
		    	$this->records_set = true;
		    	$this->num_recs = count($this->records);
		    }
	    }

	    $this->flags['fetch_all_rows']++;
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
        return @ldap_add($this->handle, $query['dn'], $query['values']);
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
        return @ldap_modify($this->handle, $query['dn'], $query['values']);
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
        return @ldap_delete($this->handle, $query['dn']);
    }
}
