<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Database_backup extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->is_allowed("yedekleme");

    }

    public function index()
    {

        $this->template->write('title', 'Sorgular', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");
        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");

        $this->template->write_view('content', 'db_backup/db_backup_list', $this->data, TRUE);
        $this->template->render();


    }

    public function db_backup()
    {


        $this->load->dbutil();

        $this->load->helper('file');
        $backup_name = date("d-m-Y H-i-s") . "-" . generate_key(20);
        write_file(FCPATH . "storage/backup/db/" . $backup_name . ".zip", $this->dbutil->backup());
        $backup = $this->load->dbutil();

        if ($backup) {
            $this->data = array(
                'result' => true,
                'message' => "Veritabanı yedeği başarılya alındı Kayıt Yeri (storage/backup/db/)",
            );
        } else {
            $this->data = array(
                'result' => false,
                'redirect' => "Bir hata oluştu."
            );
        }

        return $this->response($this->data);

    }

    public function db_backup_list()
    {

        $this->load->view("db_backup/db_backup_list_ajax");


    }

    public function db_backup_delete()
    {

        $type =$this->input->post('type');
        $files =$this->input->post('files');

        if($type == "db"){
            $url_path = FCPATH ."storage/backup/db/";
        }else if($type=="log"){
            $url_path = FCPATH ."storage/backup/log_deleted_before/";
        }


        $deleted =  unlink($url_path.$files);


        if ($deleted) {
            $this->data = array(
                'result' => true,
                'message' => "Veritabanı yedeği başarıyla silindi.",
            );
        } else {
            $this->data = array(
                'result' => false,
                'redirect' => "Bir hata oluştu."
            );
        }

       return $this->response($this->data);



    }
}
