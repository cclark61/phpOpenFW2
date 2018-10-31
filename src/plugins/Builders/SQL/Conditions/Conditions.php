<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Conditions Trait
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
 * Conditions Trait
 */
//**************************************************************************************
trait Conditions
{
    //=========================================================================
    // Traits
    //=========================================================================
    use \phpOpenFW\Builders\SQL\Traits\Aux;
    use \phpOpenFW\Builders\SQL\Traits\Condition;

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
        return self::Condition(static::$db_type, $field, '=', $value, $params, $type);
    }
    public static function EQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '=', $value, $params, $type);
    }
    public static function AndEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '=', $value, $params, $type));
    }
    public static function OrEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '=', $value, $params, $type));
    }
    public static function AndEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '=', $value, $params, $type));
    }
    public static function OrEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '=', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Not Equals
    //=========================================================================
    //=========================================================================
    public static function NotEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '!=', $value, $params, $type);
    }
    public static function NEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '!=', $value, $params, $type);
    }
    public static function AndNotEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '!=', $value, $params, $type));
    }
    public static function OrNotEquals(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '!=', $value, $params, $type));
    }
    public static function AndNEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '!=', $value, $params, $type));
    }
    public static function OrNEQ(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '!=', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Less Than
    //=========================================================================
    //=========================================================================
    public static function LessThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '<', $value, $params, $type);
    }
    public static function LT(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '<', $value, $params, $type);
    }
    public static function AndLessThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '<', $value, $params, $type));
    }
    public static function OrLessThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '<', $value, $params, $type));
    }
    public static function AndLT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '<', $value, $params, $type));
    }
    public static function OrLT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '<', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Less Than Or Equal
    //=========================================================================
    //=========================================================================
    public static function LessThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '<=', $value, $params, $type);
    }
    public static function LTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '<=', $value, $params, $type);
    }
    public static function AndLessThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '<=', $value, $params, $type));
    }
    public static function OrLessThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '<=', $value, $params, $type));
    }
    public static function AndLTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '<=', $value, $params, $type));
    }
    public static function OrLTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '<=', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Greater Than
    //=========================================================================
    //=========================================================================
    public static function GreaterThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '>', $value, $params, $type);
    }
    public static function GT(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '>', $value, $params, $type);
    }
    public static function AndGreaterThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '>', $value, $params, $type));
    }
    public static function OrGreaterThan(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '>', $value, $params, $type));
    }
    public static function AndGT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '>', $value, $params, $type));
    }
    public static function OrGT(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '>', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Greater Than Or Equal
    //=========================================================================
    //=========================================================================
    public static function GreaterThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '>=', $value, $params, $type);
    }
    public static function GTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, '>=', $value, $params, $type);
    }
    public static function AndGreaterThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '>=', $value, $params, $type));
    }
    public static function OrGreaterThanOrEqual(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '>=', $value, $params, $type));
    }
    public static function AndGTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, '>=', $value, $params, $type));
    }
    public static function OrGTOE(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, '>=', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Like
    //=========================================================================
    //=========================================================================
    public static function Like(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, 'LIKE', $value, $params, $type);
    }
    public static function AndLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, 'LIKE', $value, $params, $type));
    }
    public static function OrLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, 'LIKE', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // NOT Like
    //=========================================================================
    //=========================================================================
    public static function NotLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, 'NOT LIKE', $value, $params, $type);
    }
    public static function AndNotLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, 'NOT LIKE', $value, $params, $type));
    }
    public static function OrNotLike(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, 'NOT LIKE', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Is Null
    //=========================================================================
    //=========================================================================
    public static function IsNull(String $field)
    {
        return self::IsNullCondition($field);
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
        return self::IsNotNullCondition($field);
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
    public static function In(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, 'IN', $value, $params, $type);
    }
    public static function AndIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, 'IN', $value, $params, $type));
    }
    public static function OrIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, 'IN', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // NOT In
    //=========================================================================
    //=========================================================================
    public static function NotIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::Condition(static::$db_type, $field, 'NOT IN', $value, $params, $type);
    }
    public static function AndNotIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::Condition(static::$db_type, $field, 'NOT IN', $value, $params, $type));
    }
    public static function OrNotIn(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::Condition(static::$db_type, $field, 'NOT IN', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Between
    //=========================================================================
    //=========================================================================
    public static function Between(String $field, $value, Array &$params, String $type='s')
    {
        return self::BetweenCondition(static::$db_type, $field, 'BETWEEN', $value, $params, $type);
    }
    public static function AndBetween(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::BetweenCondition(static::$db_type, $field, 'BETWEEN', $value, $params, $type));
    }
    public static function OrBetween(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::BetweenCondition(static::$db_type, $field, 'BETWEEN', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // NOT Between
    //=========================================================================
    //=========================================================================
    public static function NotBetween(String $field, $value, Array &$params, String $type='s')
    {
        return self::BetweenCondition(static::$db_type, $field, 'NOT BETWEEN', $value, $params, $type);
    }
    public static function AndNotBetween(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('and', self::BetweenCondition(static::$db_type, $field, 'NOT BETWEEN', $value, $params, $type));
    }
    public static function OrNotBetween(String $field, $value, Array &$params, String $type='s')
    {
        return self::AndOr('or', self::BetweenCondition(static::$db_type, $field, 'NOT BETWEEN', $value, $params, $type));
    }

    //=========================================================================
    //=========================================================================
    // Nested
    //=========================================================================
    //=========================================================================
    public static function Nested(Array $conditions, $andor=false)
    {
        $nested = '';
        foreach ($conditions as $condition) {
            if (!$nested) {
                if (strtolower(substr($condition, 0, 4)) == 'and ') {
                    $condition = substr($condition, 4);                    
                }
                else if (strtolower(substr($condition, 0, 3)) == 'or ') {
                    $condition = substr($condition, 3);
                }
            }
            else {
                $nested .= ' ';
            }
            $nested .= $condition;
        }
        if ($nested) {
            if ($andor) {
                $nested = "{$andor} ({$nested})";
            }
            else {
                $nested = "({$nested})";
            }
        }
        return $nested;
    }
}
