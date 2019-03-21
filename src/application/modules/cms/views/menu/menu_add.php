<?= breadcrumbs("Menü Ekleme", "fa-list", array("Menü", "Ekle")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Yeni Menü</h4>

                </div>
                <div class="box-body">
                    <?= form_open('', [
                        'name' => 'form_menu',
                        'class' => 'form-horizontal',
                        'id' => 'form_menu',
                        'method' => 'POST'
                    ]); ?>
                    <input type="hidden" value="<?= $menu_type_id; ?>" name="menu_type_id">
                    <div class="form-group menu-only" style="margin-top: 20px;">
                        <label for="content" class="col-sm-2 control-label">Simge</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="icon" id="icon">

                            <div class="icon-preview btn-select-icon">
                                <span class="icon-preview-item"><i class="fa fa-rss fa-lg"></i></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group ">
                        <label for="label" class="col-sm-2 control-label">Renk <i class="required">*</i></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control jscolor" name="icon_color" id="icon_color"
                                   placeholder="Renk"
                                   value="<?= set_value('icon_color', "000000"); ?>">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Üst Menü</label>
                        <div class="col-sm-8">
                            <select class="form-control chosen" name="parent" id="parent"
                                    tabi-ndex="5" data-placeholder="Seçiniz">
                                <option value=""></option>
                                <?php foreach (db_get_all_data('cms_menu', ['menu_type_id' => $menu_type_id]) as $row): ?>
                                    <option value="<?= $row->id; ?>"><?= ucwords($row->label); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="label" class="col-sm-2 control-label">Etiket <i class="required">*</i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="label" id="label" placeholder="Etiket"
                                   value="<?= set_value('label'); ?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="link" class="col-sm-2 control-label">Link <i class="required">*</i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="link" id="link" placeholder="Link"
                                   value="<?= set_value('link'); ?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Menu Tipi</label>
                        <div class="col-sm-8">
                            <label class="col-md-2">
                                <input type="radio" name="type" class="flat-green menu_type" value="menu" checked> <span
                                        style="padding-left: 10px;">Menü</span>
                            </label>
                            <label>
                                <input type="radio" name="type" class="flat-green menu_type" value="label"> <span
                                        style="padding-left: 10px;">Etiket</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Grup İzni </label>
                        <div class="col-sm-8">
                            <select class="form-control chosen" name="group[]" id="group" tabi-ndex="5"
                                    data-placeholder="Seçiniz" multiple="">
                                <option value=""></option>
                                <?php foreach (db_get_all_data('cms_aauth_groups') as $row): ?>
                                    <option value="<?= $row->id; ?>"><?= $row->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <div class="row-fluid col-md-7">
                        <button class="btn btn-flat btn-bitbucket btn_save btn_action" id="btn_save" data-stype='stay'
                                data-toggle="tooltip" data-placement="top" title="Kaydet"><i class="fa fa-save"></i>
                            Kaydet
                        </button>
                        <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save"
                           data-stype='back' data-toggle="tooltip" data-placement="top"
                           title="Kaydet ve Listeye Geri Dön"><i class="fa fa-list"></i>
                            Kaydet ve Listeye Geri Dön</a>
                        <a class="btn btn-flat btn-danger btn_action" id="btn_cancel" data-toggle="tooltip"
                           data-placement="top" title="Vazgeç"><i
                                    class="fa fa-undo"></i> Vazgeç</a> <br>

                    </div>

                </div>

                <?= form_close(); ?>
                <div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
                        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>

            </div>
        </div>
    </div>
</section>
<div class="modal fade " tabindex="-1" role="dialog" id="modalIcon">
    <div class="modal-dialog full-width" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <?php $this->load->view('menu/partial_icon'); ?>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.loading').hide();
        $('input[type="radio"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });

        $(".chosen").chosen({
            width: "100%"
        });
        $('.btn-select-icon').click(function (event) {
            event.preventDefault();

            $('#modalIcon').modal('show');
        });

        $('.icon-container').click(function (event) {
            $('#modalIcon').modal('hide');
            var icon = $(this).find('.icon-class').html();

            icon = $.trim(icon);

            $('#icon').val(icon);

            $('.icon-preview-item .fa').attr('class', 'fa fa-lg ' + icon);
        });

        $('#icon_color').change(function (event) {
            $('.icon-preview-item').attr('style', 'color:#' + $(this).val());
        });

        $('#find-icon').keyup(function (event) {
            $('.icon-container').hide();
            var search = $(this).val();

            $('.icon-class').each(function (index, el) {
                var str = $(this).html();
                var patt = new RegExp(search);
                var res = patt.test(str);

                if (res) {
                    $(this).parent('.icon-container').show();
                }
            });
        });

        var menu_type = $('.menu_type');

        menu_type.on('ifClicked', function (event) {
            var type = $(this).val();
            updateMenuType(type);
        });

        function updateMenuType(type) {
            if (type == 'menu') {
                $('.menu-only').show();
            } else {
                $('.menu-only').hide();
            }
        }

        $('.btn_save').click(function () {

            var form_menu = $('#form_menu');
            var data_post = form_menu.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                url: BASE_URL + '/cms/menu/add_save',
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
                        $('.sidebar-menu').html(res.menu);
                        $.notify(res.message, 'success');
                        resetForm();
                    } else {

                        $.notify(res.message, 'error');
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Veriler kaydedilemedi.', 'error');

                })
                .always(function () {
                    $('.loading').hide();

                });
            return false;
        });
    });
</script>
