<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/datepicker/locales/bootstrap-datepicker.tr.min.js") ?>"></script>
<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css") ?>">

<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>

<?= form_open(base_url('randevu/add_save/'), [
    'name' => 'form_randevu',
    'class' => 'form-horizontal',
    'id' => 'form_randevu',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>
<div class="form-group ">
    <label for="name" class="col-sm-6 col-xs-6">Ad ve Soyad <i class="required">*</i></label>
    <label for="name" class="col-sm-6 col-xs-6">Çalıştığı Yer <i class="required">*</i></label>

</div>

<div class="form-group ">
    <div class="col-sm-6  col-xs-6">
        <input type="text" class="form-control" name="randevu_ad_soyad" id="randevu_ad_soyad" placeholder="Ad ve Soyad"
               value="<?= set_value('randevu_ad_soyad'); ?>">
    </div>
    <div class="col-sm-6  col-xs-6">
        <input type="text" class="form-control" name="randevu_calistigi_yer" id="randevu_calistigi_yer" placeholder="Çalıştığı Yer"
               value="<?= set_value('randevu_calistigi_yer'); ?>">
    </div>


</div>


<div class="form-group ">
    <label for="name" class="col-sm-6">Telefon Numarası <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="randevu_telefon_no" id="randevu_telefon_no" placeholder="Telefon Numarası"
               value="<?= set_value('randevu_telefon_no'); ?>">
    </div>

</div>



<div class="form-group ">
    <label for="name" class="col-sm-6">Randevu Sebebi <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="randevu_sebep" id="randevu_sebep" placeholder="Randevu Sebebi"
               value="<?= set_value('randevu_sebep'); ?>">
    </div>
</div>


<div class="form-group ">
    <label for="name" class="col-sm-6 col-xs-6">Randevu Talep Tarihi<i class="required">*</i></label>
    <label for="name" class="col-sm-6 col-xs-6">Randevu Talep Saati </label>

</div>

<div class="form-group ">
    <div class="col-sm-6  col-xs-6">
        <input type="text" class="form-control dateInput" name="randevu_tarih" id="randevu_tarih" placeholder="Tarih"
               value="<?= set_value('randevu_tarih'); ?>">
    </div>
    <div class="col-sm-6  col-xs-6">
        <input type="text" class="form-control time" name="randevu_saat" id="randevu_saat" placeholder="Saat"
               value="<?= set_value('randevu_saat'); ?>">
    </div>
</div>

<?php if ($this->aauth->is_admin()): ?>
    <div class="form-group ">
        <label for="content" class="col-sm-12">Randevu Birimi</label>
        <div class="col-sm-12">
            <select class="form-control chosen " name="randevu_birim" id="randevu_birim"
                    tabi-ndex="5" data-placeholder="Seçiniz">
                <option value=""></option>
                <?php foreach (db_get_all_data('okbs_birim', ['birim_durum' => 1]) as $row): ?>
                    <option value="<?= $row->birim_id; ?>"><?= ucwords($row->birim_adi); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
<?php else: ?>
    <input type="hidden" class="form-control" name="randevu_birim" id="randevu_birim" placeholder="Birim"
           value="<?= set_value('randevu_birim', $this->aauth->get_user()->user_birim); ?>">
<?php endif; ?>

<div class="form-group ">
    <label for="definition" class="col-sm-3">Notlar <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="randevu_notlar" id="randevu_notlar" cols="30" rows="5" class="form-control"></textarea>

    </div>
</div>
<?= form_close(); ?>



<div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>

<script>
    $(document).ready(function () {
        $('.loading').hide();
    });

    $(".chosen").chosen({
        width: "100%"
    });
    $('.dateInput').datepicker({
        format: "yyyy-mm-dd",
        language: "tr",
        todayHighlight: true,

    });

</script>

