<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->is_allowed("dashboard");
    }

    public function index()
    {


        if (!$this->aauth->is_loggedin()) {
            redirect('/', 'refresh');
        }

        $this->template->write('title', 'Ana Sayfa', TRUE);

        $this->template->write_view('content', 'dashboard/dashboard', '', TRUE);
        $this->template->render();
    }

}

