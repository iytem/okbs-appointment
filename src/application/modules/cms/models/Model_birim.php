<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_birim extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'okbs_birim';
        $this->primary_key = 'birim_id';
        $this->column_order = array(null, '','birim_adi', 'birim_durum');
        $this->column_search = array('birim_adi', 'birim_durum');
        $this->order = array('birim_id' => 'desc');

    }


}
