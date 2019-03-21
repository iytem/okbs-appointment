<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css") ?>">
<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/ckeditor/ckeditor.js") ?>"></script>

<?= form_open(base_url('cms/popup/edit_save/' . $popup->popup_id), [
    'name' => 'form_popup',
    'class' => 'form-horizontal',
    'id' => 'form_popup',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>



<div class="form-group ">
    <label for="name" class="col-sm-3">Başlık <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="title" id="title" placeholder="Başlık"
               value="<?= set_value('title', $popup->title); ?>">
    </div>
</div>
<div class="form-group ">
    <label for="definition" class="col-sm-3">İçerik <i
                class="required">*</i></label>
    <div class="col-sm-12">
        <textarea name="description" id="description" cols="30" rows="5" class="form-control"><?=  $popup->description; ?></textarea>

    </div>
</div>
<div class="form-group ">
    <label for="name" class="col-sm-3">Sayfa URL <i class="required">*</i></label>
    <div class="col-sm-12">
        <select class="form-control chosen" name="page_url" id="page_url"
                tabi-ndex="5" data-placeholder="Seçiniz">
            <option value=""></option>
            <?php foreach (get_page_list()  as $page => $value): ?>
                <option value="<?=$page; ?>" <?= $page==$popup->page_url ? "selected":"" ?>><?= ucwords($value); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<?= form_close(); ?>
<div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>

<script>
    $(document).ready(function () {
        $('.loading').hide();
        $(".chosen").chosen({
            width: "100%"
        });

        CKEDITOR.replace( 'description', {
            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"links","groups":["links"]},
                {"name":"paragraph","groups":["list","blocks"]},
                {"name":"insert","groups":["insert"]},
                {"name":"styles","groups":["styles"]},
                {"name":"colors","groups":["colors"]},
            ],
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        } );
    })
</script>