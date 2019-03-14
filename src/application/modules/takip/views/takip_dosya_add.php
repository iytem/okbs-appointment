<?= form_open(base_url("takip/dosya_add_save"), [
    'name' => 'form_takip_dosya',
    'class' => 'form-horizontal',
    'id' => 'form_takip_dosya',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>

<input type="hidden" class="form-control" name="dosya_takip_id" id="dosya_takip_id"
       value="<?= $dosya_takip_id; ?>">


<div class="clearfix margin-bottom"></div>

<div class="form-group ">
    <label for="link" class="col-sm-12">
        Dosya Seçiniz<i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="file" class="form-control" name="file[]" id="file" multiple>

    </div>
</div>
<div class="clearfix margin-bottom"></div>
<div class="box-footer">
    <div class="clearfix margin-bottom"></div>
    <div class="row-fluid col-md-12 text-center">

        <a class="btn btn-flat btn-bitbucket btn_action"
           data-toggle="tooltip" data-placement="top" title="Dosya Yükle" onclick="upload_file()">
            <i class="fa fa-upload fa-3x" style="width: 100px;color: #fff;"></i><br>
            Yükle
        </a>
        <div class="clearfix margin-bottom"></div>
        <div class="loading-folder"><img
                src="<?= cms_theme_assets_folder("img/loading.svg"); ?>">
            <strong style="color: #000000;">Lütfen Bekleyiniz... Dosya Yüklemesi Yapılıyor...</strong>
        </div>
    </div>
</div>
<?= form_close(); ?>
<script>
    $(document).ready(function () {
        $('.loading-folder').hide();
    })

    function upload_file() {
        var form_takip_dosya = $('#form_takip_dosya')[0];

        var data = new FormData(form_takip_dosya);

        data.append('file', file);

        $('.loading-folder').show();

        $.ajax({
            url: $('#form_takip_dosya').attr('action'),
            type: 'POST',
            dataType: 'json',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
        })
            .done(function (res) {

                if (res.result) {
                    $.notify(res.message, 'success');
                    $('#modal-default').modal('toggle');
                } else {
                    $.notify(res.message, 'error');
                }
            })
            .fail(function () {
                $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'info');
            })
            .always(function () {
                table.ajax.reload(null, false);
                $('.loading-folder').hide();
            })

        return false;
    }
</script>
