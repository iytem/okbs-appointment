<?= breadcrumbs("Menü Tipi","fa-list",array("Menü","Menü Tipi"))?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Yeni Menu Tipi </h4>
                </div>
                <div class="box-body">
                    <?= form_open('', ['name' => 'form_menu_type', 'class' => 'form-horizontal', 'id' => 'form_menu_type', 'method' => 'POST']); ?>
                    <div class="form-group ">
                        <label for="name" class="col-sm-2 control-label">Adı <i class="required">*</i>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Adı"
                                   value="<?= set_value('name'); ?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="definition" class="col-sm-2 control-label">Açıklama <i class="required">*</i>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="definition" id="definition"
                                   placeholder="Açıklama" value="<?= set_value('definition'); ?>">
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-bitbucket btn_save btn_action" id="btn_save" data-stype='stay'
                                title="kaydet"><i class="fa fa-save"></i> Kaydet
                        </button>
                        <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save"
                           data-stype='back' title="kaydet ve listeye geri dön"><i class="fa fa-list"></i>
                            Kaydet ve Listeye Geri Dön</a>
                        <a class="btn btn-flat btn-danger btn_action" id="btn_cancel" title="vazgeç"><i
                                    class="fa fa-undo"></i> Vazgeç</a>

                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('.btn_save').click(function () {
            var form_menu_type = $('#form_menu_type');
            var data_post = form_menu_type.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                url: BASE_URL + '/cms/menu_type/add_save',
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })

                .done(function (res) {

                    if (res.result) {
                        if (save_type == 'back') {
                            window.location.href = res.redirect
                            return;
                        }
                        $.notify(res.message, 'success');
                        resetForm();
                    } else {
                        $.notify(res.message, 'error');
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'info');
                })
                .always(function () {
                    $('.loading').hide();
                    $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 1000);
                });

            return false;

        });
        /*end btn save*/
    });
    /*end doc ready*/
</script>