<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_telefon extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'okbs_telefon';
        $this->primary_key = 'telefon_id';
        $this->column_order = array(null, '','telefon_ad_soyad', 'telefon_calistigi_yer', 'telefon_sebep', 'telefon_no', 'telefon_tarih', 'telefon_saat', 'telefon_notlar', 'telefon_durum');
        $this->column_search = array('telefon_ad_soyad', 'telefon_calistigi_yer', 'telefon_sebep', 'telefon_no', 'telefon_tarih', 'telefon_saat', 'telefon_notlar', 'telefon_durum');
        $this->order = array('telefon_id' => 'desc');

    }


}
