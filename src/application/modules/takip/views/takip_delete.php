<?= form_open(base_url('takip/delete/'), [
    'name' => 'form_takip',
    'class' => 'form-horizontal',
    'id' => 'form_takip',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>
    <div class="form-group ">
        <div class="col-sm-8">
            <input type="hidden" class="form-control" name="id" id="id"
                   value="<?= set_value('id',$takip); ?>">
        </div>
    </div>
<div style="color: red;font-weight: bold;font-size: 18px;text-align: center">Silmek İstediğinize Emin misiniz? Bu işlem geri alınamaz...</div>

<?= form_close(); ?>

<div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>

<script>
    $(document).ready(function () {
        $('.loading').hide();
    });
</script>
