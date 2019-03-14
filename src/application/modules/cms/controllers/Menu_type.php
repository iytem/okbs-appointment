<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Menu_type extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_menu_type');
        $this->is_allowed('menu');
    }

    public function add()
    {

        $this->template->write('title', 'Yeni Navigation Tipi', TRUE);
        $this->template->add_css("assets/cms/default/plugins/sweet-alert/sweetalert.css");

        $this->template->add_js("assets/cms/default/plugins/sweet-alert/sweetalert.min.js");
        $this->template->write_view('content', 'menu_type/menu_type_add', $this->data, TRUE);
        $this->template->render();


    }

    public function add_save()
    {

        $this->form_validation->set_rules('name', 'Adı', 'trim|required|is_unique[cms_menu_type.name]|alpha_numeric_spaces');
        $this->form_validation->set_rules('definition', 'Açıklama', 'trim|required');

        $this->form_validation->set_message('required', '%s alanı zorunludur');
        $this->form_validation->set_message('is_unique', 'Bu menü tipi daha önce kullanılmıştır.');
        $this->form_validation->set_message('alpha_numeric_spaces', 'Lütfen türkçe karakter kullanmayınız.');

        if ($this->form_validation->run()) {

            $save_data = [
                'name' => $this->input->post('name'),
                'definition' => $this->input->post('definition'),
            ];

            $save_menu_type = $this->model_menu_type->add($save_data);

            if ($save_menu_type) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data = array(
                        'result' => true,
                        'message' => "Menü Tipi başarıyla kaydedildi",
                    );
                } else {
                    flash_message("Menü Tipi başarıyla kaydedildi", 'success');
                    $this->data = array(
                        'result' => true,
                        'redirect' => base_url("cms/menu")
                    );
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data = array(
                        'result' => false,
                        'message' => "Bir hata oluştu. Menü Tipi Kaydedilemedi.",
                    );
                } else {
                    flash_message("Bir hata oluştu. Menü Tipi Kaydedilemedi.", 'error');
                    $this->data = array(
                        'result' => false,
                        'redirect' => base_url("cms/menu")
                    );
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

    public function delete($id)
    {

        $remove = $this->model_menu_type->delete($id);
        $this->db->delete('cms_menu', ['menu_type_id' => $id]);

        if ($remove) {
            flash_message("Menü Tipi Silindi.", 'success');
        } else {
            flash_message("Bir hata oluştu. Menü Tipi Silinemedi.", 'error');
        }

        redirect_back();
    }
}

