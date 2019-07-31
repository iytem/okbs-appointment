<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Ziyaretci extends APP_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_ziyaretci');
        $this->is_allowed("ziyaretci");

    }

    public function index()
    {


        $this->template->write('title', 'Ziyaretçi İşlemleri', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/dataTables.buttons.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.flash.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/jszip.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/pdfmake.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/vfs_fonts.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/plugins/buttons.html5.min.js");


        $this->template->write_view('content', 'ziyaretci_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view()
    {

        $list = $this->db->where(array("ziyaretci_birim" => $this->aauth->get_user()->user_birim));

        $this->db->order_by('ziyaretci_tarih asc, ziyaretci_saat asc');
        $list = $this->model_ziyaretci->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_ziyaretci) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';


                $link .= '<li><a onclick="generate_modal(\'view\',' . $model_ziyaretci->ziyaretci_id . ',\'Ziyaretçi Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</   a></li>';
            $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_ziyaretci->ziyaretci_id . ',\'Ziyaretçi Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';
            $link .= '<li><a onclick="generate_modal(\'delete\',' . $model_ziyaretci->ziyaretci_id . ',\'Ziyaretçi Silme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Sil" style="margin-right: 3px"><i
                        class="fa fa-trash"></i>Sil</a></li>';


            $link .= '</ul></div>';

            $row[] = $no;
            $row[] = $link;
            $row[] = ucwords($model_ziyaretci->ziyaretci_ad_soyad);
            $row[] = $model_ziyaretci->ziyaretci_tel_no;
            $row[] = $model_ziyaretci->ziyaretci_geldigi_yer;
            $row[] = $model_ziyaretci->ziyaretci_referans;
            $row[] = dateConvert($model_ziyaretci->ziyaretci_tarih);
            $row[] = $model_ziyaretci->ziyaretci_saat;
            $row[] = $model_ziyaretci->ziyaretci_not;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_ziyaretci->count_all(),
            "recordsFiltered" => $this->model_ziyaretci->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function modal_render()
    {

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("ziyaretci_add", $this->data);

        } else if ($param == 'edit') {
            $this->data["ziyaretci"] = $this->model_ziyaretci->get($value);
            return $this->load->view("ziyaretci_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["ziyaretci"] = $this->model_ziyaretci->get($value);
            return $this->load->view("ziyaretci_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["ziyaretci"] = $value;
            return $this->load->view("ziyaretci_delete", $this->data);

        }
    }

    public function add_save()
    {

        $this->form_validation->set_rules('ziyaretci_ad_soyad', 'Ad ve Soyad', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_tel_no', 'Telefon Numarası', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_geldigi_yer', 'Ziyaretçinin Geldiği Yer', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_tarih', 'Tarih', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_saat', 'Saat', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_not', 'Notlar', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'ziyaretci_ad_soyad' => $this->input->post('ziyaretci_ad_soyad'),
                'ziyaretci_tel_no' => $this->input->post('ziyaretci_tel_no'),
                'ziyaretci_geldigi_yer' => $this->input->post('ziyaretci_geldigi_yer'),
                'ziyaretci_referans' => $this->input->post('ziyaretci_referans'),
                'ziyaretci_tarih' => $this->input->post('ziyaretci_tarih'),
                'ziyaretci_saat' => $this->input->post('ziyaretci_saat'),
                'ziyaretci_not' => $this->input->post('ziyaretci_not'),
                'ziyaretci_birim' => $this->input->post('ziyaretci_birim'),
            );

            $save_ziyaretci = $this->model_ziyaretci->add($save_data);

            if ($save_ziyaretci) {
                $this->data = array(
                    'result' => true,
                    'message' => "Ziyaretçi kaydı başarıyla kaydedildi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Ziyaretçi kaydı kaydedilemedi.",
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

        $this->form_validation->set_rules('ziyaretci_ad_soyad', 'Ad ve Soyad', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_tel_no', 'Telefon Numarası', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_geldigi_yer', 'Ziyaretçinin Geldiği Yer', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_tarih', 'Tarih', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_saat', 'Saat', 'trim|required');
        $this->form_validation->set_rules('ziyaretci_not', 'Notlar', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            $save_data = array(
                'ziyaretci_ad_soyad' => $this->input->post('ziyaretci_ad_soyad'),
                'ziyaretci_tel_no' => $this->input->post('ziyaretci_tel_no'),
                'ziyaretci_geldigi_yer' => $this->input->post('ziyaretci_geldigi_yer'),
                'ziyaretci_referans' => $this->input->post('ziyaretci_referans'),
                'ziyaretci_tarih' => $this->input->post('ziyaretci_tarih'),
                'ziyaretci_saat' => $this->input->post('ziyaretci_saat'),
                'ziyaretci_not' => $this->input->post('ziyaretci_not'),
                'ziyaretci_birim' => $this->input->post('ziyaretci_birim'),
            );


            $save_ziyaretci = $this->model_ziyaretci->update($id, $save_data);

            if ($save_ziyaretci) {
                $this->data = array(
                    'result' => true,
                    'message' => "Ziyaretçi kaydı başarıyla güncellendi",
                );

            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Ziyaretçi kaydı güncellenemedi.",
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
                'message' => "ziyaretci kaydı başarıyla silindi",
            );

        } else {
            $this->data = array(
                'result' => false,
                'message' => "Bir hata oluştu. ziyaretci kaydı silinemedi.",
            );
        }
        return $this->response($this->data);
    }

    private function _remove($id)
    {

        return $this->model_ziyaretci->delete($id);

    }

}
