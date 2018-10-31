<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Condition Trait
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
 * Condition Trait
 */
//**************************************************************************************
trait Condition
{
    //=========================================================================
    //=========================================================================
    // Condition
    //=========================================================================
    //=========================================================================
    protected static function Condition(String $db_type, String $field, String $op, $value=false, Array &$params=null, String $type='s')
    {
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid field name given.');
        }
        if (!self::IsValidOperator($op)) {
            throw new \Exception('Invalid operator given.');
        }

        //-----------------------------------------------------------------
        // Lowercase the Operator
        //-----------------------------------------------------------------
        $lc_op = strtolower($op);

        //-----------------------------------------------------------------
        // Switch based on Operator
        //-----------------------------------------------------------------
        switch ($lc_op) {

            //-------------------------------------------------------------
            // In / Not In (Multiple Value Conditions)
            //-------------------------------------------------------------
            case 'in':
            case 'not in':
                return self::MultipleValueCondition($db_type, $field, $op, $value, $params, $type);
                break;

            //-------------------------------------------------------------
            // Between / Not Between
            //-------------------------------------------------------------
            case 'between':
            case 'not between':
                return self::BetweenCondition($db_type, $field, $op, $value, $params, $type);
                break;

            //-------------------------------------------------------------
            // Is Null
            //-------------------------------------------------------------
            case 'is null':
                return self::IsNullCondition($field);
                break;

            //-------------------------------------------------------------
            // Is Not Null
            //-------------------------------------------------------------
            case 'is not null':
                return self::IsNotNullCondition($field);
                break;

            //-------------------------------------------------------------
            // Everything else (Single Value Conditions)
            //-------------------------------------------------------------
            default:
                return self::SingleValueCondition($db_type, $field, $op, $value, $params, $type);
                break;
        }

        return '';
    }

    //=========================================================================
    //=========================================================================
    // Is Null
    //=========================================================================
    //=========================================================================
    protected static function IsNullCondition(String $field)
    {
        //-----------------------------------------------------------------
        // Check if field is empty
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid field name given.');
        }

        return "{$field} IS NULL";
    }

    //=========================================================================
    //=========================================================================
    // Is NOT Null
    //=========================================================================
    //=========================================================================
    protected static function IsNotNullCondition(String $field)
    {
        //-----------------------------------------------------------------
        // Check if field is empty
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid field name given.');
        }

        return "{$field} IS NOT NULL";
    }

    //=========================================================================
    //=========================================================================
    // Single Value Condition
    //=========================================================================
    // (=, !=, <>, <, <=, >, >=, like, not like)
    //=========================================================================
    //=========================================================================
    protected static function SingleValueCondition(String $db_type, String $field, String $op, $value, Array &$params, String $type='s')
    {
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid field name given.');
        }
        if (!self::IsValidOperator($op)) {
            throw new \Exception('Invalid operator given.');
        }

        //-----------------------------------------------------------------
        // False Value? Return.
        //-----------------------------------------------------------------
        if ($value === false) {
            return false;
        }
        //-----------------------------------------------------------------
        // Null Value
        //-----------------------------------------------------------------
        else if (is_null($value)) {
            if ($op == '=') {
                return self::IsNullCondition($field);
            }
            else if ($op == '!=') {
                return self::IsNotNullCondition($field);
            }
            else {
                return false;
            }
        }
        if (!is_scalar($value)) {
            throw new \Exception('Value must be a scalar value.');
        }

        //-----------------------------------------------------------------
        // Add Bind Parameter
        //-----------------------------------------------------------------
        $place_holder = self::AddBindParam($db_type, $params, $value, $type);

        //-----------------------------------------------------------------
        // Create and Return Condition
        //-----------------------------------------------------------------
        return "{$field} {$op} {$place_holder}";
    }

    //=========================================================================
    //=========================================================================
    // Multiple Value Condition
    //=========================================================================
    // (in, not in)
    //=========================================================================
    //=========================================================================
    protected static function MultipleValueCondition(String $db_type, String $field, String $op, Array $values, Array &$params, String $type='s')
    {
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid field name given.');
        }
        if (!self::IsValidOperator($op)) {
            throw new \Exception('Invalid operator given.');
        }

        //-----------------------------------------------------------------
        // No Values? Return.
        //-----------------------------------------------------------------
        if (!$values) {
            return false;
        }

        //-----------------------------------------------------------------
        // Add Bind Parameters
        //-----------------------------------------------------------------
        $place_holders = self::AddBindParams($db_type, $params, $values, $type);

        //-----------------------------------------------------------------
        // Create and Return Condition
        //-----------------------------------------------------------------
        return "{$field} {$op} ({$place_holders})";
    }

    //=========================================================================
    //=========================================================================
    // Between Condition
    //=========================================================================
    // (between, not between)
    //=========================================================================
    //=========================================================================
    protected static function BetweenCondition(String $db_type, String $field, String $op, Array $values, Array &$params, String $type='s')
    {
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid field name given.');
        }
        if (!self::IsValidOperator($op)) {
            throw new \Exception('Invalid operator given.');
        }

        //-----------------------------------------------------------------
        // No Values? Return.
        //-----------------------------------------------------------------
        if (!$values) {
            return false;
        }
        else if (!array_key_exists(0, $values) || !array_key_exists(1, $values)) {
            throw new \Exception('Invalid between values given. (1)');
        }
        else if (!is_scalar($values[0]) || !is_scalar($values[1])) {
            throw new \Exception('Invalid between values given. (2)');
        }

        //-----------------------------------------------------------------
        // Add Bind Parameters
        //-----------------------------------------------------------------
        $place_holder1 = self::AddBindParam($db_type, $params, $values[0], $type);
        $place_holder2 = self::AddBindParam($db_type, $params, $values[1], $type);

        //-----------------------------------------------------------------
        // Create and Return Condition
        //-----------------------------------------------------------------
        return "{$field} {$op} {$place_holder1} AND {$place_holder2}";
    }
}
