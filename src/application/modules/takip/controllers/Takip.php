<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Takip extends APP_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_takip');
        $this->load->model('model_takip_dosya');

        $this->is_allowed("takip");

    }

    public function index($sonuc = "")
    {



        $this->data["sonuc"] = $sonuc;
        $this->template->write('title', 'Takip İşlemleri', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/dataTables.buttons.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.flash.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/jszip.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/pdfmake.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/vfs_fonts.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.html5.min.js");


        $this->template->write_view('content', 'takip_list', $this->data, TRUE);
        $this->template->render();


    }


    public function grid_view($sonuc = "")
    {


        if ($sonuc == 1) {
            if ($this->aauth->is_admin()) {
                $list = $this->db->where(array("takip_durum" => 0));
            }else{
                $list = $this->db->where(array("takip_durum" => 0,"takip_birim" => $this->aauth->get_user()->user_birim));
            }

        } else {
            if ($this->aauth->is_admin()) {
                $list = $this->db->where(array("takip_durum" => 1));
            }else{
                $list = $this->db->where(array("takip_durum" => 1,"takip_birim" => $this->aauth->get_user()->user_birim));
            }

        }

        $list = $this->model_takip->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_takip) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a href="'.base_url("takip/takip_dosya/".$model_takip->takip_id).'"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Dosya Ekle"><i
                        class="fa fa-upload"></i>Dosya Ekle</   a></li>';


                $link .= '<li><a onclick="generate_modal(\'view\',' . $model_takip->takip_id . ',\'Takip Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</   a></li>';


                $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_takip->takip_id . ',\'Takip Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

                $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_takip->takip_id . ',\'Takip Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';


            if ($model_takip->takip_durum == 1):

                    $link .= '<li><a onclick="generate_modal(\'close\',' . $model_takip->takip_id . ',\'Takip Kapatma\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Kapat" style="margin-right: 3px"><i
                        class="fa fa-check"></i>Kapat</a></li>';

            endif;
            $link .= '</ul></div>';


            $row[] = $no;
            $row[] = $link;
            $row[] = $model_takip->takip_ad_soyad;
            $row[] = $model_takip->takip_sicil_tc;
            $row[] = $model_takip->takip_iletisim_bilgileri;
            $row[] = $model_takip->takip_konu;
            $row[] = $model_takip->takibin_geldigi_yer;
            $row[] = dateConvert($model_takip->takip_gelis_tarihi, "-");
            $row[] = dateConvert($model_takip->takip_sonuc_tarihi, "-");
            $row[] = $model_takip->takip_sonuc_notu;
            $row[] = $model_takip->takip_durum == 1 ? "İncelemede" : "Sonuçlandı";
            $data[] = $row;

        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_takip->count_all(),
            "recordsFiltered" => $this->model_takip->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("takip_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["takip"] = $this->model_takip->get($value);
            return $this->load->view("takip_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["takip"] = $this->model_takip->get($value);
            return $this->load->view("takip_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["takip"] = $value;
            return $this->load->view("takip_delete", $this->data);

        } else if ($param == 'close') {
            $this->data["takip"] = $this->model_takip->get($value);
            return $this->load->view("takip_close", $this->data);

        }else if ($param == 'dosya_add') {
            $this->data["dosya_takip_id"] = $value;
            return $this->load->view("takip_dosya_add", $this->data);

        }else if ($param == 'dosya_delete') {
            $this->data["dosya"] = $this->model_takip_dosya->get($value);;
            return $this->load->view("takip_dosya_delete", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('takip_ad_soyad', 'Ad Soyad', 'trim|required');
        $this->form_validation->set_rules('takip_sicil_tc', 'TC/Sicil No', 'trim|required');
        $this->form_validation->set_rules('takip_iletisim_bilgileri', 'İletişim Bilgileri', 'trim|required');
        $this->form_validation->set_rules('takip_konu', 'Konu', 'trim|required');
        $this->form_validation->set_rules('takibin_geldigi_yer', 'Geldiği Yer', 'trim|required');
        $this->form_validation->set_rules('takip_gelis_tarihi', 'Geliş Tarihi', 'trim|required');
        $this->form_validation->set_rules('takip_sonuc_notu', 'Notlar', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {


            $save_data = array(
                'takip_ad_soyad' => $this->input->post('takip_ad_soyad'),
                'takip_sicil_tc' => $this->input->post('takip_sicil_tc'),
                'takip_iletisim_bilgileri' => $this->input->post('takip_iletisim_bilgileri'),
                'takip_konu' => $this->input->post('takip_konu'),
                'takibin_geldigi_yer' => $this->input->post('takibin_geldigi_yer'),
                'takip_birim' => $this->input->post('takip_birim'),
                'takip_gelis_tarihi' => $this->input->post('takip_gelis_tarihi'),
                'takip_sonuc_notu' => $this->input->post('takip_sonuc_notu'),

            );


            $save_takip = $this->model_takip->add($save_data);

            if ($save_takip) {
                $this->data = array(
                    'result' => true,
                    'message' => "İş Takibi başarıyla kaydedildi",
                );
            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. İş Takibi Kaydedilemedi.",
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

        $this->form_validation->set_rules('takip_ad_soyad', 'Ad Soyad', 'trim|required');
        $this->form_validation->set_rules('takip_sicil_tc', 'TC/Sicil No', 'trim|required');
        $this->form_validation->set_rules('takip_iletisim_bilgileri', 'İletişim Bilgileri', 'trim|required');
        $this->form_validation->set_rules('takip_konu', 'Konu', 'trim|required');
        $this->form_validation->set_rules('takibin_geldigi_yer', 'Geldiği Yer', 'trim|required');
        $this->form_validation->set_rules('takip_gelis_tarihi', 'Geliş Tarihi', 'trim|required');
        $this->form_validation->set_rules('takip_sonuc_notu', 'Notlar', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {


            $save_data = array(
                'takip_ad_soyad' => $this->input->post('takip_ad_soyad'),
                'takip_sicil_tc' => $this->input->post('takip_sicil_tc'),
                'takip_iletisim_bilgileri' => $this->input->post('takip_iletisim_bilgileri'),
                'takip_konu' => $this->input->post('takip_konu'),
                'takibin_geldigi_yer' => $this->input->post('takibin_geldigi_yer'),
                'takip_birim' => $this->input->post('takip_birim'),
                'takip_gelis_tarihi' => $this->input->post('takip_gelis_tarihi'),
                'takip_sonuc_notu' => $this->input->post('takip_sonuc_notu'),


            );


            $save_takip = $this->model_takip->update($id, $save_data);

            if ($save_takip) {
                $this->data = array(
                    'result' => true,
                    'message' => "İş Takibi başarıyla güncellendi",
                );
            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. İş Takibi güncellenemedi.",
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
                'message' => "Takip başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu.Takip silinemedi.",
            );
        }
        return $this->response($this->data);
    }

    private function _remove($id)
    {

        return $this->model_takip->delete($id);

    }

    public function add_close_save($id)
    {



        $this->form_validation->set_rules('takip_sonuc_tarihi', 'Takip Sonuç Tarihi', 'trim|required');
        $this->form_validation->set_rules('takip_sonuc_notu', 'Dosya', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {


            $save_data = array(
                'takip_sonuc_tarihi' => $this->input->post('takip_sonuc_tarihi'),
                'takip_sonuc_notu' => $this->input->post('takip_sonuc_notu'),
                'takip_durum' => 0

            );


            $save_takip = $this->model_takip->update($id, $save_data);

            if ($save_takip) {
                $this->data = array(
                    'result' => true,
                    'message' => "İş Takibi başarıyla kapatıldı",
                );
            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. İş Takibi kapatılamadı.",
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


    public function takip_dosya($id)
    {



        $this->template->write('title', 'Takip Dosya İşlemleri', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");

        $this->template->write_view('content', 'takip_dosya_list', $this->data, TRUE);
        $this->template->render();
    }

    public function dosya_grid_view($takip_id = "")
    {




        $list = $this->db->where(array("dosya_takip_id" => $takip_id));

        $list = $this->model_takip_dosya->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_takip_dosya) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';


                $link .= '<li><a onclick="generate_modal(\'dosya_delete\',' . $model_takip_dosya->dosya_id . ',\'Takip Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';

            $link .= '</ul></div>';


            $row[] = $no;
            $row[] = $link;
            $row[] = "<a href=".base_url("storage/takip_folder/".$model_takip_dosya->dosya_adi)."><i class='fa fa-file fa-3x'></i> </a>";
            $row[] = dateConvert($model_takip_dosya->dosya_tarih);
            $data[] = $row;

        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_takip_dosya->count_all(),
            "recordsFiltered" => $this->model_takip_dosya->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function dosya_add_save()
    {

        $number_of_files = sizeof($_FILES['file']['tmp_name']);


        $files = $_FILES['file'];
        $errors = array();

        for ($i = 0; $i < $number_of_files; $i++) {
            if ($_FILES['file']['error'][$i] != 0) $errors[$i][] = 'Dosya yüklenemedi. Lütfen Tekrar Deneyiniz. ' . $_FILES['file']['name'][$i];
        }
        if (sizeof($errors) == 0) {

            $this->load->library('upload');
            $takip_id = $this->input->post("dosya_takip_id");
            $path = "storage/takip_folder/";
            if (!is_dir($path)) {
                @mkdir($path, 0777, true);
            }


            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';


            for ($i = 0; $i < $number_of_files; $i++) {

                $nokta = explode('.', $files['name'][$i]);
                $nokta = $nokta[count($nokta) - 1];


                $_FILES['file']['name'] = seo_link($i . " " . time() . " " . $files['name'][$i]) . "." . $nokta;
                $_FILES['file']['type'] = $files['type'][$i];
                $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['file']['error'] = $files['error'][$i];
                $_FILES['file']['size'] = $files['size'][$i];
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {



                    $data['uploads'][$i] = $this->upload->data();


                    $save_data = array(
                        "dosya_takip_id" => $takip_id,
                        "dosya_tipi" => $_FILES['file']['type'],
                        "dosya_adi" => $_FILES['file']['name'],
                        "dosya_boyut" => $_FILES['file']['size'],
                        "dosya_tarih" => date("Y-m-d"),
                    );

                    $this->db->insert("okbs_takip_dosya", $save_data);

                    $this->data = array(
                        'result' => true,
                        'message' => "Dosya Başarıyla Yüklendi"

                    );


                } else {
                    $this->data = array(
                        'result' => false,
                        'message' => $this->upload->display_errors(),
                    );

                }
            }

        } else {
            $this->data = array(
                'result' => false,
                'message' => $errors,
            );

        }


        return $this->response($this->data);
    }

    public function dosya_delete()
    {


        $dosya_id = $this->input->post('dosya_id');
        $dosya_adi = $this->input->post('dosya_adi');

        $delete = unlink("storage/takip_folder/$dosya_adi");


        $delete = $this->_dosya_remove($dosya_id);

        if ($delete) {
            $this->data = array(
                'result' => true,
                'message' => "Dosya başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu.Dosya silinemedi.",
            );
        }
        return $this->response($this->data);
    }

    private function _dosya_remove($id)
    {
        return $this->model_takip_dosya->delete($id);

    }



}
