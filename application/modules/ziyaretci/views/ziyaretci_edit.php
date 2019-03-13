<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/datepicker/locales/bootstrap-datepicker.tr.min.js") ?>"></script>
<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css") ?>">

<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>


<?= form_open(base_url('ziyaretci/edit_save/' . $ziyaretci->ziyaretci_id), [
    'name' => 'form_ziyaretci',
    'class' => 'form-horizontal',
    'id' => 'form_ziyaretci',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>


<div class="form-group ">
    <label for="name" class="col-sm-12">Ad ve Soyad <i class="required">*</i></label>
</div>

<div class="form-group ">
    <div class="col-sm-12">
        <input type="text" class="form-control" name="ziyaretci_ad_soyad" id="ziyaretci_ad_soyad" placeholder="Ad ve Soyad"
               value="<?= set_value('ziyaretci_ad_soyad',$ziyaretci->ziyaretci_ad_soyad); ?>">
    </div>
</div>


<div class="form-group ">
    <label for="name" class="col-sm-6 col-xs-6">Telefon Numarası <i class="required">*</i></label>
    <label for="name" class="col-sm-6 col-xs-6">Ziyaretçinin Geldiği Yer <i class="required">*</i></label>

</div>

<div class="form-group ">
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control" name="ziyaretci_tel_no" id="ziyaretci_tel_no" placeholder="Telefon Numarası"
               value="<?= set_value('ziyaretci_tel_no',$ziyaretci->ziyaretci_tel_no); ?>">
    </div>
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control" name="ziyaretci_geldigi_yer" id="ziyaretci_geldigi_yer" placeholder="Geldiği Yer"
               value="<?= set_value('ziyaretci_geldigi_yer',$ziyaretci->ziyaretci_geldigi_yer); ?>">
    </div>
</div>

<div class="form-group ">
    <label for="name" class="col-sm-6">Referans</label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="ziyaretci_referans" id="ziyaretci_referans" placeholder="Referans"
               value="<?= set_value('ziyaretci_referans',$ziyaretci->ziyaretci_referans); ?>">
    </div>
</div>


<div class="form-group ">
    <label for="name" class="col-sm-6 col-xs-6">Tarih <i class="required">*</i></label>
    <label for="name" class="col-sm-6 col-xs-6">Saat <i class="required">*</i></label>

</div>

<div class="form-group ">
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control dateInput" name="ziyaretci_tarih" id="ziyaretci_tarih" placeholder="Tarih"
               value="<?= set_value('ziyaretci_tarih',$ziyaretci->ziyaretci_tarih); ?>">
    </div>
    <div class="col-sm-6  col-xs-6">
        <input type="text" class="form-control time" name="ziyaretci_saat" id="ziyaretci_saat" placeholder="Saat"
               value="<?= set_value('ziyaretci_saat',$ziyaretci->ziyaretci_saat); ?>">
    </div>
</div>

<?php if ($this->aauth->is_admin()): ?>
    <div class="form-group ">
        <label for="content" class="col-sm-12">Ziyaretçi Birimi</label>
        <div class="col-sm-12">
            <select class="form-control chosen " name="ziyaretci_birim" id="ziyaretci_birim"
                    tabi-ndex="5" data-placeholder="Seçiniz">
                <option value=""></option>
                <?php foreach (db_get_all_data('okbs_birim', ['birim_durum' => 1]) as $row): ?>
                    <option value="<?= $row->birim_id; ?>" <?= $ziyaretci->ziyaretci_birim==$row->birim_id?"selected":""?>><?= ucwords($row->birim_adi); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
<?php else: ?>
    <input type="hidden" class="form-control" name="ziyaretci_birim" id="ziyaretci_birim" placeholder="Birim"
           value="<?= set_value('ziyaretci_birim', $ziyaretci->ziyaretci_birim); ?>">
<?php endif; ?>




<div class="form-group ">
    <label for="definition" class="col-sm-3">Notlar <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="ziyaretci_not" id="ziyaretci_not" cols="30" rows="5" class="form-control"><?= $ziyaretci->ziyaretci_not?></textarea>

    </div>
</div>
<?= form_close(); ?>

<div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>

<script>
    $(document).ready(function () {
        $('.loading').hide();
    });

    $('.dateInput').datepicker({
        format: "yyyy-mm-dd",
        language: "tr",
        todayHighlight: true,

    });

    $(".chosen").chosen({
        width: "100%"
    });
</script>



