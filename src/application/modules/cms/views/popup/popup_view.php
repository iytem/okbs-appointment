<style>
   .table_view iframe{
        width: auto;
    }
</style>
<table class="table table-bordered table-striped table_view">
    <tbody>
    <tr>
        <th>ID</th>
        <td><?= $popup->popup_id ?></td>
    </tr>
    <tr>
        <th>Başlık</th>
        <td><?= $popup->title ?></td>
    </tr>
    <tr>
        <th>İçerik</th>
        <td><?= $popup->description ?></td>
    </tr>
    <tr>
        <th>Sayfa URL</th>
        <td><?= $popup->page_url ?></td>
    </tr>
    <tr>
        <th>Durum</th>
        <td><?= $popup->status == 1?"Aktif":"Pasif" ?></td>
    </tr>
    </tbody>
</table>



