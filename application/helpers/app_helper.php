<?php
function get_randevu_durum($durum){
    if($durum == 1)
        return "Henüz Gerçekleşmedi";
    else if($durum == 2)
        return "Randevu Gerçekleştirildi";
}

function get_telefon_durum($durum){
    if($durum == 1)
        return "Görüşme Yapıldı";
    else if($durum == 2)
        return "Geri Dönüş Bekliyor";
    else if($durum == 3)
        return "Geri Dönüş Yapıldı";
    else if($durum == 4)
        return "Geri Dönüş Yapılmadı";

}



function get_program_durum($status){
    if($status == 1)
        return "Aktif";
    else if($status == 0)
        return "Pasif";
}

function date_convert_label($tarih, $isaret="-")
{
    if ($tarih == null) {
        return "---";
    } else {
        list($gun, $ay, $yil) = explode("-", $tarih);
        if($ay == 1)
            $ay_label = "Ocak";
        elseif($ay == 2)
            $ay_label = "Şubat";
        elseif($ay == 3)
            $ay_label = "Mart";
        elseif($ay == 4)
            $ay_label = "Nisan";
        elseif($ay == 5)
            $ay_label = "Mayıs";
        elseif($ay == 6)
            $ay_label = "Haziran";
        elseif($ay == 7)
            $ay_label = "Temmuz";
        elseif($ay == 8)
            $ay_label = "Ağustos";
        elseif($ay == 9)
            $ay_label = "Eylül";
        elseif($ay == 10)
            $ay_label = "Ekim";
        elseif($ay == 11)
            $ay_label = "Kasım";
        elseif($ay == 12)
            $ay_label = "Aralık";

        $yeniTarih = $yil . $isaret . mb_strtoupper($ay_label) . $isaret . $gun;

        return $yeniTarih;
    }
}