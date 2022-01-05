<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Core Database Type Trait
 *
 * @package         phpOpenFW
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @website         https://phpopenfw.org
 * @license         https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Database\Structure\DatabaseType;

//**************************************************************************************
/**
 * Core Trait
 */
//**************************************************************************************
trait Core
{

    //**********************************************************************************
    //**********************************************************************************
    // Validate Data Source
    //**********************************************************************************
    //**********************************************************************************
    protected static function ValidateDataSource($data_source)
    {
        //=======================================================================
        // Validate Data Source and Table
        //=======================================================================
        if ($data_source == '') {
            trigger_error('Invalid data source handle');
            return false;
        }
        $ds_data = \phpOpenFW\Framework\Core\DataSources::GetOne($data_source);
        if (!$ds_data) {
            trigger_error('Invalid data source.');
            return false;
        }

        return $ds_data;
    }

    //**********************************************************************************
    //**********************************************************************************
    // Determine Schema from a Table
    //**********************************************************************************
    //**********************************************************************************
    public static function DetermineSchema($data_source, $table, $default=false, $separator=false)
    {
        //=======================================================================
        // Validate Data Source and Table
        //=======================================================================
        if (!$ds_data = self::ValidateDataSource($data_source)) {
            return false;
        }

        //=======================================================================
        // Check for separator
        //=======================================================================
        if (!$separator) {
            $separator = '.';
        }

        //=======================================================================
        // Set Default Schema
        //=======================================================================
        $schema = (isset($ds_data['schema'])) ? ($ds_data['schema']) : (false);

        //=======================================================================
        // Determine Schema
        //=======================================================================
        $table_parts = explode($separator, $table);
        if (is_array($table_parts)) {
            $table = $table_parts[count($table_parts) - 1];
            if (isset($table_parts[count($table_parts) - 2])) {
                $schema = $table_parts[count($table_parts) - 2];
            }
        }
        if (!$schema && $default) {
            $schema = $default;
        }

        return [
            'table' => $table,
            'schema' => $schema
        ];
    }
}
