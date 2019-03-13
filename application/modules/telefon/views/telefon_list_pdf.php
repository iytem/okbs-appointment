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
            style="text-align: center;font-weight: bold;font-size: 18px;"> <?= date_convert_label($telefon_tarih, " ") ?> TELEFON LİSTESİ
        </td>

    </tr>

</table>

<br><br>
<table cellspacing="0.5" cellpadding="6" border="0.5" class="table table-bordered table-striped table-goruntu">


    <thead>
    <tr>
        <th style="background-color: rgb(255,127,48)">Tarih Saat</th>
        <th style="background-color: rgb(255,127,48)">Adı Soyadı</th>
        <th style="background-color: rgb(255,127,48)">Referans</th>
        <th style="background-color: rgb(255,127,48)">Talebi</th>
        <th style="background-color: rgb(255,127,48)">İrtibat Bilgileri</th>
        <th style="background-color: rgb(255,127,48)">Görüşme Notları</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $i = 0;
    foreach ($telefon_lists as $telefon_list) {
        if ($i % 2 == 0) {
            $style = 'style="background-color: rgb(255, 208, 179)!important;"';
        }else{
            $style ="";
        }

        ?>

        <tr>
            <td <?= $style ?>><?= dateConvert($telefon_list->telefon_tarih) . "<br>" . $telefon_list->telefon_saat ?> </td>
            <td <?= $style ?>><?= $telefon_list->telefon_ad_soyad ?> </td>
            <td <?= $style ?>><?= $telefon_list->telefon_calistigi_yer ?> </td>
            <td <?= $style ?>><?= $telefon_list->telefon_sebep ?> </td>
            <td <?= $style ?>><?= $telefon_list->telefon_no ?> </td>
            <td <?= $style ?>><?= $telefon_list->telefon_notlar ?> </td>

        </tr>
        <?php $i++;
    } ?>
    </tbody>
</table>
