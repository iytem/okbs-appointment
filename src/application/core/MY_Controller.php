<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{

    protected $data = array();

    public function __construct()
    {


        parent::__construct();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        date_default_timezone_set('Europe/Istanbul');

        /*if (!$this->agent->is_browser('Chrome')){
            echo 'Lütfen Google Chrome Kullanınız';
            die();
        }*/


    }

    public function response($data, $status = 200)
    {
        die(json_encode($data));

        $this->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($data));
    }

    public function is_allowed($perm, $redirect = true)
    {
        if (!$this->aauth->is_loggedin()) {
            if ($redirect) {
                redirect('/', 'refresh');
            } else {
                return false;
            }
        } else {
            if ($this->aauth->is_allowed($perm)) {
                return true;
            } else {
                if ($redirect) {

                    redirect(base_url("errors/error_403"));

                }
                return false;
            }
        }
    }

}

class APP_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->config->item('under_construction') == TRUE) {

            if ($this->aauth->is_admin()) {
                return true;
            } else {
                $this->aauth->logout();
                redirect(base_url("under_construction"));
            }
        }

        if ($this->aauth->is_loggedin()) {
            return true;
        } else {
            redirect('/', 'refresh');
        }



        $this->template->set_template(get_option("cms_theme"));
    }
}

class Web_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->config->item('under_construction') == TRUE) {

            if ($this->aauth->is_admin()) {
                return true;
            } else {
                $this->aauth->logout();
                redirect(base_url("under_construction"));
            }
        }
        $this->template->set_template(get_option("frontend_theme"));
    }
}

class Auth_Controller extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->template->set_template(get_option("cms_theme"));
    }
}

class Under_Controller extends MY_Controller
{


    public function __construct()
    {
        if ($this->config->item('under_construction') == FALSE) {

            $this->aauth->logout();
            redirect(base_url());

        }
        parent::__construct();
    }
}



