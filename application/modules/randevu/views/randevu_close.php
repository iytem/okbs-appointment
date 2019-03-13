<?= form_open(base_url('randevu/add_close_save/' . $randevu->randevu_id), [
    'name' => 'form_randevu',
    'class' => 'form-horizontal',
    'id' => 'form_randevu',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>

<div class="form-group ">
    <label for="definition" class="col-sm-3">Notlar <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="randevu_notlar" id="randevu_notlar" cols="30" rows="5"
                  class="form-control"><?= $randevu->randevu_notlar?></textarea>
    </div>
</div>
<?= form_close(); ?>


<div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>

<script>
    $(document).ready(function () {
        $('.loading').hide();
    });

</script>

