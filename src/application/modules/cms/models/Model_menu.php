<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_menu extends MY_Model {

    public function __construct()
    {
        parent::__construct();

        $this->table_name = 'cms_menu';
        $this->primary_key = 'id';
        $this->column_order = array(null);
        $this->column_search = array();
        $this->order = array('id' => 'desc');

    }

    public function get_menu_type_id($flag = '')
    {
        $flag = str_replace('-', ' ', $flag);

        $query = $this->db->get_where('cms_menu_type', ['name' => $flag]);

        if ($query->row()) {
            return $query->row()->id;
        }

        return false;
    }

	public function get_group_menu($menu_id = false)
	{
		if ($menu_id === false) {
			$menu_id = get_user_data('id');
		}
		$result_group_menu = [];
		$menu = $this->get($menu_id);
		if (!$menu) {
			return [];
		}
		$permission = $this->get_permission_name("navigation_".seo_link($menu->label));
		if (!$permission) {
			return [];
		}
		$query = $this->db->get_where('cms_aauth_perm_to_group', ['perm_id' => $permission->id]);
		foreach ($query->result() as $row) {
			$result_group_menu[] = $row->group_id;
		}

		return $result_group_menu;
	}

	public function get_permission_name($perm_name)
	{
		$permission = $this->db->get_where('cms_aauth_perms', ['name' => $perm_name])->row();
		if (!$permission) {
			return [];
		}

		return $permission;
	}

 	public function update_parent($parent)
	{
		$this->db->where('parent', $parent);
        $result = $this->db->update($this->table_name, array("parent" => '0'));

        return $result;
	}

	public function get_menu($parent,$menu_type){
        $menu_type_id = $this->get_menu_type_id($menu_type);
        $result = $this->db->query("SELECT c.id, c.label,c.icon_color, c.type, c.link,c.icon, cmsmenu.Count 
                                          FROM `cms_menu` c  
                                          LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count 
                                          FROM `cms_menu` 
                                          GROUP BY parent) cmsmenu ON c.id = cmsmenu.parent 
                                          WHERE c.menu_type_id =  " . $menu_type_id . " AND c.parent=" . $parent." order by `sort` ASC")->result();


    return $result;
    }

    public function get_modul_menu($parent,$menu_type){
        $menu_type_id = $this->get_menu_type_id($menu_type);
        $result = $this->db->query("SELECT c.id, c.label, c.link, cmsmenu.Count 
                                            FROM `cms_menu` c  
                                            LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count 
                                            FROM `cms_menu` 
                                            GROUP BY parent) cmsmenu ON c.id = cmsmenu.parent 
                                            WHERE c.menu_type_id = " . $menu_type_id . " AND c.parent=" . $parent." order by `sort` ASC")->result();


        return $result;
    }
}

