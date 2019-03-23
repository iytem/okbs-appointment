<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/datepicker/css/bootstrap-datepicker.min.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/datepicker/js/bootstrap-datepicker.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/datepicker/locales/bootstrap-datepicker.tr.min.js") ?>"></script>

<?= form_open(base_url('randevu/randevu_list_print'), [
    'name' => 'form_randevu',
    'class' => 'form-horizontal',
    'id' => 'form_randevu',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>
<small style="color: tomato">Tüm Liste İçin Tarihi Boş Geçiniz</small>
<table class="table-striped"></table>
<div class="form-group ">
    <label for="name" class="col-sm-6">Randevu Tarihi <i class="required">*</i></label>
</div>

<div class="form-group ">
    <div class="col-sm-12">
        <input type="text" class="form-control dateInput" name="randevu_tarih" id="randevu_tarih" placeholder="Tarih"
               value="<?= set_value('randevu_tarih'); ?>">
    </div>
</div>
<div class="form-group ">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-danger btn-block">Döküm Al</button>
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
</script>

