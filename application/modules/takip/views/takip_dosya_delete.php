<?= form_open(base_url('takip/dosya_delete/'), [
    'name' => 'form_takip_dosya',
    'class' => 'form-horizontal',
    'id' => 'form_takip_dosya',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>
    <div class="form-group ">
        <div class="col-sm-8">
            <input type="hidden" class="form-control" name="dosya_id" id="dosya_id"
                   value="<?= set_value('dosya_id',$dosya->dosya_id); ?>">
            <input type="hidden" class="form-control" name="dosya_adi" id="dosya_adi"
                   value="<?= set_value('dosya_adi',$dosya->dosya_adi); ?>">
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
