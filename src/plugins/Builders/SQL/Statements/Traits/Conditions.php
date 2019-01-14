<?php
//**************************************************************************************
//**************************************************************************************
/**
 * SQL Conditions Trait
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Builders\SQL\Statements\Traits;
use \Closure;

//**************************************************************************************
/**
 * SQL Conditions Trait
 */
//**************************************************************************************
trait Conditions
{
    //=========================================================================
    //=========================================================================
	// Add Condition Method
    //=========================================================================
    //=========================================================================
	protected function AddCondition(&$conditions, $field, $op, $val, $type, $andor='and')
	{
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid first parameter.');
        }

        //-----------------------------------------------------------------
        // Anonymous Function: Nested
        //-----------------------------------------------------------------
        if ($field instanceof Closure) {
        	$nested = new \phpOpenFW\Builders\SQL\Statements\NestedConditions($this, $this->depth+1);
        	$field($nested);
        	$rear_pad = str_repeat(' ', 2 + ($this->depth * 2));
        	$conditions[] = [$andor, "({$nested}\n{$rear_pad})"];
        }
        //-----------------------------------------------------------------
        // Single Condition
        //-----------------------------------------------------------------
        else if (is_scalar($field) && is_string($field)) {
            $conditions[] = [$andor, self::Condition($this->db_type, $field, $op, $val, $this->bind_params, $type)];
        }
        //-----------------------------------------------------------------
        // Unknown: Throw Exception
        //-----------------------------------------------------------------
        else {
            throw new \Exception('Invalid condition parameters.');
        }
	}

    //=========================================================================
    //=========================================================================
	// Format Conditions Method
    //=========================================================================
    //=========================================================================
	protected function FormatConditions($conditions)
	{
        $clause = '';
        $front_pad = str_repeat(' ', 2 + ($this->depth * 2));
        foreach ($conditions as $condition) {
            if (is_array($condition)) {
                if ($clause) {
                    $clause .= "\n{$front_pad}{$condition[0]} {$condition[1]}";
                }
                else {
                    $clause .= "\n{$front_pad}{$condition[1]}";
                }
            }
            else {
                $clause .= "\n{$front_pad}{$condition}";
            }
        }
        return $clause;
	}

}
