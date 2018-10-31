<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Select Statement Test Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Test\Builders\SQL;
use \phpOpenFW\Builders\SQL;

//**************************************************************************************
/**
 * Select Class
 */
//**************************************************************************************
class Select
{
    //=========================================================================
    //=========================================================================
    // Test
    //=========================================================================
    //=========================================================================
    public static function Test()
    {
        //---------------------------------------------------------------
        // DB Types
        //---------------------------------------------------------------
        $db_types = [
            'mysql',
            'pgsql',
            'oracle',
            'sqlsrv'
        ];

        //---------------------------------------------------------------
        // Build SQL Select Statements for each database type
        //---------------------------------------------------------------
        foreach ($db_types as $db_type) {

            //----------------------------------------------------------------
            // Test Header
            //----------------------------------------------------------------
            $disp_db_type = ucfirst($db_type);
            print "\n-------------------------------------------------------";
            print "\n*** {$disp_db_type} Select Statements";
            print "\n-------------------------------------------------------\n\n";

            //---------------------------------------------------------------
            // Test Values
            //---------------------------------------------------------------
            $test_value = 27;

            //---------------------------------------------------------------
            // Short Query
            //---------------------------------------------------------------
            $query1 = SQL::Select('contacts')
            ->Where('last_name', '=', 'Clark');

            //---------------------------------------------------------------
            // Create / Start SQL Select Statement
            //---------------------------------------------------------------
            $query = SQL::Select('cases a')
                ->SetDbType($db_type)
                ->Select('a.id, a.worker_id')
                ->Select('a.child_id, a.birth_mother_id')
                ->SelectRaw("concat(b.first_name, ' ', b.last_name as full_name")
                ->LeftJoin('join_table b', 'a.worker_id', '=', 'b.id')
                ->InnerJoin('join_table c', function ($join) {
                    $join->On('test_col1', 'test_col2')
                    ->Where('test1', '=', 1);
                })
                ->OuterJoin('join_table c', function ($join) use ($test_value) {
                    $join->On('test_col1', 'test_col2')
                    ->Where('test2', '=', 2)
                    ->Where('test3', '!=', $test_value);
                })
                //->From('test_table')
                //->From('test_table2 a, test_table3 z, ')
                //->CrossJoin('join_table b', 'a.worker_id', '=', 'b.id')
                //->From(['test1', 'test3'])
                ->GroupBy('worker_id')
                //->GroupBy('test1, test2')
                ->OrderBy(['child_id', 'id desc'])
                ->Where('test4', '>=', 4, 'i')
                ->Where(function ($query) use ($test_value) {
                    $query->WhereColumn('test5', 'test6')
                    ->OrWhereColumn('test7', 'test8')
                    ->OrWhere('test9', '=', 9)
                    ->Where('test10', '!=', $test_value + 10)
                    ->Where(function ($query) use ($test_value) {
                        $query->WhereNotBetween('test11', [23, 26], 'i')
                        ->WhereIn('test12', [11, 12, 13], 'i')
                        ->WhereNull('test13');
                    });
                })
                ->Limit(50, 2);
                //->Union($query1)
                //->UnionAll($query1);

            //---------------------------------------------------------------
            // Output Query / Bind Parameters
            //---------------------------------------------------------------
            print $query . "\n";
            print_r($query->GetBindParams());
        }
    }
    
}
