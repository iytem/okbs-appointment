<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_popup extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'cms_popups';
        $this->primary_key = 'popup_id';
        $this->column_order = array(null, '','title', 'description','page_url','status');
        $this->column_search = array('title', 'description','page_url','status');
        $this->order = array('popup_id' => 'desc');

    }


}

