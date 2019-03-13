<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends APP_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_menu');
        $this->load->model('model_permission');
        $this->is_allowed('menu');

    }

    public function index($type = null)
    {

        if (!$this->model_menu->get_menu_type_id($type)) {
            redirect('cms/menu/index/side-menu');

        }

        $this->data["menus"] = menu_module(0, 1, $this->uri->segment(4));

        $this->template->write('title', 'Menü', TRUE);

        $this->template->add_css("assets/cms/default/plugins/nestable/nesteable.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/nestable/jquery.nestable.js");
        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");

        $this->template->write_view('content', 'menu/menu_list', $this->data, TRUE);
        $this->template->render();

    }

    public function add()
    {

        $menu_type = $this->uri->segment(4);
        $menu_type_id = $this->model_menu->get_menu_type_id($menu_type);

        if (!$menu_type_id) {
            flash_message("Menu tipi bulunamadı", "error");
            redirect('cms/menu');
        }
        $this->data = array('menu_type_id' => $menu_type_id,);


        $this->template->write('title', 'Yeni Menü', TRUE);
        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");
        $this->template->add_css("assets/cms/default/plugins/iCheck/all.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/iCheck/icheck.js");
        $this->template->add_js("assets/cms/default/plugins/jscolor/jscolor.min.js");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");
        $this->template->write_view('content', 'menu/menu_add', $this->data, TRUE);
        $this->template->render();


    }

    public function add_save()
    {

        $this->form_validation->set_rules('label', 'Etiket', 'trim|required|is_unique[cms_menu.label]');
        $this->form_validation->set_rules('link', 'Link', 'trim|required');
        $this->form_validation->set_rules('group[]', 'Grup', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('is_unique', 'Bu menü daha önce kaydedilmiştir');

        if ($this->form_validation->run()) {


            $permission_menu_name = 'navigation_'.seo_link($this->input->post('label'));
            $permission_menu_desc = $this->input->post('label') . " Menü Linki";
            $find_permission = $this->model_permission->get_where(array('name' => $permission_menu_name));

            if (!$find_permission) {
                $perm_id = $this->aauth->create_perm($permission_menu_name, $permission_menu_desc);
            } else {
                $perm_id = $find_permission->id;
            }

            $perm_to_group = [];

            if (count($this->input->post('group'))) {
                foreach ($this->input->post('group') as $group_id) {
                    $perm_to_group[] = [
                        'perm_id' => $perm_id,
                        'group_id' => $group_id
                    ];
                }
            }

            if (count($perm_to_group)) {
                $this->db->insert_batch('cms_aauth_perm_to_group', $perm_to_group);
            }


            $save_data = [
                'label' => $this->input->post('label'),
                'link' => $this->input->post('link'),
                'icon' => $this->input->post('icon'),
                'parent' => $this->input->post('parent'),
                'type' => $this->input->post('type'),
                'icon_color' => '#' . $this->input->post('icon_color'),
                'menu_type_id' => $this->input->post('menu_type_id'),
                'sort' => $this->model_menu->count_all(),
                'perm_id' => $perm_id,

            ];

            $save_menu = $this->model_menu->add($save_data);

            if ($save_menu) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data = array(
                        'result' => true,
                        'message' => "Menü başarıyla kaydedildi",
                        'menu' => get_menu(0, 1, "side-menu")
                    );
                } else {
                    flash_message("Menü başarıyla kaydedildi", 'success');
                    $this->data = array(
                        'result' => true,
                        'redirect' => base_url("cms/menu")
                    );
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data = array(
                        'result' => false,
                        'message' => "Bir hata oluştu. Menü Kaydedilemedi.",
                    );
                } else {
                    flash_message("Bir hata oluştu. Menü Kaydedilemedi.", 'error');
                    $this->data = array(
                        'result' => false,
                        'redirect' => base_url("cms/menu")
                    );
                }

            }
        } else {
            $this->data = array(
                'result' => false,
                'message' => validation_errors(),
            );
        }

        return $this->response($this->data);
    }

    public function edit($id = "")
    {

        if (!$this->model_menu->get($id)) {
            redirect("404");
        }

        $this->data = array(
            'menu' => $this->model_menu->get($id),
            'group_menu' => $this->model_menu->get_group_menu($id)
        );


        $this->template->write('title', 'Menü Güncelle', TRUE);

        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");
        $this->template->add_css("assets/cms/default/plugins/iCheck/all.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/iCheck/icheck.js");
        $this->template->add_js("assets/cms/default/plugins/jscolor/jscolor.min.js");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");
        $this->template->write_view('content', 'menu/menu_update', $this->data, TRUE);
        $this->template->render();


    }

    public function edit_save($id)
    {

        $this->form_validation->set_rules('label', 'Etiket', 'trim|required|is_unique[cms_menu.label.id.' . $id . ']');
        $this->form_validation->set_rules('link', 'Link', 'trim|required');
        $this->form_validation->set_rules('group[]', 'Grup', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message("is_unique", "Bu menü daha önce kaydedilmiştir.");

        if ($this->form_validation->run()) {



            $menu = $this->model_menu->get($id);
            $menu_label_name = 'navigation_' . seo_link($menu->label);


            $permission = $this->model_menu->get_permission_name($menu_label_name);

            if ($permission) {
                $this->aauth->delete_perm($permission->name);
            }



            $permission_menu_name = "navigation_".seo_link($this->input->post('label'));
            $permission_menu_desc = $this->input->post('label')." İşlemleri Menü Linki";
            $find_permission = $this->model_permission->get_where(['name' => $permission_menu_name]);

            if (!$find_permission) {
                $perm_id = $this->aauth->create_perm($permission_menu_name, $permission_menu_desc);
            } else {
                $perm_id = $find_permission->id;
            }

            $perm_to_group = [];

            if (count($this->input->post('group'))) {
                foreach ($this->input->post('group') as $group_id) {
                    $perm_to_group[] = [
                        'perm_id' => $perm_id,
                        'group_id' => $group_id
                    ];
                }
            }

            if (count($perm_to_group)) {
                $this->db->insert_batch('cms_aauth_perm_to_group', $perm_to_group);
            }


            $save_data = [
                'label' => $this->input->post('label'),
                'link' => $this->input->post('link'),
                'icon' => $this->input->post('icon'),
                'parent' => $this->input->post('parent'),
                'type' => $this->input->post('type'),
                'perm_id' => $perm_id,
                'icon_color' => '#' . $this->input->post('icon_color'),
            ];


            $save_menu = $this->model_menu->update($id, $save_data);

            if ($save_menu) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data = array(
                        'result' => true,
                        'message' => "Menü başarıyla güncellendi",
                        'id' => $save_menu,
                        'menu' => get_menu(0, 1, "side-menu")
                    );
                } else {
                    flash_message("Menü başarıyla güncellendi", 'success');
                    $this->data = array(
                        'result' => true,
                        'redirect' => base_url("cms/menu")
                    );
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data = array(
                        'result' => false,
                        'message' => "Bir hata oluştu. Menü güncellenemedi.",
                    );
                } else {
                    flash_message("Bir hata oluştu. Menü güncellenemedi.", 'error');
                    $this->data = array(
                        'result' => false,
                        'redirect' => base_url("cms/menu")
                    );
                }

            }
        } else {
            $this->data = array(
                'result' => false,
                'message' => validation_errors(),
            );
        }
        return $this->response($this->data);
    }

    public function save_ordering()
    {
        $this->menus = [];
        $this->sort = 0;
        $this->_parse_menu($_POST['menu']);
        $save_ordering = $this->db->update_batch('cms_menu', $this->menus, 'id');
        if ($save_ordering) {
            $this->data = array(
                'success' => true,
                'message' => "Menü sıralaması güncellendi.",
                'menu' => get_menu(0, 1, "side-menu")
            );
        } else {
            $this->data = array(
                'success' => false,
                'message' => "Bir hata oluştu. Menü Sıralaması Değişmedi."
            );
        }


        return $this->response($this->data);
    }

    private function _parse_menu($menus, $parent = '')
    {

        foreach ($menus as $menu) {
            $this->sort++;
            $this->menus[] = [
                'id' => $menu['id'],
                'sort' => $this->sort,
                'parent' => $parent
            ];
            if (isset($menu['children'])) {
                $this->_parse_menu($menu['children'], $menu['id']);
            }
        }
    }

    public function delete($id)
    {

        $menu = $this->model_menu->get($id);

        $remove = $this->model_menu->delete($id);
        $this->model_menu->update_parent($id);


        $find_permission = $this->model_permission->get_where(['id' => $menu->perm_id]);

        $this->aauth->delete_perm($find_permission->name);

        if ($remove) {
            flash_message("Menü Silindi", 'success');
        } else {
            flash_message("Bir hata oluştu. Menü Silinemedi.", 'error');
        }

        redirect_back();
    }

}
