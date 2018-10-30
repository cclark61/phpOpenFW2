<?php
//**************************************************************************************
//**************************************************************************************
/**
 * SQL Server Conditions Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Builders\SQL\Conditions;

//**************************************************************************************
/**
 * SQLSrv Class
 */
//**************************************************************************************
class SQLSrv
{
    use Conditions;
    protected static $db_type = 'sqlsrv';
}