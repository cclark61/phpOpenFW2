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
	protected function AddCondition(&$conditions, $field, $op, $val, $type='s', $andor='and')
	{
        //-----------------------------------------------------------------
        // Validate Parameters
        //-----------------------------------------------------------------
        if (!$field) {
            throw new \Exception('Invalid first parameter.');
        }

        //-----------------------------------------------------------------
        // Anonymous Function: Nested Conditions
        //-----------------------------------------------------------------
        if ($field instanceof Closure) {
        	$nested = new \phpOpenFW\Builders\SQL\Statements\NestedConditions($this, $this->depth+1);
        	$field($nested);
        	$rear_pad = str_repeat(' ', 2 + ($this->depth * 2));
        	$nested = (string)$nested;
        	if ($nested) {
            	$conditions[] = [$andor, "({$nested}\n{$rear_pad})"];
            }
        }
        //-----------------------------------------------------------------
        // Single / Multiple Unnested Condition
        //-----------------------------------------------------------------
        else if (is_scalar($field) && is_string($field)) {
            $lower_op = trim(strtolower($op));
            $disallowed_ops = [
                'between', 'not between',
                'in', 'not in'
            ];
            if (is_array($val) && $val && !in_array($lower_op, $disallowed_ops)) {
                foreach ($val as $val2) {
                    $conditions[] = [$andor, self::Condition($this->db_type, $field, $op, $val2, $this->bind_params, $type)];
                }
            }
            else {
                $conditions[] = [$andor, self::Condition($this->db_type, $field, $op, $val, $this->bind_params, $type)];
            }
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
