<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_group_access extends MY_Model {


    public function __construct()
    {
        $this->table_name = 'cms_aauth_perm_to_group';
        $this->primary_key = 'perm_id';
        $this->table_fields = array('perm_id', 'group_id');

        parent::__construct();

    }

    public function get_group_name($group_id)
    {
        $group = $this->db->get_where('cms_aauth_groups', ['id' => $group_id])->row();
        if ($group) {
            return $group->name;
        }

        return false;
    }
}

