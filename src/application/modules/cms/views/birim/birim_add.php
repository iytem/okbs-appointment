<?= form_open(base_url('cms/birim/add_save/'), [
    'name' => 'form_birim',
    'class' => 'form-horizontal',
    'id' => 'form_birim',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>

<div class="form-group ">
    <label for="name" class="col-sm-3">Adı <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="birim_adi" id="birim_adi" placeholder="Adı"
               value="<?= set_value('birim_adi'); ?>">
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

