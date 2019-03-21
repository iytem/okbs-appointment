<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_menu_type extends MY_Model {


    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'cms_menu_type';
        $this->primary_key = 'id';
        $this->column_order = array(null);
        $this->column_search = array();
        $this->order = array('id' => 'desc');
    }

}

