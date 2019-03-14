<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_user extends MY_Model {


    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'cms_aauth_users';
        $this->primary_key = 'id';
        $this->column_order = array(null,'','','email', 'pass', 'name', 'full_name', 'registry_number', 'task_status', 'gender', 'title', 'avatar', 'banned', 'last_login', 'last_activity', 'last_login_attempt', 'forgot_exp', 'remember_time', 'remember_exp', 'verification_code', 'ip_address', 'login_attempts');
        $this->column_search = array('email', 'pass', 'name', 'full_name', 'registry_number', 'task_status', 'gender', 'title', 'avatar', 'banned', 'last_login', 'last_activity', 'last_login_attempt', 'forgot_exp', 'remember_time', 'remember_exp', 'verification_code', 'ip_address', 'login_attempts');
        $this->order = array('id' => 'desc');


    }

    public function get_group_user($user_id = false)
	{
		$result_group_user = [];

		$query = $this->db->get_where('cms_aauth_user_to_group', ['user_id' => $user_id]);
		foreach ($query->result() as $row) {
			$result_group_user[] = $row->group_id;
		}

		return $result_group_user;
	}

    public function get_permission_user($user_id = false)
    {
        $result_perm_user[] = 0;

        $query = $this->db->get_where('cms_aauth_perm_to_user', ['user_id' => $user_id]);

        foreach ($query->result() as $row) {
            $result_perm_user[] = $row->perm_id;
        }

        return $result_perm_user;
    }

    public function join_statement()
    {
       $this->db->join("okbs_birim","okbs_birim.birim_id=cms_aauth_users.user_birim","LEFT");
    }

}


/* End of file Model_user.php */
/* Location: ./application/models/Model_user.php */