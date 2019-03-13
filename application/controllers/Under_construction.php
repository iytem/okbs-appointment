<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Under_construction extends Under_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("under_construction");
    }

    public function error_403()
    {
        $this->load->view("error_403");
    }


}