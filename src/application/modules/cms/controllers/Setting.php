<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_setting');
        $this->is_allowed("ayarlar");
    }

    public function index()
    {

        $this->data = [
            'times' => [
                ['label' => '15 Dakika', 'value' => '900'],
                ['label' => '30 Dakika', 'value' => '1800'],
                ['label' => '1 Saat', 'value' => '3600'],
                ['label' => '2 Saat', 'value' => '7200'],
                ['label' => '4 Saat', 'value' => '14400'],
                ['label' => '6 Saat', 'value' => '21600'],
                ['label' => '8 Saat', 'value' => '28800'],
                ['label' => '12 Saat', 'value' => '43200'],
                ['label' => '1 Gün', 'value' => '86400'],
                ['label' => '1 Hafta', 'value' => '604800'],
                ['label' => '1 Ay', 'value' => '2592000'],
                ['label' => '6 Ay', 'value' => '15552000'],
                ['label' => '1 Yıl', 'value' => '31104000'],
                ['label' => 'Herzaman', 'value' => '0']
            ],

        ];

        $this->template->write('title', 'Sistem Ayarları', TRUE);

        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");

        $this->template->add_js("assets/cms/default/plugins/jscolor/jscolor.min.js");
        $this->template->add_js("assets/cms/default/plugins/ckeditor/ckeditor.js");

        $this->template->write_view('content', 'setting/setting', $this->data, TRUE);
        $this->template->render();

    }

    public function save()
    {

        $this->load->helper('file');

        $this->form_validation->set_rules('app_name', 'Uygulama Adı', 'trim|required');
        $this->form_validation->set_rules('app_short_name', 'Uygulama Kısa Adı', 'trim|required');
        $this->form_validation->set_rules('email', 'E-Posta Adresi', 'trim|required|valid_email');
        $this->form_validation->set_rules('encryption_key', 'Şifreleme Anahtarı', 'trim|required');
        $this->form_validation->set_rules('sess_expiration', 'Oturum Süresi', 'trim|numeric');
        $this->form_validation->set_rules('sess_time_to_update', 'Oturum Güncelleme Süresi', 'trim|numeric');
        $this->form_validation->set_rules('global_xss_filtering', 'Global XSS Filtresi', 'trim|required');
        $this->form_validation->set_rules('csrf_token_name', 'CSRF Token Adı', 'trim|required');
        $this->form_validation->set_rules('csrf_cookie_name', 'CSRF Cookie Adı', 'trim|required');
        $this->form_validation->set_rules('csrf_expire', 'CSRF Süresi', 'trim|required');
        $this->form_validation->set_rules('sess_cookie_name', 'Session Cookie Adı', 'trim|required');
        $this->form_validation->set_rules('version', 'Versiyon Bilgisi', 'trim|required');
        $this->form_validation->set_rules('ft_folder_status', 'Dosya Upload İşlemi', 'trim|required');


        $this->form_validation->set_message('required', '%s alanı zorunludur.');

        if ($this->form_validation->run()) {
            set_option('app_name', $this->input->post('app_name'));
            set_option('app_short_name', $this->input->post('app_short_name'));
            set_option('email', $this->input->post('email'));
            set_option('author', $this->input->post('author'));
            set_option('version', $this->input->post('version'));
            set_option('modal_title_color', $this->input->post('modal_title_color'));
            set_option('modal_title_font_color', $this->input->post('modal_title_font_color'));
            set_option('google_analytics', $this->input->post('google_analytics'));
            set_option('meta_key', $this->input->post('meta_key'));
            set_option('meta_desc', $this->input->post('meta_desc'));
            set_option('under_note', $this->input->post('under_note'));
            set_option('ft_folder_status', $this->input->post('ft_folder_status'));



            if ($_FILES["file_logo"]["name"] != "") {
                $file_name = seo_link(pathinfo($_FILES["file_logo"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file_logo"]["name"], PATHINFO_EXTENSION);

                $delete = get_delete("app/logo", "180x180", get_option('app_logo'));

                $image_450x217 = upload_picture($_FILES["file_logo"]["tmp_name"], "storage/app/logo", 180, 180, $file_name);

                set_option('app_logo', $file_name);
            }


            if ($_FILES["file_ico"]["name"] != "") {
                $file_name = seo_link(pathinfo($_FILES["file_ico"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file_ico"]["name"], PATHINFO_EXTENSION);

                $delete = get_delete("app/ico", "16x16", get_option('app_ico'));

                $image_16x16 = upload_picture($_FILES["file_ico"]["tmp_name"], "storage/app/ico", 16, 16, $file_name);

                set_option('app_ico', $file_name);
            }


            if ($_FILES["file_login"]["name"] != "") {
                $file_name = seo_link(pathinfo($_FILES["file_login"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file_login"]["name"], PATHINFO_EXTENSION);

                $delete = get_delete("app/login", "2048x1152", get_option('app_login'));

                $image_2048x1152 = upload_picture($_FILES["file_login"]["tmp_name"], "storage/app/login", 2048, 1152, $file_name);

                set_option('app_login', $file_name);
            }


            $data = [
                'php_tag_open' => '<?php',
                'encryption_key' => addslashes($this->input->post('encryption_key')),
                'sess_expiration' => addslashes($this->input->post('sess_expiration')),
                'sess_time_to_update' => addslashes($this->input->post('sess_time_to_update')),
                'global_xss_filtering' => addslashes($this->input->post('global_xss_filtering')),
                'csrf_token_name' => addslashes($this->input->post('csrf_token_name')),
                'csrf_cookie_name' => addslashes($this->input->post('csrf_cookie_name')),
                'csrf_expire' => addslashes($this->input->post('csrf_expire')),
                'sess_cookie_name' => addslashes($this->input->post('sess_cookie_name')),
                'under_construction' => addslashes($this->input->post('under_construction')),
            ];


            $config_template = $this->parser->parse('templates/cms/_common/config_template.txt', $data, TRUE);
            write_file(FCPATH . '/application/config/config.php', $config_template);


            $this->data['result'] = true;
            $this->data['message'] = 'Ayarlar başarıyla güncellendi. ';
        } else {
            $this->data['result'] = false;
            $this->data['message'] = validation_errors();
        }

        return $this->response($this->data);
    }

    public function theme_save()
    {

        switch ($this->input->post('theme')){
            case 'skin-blue-light':
                set_option('modal_title_color', "3c8dbc");
                break;
            case 'skin-purple-light':
                set_option('modal_title_color', "605ca8");
                break;
            case 'skin-green-light':
                set_option('modal_title_color', "00a65a");
                break;
            case 'skin-red-light':
                set_option('modal_title_color', "dd4b39");
                break;
            case 'skin-yellow-light':
                set_option('modal_title_color', "f39c12");
                break;
            case 'skin-gray-light':
                set_option('modal_title_color', "3c4859");
                break;
            case 'skin-orange-light':
                set_option('modal_title_color', "D66853");
                break;
            case 'skin-purple_2-light':
                set_option('modal_title_color', "59114D");
                break;
            case 'skin-pink-light':
                set_option('modal_title_color', "D81E5B");
                break;
            case 'skin-plato-light':
                set_option('modal_title_color', "9D8189");
                break;
            case 'skin-green_2-light':
                set_option('modal_title_color', "6494AA");
                break;
            case 'skin-black-light':
                set_option('modal_title_color', "2A1F2D");
                break;
            case 'skin-green_3-light':
                set_option('modal_title_color', "4C6663");
                break;
            case 'skin-spanish_gray-light':
                set_option('modal_title_color', "998DA0");
                break;
            case 'skin-blue_sappire-light':
                set_option('modal_title_color', "005E7C");
                break;
        }

        $theme_save = set_option('theme', $this->input->post('theme'));
        if ($theme_save) {
            flash_message("Tema başarıyla uygulandı", 'success');
            $this->data = array(
                'result' => true,
                'redirect' => base_url("cms/setting"),
            );
        } else {
            flash_message("Bir hata oluştu. Tema Uygulanamadı.", 'error');
            $this->data = array(
                'result' => false,
                'redirect' => base_url("cms/setting")
            );
        }

        return $this->response($this->data);
    }

    public function generate_key()
    {

        echo generate_key();
    }

}


