<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Birim extends APP_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_birim');
        $this->is_allowed("kullanici-birim");

    }

    public function index()
    {

        $this->template->write('title', 'Birimler', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");


        $this->template->write_view('content', 'birim/birim_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view()
    {

        $list = $this->model_birim->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_birim) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a onclick="generate_modal(\'view\',' . $model_birim->birim_id . ',\'Birim Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_birim->birim_id . ',\'Birim Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

            $link .= '</ul></div>';

            if ($model_birim->birim_durum == 1):
                $durum = '<a href="javascript:void(0);"  onclick="birim_status(' . $model_birim->birim_id . ',' . $model_birim->birim_durum . ')"><i class="fa fa-check-circle fa-2x" style="color: green"></i></a>';
            else:
                $durum = '<a href="javascript:void(0);"  onclick="birim_status(' . $model_birim->birim_id . ',' . $model_birim->birim_durum . ')"><i class="fa fa-minus-circle fa-2x" style="color: red"></i></a>';
            endif;

            $row[] = $no;
            $row[] = $link;
            $row[] = $model_birim->birim_adi;
            $row[] = $durum;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_birim->count_all(),
            "recordsFiltered" => $this->model_birim->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("birim/birim_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["birim"] = $this->model_birim->get($value);
            return $this->load->view("birim/birim_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["birim"] = $this->model_birim->get($value);
            return $this->load->view("birim/birim_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["birim"] = $value;
            return $this->load->view("birim/birim_delete", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('birim_adi', 'Adı', 'trim|required|is_unique[okbs_birim.birim_adi]');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('is_unique', 'Bu birim daha önce kaydedilmiştir');


        if ($this->form_validation->run()) {

            $save_data = array(
                'birim_adi' => $this->input->post('birim_adi'),
            );

            $save_birim = $this->model_birim->add($save_data);

            if ($save_birim) {
                $this->data = array(
                    'result' => true,
                    'message' => "Birim başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Birim Kaydedilemedi.",
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

        $this->form_validation->set_rules('birim_adi', 'Adı', 'trim|required|is_unique[okbs_birim.birim_adi.birim_id.' . $id . ']');

        $this->form_validation->set_message("required", "%s alanı zorunludur");
        $this->form_validation->set_message("is_unique", "Bu birim daha önce kaydedilmiştir.");

        if ($this->form_validation->run()) {

            $save_data = [
                'birim_adi' => $this->input->post('birim_adi'),
            ];

            $save_birim = $this->model_birim->update($id, $save_data);
            if ($save_birim) {

                $this->data = array(
                    'result' => true,
                    'message' => "Birim başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Birim güncellenemedi.",
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
                'message' => "Birim başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. Birim silinemedi.",
            );
        }

        return $this->response($this->data);
    }

    private function _remove($id)
    {
        return $this->model_birim->delete($id);

    }

    public function set_status()
    {

        $status = $this->input->post('status');
        $id = $this->input->post('id');

        if ($status == 0) {
            $update_status = $this->model_birim->update($id,array("birim_durum"=>1));

            $message = "Birim Durumu Aktifleştirildi";
        } else if ($status == 1) {
            $update_status = $this->model_birim->update($id,array("birim_durum"=>0));
            $message = "Birim Durumu Pasifleştirildi";
        }

        if ($update_status) {
            $this->data = [
                'result' => true,
                'message' => $message,
            ];
        } else {
            $this->data = [
                'result' => false,
                'message' => "Bir hata oluştu. Lütfen tekrar deneyiniz."
            ];
        }

        return $this->response($this->data);
    }
}
