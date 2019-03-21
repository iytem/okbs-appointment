<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Permission extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_permission');
        $this->is_allowed("uygulama-izinleri");
    }

    public function index()
    {

        $this->template->write('title', 'Uygulama İzinler', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/jquery.dataTables_themeroller.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");

        $this->template->write_view('content', 'permission/permission_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view()
    {

        $list = $this->model_permission->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_permission) {
            $no++;
            $row = array();

            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
               <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a onclick="generate_modal(\'view\',' . $model_permission->id . ',\'Yetki Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_permission->id . ',\'Yetki Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_permission->id . ',\'Yetki Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';

            $link .= '</ul></div>';

            $row[] = $no;
            $row[] = $link;
            $row[] = $model_permission->name;
            $row[] = $model_permission->definition;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_permission->count_all(),
            "recordsFiltered" => $this->model_permission->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("permission/permission_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["permission"] = $this->model_permission->get($value);
            return $this->load->view("permission/permission_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["permission"] = $this->model_permission->get($value);
            return $this->load->view("permission/permission_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["permission"] = $value;
            return $this->load->view("permission/permission_delete", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('name', 'Adı', 'trim|required|is_unique[cms_aauth_perms.name]');
        $this->form_validation->set_rules('definition', 'Açıklama', 'trim|required');

        $this->form_validation->set_message("required", "%s alanı zorunludur");
        $this->form_validation->set_message("is_unique", "Bu izin daha önce kaydedilmiş.");

        if ($this->form_validation->run()) {

            $save_permission = $this->aauth->create_perm($this->input->post('name'), $this->input->post('definition'));

            if ($save_permission) {
                $this->data = array(
                    'result' => true,
                    'message' => "Yetki başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Yetki kaydedilemedi.",
                );
            }
        } else {
            $this->data = array(
                'result' => false,
                'message' => validation_errors(),
            );
        }
        return $this->response($this->data);
    }

    public function edit_save($id)
    {


        $this->form_validation->set_rules('name', 'Adı', 'trim|required|is_unique[cms_aauth_perms.name.id.' . $id . ']');
        $this->form_validation->set_rules('definition', 'Açıklama', 'trim|required');

        $this->form_validation->set_message("required", "%s alanı zorunludur");
        $this->form_validation->set_message("is_unique", "Bu yetki daha önce kaydedilmiş.");

        if ($this->form_validation->run()) {

            $save_permission = $this->aauth->update_perm($id, $this->input->post('name'), $this->input->post('definition'));

            if ($save_permission) {
                $this->data = array(
                    'result' => true,
                    'message' => "Yetki başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Yetki Güncelleştirilemedi.",
                );
            }

        } else {
            $this->data = array(
                'result' => false,
                'message' => validation_errors(),
            );
        }
        return $this->response($this->data);
    }

    public function delete()
    {

        $param = $this->input->post('id');

        $delete = $this->_remove($param);

        if ($delete) {
            $this->data = array(
                'result' => true,
                'message' => "Yetki başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. Yetki silinemedi.",
            );
        }

        return $this->response($this->data);
    }

    private function _remove($id)
    {

        return $this->aauth->delete_perm($id);

    }

}