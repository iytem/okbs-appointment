<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Group extends APP_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_group');
        $this->is_allowed("kullanici-gruplari");

    }

    public function index()
    {

        $this->template->write('title', 'Gruplar', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");


        $this->template->write_view('content', 'group/group_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view()
    {

        $list = $this->model_group->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_group) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a onclick="generate_modal(\'view\',' . $model_group->id . ',\'Grup Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_group->id . ',\'Grup Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_group->id . ',\'Grup Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';

            $link .= '</ul></div>';

            $row[] = $no;
            $row[] = $link;
            $row[] = $model_group->name;
            $row[] = $model_group->definition;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_group->count_all(),
            "recordsFiltered" => $this->model_group->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("group/group_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["group"] = $this->model_group->get($value);
            return $this->load->view("group/group_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["group"] = $this->model_group->get($value);
            return $this->load->view("group/group_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["group"] = $value;
            return $this->load->view("group/group_delete", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('name', 'Adı', 'trim|required|is_unique[cms_aauth_groups.name]');
        $this->form_validation->set_rules('definition', 'Açıklama', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('is_unique', 'Bu grup daha önce kaydedilmiştir');


        if ($this->form_validation->run()) {

            $save_data = array(
                'definition' => $this->input->post('definition'),
            );

            $save_group = $this->aauth->create_group($this->input->post('name'), $save_data);

            if ($save_group) {
                $this->data = array(
                    'result' => true,
                    'message' => "Grup başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Grup Kaydedilemedi.",
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

        $this->form_validation->set_rules('name', 'Adı', 'trim|required|is_unique[cms_aauth_groups.name.id.' . $id . ']');
        $this->form_validation->set_rules('definition', 'Açıklama', 'trim|required');

        $this->form_validation->set_message("required", "%s alanı zorunludur");
        $this->form_validation->set_message("is_unique", "Bu grup daha önce kaydedilmiştir.");

        if ($this->form_validation->run()) {

            $save_data = [
                'definition' => $this->input->post('definition'),
            ];

            $save_group = $this->aauth->update_group($id, $this->input->post('name'), $save_data);
            if ($save_group) {

                $this->data = array(
                    'result' => true,
                    'message' => "Grup başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Grup güncellenemedi.",
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
                'message' => "Grup başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. Grup silinemedi.",
            );
        }

        return $this->response($this->data);
    }

    private function _remove($id)
    {
        return $this->aauth->delete_group($id);

    }

}
