<?php
//******************************************************************************
//******************************************************************************
/**
 * SQL Select Statement Class
 *
 * @package         phpopenfw/phpopenfw2
 * @author          Christian J. Clark
 * @copyright       Copyright (c) Christian J. Clark
 * @license         https://mit-license.org
 **/
//******************************************************************************
//******************************************************************************

namespace phpOpenFW\Builders\SQL;

//******************************************************************************
/**
 * SQL Select Class
 */
//******************************************************************************
class Select extends Statement
{
    //==========================================================================
    // Traits
    //==========================================================================
    use Traits\Select;
    use Traits\From;
    use Traits\Join;
    use Traits\Where;
    use Traits\GroupBy;
    use Traits\OrderBy;
    use Traits\Having;
    use Traits\Limit;
    use Traits\Union;

    //==========================================================================
    // Class Memebers
    //==========================================================================
    protected $sql_type = 'select';

    //==========================================================================
    //==========================================================================
    // Constructor Method
    //==========================================================================
    //==========================================================================
    public function __construct($table, $data_source=false)
    {
        parent::__construct($table, $data_source);
        if ($this->table) {
            $this->from[] = $this->table;
        }
    }

    //==========================================================================
    //==========================================================================
    // Get Method
    //==========================================================================
    //==========================================================================
    public function GetSQL()
    {
        //---------------------------------------------------------------------
        // Set / Reset Bind Parameters
        //---------------------------------------------------------------------
        if ($this->parent_query) {
            $this->bind_params = $this->parent_query->GetBindParams();
        }
        else {
            $this->bind_params = [];
        }

        //---------------------------------------------------------------------
        // Start SQL
        //---------------------------------------------------------------------
        $strsql = '';

        //---------------------------------------------------------------------
        // Select Fields / From Tables...
        //---------------------------------------------------------------------
        $this->AddSQLClause($strsql, $this->FormatFields());
        $this->AddSQLClause($strsql, $this->FormatFrom());

        //---------------------------------------------------------------------
        // Where
        //---------------------------------------------------------------------
        $this->AddSQLClause($strsql, $this->FormatWhere());

        //---------------------------------------------------------------------
        // Group By
        //---------------------------------------------------------------------
        $this->AddSQLClause($strsql, $this->FormatGroupBy());

        //---------------------------------------------------------------------
        // Unions
        //---------------------------------------------------------------------
        $this->AddSQLClause($strsql, $this->FormatUnions());

        //---------------------------------------------------------------------
        // Having
        //---------------------------------------------------------------------
        $this->AddSQLClause($strsql, $this->FormatHaving());

        //---------------------------------------------------------------------
        // Order By
        //---------------------------------------------------------------------
        $this->AddSQLClause($strsql, $this->FormatOrderBy());

        //---------------------------------------------------------------------
        // Limit
        //---------------------------------------------------------------------
        $this->AddLimitClause($strsql);

        //---------------------------------------------------------------------
        // Return SQL
        //---------------------------------------------------------------------
        return $strsql;
    }

}
