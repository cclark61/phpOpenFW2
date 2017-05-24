<?php
//**************************************************************************************
//**************************************************************************************
/**
 * MongoDB Class
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
 * MongoDB Class
 */
//**************************************************************************************
class MongoDB {


	//*****************************************************************************
	// Class Members
	//*****************************************************************************
	protected $data_src;
	protected $mongo_client;
	protected $mongo_client_db;
	protected $mongo_client_db_gridfs;

	//*****************************************************************************
	//*****************************************************************************
	// Constructor function
	//*****************************************************************************
	//*****************************************************************************
	public function __construct($data_src='')
	{
        //=================================================================
		// Data Source
        //=================================================================
		if ($data_src != '') {
			if (!isset($_SESSION[$data_src])) {
				throw new \Exception("Invalid Data Source '{$data_src}'.");
			}
		}
		else {
			if (isset($_SESSION['default_data_source'])) {
				$data_src = $_SESSION['default_data_source'];
			}
			else {
				throw new \Exception('Data Source not given and default data source is not set.');
			}
		}
		$this->data_src = $data_src;

        //=================================================================
		// Connect
        //=================================================================
		if (!isset($GLOBALS[$this->data_src])) {
			$GLOBALS[$this->data_src] = [];
			$this->mongo_client = self::Connect($this->data_src);
			$GLOBALS[$this->data_src]['mongo_client'] =& $this->mongo_client;
			$this->mongo_client_db = $this->mongo_client->{$_SESSION[$this->data_src]['source']};
			$GLOBALS[$this->data_src]['mongo_client_db'] =& $this->mongo_client_db;
			$this->mongo_client_db_gridfs = $this->mongo_client_db->selectGridFSBucket();
			$GLOBALS[$this->data_src]['mongo_client_db_gridfs'] =& $this->mongo_client_db_gridfs;
		}
		else {
			$this->mongo_client =& $GLOBALS[$this->data_src]['mongo_client'];
			$this->mongo_client_db =& $GLOBALS[$this->data_src]['mongo_client_db'];
			$this->mongo_client_db_gridfs =& $GLOBALS[$this->data_src]['mongo_client_db_gridfs'];
		}
	}

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
	// Get MongoDB Client Connection
	//*****************************************************************************
	//*****************************************************************************
	protected static function Connect($data_source)
	{
		$conn_str = self::ConnectionString($data_source);
		return new \MongoDB\Client($conn_str);
	}

	//*****************************************************************************
	//*****************************************************************************
	// Get MongoDB Connection String
	//*****************************************************************************
	//*****************************************************************************
	protected static function ConnectionString($data_source)
	{
		//=================================================================
		// Validate Data Source
		//=================================================================
		if (!$data_source || !isset($_SESSION[$data_source])) {
			throw new \Exception('Invalid data source.');
			return false;
		}
		$ds = $_SESSION[$data_source];

		//=================================================================
		// Build Connection String
		//=================================================================
		return "mongodb://{$ds['user']}:{$ds['pass']}@{$ds['server']}:{$ds['port']}/{$ds['source']}";
	}

	//*****************************************************************************
	//*****************************************************************************
	// Get Document By ID
	//*****************************************************************************
	//*****************************************************************************
	public function GetDocumentByID($collection, $id)
	{
		$doc_oid = new \MongoDB\BSON\ObjectId($id);
		$doc = $this->mongo_client_db->$collection->findOne(['_id' => $doc_oid]);
		return $doc;
	}

	//*****************************************************************************
	//*****************************************************************************
	// Get GridFS File By ID
	//*****************************************************************************
	//*****************************************************************************
	public function GetGridFSFileByID($id)
	{
		$oid = new \MongoDB\BSON\ObjectId($id);
		$gridfs_file = $this->mongo_client_db_gridfs->findOne(['_id' => $oid]);
		if ($gridfs_file) {
			$file_data = (array)$gridfs_file->bsonSerialize();
			return $file_data;
		}
		
		return false;
	}

	//*****************************************************************************
	//*****************************************************************************
	// Stream GridFS File By ID
	//*****************************************************************************
	//*****************************************************************************
	public function StreamGridFSFileByID($id, Array $args=[])
	{
		extract($args);

		//=================================================================
		// Try to Get File Record from MongoDB
		//=================================================================
		$file_data = $this->GetGridFSFileByID($id);
		if (!$file_data) { return false; }
		
		//=================================================================
		// Output Content Type / Content
		//=================================================================
		$stream = true;
		if (!empty($output_header)) {
			$stream = \phpOpenFW\Content\CDN::OutputContentType($file_data['filename']);
		}
		if ($stream) {
			$file_data['stream'] = $this->mongo_client_db_gridfs->openDownloadStream($file_data['_id']);
			print stream_get_contents($file_data['stream']);
		}
		else {
			return false;
		}

		return true;
	}

}
