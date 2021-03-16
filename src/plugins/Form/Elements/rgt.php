<?php
//**************************************************************************************
//**************************************************************************************
/**
 * A class for constructing a Radio Group from a Table (RGT)
 *
 * @package        phpOpenFW
 * @author         Christian J. Clark
 * @copyright    Copyright (c) Christian J. Clark
 * @license        https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Form\Elements;
use phpOpenFW\Database\DataTrans;

//**************************************************************************************
/**
 * Radio Group from Table Class
 */
//**************************************************************************************
class rgt extends GroupFormElement
{
    /**
    * @var string Name of the Radio buttons
    **/
    private $name;            // Name of the select
    private $data_src;        // Data Source
    private $strsql;        // SQL string to query
    
    //*************************************************************************
    // Constructor Function
    //*************************************************************************
    public function __construct($name, $data_src, $strsql, $key, $val)
    {
        $this->name = $name;
        $this->data_src = $data_src;
        $this->strsql = $strsql;
        $this->opt_key = $key;
        $this->opt_val = $val;
        $this->style = 'newline';
    }

    //*************************************************************************
    /**
    * RGT class render function
    **/
    //*************************************************************************
    // Construct and output the RGT.
    //*************************************************************************
    public function render($buffer=false)
    {
        //============================================
        // Pull items from database
        //============================================
        $data = new DataTrans($this->data_src);
        $data->data_query($this->strsql);
        $result = $data->data_assoc_result();
        
        foreach ($result as $row) {

            //-----------------------------------------
            // Create Radio Button
            //-----------------------------------------
            $tmp_radio = new radio($this->name, $row[$this->opt_key]);

            //-----------------------------------------
            // Is Checked?
            //-----------------------------------------
            if (isset($this->checked_value)) {
                if ($this->checked_value == $row[$this->opt_key]) { $tmp_radio->set_attribute('checked', 'checked'); }
            }

            //-----------------------------------------
            // Element Attributes
            //-----------------------------------------
            if (isset($this->elements_attrs[$row[$this->opt_key]])) {
                $tmp_radio->attrs($this->elements_attrs[$row[$this->opt_key]]);
            }

            //-----------------------------------------
            // Output
            //-----------------------------------------
            $tmp_radio->render();
            print '&nbsp;' . $row[$this->opt_val];
            if ($this->style == 'newline') { print '<br/>'; }
            else if ($this->style == 'custom') { print $this->custom_style; }
            print "\n";
        }
    }    

}

