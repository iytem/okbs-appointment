<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');

    }

    public function index()
    {
        $this->is_allowed("kullanicilar");

        $this->template->write('title', 'Kullanıcılar', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/jquery.dataTables_themeroller.css");
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");
        $this->template->add_css("assets/cms/default/plugins/fancy-box/source/jquery.fancybox.css?v=2.1.5");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->add_js("assets/cms/default/plugins/fancy-box/source/jquery.fancybox.js?v=2.1.5");

        $this->template->write_view('content', 'user/user_list', $this->data, TRUE);
        $this->template->render();


    }

    public function grid_view()
    {
        $this->is_allowed("kullanicilar");

        $list = $this->model_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_user) {


            $link = '<div class="dropdown">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" style="color:#111">
                <i class="fa fa-folder-open-o fa-lg" style="color: tomato"></i>
            </a>
    		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';

            $link .= '<li><a onclick="generate_modal(\'view\',' . $model_user->id . ',\'Kullanıcı Görüntüleme\')" href="javascript:void(0);"
                   data-toggle="tooltip" data-placement="top" id="view-a" title="Görüntüle"><i
                        class="fa fa-eye"></i>Görüntüle</a></li>';

            $link .= '<li><a onclick="generate_modal(\'edit\',' . $model_user->id . ',\'Kullanıcı Güncelleme\')" href="javascript:void(0);"
                  data-toggle="tooltip" data-placement="top"  title="Güncelle" style="margin-right: 3px"><i
                        class="fa fa-edit"></i>Güncelle</a></li>';

            $link .= '</ul></div>';


            $group = null;
            foreach ($this->aauth->get_user_groups($model_user->id) as $row):
                $group .= '<span class="badge bg-blue">' . $row->name . '</span>';
            endforeach;

            $permission = null;

            if ($model_user->banned == 0):
                $banned = '<a href="javascript:void(0);"  onclick="user_status(' . $model_user->id . ',' . $model_user->banned . ')"><i class="fa fa-check-circle fa-2x" style="color: green"></i></a>';
            else:
                $banned = '<a href="javascript:void(0);"  onclick="user_status(' . $model_user->id . ',' . $model_user->banned . ')"><i class="fa fa-minus-circle fa-2x" style="color: red"></i></a>';
            endif;
            $no++;
            $row = array();


            $row[] = $no;
            $row[] = ' <div class="chip" style="text-align: center">
                            <a class="fancybox" rel="group" href="' . get_user_picture("user", "base", $model_user->avatar,$model_user->gender) . '">
                                <img src="' . get_user_picture("user", "base", $model_user->avatar,$model_user->gender) . '" alt="User" width="50" height="50">
                            </a>
                          
                        </div>';
            $row[] = $link;
            $row[] = $model_user->full_name;
            $row[] = $model_user->email;
            $row[] = $model_user->gender == 1 ? "Bay" : "Bayan";
            $row[] = $group;
            $row[] = $model_user->last_login;
            $row[] = $model_user->ip_address;
            $row[] = '<div class="numberCircle" onclick="user_login_attempts(' . $model_user->id . ')"><b>' . $model_user->login_attempts . '</b></div>';
            $row[] = $banned;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_user->count_all(),
            "recordsFiltered" => $this->model_user->count_filtered(),
            "data" => $data,
        );

        return $this->response($output);

    }

    public function modal_render()
    {
        $this->is_allowed("kullanicilar");

        $param = $this->input->post("param");
        $value = $this->input->post("value");

        if ($param == 'add') {
            return $this->load->view("user/user_add", $this->data);

        } else if ($param == 'edit') {
            $this->data = [
                'user' => $this->model_user->get($value),
                'group_user' => $this->model_user->get_group_user($value)
            ];
            return $this->load->view("user/user_edit", $this->data);

        } else if ($param == 'view') {
            $this->data["user"] = $this->model_user->get($value);
            return $this->load->view("user/user_view", $this->data);

        } else if ($param == 'delete') {
            $this->data["user"] = $value;
            return $this->load->view("user/user_delete", $this->data);

        }
    }

    public function add_save()
    {
        $this->is_allowed("kullanicilar");

        $this->form_validation->set_rules('full_name', 'Ad Soyad', 'trim|required');
        $this->form_validation->set_rules('email', 'E-Posta', 'trim|required|valid_email|is_unique[cms_aauth_users.email]');
        $this->form_validation->set_rules('password', 'Parola', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('gender', 'Cinsiyet', 'trim|required');
        $this->form_validation->set_rules('user_birim', 'Birim', 'trim|required');


        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('min_length', 'Parola en az 6 karakter olmalıdır');
        $this->form_validation->set_message('is_unique', 'Kullanıcı daha önce kaydedilmiştir.');
        $this->form_validation->set_message('valid_email', 'E-posta alanı eposta kurallarına uymuyor.');


        if ($this->form_validation->run()) {


                if($this->input->post('gender') == 1){
                    $avatar = "male.png";
                }else if($this->input->post('gender') == 2){
                    $avatar = "female.png";
                }


                    $save_data = array(
                        'full_name' => $this->input->post('full_name'),
                        'user_birim' => $this->input->post('user_birim'),
                        'gender' => $this->input->post('gender'),
                        'avatar' => $avatar
                    );

                    $user_name = explode("@", $this->input->post('email'));

                    $save_user = $this->aauth->create_user($this->input->post('email'), $this->input->post('password'), $user_name[0], $save_data);
                    if ($save_user) {
                        if (count($this->input->post('group'))) {
                            $user_id = $save_user;
                            foreach ($this->input->post('group') as $group_id) {
                                $this->aauth->add_member($user_id, $group_id);
                            }
                        }
                        $this->data = array(
                            'result' => true,
                            'message' => "Kullanıcı başarıyla kaydedildi",
                        );
                    } else {
                        $this->data = array(
                            'result' => false,
                            'message' => "Bir hata oluştu. Kullanıcı Kaydedilemedi.",
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
        $this->is_allowed("kullanicilar");

        $this->form_validation->set_rules('email', 'E-Posta', 'trim|required|valid_email|is_unique[cms_aauth_users.email.id.' . $id . ']');
        $this->form_validation->set_rules('user_birim', 'Birim', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Ad Soyad', 'trim|required');
        $this->form_validation->set_rules('gender', 'Cinsiyet', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('is_unique', 'Kullanıcı daha önce kaydedilmiştir.');

        if ($this->form_validation->run()) {


            if($this->input->post('gender') == 1){
                $avatar = "male.png";
            }else{
                $avatar = "female.png";
            }




                $save_data = array(
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'user_birim' => $this->input->post('user_birim'),
                    'gender' => $this->input->post('gender'),
                    'avatar' => $avatar
                );


            if ($pass = $this->input->post('password')) {
                $password = $pass;
            } else {
                $password = false;
            }

            $user_name = explode("@",$this->input->post('email'));
            $save_user = $this->aauth->update_user($id, $this->input->post('email'), $password, $user_name[0], $save_data);


            if ($save_user) {
                $this->db->delete('cms_aauth_user_to_group', ['user_id' => $id]);
                if (count($this->input->post('group'))) {
                    foreach ($this->input->post('group') as $group_id) {
                        $this->aauth->add_member($id, $group_id);
                    }
                }

                $this->data = array(
                    'result' => true,
                    'message' => "Kullanıcı başarıyla güncellendi",
                );
            } else {
                $this->data = array(
                    'result' => false,
                    'message' => "Bir hata oluştu. Kullanıcı Güncelleştirilemedi.",
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

    public function profile()
    {

        $id = $this->aauth->get_user()->id;

        $this->data['user'] = $this->model_user->get($id);

        $this->template->write('title', 'Profil', TRUE);

        $this->template->add_css("assets/cms/default/plugins/fancy-box/source/jquery.fancybox.css?v=2.1.5");

        $this->template->add_js("assets/cms/default/plugins/fancy-box/source/jquery.fancybox.js?v=2.1.5");

        $this->template->write_view('content', 'user/user_profile', $this->data, TRUE);
        $this->template->render();

    }

    public function password_edit()
    {


        $id = $this->aauth->get_user()->id;


        $this->data = [
            'user' => $this->model_user->get($id),
        ];

        $this->template->write('title', 'Parola Güncelleme', TRUE);

        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");

        $this->template->write_view('content', 'user/user_password_update', $this->data, TRUE);
        $this->template->render();


    }

    public function password_edit_save()
    {


        $this->form_validation->set_rules('mevcut_password', 'Mevcut Parola', 'trim|required');
        $this->form_validation->set_rules('yeni_parola', 'Yeni Parola', 'trim|required');
        $this->form_validation->set_rules('yeni_parola_tekrar', 'Yeni Parola Tekrarı', 'trim|required|matches[yeni_parola]');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('matches', 'Yeni Parola ve Tekrarı birbiri ile uyuşmuyor.');


        if ($this->form_validation->run()) {


            $mevcut_parola = $this->aauth->get_user()->pass;


            if ($mevcut_parola != $this->aauth->hash_password($this->input->post("mevcut_password"), $this->aauth->get_user()->id)) {
                $this->data = array(
                    'result' => false,
                    'message' => "Mevcut Parolanızı hatalı girdiniz.",
                );
            } else {


                $save_data = [
                    'pass' => $this->aauth->hash_password($this->input->post('yeni_parola'), $this->aauth->get_user()->id),
                ];

                $save_password = $this->model_user->update($this->aauth->get_user()->id, $save_data);
                if ($save_password) {
                    if ($this->input->post('save_type') == 'stay') {
                        $this->data = array(
                            'result' => true,
                            'message' => "Parolanız başarıyla güncellendi",
                        );
                    } else {
                        flash_message("Parolanız başarıyla güncellendi", 'success');
                        $this->data = array(
                            'result' => true,
                            'redirect' => base_url("cms/user/profile")
                        );
                    }
                } else {
                    if ($this->input->post('save_type') == 'stay') {
                        $this->data = array(
                            'result' => false,
                            'message' => "Bir hata oluştu. Grup Güncelleştirilemedi.",
                        );
                    } else {
                        flash_message("Bir hata oluştu. Grup Kaydedilemedi.", 'error');
                        $this->data = array(
                            'result' => false,
                            'redirect' => base_url("cms/user/profile")
                        );
                    }

                }
            }
        } else {
            $this->data = array(
                'result' => false,
                'message' => validation_errors(),
            );
        }
        return $this->response($this->data);
    }

    public function set_status()
    {
        $this->is_allowed("kullanicilar");

        $status = $this->input->post('status');
        $id = $this->input->post('id');

        if ($status == 0) {
            $update_status = $this->aauth->ban_user($id);

            $this->db->delete("cms_aauth_perm_to_user", array("user_id" => $id));
            $this->db->delete("cms_aauth_user_to_group", array("user_id" => $id));

            $message = "Kullanıcı Durumu Pasifleştirildi";
        } else if ($status == 1) {
            $update_status = $this->aauth->unban_user($id);
            $message = "Kullanıcı Durumu Aktifleştirildi";
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

    public function login_attempts_reset()
    {
        $this->is_allowed("kullanicilar");

        $id = $this->input->post('id');

        $update_login_attempts = $this->aauth->reset_login_attempts($id);

        if ($update_login_attempts) {
            $this->data = [
                'result' => true,
                'message' => 'Hatalı giriş denemeleri sıfırlandı',
            ];
        } else {
            $this->data = [
                'result' => false,
                'message' => "Bir hata oluştu. Kullanıcı durumu güncellenemedi"
            ];
        }

        return $this->response($this->data);
    }

}


