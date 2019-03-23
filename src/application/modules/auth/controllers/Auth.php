<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends Auth_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        if ($this->aauth->is_loggedin()) {
            redirect('home','refresh');

        }

        $this->form_validation->set_rules('username', 'Kullanıcı Adı', 'trim|required');
        $this->form_validation->set_rules('password', 'Parola', 'trim|required');

        $this->form_validation->set_message("required","%s alanı zorunludur");

        if ($this->form_validation->run()) {
            if ($this->aauth->login($this->input->post('username'), $this->input->post('password'))) {

                user_activity("cms_aauth_users","Login",$this->aauth->get_user()->id);

                flash_message("Uygulamaya Hoşgeldiniz","success");
                redirect('home', 'refresh');
            } else {
                $this->data['error'] = $this->aauth->print_errors(TRUE);
            }
        } else {
            $this->data['error'] = validation_errors();
        }

        $this->data["titles"] = "Giriş";
        $this->load->view('auth/auth/login', $this->data);

    }


    public function logout()
    {
        user_activity("cms_aauth_users","Logout",$this->aauth->get_user()->id);
        $this->aauth->logout();
        redirect('/');
    }
}