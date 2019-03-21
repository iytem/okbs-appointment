<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Popup extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_popup');


    }

    public function index()
    {

        $this->is_allowed("popup");
        $this->template->write('title', 'Popup(Duyurular)', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");


        $this->template->write_view('content', 'popup/popup_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view()
    {
        $this->is_allowed("popup");
        $list = $this->model_popup->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_popup) {
            $no++;
            $row = array();

            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
            <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a onclick="generate_modal(\'view\',' . $model_popup->popup_id . ',\'Popup Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_popup->popup_id . ',\'Popup Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_popup->popup_id . ',\'Popup Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';

            $link .= '</ul></div>';

            if ($model_popup->status == 1):
                $status = '<a href="javascript:void(0);"  onclick="popup_status(' . $model_popup->popup_id . ',' . $model_popup->status . ')"><i class="fa fa-check-circle fa-2x" style="color: green"></i></a>';
            else:
                $status = '<a href="javascript:void(0);"  onclick="popup_status(' . $model_popup->popup_id . ',' . $model_popup->status . ')"><i class="fa fa-minus-circle fa-2x" style="color: red"></i></a>';
            endif;


            $row[] = $no;
            $row[] = $link;
            $row[] = $model_popup->title;
            $row[] = $model_popup->description;
            $row[] = $model_popup->page_url;
            $row[] = $status;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_popup->count_all(),
            "recordsFiltered" => $this->model_popup->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $this->is_allowed("popup");
        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("popup/popup_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["popup"] = $this->model_popup->get($value);
            return $this->load->view("popup/popup_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["popup"] = $this->model_popup->get($value);
            return $this->load->view("popup/popup_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["popup"] = $value;
            return $this->load->view("popup/popup_delete", $this->data);

        }
    }

    public function add_save()
    {

        $this->is_allowed("popup");
        $this->form_validation->set_rules('title', 'Başlık', 'trim|required');
        $this->form_validation->set_rules('description', 'Açıklama', 'trim|required');
        $this->form_validation->set_rules('page_url', 'Sayfa URL', 'trim|required');


        $this->form_validation->set_message('required', '%s alanı zorunludur');

        if ($this->form_validation->run()) {

            $save_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'page_url' => $this->input->post('page_url'),
                'popup_token_key' => generate_key(),
            );

            $save_popup = $this->model_popup->add($save_data);

            if ($save_popup) {
                $this->data = array(
                    'result' => true,
                    'message' => "Popup başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Popup Kaydedilemedi.",
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
        $this->is_allowed("popup");
        $this->form_validation->set_rules('title', 'Başlık', 'trim|required');
        $this->form_validation->set_rules('description', 'Açıklama', 'trim|required');
        $this->form_validation->set_rules('page_url', 'Sayfa URL', 'trim|required');

        $this->form_validation->set_message("required", "%s alanı zorunludur");

        if ($this->form_validation->run()) {

            $save_data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'page_url' => $this->input->post('page_url'),
            );

            $save_popup = $this->model_popup->update($id, $save_data);
            if ($save_popup) {

                $this->data = array(
                    'result' => true,
                    'message' => "Popup başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Popup güncellenemedi.",
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


        $this->is_allowed("popup");
        $param = $this->input->post('id');

        $delete = $this->_remove($param);


        if ($delete) {
            $this->data = array(
                'result' => true,
                'message' => "Popup(Duyurular) başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. Popup(Duyurular) silinemedi.",
            );
        }

        return $this->response($this->data);
    }

    private function _remove($id)
    {

        return $this->model_popup->delete($id);

    }

    public function set_status()
    {
        $this->is_allowed("popup");
        $status = $this->input->post('status');
        $id = $this->input->post('id');

        if ($status == 0) {
            $update_status = $this->model_popup->update($id, array("status" => 1));

            $message = "Popup Yayına Açıldı";
        } else if ($status == 1) {
            $update_status = $this->model_popup->update($id, array("status" => 0));
            $message = "Popup Yayına Kapatıldı";
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

    public function dont_show()
    {

        $popup_token_key = $this->input->post('id');

        set_cookie($popup_token_key, "true", 60 * 60 * 24 * 365);
    }

}
