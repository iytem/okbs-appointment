<?= form_open(base_url('cms/permission/edit_save/' . $permission->id), [
    'name' => 'form_permission',
    'class' => 'form-horizontal',
    'id' => 'form_permission',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>

<div class="form-group ">
    <label for="name" class="col-sm-3">Adı <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="name" id="name" placeholder="Adı"
               value="<?= set_value('name', $permission->name); ?>">
    </div>
</div>
<div class="form-group ">
    <label for="definition" class="col-sm-3">Açıklama <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="definition" id="definition"
               placeholder="Açıklama" value="<?= set_value('definition', $permission->definition); ?>">
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


