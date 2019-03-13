<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_ziyaretci extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'okbs_ziyaretci';
        $this->primary_key = 'ziyaretci_id';
        $this->column_order = array(null, '','ziyaretci_birim','ziyaretci_ad_soyad', 'ziyaretci_tel_no', 'ziyaretci_geldigi_yer', 'ziyaretci_referans', 'ziyaretci_tarih', 'ziyaretci_saat', 'ziyaretci_not');
        $this->column_search = array('ziyaretci_birim','ziyaretci_ad_soyad', 'ziyaretci_tel_no', 'ziyaretci_geldigi_yer', 'ziyaretci_referans', 'ziyaretci_tarih', 'ziyaretci_saat', 'ziyaretci_not');
        $this->order = array('ziyaretci_id' => 'desc');

    }


}
