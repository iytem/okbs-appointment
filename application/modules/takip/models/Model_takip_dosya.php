<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_takip_dosya extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'okbs_takip_dosya';
        $this->primary_key = 'dosya_id';
        $this->column_order = array();
        $this->column_search = array();
        $this->order = array('dosya_id' => 'desc');

    }


}
