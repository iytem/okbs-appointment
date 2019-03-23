<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Telefon extends APP_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_telefon');
        $this->is_allowed("telefon");

    }

    public function index($sonuc = "")
    {


        $this->data["sonuc"] = $sonuc;
        $this->template->write('title', 'Telefon Görüşmeleri', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/dataTables.buttons.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.flash.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/jszip.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/pdfmake.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/vfs_fonts.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.html5.min.js");


        $this->template->write_view('content', 'telefon_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view($sonuc = "")
    {

        if ($sonuc == 1) {
            if ($this->aauth->is_admin()) {
                $list = $this->db->where(array("telefon_durum" => 2));
            }else{
                $list = $this->db->where(array("telefon_durum" => 2,"telefon_birim" => $this->aauth->get_user()->user_birim));
            }

        } else {
            if (!$this->aauth->is_admin()) {
                $list = $this->db->where(array("telefon_birim" => $this->aauth->get_user()->user_birim));
            }

        }


        if ($sonuc == 1) {
            $list = $this->db->where(array("telefon_durum" => 2));
        }
        $list = $this->model_telefon->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_telefon) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';


                $link .= '<li><a onclick="generate_modal(\'view\',' . $model_telefon->telefon_id . ',\'Telefon Görüşmesi Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</   a></li>';
                $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_telefon->telefon_id . ',\'Telefon Görüşmesi Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';
                $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_telefon->telefon_id . ',\'Telefon Görüşmesi Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';


            $link .= '</ul></div>';

            $row[] = $no;
            $row[] = $link;
            $row[] = ucwords($model_telefon->telefon_ad_soyad);
            $row[] = $model_telefon->telefon_calistigi_yer;
            $row[] = $model_telefon->telefon_sebep;
            $row[] = $model_telefon->telefon_no;
            $row[] = dateConvert($model_telefon->telefon_tarih, "-");
            $row[] = $model_telefon->telefon_saat;
            $row[] = $model_telefon->telefon_notlar;
            $row[] = get_telefon_durum($model_telefon->telefon_durum);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_telefon->count_all(),
            "recordsFiltered" => $this->model_telefon->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("telefon_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["telefon"] = $this->model_telefon->get($value);
            return $this->load->view("telefon_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["telefon"] = $this->model_telefon->get($value);
            return $this->load->view("telefon_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["telefon"] = $value;
            return $this->load->view("telefon_delete", $this->data);

        } else if ($param == 'print') {
            $this->data["telefon"] = $value;
            return $this->load->view("telefon_print", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('telefon_ad_soyad', 'Ad ve Soyad', 'trim|required');
        $this->form_validation->set_rules('telefon_no', 'Telefon Numarası', 'trim|required');
        $this->form_validation->set_rules('telefon_calistigi_yer', 'Çalıştığı Kurum', 'trim|required');
        $this->form_validation->set_rules('telefon_sebep', 'Referans', 'trim|required');
        $this->form_validation->set_rules('telefon_tarih', 'Tarih', 'trim|required');
        $this->form_validation->set_rules('telefon_saat', 'Saat', 'trim|required');
        $this->form_validation->set_rules('telefon_notlar', 'Notlar', 'trim|required');
        $this->form_validation->set_rules('telefon_durum', 'Durum', 'trim|required');
        $this->form_validation->set_rules('telefon_birim', 'Telefon Birim', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'telefon_ad_soyad' => $this->input->post('telefon_ad_soyad'),
                'telefon_no' => $this->input->post('telefon_no'),
                'telefon_calistigi_yer' => $this->input->post('telefon_calistigi_yer'),
                'telefon_sebep' => $this->input->post('telefon_sebep'),
                'telefon_tarih' => $this->input->post('telefon_tarih'),
                'telefon_saat' => $this->input->post('telefon_saat'),
                'telefon_notlar' => $this->input->post('telefon_notlar'),
                'telefon_durum' => $this->input->post('telefon_durum'),
                'telefon_birim' => $this->input->post('telefon_birim'),
            );

            $save_telefon = $this->model_telefon->add($save_data);

            if ($save_telefon) {
                $this->data = array(
                    'result' => true,
                    'message' => "Telefon görüşme kaydı başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Telefon görüşme kaydı kaydedilemedi.",
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

        $this->form_validation->set_rules('telefon_ad_soyad', 'Ad ve Soyad', 'trim|required');
        $this->form_validation->set_rules('telefon_no', 'Telefon Numarası', 'trim|required');
        $this->form_validation->set_rules('telefon_calistigi_yer', 'Çalıştığı Kurum', 'trim|required');
        $this->form_validation->set_rules('telefon_sebep', 'Referans', 'trim|required');
        $this->form_validation->set_rules('telefon_tarih', 'Tarih', 'trim|required');
        $this->form_validation->set_rules('telefon_saat', 'Saat', 'trim|required');
        $this->form_validation->set_rules('telefon_notlar', 'Notlar', 'trim|required');
        $this->form_validation->set_rules('telefon_durum', 'Durum', 'trim|required');
        $this->form_validation->set_rules('telefon_birim', 'Telefon Birim', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'telefon_ad_soyad' => $this->input->post('telefon_ad_soyad'),
                'telefon_no' => $this->input->post('telefon_no'),
                'telefon_calistigi_yer' => $this->input->post('telefon_calistigi_yer'),
                'telefon_sebep' => $this->input->post('telefon_sebep'),
                'telefon_tarih' => $this->input->post('telefon_tarih'),
                'telefon_saat' => $this->input->post('telefon_saat'),
                'telefon_notlar' => $this->input->post('telefon_notlar'),
                'telefon_durum' => $this->input->post('telefon_durum'),
                'telefon_birim' => $this->input->post('telefon_birim'),
            );


            $save_telefon = $this->model_telefon->update($id, $save_data);

            if ($save_telefon) {
                $this->data = array(
                    'result' => true,
                    'message' => "Telefon görüşme kaydı başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Telefon görüşme kaydı güncellenemedi.",
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
                'message' => "Telefon görüşme kaydı başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. Telefon görüşme kaydı silinemedi.",
            );
        }
        return $this->response($this->data);
    }

    private function _remove($id)
    {

        return $this->model_telefon->delete($id);

    }

    public function telefon_list_print()
    {



        if ($this->input->post("telefon_tarih") == "") {
            $this->data["telefon_lists"] = $this->model_telefon->get_all(array("telefon_durum" => 2));
        } else {
            $this->data["telefon_lists"] = $this->model_telefon->get_all(array("telefon_tarih" => $this->input->post("telefon_tarih"), "telefon_durum" => 2));
        }

        $this->data['telefon_tarih'] = $this->input->post("telefon_tarih");

        $file_name = time() . ".pdf";
        $html = $this->load->view("telefon_list_pdf", $this->data, TRUE);

        $this->data = array(
            "result" => true,
            "message" => get_pdf($file_name, $html, "Telefon Görüşme Listesi","L")
        );


    return $this->response($this->data);

    }



}
