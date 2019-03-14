<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/datepicker/locales/bootstrap-datepicker.tr.min.js") ?>"></script>
<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css") ?>">

<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>
<?= form_open(base_url('telefon/add_save/'), [
    'name' => 'form_telefon',
    'class' => 'form-horizontal',
    'id' => 'form_telefon',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>

<div class="form-group ">
    <label for="name" class="col-sm-6 col-xs-6">Ad ve Soyad <i class="required">*</i></label>
    <label for="name" class="col-sm-6  col-xs-6">Çalıştığı Kurum <i class="required">*</i></label>

</div>

<div class="form-group ">
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control" name="telefon_ad_soyad" id="telefon_ad_soyad" placeholder="Ad ve Soyad"
               value="<?= set_value('telefon_ad_soyad'); ?>">
    </div>
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control" name="telefon_calistigi_yer" id="telefon_calistigi_yer"
               placeholder="Çalıştığı Kurum"
               value="<?= set_value('telefon_calistigi_yer'); ?>">
    </div>
</div>
<div class="form-group ">
    <label for="name" class="col-sm-6">Arama Sebebi <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="telefon_sebep" id="telefon_sebep" placeholder="Arama Sebebi"
               value="<?= set_value('telefon_sebep'); ?>">
    </div>
</div>

<div class="form-group ">
    <label for="name" class="col-sm-6">Telefon No <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="telefon_no" id="telefon_no" placeholder="Telefon No"
               value="<?= set_value('telefon_no'); ?>">
    </div>
</div>

<div class="form-group ">
    <label for="name" class="col-sm-6 col-xs-6">Tarih <i class="required">*</i></label>
    <label for="name" class="col-sm-6 col-xs-6">Saat <i class="required">*</i></label>

</div>

<div class="form-group ">
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control dateInput" name="telefon_tarih" id="telefon_tarih" placeholder="Tarih"
               value="<?= set_value('telefon_tarih'); ?>">
    </div>
    <div class="col-sm-6 col-xs-6">
        <input type="text" class="form-control time" name="telefon_saat" id="telefon_saat" placeholder="Saat"
               value="<?= set_value('telefon_saat'); ?>">
    </div>
</div>
<div class="form-group ">
    <label for="content" class="col-sm-3">Durum <i class="required">*</i></label>

    <div class="col-sm-12">
        <select class="form-control chosen" name="telefon_durum" id="telefon_durum"
                placeholder="Seçiniz">
            <option value=""></option>
            <option value="1">Görüşme Yapıldı</option>
            <option value="2">Geri Dönüş Bekliyor</option>
        </select>
    </div>
</div>
<?php if ($this->aauth->is_admin()): ?>
    <div class="form-group ">
        <label for="content" class="col-sm-12">Telefon Birimi</label>
        <div class="col-sm-12">
            <select class="form-control chosen " name="telefon_birim" id="telefon_birim"
                    tabi-ndex="5" data-placeholder="Seçiniz">
                <option value=""></option>
                <?php foreach (db_get_all_data('okbs_birim', ['birim_durum' => 1]) as $row): ?>
                    <option value="<?= $row->birim_id; ?>"><?= ucwords($row->birim_adi); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
<?php else: ?>
    <input type="hidden" class="form-control" name="telefon_birim" id="telefon_birim" placeholder="Birim"
           value="<?= set_value('telefon_birim', $this->aauth->get_user()->user_birim); ?>">
<?php endif; ?>
<div class="form-group ">
    <label for="definition" class="col-sm-3">Notlar <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="telefon_notlar" id="telefon_notlar" cols="30" rows="5" class="form-control"></textarea>

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

