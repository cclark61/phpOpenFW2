<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Memcache Cache Driver Object
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 */
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Cache\Drivers;

//**************************************************************************************
/**
 * Memcache Class
 */
//**************************************************************************************
class Memcache extends Core
{
	//**********************************************************************************
	// Class Members
	//**********************************************************************************
	protected static $port = 11211;

	//**********************************************************************************
	// Constructor Method
	//**********************************************************************************
    public function __construct($params)
    {
        parent::__construct($params);
        $this->cache_obj = new \Memcached();
        if (is_array($this->server)) {
            $mc_status = $memcache->addServer($this->server, $this->port);
        }
        else {
            foreach ($this->server as $key => $server) {
                if (!is_array($server)) {
                    $this->server[$key] = [$server, $this->port, $this->weight]
                }
            }
            $mc_status = $memcache->addServers($this->server, $this->port);
        }
    }

	//**********************************************************************************
	// Set Options Method
	//**********************************************************************************
	public function setOptions(Array $opts)
	{
        return $this->cache_obj->setOptions($opts);
	}

	//**********************************************************************************
	// Get Options Method
	//**********************************************************************************
	public function getOptions(Array $keys)
	{
        return $this->cache_obj->getOptions($keys);
	}

	//**********************************************************************************
	// Set Multiple Method
	//**********************************************************************************
	public function setMulti(Array $values, $ttl=0, Array $args=[])
	{
        return $this->cache_obj->setMulti($values, $ttl);
	}

	//**********************************************************************************
	// Get Multiple Method
	//**********************************************************************************
	public function getMulti(Array $keys, Array $args=[])
	{
        return $this->cache_obj->getMulti($keys);
	}

	//**********************************************************************************
	// Delete Multiple Method
	//**********************************************************************************
	public function deleteMulti(Array $keys, Array $args=[])
	{
        return $this->cache_obj->deleteMulti($keys);
	}
}
