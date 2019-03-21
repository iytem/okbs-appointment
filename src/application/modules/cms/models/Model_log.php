<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_log extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'cms_logs';
        $this->primary_key = 'id';
        $this->column_order = array(null,'errno','errtype','errstr','errfile','errline','user_agent','ip_address','time');
        $this->column_search = array('errno','errtype','errstr','errfile','errline','user_agent','ip_address','time');
        $this->order = array('id' => 'desc');

    }
}
