<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Log extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_user_activity');

    }

    public function user_activity()
    {
        $this->is_allowed("kullanici-aktivitileri");

        $this->template->write('title', 'Kullanıcı Aktivitileri', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");
        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");

        $this->template->write_view('content', 'log/user_log_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view_user_activity()
    {
        $this->is_allowed("kullanici-aktivitileri");

        $list = $this->model_user_activity->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_user_activity) {
            $no++;
            $row = array();


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                  <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a onclick="log_detail(' . $model_user_activity->activity_id . ',\'Kullanıcı Activite Detay\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</a></li></ul></div>';

            $link .= '</ul></div>';


            $row[] = $no;
            $row[] = $link;
            $row[] = dateTimeConvertDate($model_user_activity->time);
            $row[] = $model_user_activity->full_name;
            $row[] = $model_user_activity->table_name;
            $row[] = $model_user_activity->action;
            $row[] = $model_user_activity->data_where;
            $row[] = $model_user_activity->url;
            $row[] = $model_user_activity->ip_address;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_user_activity->count_all(),
            "recordsFiltered" => $this->model_user_activity->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);
    }

    public function deleted_user_log()
    {
        $this->is_allowed("kullanici-aktivitileri");

        $this->load->dbutil();

        $this->load->helper('file');
        $backup_name = date("d-m-Y H-i-s") . "-user-" . generate_key(20);
        write_file(FCPATH . "storage/backup/log_deleted_before/" . $backup_name . ".zip", $this->dbutil->backup());
        $backup = $this->load->dbutil();

        if ($backup) {
            $delete = $this->db->empty_table("cms_user_activity");


            if ($delete) {
                flash_message("Log başarıyla silindi", "success");
                redirect(base_url("cms/log/user_activity"));

            } else {
                flash_message("Bir hata oluştu Log silinemedi", "error");
                redirect(base_url("cms/log/user_activity"));
            }
        }else{
            flash_message("Bir hata oluştu. Silme öncesi yedek dosyası oluşturulamadı", "error");
            redirect(base_url("cms/log/user_activity"));
        }
    }

    public function user_log_detail()
    {
        $this->is_allowed("kullanici-aktivitileri");

        $param = $this->input->post("id");
        $this->data["log"] = $this->model_user_activity->get($param);
        return $this->load->view("log/user_log_detail", $this->data);
    }
}
