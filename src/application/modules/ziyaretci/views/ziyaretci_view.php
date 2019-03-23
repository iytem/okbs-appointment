<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <th width="200">ID</th>
        <td><?= $ziyaretci->ziyaretci_id ?></td>
    </tr>
    <tr>
        <th>Ad ve Soyad</th>
        <td><?= $ziyaretci->ziyaretci_ad_soyad ?></td>
    </tr>

    <tr>
        <th>Telefon No</th>
        <td><?= $ziyaretci->ziyaretci_tel_no ?></td>
    </tr>
    <tr>
        <th>Geldiği Yer</th>
        <td><?= $ziyaretci->ziyaretci_geldigi_yer ?></td>
    </tr>
    <tr>
        <th>Referans</th>
        <td><?= $ziyaretci->ziyaretci_referans ?></td>
    </tr>
    <tr>
        <th>Tarih/Saat</th>
        <td><?= dateConvert($ziyaretci->ziyaretci_tarih,"-")."/" .$ziyaretci->ziyaretci_saat ?></td>
    </tr>
    <tr>
        <th>Notlar</th>
        <td><?= $ziyaretci->ziyaretci_not ?></td>
    </tr>



    </tbody>
</table>



