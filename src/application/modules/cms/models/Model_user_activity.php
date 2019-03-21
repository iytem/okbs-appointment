<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_user_activity extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'cms_user_activity';
        $this->primary_key = 'activity_id';
        $this->column_order = array(null,'time','user_id','table_name','action','deleted_insert_get_data','before_data','after_data','ip_addres');
        $this->column_search = array('time','user_id','table_name','action','deleted_insert_get_data','before_data','after_data','ip_addres');
        $this->order = array('activity_id' => 'desc');

    }


    public function join_statement()
    {
        $this->db->join("cms_aauth_users","cms_aauth_users.id=cms_user_activity.user_id","LEFT");
    }

}
