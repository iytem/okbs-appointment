<style>

    .table-goruntu th {
        color: #000000;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
    }

    .table-goruntu td {
        font-size: 14px;
        text-align: center;
    }


</style>
<table class="" style="width: 100%;font-size: 10px;">

    <tr>

        <td class="baslik" colspan="9"
            style="text-align: center;font-weight: bold;font-size: 18px;"> <?= date_convert_label($randevu_tarih, " ") ?> RANDEVU LİSTESİ
        </td>

    </tr>

</table>

<br><br>
<table cellspacing="0.5" cellpadding="6" border="0.5" class="table table-bordered table-striped table-goruntu">


    <thead>
    <tr>
        <th style="background-color: rgb(170,152,194)">İsim-Soyisim</th>
        <th style="background-color: rgb(170,152,194)">Çalıştığı Birim Yeri</th>
        <th style="background-color: rgb(170,152,194)">Randevu Tarihi</th>
        <th style="background-color: rgb(170,152,194)">Randevu Saati</th>
        <th style="background-color: rgb(170,152,194)">Görüşme Notları</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($randevu_lists as $randevu_list) {
        if ($i % 2 == 0) {
            $style = 'style="background-color: rgb(223,216,232)!important;"';
        }else{
            $style ="";
        }

        ?>

        <tr>
            <td <?= $style ?>><?= $randevu_list->randevu_ad_soyad ?> </td>
            <td <?= $style ?>><?= $randevu_list->randevu_calistigi_yer ?> </td>
            <td <?= $style ?>><?= dateConvert($randevu_list->randevu_tarih) ?> </td>
            <td <?= $style ?>><?= $randevu_list->randevu_saat ?> </td>
            <td <?= $style ?>></td>

        </tr>
        <?php $i++;
    } ?>
    </tbody>
</table>
