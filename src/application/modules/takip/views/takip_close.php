<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/datepicker/locales/bootstrap-datepicker.tr.min.js") ?>"></script>


<?= form_open(base_url('takip/add_close_save/' . $takip->takip_id), [
    'name' => 'form_takip',
    'class' => 'form-horizontal',
    'id' => 'form_takip',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>

<div class="form-group ">
    <label for="email" class="col-sm-6">Kapanış Tarihi <i class="required">*</i></label>

    <div class="col-sm-12">
        <input type="text" class="form-control dateInput" name="takip_sonuc_tarihi" id="takip_sonuc_tarihi" placeholder="Kapanış Tarihi"
               value="<?= set_value('takip_sonuc_tarihi'); ?>">
    </div>
</div>

<div class="form-group ">
    <label for="definition" class="col-sm-3">Notlar <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="takip_sonuc_notu" id="takip_sonuc_notu" cols="30" rows="5" class="form-control"><?= $takip->takip_sonuc_notu;?></textarea>

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



