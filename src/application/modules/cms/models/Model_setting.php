<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_setting extends MY_Model
{


    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'cms_options';
        $this->primary_key = 'id';
        $this->column_order = array(null, 'option_name', 'option_value');
        $this->column_search = array('option_name', 'option_value');
        $this->order = array('id' => 'desc');


    }

}
