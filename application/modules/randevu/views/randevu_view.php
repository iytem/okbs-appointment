<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <th width="200">ID</th>
        <td><?= $randevu->randevu_id ?></td>
    </tr>
    <tr>
        <th>Ad ve Soyad</th>
        <td><?= $randevu->randevu_ad_soyad ?></td>
    </tr>
    <tr>
        <th>Çalıştığı Yer</th>
        <td><?= $randevu->randevu_calistigi_yer ?></td>
    </tr>
    <tr>
        <th>Telefon No</th>
        <td><?= $randevu->randevu_telefon_no ?></td>
    </tr>
    <tr>
        <th>Randevu Sebebi</th>
        <td><?= $randevu->randevu_sebep ?></td>
    </tr>

    <tr>
        <th>Tarih/Saat</th>
        <td><?= dateConvert($randevu->randevu_tarih,"-")."/" .$randevu->randevu_saat ?></td>
    </tr>
    <tr>
        <th>Görüşme Notlar</th>
        <td><?= $randevu->randevu_notlar ?></td>
    </tr>



    </tbody>
</table>



