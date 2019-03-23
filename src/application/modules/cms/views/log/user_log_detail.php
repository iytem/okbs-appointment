<table class="table table-bordered table-striped">
    <tbody>
    <tr>
        <th>ID</th>
        <td><?= $log->activity_id ?></td>
    </tr>
    <tr>
        <th>Tarih Saat</th>
        <td><?= dateTimeConvertDate($log->time) ?></td>
    </tr>
    <tr>
        <th>Kullanıcı Adı</th>
        <td><?= $log->full_name ?></td>
    </tr>
    <tr>
        <th>Database Tablo Adı</th>
        <td><?= $log->table_name ?></td>
    </tr>
    <tr>
        <th>İşlem</th>
        <td><?= $log->action ?></td>
    </tr>
    <tr>
        <th>Eklenen-Silinen-Görüntülenen Data/ID</th>
        <td><?= $log->data_where ?></td>
    </tr>
    <tr>
        <th>İp Adres</th>
        <td><?= $log->ip_addres ?></td>
    </tr>

    </tbody>
</table>



