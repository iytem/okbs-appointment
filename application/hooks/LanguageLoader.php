<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('cms',$siteLang);
            $ci->lang->load('aauth',$siteLang);
            $ci->lang->load('web',$siteLang);
        } else {
            $ci->lang->load('cms','tr');
            $ci->lang->load('aauth','tr');
            $ci->lang->load('web',$siteLang);
        }
    }
}