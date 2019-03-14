<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_permission extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'cms_aauth_perms';
        $this->primary_key = 'id';
        $this->column_order = array(null, '','name', 'definition');
        $this->column_search = array('name', 'definition');
        $this->order = array('id' => 'desc');

    }

}

