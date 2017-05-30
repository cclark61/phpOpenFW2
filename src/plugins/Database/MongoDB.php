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
	// Get One By ID
	//*****************************************************************************
	//*****************************************************************************
	public function GetOneByID($collection, $id)
	{
		$doc_oid = new \MongoDB\BSON\ObjectId($id);
		$doc = $this->mongo_client_db->$collection->findOne(['_id' => $doc_oid]);
		if ($doc) {
			return (array)$doc->bsonSerialize();
		}
		return false;
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

	//*****************************************************************************
	//*****************************************************************************
	// Insert One Document
	//*****************************************************************************
	//*****************************************************************************
	public function InsertOne($collection, $data, array $args=[])
	{
		$return_raw_result = false;
		extract($args);

		$result = $this->mongo_client_db->$collection->insertOne($data);
		return ($return_raw_result) ? ($result) : ($result->getInsertedId());
	}

	//*****************************************************************************
	//*****************************************************************************
	// Update One Document By ID
	//*****************************************************************************
	//*****************************************************************************
	public function UpdateOneByID($collection, $id, $data, array $args=[])
	{
		$return_raw_result = false;
		extract($args);

		$doc_oid = new \MongoDB\BSON\ObjectId($id);
		$result = $this->mongo_client_db->$collection->updateOne(
			['_id' => $doc_oid],
			['$set' => $data]
		);

		if ($return_raw_result) {
			return $result;
		}
		else {
			return $result->getMatchedCount();
		}
	}

	//*****************************************************************************
	//*****************************************************************************
	// Upsert One Document By ID
	//*****************************************************************************
	//*****************************************************************************
	public function UpsertOneByID($collection, $id, $data, array $args=[])
	{
		$return_raw_result = false;
		extract($args);

		$doc_oid = new \MongoDB\BSON\ObjectId($id);
		$result = $this->mongo_client_db->$collection->updateOne(
			['_id' => $doc_oid],
			['$set' => $data],
			['upsert' => true]
		);

		if ($return_raw_result) {
			return $result;
		}
		else {
			$upsert_id = $result->getUpsertedId();
			return ($upsert_id) ? ($upsert_id) : ($id);
		}
	}

	//*****************************************************************************
	//*****************************************************************************
	// Delete One Document By ID
	//*****************************************************************************
	//*****************************************************************************
	public function DeleteOneByID($collection, $id, array $args=[])
	{
		$return_raw_result = false;
		extract($args);

		$doc_oid = new \MongoDB\BSON\ObjectId($id);
		$result = $this->mongo_client_db->$collection->deleteOne(
			['_id' => $doc_oid]
		);

		return ($return_raw_result) ? ($result) : ($result->getDeletedCount());
	}

	//*****************************************************************************
	//*****************************************************************************
	// Add GridFS File
	//*****************************************************************************
	//*****************************************************************************
	public function AddGridFSFile($file, Array $args=[])
	{
		extract($args);

		if (file_exists($file)) {
			$fhandle = fopen($file, 'rb');
			if (empty($file_name)) {
				$file_name = basename($file);
			}
			$result = $this->mongo_client_db_gridfs->uploadFromStream($file_name, $fhandle);
			return $result;
		}
		
		return false;
	}

	//*****************************************************************************
	//*****************************************************************************
	// Delete GridFS File
	//*****************************************************************************
	//*****************************************************************************
	public function DeleteGridFSFileByID($id, Array $args=[])
	{
		$file_data = $this->GetGridFSFileByID($id);
		if ($file_data) {
			$fileId = new \MongoDB\BSON\ObjectId($id);
			$this->mongo_client_db_gridfs->delete($fileId);
			return true;
		}

		return false;
	}
}
