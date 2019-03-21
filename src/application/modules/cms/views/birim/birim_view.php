<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <th>ID</th>
        <td><?= $birim->birim_id ?></td>
    </tr>
    <tr>
        <th>Adı</th>
        <td><?= $birim->birim_adi ?></td>
    </tr>
    <tr>
        <th>Durum</th>
        <td><?= $birim->birim_durum==1?"Aktif":"Pasif" ?></td>
    </tr>
    </tbody>
</table>



