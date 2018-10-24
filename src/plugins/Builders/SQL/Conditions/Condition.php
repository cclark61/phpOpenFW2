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

namespace phpOpenFW\Builders\SQL\Conditions;

//**************************************************************************************
/**
 * Condition Trait
 */
//**************************************************************************************
trait Condition
{
    //=========================================================================
    // Class Members
    //=========================================================================

    //-----------------------------------------------------------------
    // Database Type (REQUIRED)
    //-----------------------------------------------------------------
    //protected static $db_type = '';

    //=========================================================================
    //=========================================================================
    // Equals
    //=========================================================================
    //=========================================================================
    public static function Equals(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '=', $params, $type);
    }
    public static function EQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '=', $params, $type);
    }
    public static function AndEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '=', $params, $type));
    }
    public static function OrEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '=', $params, $type));
    }
    public static function AndEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '=', $params, $type));
    }
    public static function OrEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '=', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Not Equals
    //=========================================================================
    //=========================================================================
    public static function NotEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '!=', $params, $type);
    }
    public static function NEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '!=', $params, $type);
    }
    public static function AndNotEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '!=', $params, $type));
    }
    public static function OrNotEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '!=', $params, $type));
    }
    public static function AndNEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '!=', $params, $type));
    }
    public static function OrNEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '!=', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Less Than
    //=========================================================================
    //=========================================================================
    public static function LessThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '<', $params, $type);
    }
    public static function LT(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '<', $params, $type);
    }
    public static function AndLessThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '<', $params, $type));
    }
    public static function OrLessThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '<', $params, $type));
    }
    public static function AndLT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '<', $params, $type));
    }
    public static function OrLT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '<', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Less Than Or Equal
    //=========================================================================
    //=========================================================================
    public static function LessThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '<=', $params, $type);
    }
    public static function LTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '<=', $params, $type);
    }
    public static function AndLessThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '<=', $params, $type));
    }
    public static function OrLessThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '<=', $params, $type));
    }
    public static function AndLTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '<=', $params, $type));
    }
    public static function OrLTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '<=', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Greater Than
    //=========================================================================
    //=========================================================================
    public static function GreaterThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '>', $params, $type);
    }
    public static function GT(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '>', $params, $type);
    }
    public static function AndGreaterThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '>', $params, $type));
    }
    public static function OrGreaterThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '>', $params, $type));
    }
    public static function AndGT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '>', $params, $type));
    }
    public static function OrGT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '>', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Greater Than Or Equal
    //=========================================================================
    //=========================================================================
    public static function GreaterThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '>=', $params, $type);
    }
    public static function GTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, '>=', $params, $type);
    }
    public static function AndGreaterThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '>=', $params, $type));
    }
    public static function OrGreaterThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '>=', $params, $type));
    }
    public static function AndGTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, '>=', $params, $type));
    }
    public static function OrGTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, '>=', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Like
    //=========================================================================
    //=========================================================================
    public static function Like(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, 'LIKE', $params, $type);
    }
    public static function AndLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, 'LIKE', $params, $type));
    }
    public static function OrLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, 'LIKE', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // NOT Like
    //=========================================================================
    //=========================================================================
    public static function NotLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::SingleValueCondition($field, $value, 'NOT LIKE', $params, $type);
    }
    public static function AndNotLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, 'NOT LIKE', $params, $type));
    }
    public static function OrNotLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, 'NOT LIKE', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Is Null
    //=========================================================================
    //=========================================================================
    public static function IsNull(String $field)
    {
        //-----------------------------------------------------------------
        // Check if field is empty
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception("Invalid field name given.");
        }

        return "{$field} IS NULL";
    }
    public static function AndIsNull(String $field)
    {
        return self::AndOr('and', self::IsNull($field));
    }
    public static function OrIsNull(String $field)
    {
        return self::AndOr('or', self::IsNull($field));
    }

    //=========================================================================
    //=========================================================================
    // Is NOT Null
    //=========================================================================
    //=========================================================================
    public static function IsNotNull(String $field)
    {
        //-----------------------------------------------------------------
        // Check if field is empty
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception("Invalid field name given.");
        }

        return "{$field} IS NOT NULL";
    }
    public static function AndIsNotNull(String $field)
    {
        return self::AndOr('and', self::IsNotNull($field));
    }
    public static function OrIsNotNull(String $field)
    {
        return self::AndOr('or', self::IsNotNull($field));
    }

    //=========================================================================
    //=========================================================================
    // In
    //=========================================================================
    //=========================================================================
    public static function In(String $field, $values, Array &$params, String $type='s')
    {
        return self::MultipleValueCondition($field, $values, 'IN', $params, $type);
    }
    public static function AndIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, 'IN', $params, $type));
    }
    public static function OrIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, 'IN', $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // NOT In
    //=========================================================================
    //=========================================================================
    public static function NotIn(String $field, $values, Array &$params, String $type='s')
    {
        return self::MultipleValueCondition($field, $values, 'NOT IN', $params, $type);
    }
    public static function AndNotIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::SingleValueCondition($field, $value, 'NOT IN', $params, $type));
    }
    public static function OrNotIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::SingleValueCondition($field, $value, 'NOT IN', $params, $type));
    }

    //##################################################################################
    //##################################################################################
    //##################################################################################
    // "And" / "Or" Methods
    //##################################################################################
    //##################################################################################
    //##################################################################################

    //##################################################################################
    //##################################################################################
    //##################################################################################
    // Protected / Internal Methods
    //##################################################################################
    //##################################################################################
    //##################################################################################

    //=========================================================================
    //=========================================================================
    // Single Value Condition
    //=========================================================================
    //=========================================================================
    protected static function SingleValueCondition(String $field, $value, String $op, Array &$params, String $type='s')
    {
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception("Invalid field name given.");
        }
        if ($value === false) {
            return false;
        }
        else if (is_null($value)) {
            if ($op == '=') {
                return self::IsNull($field);
            }
            else if ($op == '!=') {
                return self::IsNotNull($field);
            }
            else {
                return false;
            }
        }
        if (!is_scalar($value)) {
            throw new \Exception("Value must be a scalar value.");
        }

        //-----------------------------------------------------------------
        // Add Bind Parameter
        //-----------------------------------------------------------------
        $place_holder = \phpOpenFW\Builders\SQL\Aux::AddBindParam(static::$db_type, $params, $value, $type);

        //-----------------------------------------------------------------
        // Create and Return Condition
        //-----------------------------------------------------------------
        return "{$field} {$op} {$place_holder}";
    }

    //=========================================================================
    //=========================================================================
    // Multiple Value Condition
    //=========================================================================
    //=========================================================================
    protected static function MultipleValueCondition(String $field, Array $values, String $op, Array &$params, String $type='s')
    {
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception("Invalid field name given.");
        }
        if (!$values) {
            return false;
        }

        //-----------------------------------------------------------------
        // Add Bind Parameters
        //-----------------------------------------------------------------
        $place_holders = \phpOpenFW\Builders\SQL\Aux::AddBindParams(static::$db_type, $params, $values, $type);

        //-----------------------------------------------------------------
        // Create and Return Condition
        //-----------------------------------------------------------------
        return "{$field} {$op} ({$place_holders})";
    }

    //=========================================================================
    //=========================================================================
    // AndOr Methods
    //=========================================================================
    //=========================================================================
    protected static function AndOr(String $andor, $condition)
    {
        //-----------------------------------------------------------------
        // Validate AndOr
        //-----------------------------------------------------------------
        $andor = strtolower($andor);
        if ($andor != 'and' && $andor != 'or') {
            throw new \Exception("Invalid And/Or parameter.");
        }

        //-----------------------------------------------------------------
        // Is Condition Empty?
        //-----------------------------------------------------------------
        if (!$condition) {
            return false;
        }

        //-----------------------------------------------------------------
        // Return Condtion with And / Or attached
        //-----------------------------------------------------------------
        if ($andor == 'and') {
            return 'and ' . $condition;
        }
        else {
            return 'or ' . $condition;
        }
    }

}
