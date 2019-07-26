<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_randevu extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'okbs_randevu';
        $this->primary_key = 'randevu_id';
        $this->column_order = array(null, '', 'randevu_ad_soyad', 'randevu_calistigi_yer', 'randevu_sebep', 'randevu_telefon_no', 'randevu_tarih', 'randevu_saat', 'randevu_birim','randevu_notlar', 'randevu_durum');
        $this->column_search = array('randevu_ad_soyad', 'randevu_calistigi_yer', 'randevu_sebep', 'randevu_telefon_no', 'randevu_tarih', 'randevu_saat',  'randevu_birim', 'randevu_notlar', 'randevu_durum');
        $this->order = array('randevu_tarih' => 'asc','randevu_saat' => 'desc');

    }



}
