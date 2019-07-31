<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Randevu extends APP_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_randevu');

        $this->is_allowed("randevu");
    }

    public function index($sonuc = "")
    {


        $this->data["sonuc"] = $sonuc;
        $this->template->write('title', 'Randevu İşlemleri', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/dataTables.buttons.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.flash.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/jszip.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/pdfmake.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/vfs_fonts.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.html5.min.js");


        $this->template->write_view('content', 'randevu_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view($sonuc = "")
    {


        if ($sonuc == 1) {
            if ($this->aauth->is_admin()) {
                $list = $this->db->where(array("randevu_durum" => 1));
            }else{
                $list = $this->db->where(array("randevu_durum" => 1,"randevu_birim" => $this->aauth->get_user()->user_birim));
            }

        } elseif ($sonuc == 2) {
            if ($this->aauth->is_admin()) {
                $list = $this->db->where(array("randevu_durum" => 2));
            }else{
                $list = $this->db->where(array("randevu_durum" => 2,"randevu_birim" => $this->aauth->get_user()->user_birim));
            }

        }
        $this->db->order_by('randevu_tarih asc, randevu_saat asc');
        $list = $this->model_randevu->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_randevu) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';



                $link .= '<li><a onclick="generate_modal(\'view\',' . $model_randevu->randevu_id . ',\'Randevu Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</   a></li>';


            if ($sonuc == 1 || $sonuc == 2 || $sonuc == "" || $sonuc == 5):

                    $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_randevu->randevu_id . ',\'Randevu Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

            endif;



                $link .= '<li><a onclick="generate_modal(\'close\',' . $model_randevu->randevu_id . ',\'Randevu Kapatma\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Kapat" style="margin-right: 3px"><i
                        class="fa fa-close"></i>Kapat</a></li>';




                $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_randevu->randevu_id . ',\'Randevu Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';

            $link .= '</ul></div>';

            $row[] = $no;
            $row[] = $link;
            $row[] = ucwords($model_randevu->randevu_ad_soyad);
            $row[] = $model_randevu->randevu_calistigi_yer;
            $row[] = $model_randevu->randevu_sebep;
            $row[] = $model_randevu->randevu_telefon_no;
            $row[] = dateConvert($model_randevu->randevu_tarih, "-");
            $row[] = $model_randevu->randevu_saat;
            $row[] = $model_randevu->randevu_notlar;
            $row[] = get_randevu_durum($model_randevu->randevu_durum);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_randevu->count_all(),
            "recordsFiltered" => $this->model_randevu->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("randevu_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["randevu"] = $this->model_randevu->get($value);
            return $this->load->view("randevu_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["randevu"] = $this->model_randevu->get($value);
            return $this->load->view("randevu_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["randevu"] = $value;
            return $this->load->view("randevu_delete", $this->data);

        } else if ($param == 'print') {
            $this->data["randevu"] = $value;
            return $this->load->view("randevu_print", $this->data);

        } else if ($param == 'check') {
            $this->data["randevu"] = $value;
            return $this->load->view("randevu_check", $this->data);

        } else if ($param == 'other') {
            $this->data["randevu"] = $this->model_randevu->get($value);
            return $this->load->view("randevu_other", $this->data);

        } else if ($param == 'close') {
            $this->data["randevu"] = $this->model_randevu->get($value);
            return $this->load->view("randevu_close", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('randevu_ad_soyad', 'Ad ve Soyad', 'trim|required');
        $this->form_validation->set_rules('randevu_calistigi_yer', 'Çalıştığı Yer', 'trim|required');
        $this->form_validation->set_rules('randevu_sebep', 'Randevu Sebebi', 'trim|required');
        $this->form_validation->set_rules('randevu_telefon_no', 'Telefon Numarası', 'trim|required');
        $this->form_validation->set_rules('randevu_tarih', 'Tarih', 'trim|required');
        $this->form_validation->set_rules('randevu_notlar', 'Görüşme Notları', 'trim|required');
        $this->form_validation->set_rules('randevu_birim', 'Randevu Birim', 'trim|required');


        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'randevu_ad_soyad' => ucwords($this->input->post('randevu_ad_soyad')),
                'randevu_calistigi_yer' => ucwords($this->input->post('randevu_calistigi_yer')),
                'randevu_sebep' => ucwords($this->input->post('randevu_sebep')),
                'randevu_telefon_no' => $this->input->post('randevu_telefon_no'),
                'randevu_tarih' => $this->input->post('randevu_tarih'),
                'randevu_saat' => $this->input->post('randevu_saat'),
                'randevu_notlar' => $this->input->post('randevu_notlar'),
                'randevu_birim' => $this->input->post('randevu_birim'),
            );

            $save_randevu = $this->model_randevu->add($save_data);

            if ($save_randevu) {
                $this->data = array(
                    'result' => true,
                    'message' => "Randevu başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Randevu kaydedilemedi.",
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

        $this->form_validation->set_rules('randevu_ad_soyad', 'Ad ve Soyad', 'trim|required');
        $this->form_validation->set_rules('randevu_calistigi_yer', 'Çalıştığı Yer', 'trim|required');
        $this->form_validation->set_rules('randevu_sebep', 'Randevu Sebebi', 'trim|required');
        $this->form_validation->set_rules('randevu_telefon_no', 'Telefon Numarası', 'trim|required');
        $this->form_validation->set_rules('randevu_tarih', 'Tarih', 'trim|required');
        $this->form_validation->set_rules('randevu_notlar', 'Görüşme Notları', 'trim|required');
        $this->form_validation->set_rules('randevu_durum', 'Randevu Durum', 'trim|required');
        $this->form_validation->set_rules('randevu_birim', 'Randevu Birim', 'trim|required');


        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'randevu_ad_soyad' => $this->input->post('randevu_ad_soyad'),
                'randevu_calistigi_yer' => $this->input->post('randevu_calistigi_yer'),
                'randevu_sebep' => $this->input->post('randevu_sebep'),
                'randevu_telefon_no' => $this->input->post('randevu_telefon_no'),
                'randevu_tarih' => $this->input->post('randevu_tarih'),
                'randevu_saat' => $this->input->post('randevu_saat'),
                'randevu_notlar' => $this->input->post('randevu_notlar'),
                'randevu_durum' => $this->input->post('randevu_durum'),
                'randevu_birim' => $this->input->post('randevu_birim'),
            );

            $save_randevu = $this->model_randevu->update($id, $save_data);


            if ($save_randevu) {
                $this->data = array(
                    'result' => true,
                    'message' => "Randevu kaydı başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Randevu kaydı güncellenemedi.",
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
                'message' => "randevu görüşme kaydı başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. randevu görüşme kaydı silinemedi.",
            );
        }
        return $this->response($this->data);
    }

    private function _remove($id)
    {

        return $this->model_randevu->delete($id);

    }

    public function randevu_list_print()
    {



        if ($this->input->post("randevu_tarih") == "") {
            $this->data["randevu_lists"] = $this->model_randevu->get_all(array("randevu_durum" => 1));
        } else {
            $this->data["randevu_lists"] = $this->model_randevu->get_all(array("randevu_tarih" => $this->input->post("randevu_tarih"), "randevu_durum" => 1));
        }

        $this->data['randevu_tarih'] = $this->input->post("randevu_tarih");

        $file_name = time() . ".pdf";
        $html = $this->load->view("randevu_list_pdf", $this->data, TRUE);

        $this->data = array(
            "result" => true,
            "message" => get_pdf($file_name, $html, "Randevu Listesi", "L")
        );


        return $this->response($this->data);

    }

    public function add_close_save($id)
    {


        $this->form_validation->set_rules('randevu_notlar', 'Görüşme Notları', 'trim|required');
        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'randevu_notlar' => $this->input->post('randevu_notlar'),
                'randevu_kapanis_tarihi' => date("Y-m-d"),
                'randevu_durum' => 2
            );


            $save_randevu = $this->model_randevu->update($id, $save_data);

            if ($save_randevu) {
                $this->data = array(
                    'result' => true,
                    'message' => "Randevu başarıyla kapatıldı.",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Randevu kapatılamadı.",
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
}
