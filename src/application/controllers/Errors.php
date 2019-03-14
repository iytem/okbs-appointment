<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function error_403()
    {
        $this->load->view("errors/html/error_403");
    }


}