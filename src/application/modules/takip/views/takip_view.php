<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <th width="200">ID</th>
        <td><?= $takip->takip_id ?></td>
    </tr>
    <tr>
        <th>Ad ve Soyad</th>
        <td><?= $takip->takip_ad_soyad ?></td>
    </tr>
    <tr>
        <th>Tc/Sicil No</th>
        <td><?= $takip->takip_sicil_tc ?></td>
    </tr>
    <tr>
        <th>İletişim Bilgileri</th>
        <td><?= $takip->takip_iletisim_bilgileri ?></td>
    </tr>
    <tr>
        <th>Konu</th>
        <td><?= $takip->takip_konu ?></td>
    </tr>
    <tr>
        <th>Takibin Geldiği Yer</th>
        <td><?= $takip->takibin_geldigi_yer ?></td>
    </tr>

    <tr>
        <th>Takip Sorumlusu</th>
        <td><?= get_user_field($takip->takip_sorumlu, "full_name") ?></td>
    </tr>

    <tr>
        <th>Geliş Tarihi</th>
        <td><?= dateConvert($takip->takip_gelis_tarihi) ?></td>
    </tr>
    <tr>
        <th>Sonuçlanma Tarihi</th>
        <td><?= dateConvert($takip->takip_sonuc_tarihi) ?></td>
    </tr>

    <tr>
        <th>Notlar</th>
        <td><?= $takip->takip_sonuc_notu ?></td>
    </tr>

    <tr>
        <th>Durum</th>
        <td><?= $takip->takip_durum == 1 ? "İncelemede" : "Sonuçlandı" ?></td>
    </tr>


    </tbody>
</table>



