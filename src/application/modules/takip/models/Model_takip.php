<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_takip extends MY_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->table_name = 'okbs_takip';
        $this->primary_key = 'takip_id';
        $this->column_order = array(null, null,'takip_ad_soyad', 'takip_sicil_tc', 'takip_iletisim_bilgileri', 'takip_konu', 'takibin_geldigi_yer', 'takibi_baslatan_kullanici', 'takip_sorumlu', 'takip_unite', 'takip_gelis_tarihi', 'takip_sonuc_tarihi', 'takip_sonuc_notu','takip_durum');
        $this->column_search = array('takip_ad_soyad', 'takip_sicil_tc', 'takip_iletisim_bilgileri', 'takip_konu', 'takibin_geldigi_yer', 'takibi_baslatan_kullanici', 'takip_sorumlu', 'takip_unite', 'takip_gelis_tarihi', 'takip_sonuc_notu', 'takip_sonuc_tarihi', 'takip_gizli', 'takip_durum');
        $this->order = array('takip_id' => 'desc');

    }

    public function join_statement()
    {
        $this->db->join("okbs_birim", "okbs_birim.birim_id=okbs_takip.takip_birim", "LEFT");
    }


}
