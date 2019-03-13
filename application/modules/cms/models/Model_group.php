<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_group extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'cms_aauth_groups';
        $this->primary_key = 'id';
        $this->column_order = array(null, '','name', 'definition');
        $this->column_search = array('name', 'definition');
        $this->order = array('id' => 'desc');

    }

    public function get_permission_group($group_id = false)
    {
        if ($group_id === false) {
            $group_id = get_user_data('id');
        }
        $result_perm_group[] = 0;

        $query = $this->db->get_where('cms_aauth_perm_to_group', array('group_id' => $group_id));

        foreach ($query->result() as $row) {
            $result_perm_group[] = $row->perm_id;
        }

        return $result_perm_group;
    }


}
