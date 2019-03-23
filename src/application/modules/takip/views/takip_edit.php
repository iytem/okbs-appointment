<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/datepicker/locales/bootstrap-datepicker.tr.min.js") ?>"></script>
<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css") ?>">

<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>


<?= form_open(base_url('takip/edit_save/' . $takip->takip_id), [
    'name' => 'form_takip',
    'class' => 'form-horizontal',
    'id' => 'form_takip',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>


<div class="form-group ">
    <label for="email" class="col-sm-6">Ad Soyad <i class="required">*</i></label>
    <label for="email" class="col-sm-6">TC/Sicil No <i class="required">*</i></label>

</div>
<div class="form-group ">
    <div class="col-sm-6">
        <input type="text" class="form-control" name="takip_ad_soyad" id="takip_ad_soyad" placeholder="Ad Soyad"
               value="<?= set_value('takip_ad_soyad', $takip->takip_ad_soyad); ?>">
    </div>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="takip_sicil_tc" id="takip_sicil_tc" placeholder="TC/Sicil No"
               value="<?= set_value('takip_sicil_tc', $takip->takip_sicil_tc); ?>">
    </div>

</div>


<div class="form-group ">
    <label for="full_name" class="col-sm-6">İletişim Bilgileri <i
                class="required">*</i></label>

    <div class="col-sm-12">
        <input type="text" class="form-control" name="takip_iletisim_bilgileri" id="takip_iletisim_bilgileri"
               placeholder="İletişim Bilgileri"
               value="<?= set_value('takip_iletisim_bilgileri', $takip->takip_iletisim_bilgileri); ?>">
    </div>
</div>

<div class="form-group ">
    <label for="full_name" class="col-sm-3">Konu <i
                class="required">*</i></label>

    <div class="col-sm-12">
        <input type="text" class="form-control" name="takip_konu" id="takip_konu" placeholder="Konu"
               value="<?= set_value('takip_konu', $takip->takip_konu); ?>">
    </div>
</div>

<div class="form-group ">
    <label for="full_name" class="col-sm-3">Geldiği Yer <i
                class="required">*</i></label>
    <label for="email" class="col-sm-6">Geliş Tarihi </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="takibin_geldigi_yer" id="takibin_geldigi_yer"
               placeholder="Geldiği Yer"
               value="<?= set_value('takibin_geldigi_yer', $takip->takibin_geldigi_yer); ?>">
    </div>
    <div class="col-sm-6">
        <input type="text" class="form-control dateInput" name="takip_gelis_tarihi" id="takip_gelis_tarihi"
               placeholder="Geliş Tarihi"
               value="<?= set_value('takip_gelis_tarihi', $takip->takip_gelis_tarihi); ?>">
    </div>
</div>


<?php if ($this->aauth->is_admin()): ?>
    <div class="form-group ">
        <label for="content" class="col-sm-12">Takip Birimi</label>
        <div class="col-sm-12">
            <select class="form-control chosen " name="takip_birim" id="takip_birim"
                    tabi-ndex="5" data-placeholder="Seçiniz">
                <option value=""></option>
                <?php foreach (db_get_all_data('okbs_birim', ['birim_durum' => 1]) as $row): ?>
                    <option value="<?= $row->birim_id; ?>" <?= $row->birim_id == $takip->takip_birim ? "selected" : "" ?>><?= ucwords($row->birim_adi); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
<?php else: ?>
    <input type="hidden" class="form-control" name="takip_birim" id="takip_birim" placeholder="Birim"
           value="<?= set_value('takip_birim', $takip->takip_birim); ?>">
<?php endif; ?>

<div class="form-group ">
    <label for="definition" class="col-sm-3">Notlar <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="takip_sonuc_notu" id="takip_sonuc_notu" cols="30" rows="3"
                  class="form-control"><?= $takip->takip_sonuc_notu ?></textarea>

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



