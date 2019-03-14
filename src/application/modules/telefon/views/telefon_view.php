<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <th width="200">ID</th>
        <td><?= $telefon->telefon_id ?></td>
    </tr>
    <tr>
        <th>Ad ve Soyad</th>
        <td><?= $telefon->telefon_ad_soyad ?></td>
    </tr>
    <tr>
        <th>Çalıştığı Yer</th>
        <td><?= $telefon->telefon_calistigi_yer ?></td>
    </tr>
    <tr>
        <th>Sebep</th>
        <td><?= $telefon->telefon_sebep ?></td>
    </tr>
    <tr>
        <th>Telefon No</th>
        <td><?= $telefon->telefon_no ?></td>
    </tr>
    <tr>
        <th>Tarih/Saat</th>
        <td><?= dateConvert($telefon->telefon_tarih,"-")."/" .$telefon->telefon_saat ?></td>
    </tr>
    <tr>
        <th>Notlar</th>
        <td><?= $telefon->telefon_notlar ?></td>
    </tr>



    </tbody>
</table>