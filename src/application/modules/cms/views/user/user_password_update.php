<?= breadcrumbs("Parola Güncelle","fa-user",array("Kullanıcılar","Parola Güncelle"))?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Parola Güncelle</h4>
                </div>
                <div class="box-body">
                    <?= form_open("", [
                        'name' => 'form_password',
                        'class' => 'form-horizontal',
                        'id' => 'form_password',
                        'method' => 'POST'
                    ]); ?>


                    <div class="form-group ">
                        <label for="mevcut_password" class="col-sm-2 control-label">Mevcut Parolanız <i
                                    class="required">*</i></label>

                        <div class="col-sm-8 input-password">
                            <div class="input-group col-md-8">
                                <input type="password" class="form-control password input-password"
                                       name="mevcut_password" id="mevcut_password"
                                       placeholder="Mevcut Parolanız"
                                       value="<?= set_value('mevcut_password'); ?>">
                                <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="yeni_parola" class="col-sm-2 control-label">Yeni Parolanız <i class="required">*</i></label>

                        <div class="col-sm-8 input-password">
                            <div class="input-group col-md-8">
                                <input type="password" class="form-control password input-password" name="yeni_parola"
                                       id="yeni_parola"
                                       placeholder="Yeni Parolanız"
                                       value="<?= set_value('yeni_parola'); ?>">
                                <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="yeni_parola_tekrar" class="col-sm-2 control-label">Yeni Parola Tekrarı <i
                                    class="required">*</i></label>

                        <div class="col-sm-8 input-password">
                            <div class="input-group col-md-8">
                                <input type="password" class="form-control password input-password"
                                       name="yeni_parola_tekrar"
                                       id="yeni_parola_tekrar" placeholder="Yeni Parola Tekrarı"
                                       value="<?= set_value('yeni_parola_tekrar'); ?>">
                                <span class="input-group-btn">
                        <button type="button" class="btn btn-flat show-password"><i class="fa fa-eye eye"></i></button>
                      </span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row-fluid col-md-7">
                            <button class="btn btn-flat btn-warning btn_save btn_action" id="btn_save" data-stype='stay'
                                    title="güncelle"><i class="fa fa-save"></i> Parola Değiştir
                            </button>
                            <a class="btn btn-flat btn-primary btn_save btn_action btn_save_back" id="btn_save"
                               data-stype='back' title="güncelle ve listeye geri dön"><i
                                        class="fa fa-backward"></i> Parola Değiştir ve Profile Geri Dön</a>
                            <a class="btn btn-flat btn-default btn_action" id="btn_cancel" title="vazgeç"><i
                                        class="fa fa-undo"></i> Vazgeç</a>

                        </div>

                    </div>
                    <?= form_close(); ?>
                    <div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
                            Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {
        $('.loading').hide();
        $('.btn_save').click(function () {
            $('.message').fadeOut();

            var form_password = $('#form_password');
            var data_post = form_password.serializeArray();
            var save_type = $(this).attr('data-stype');

            data_post.push({
                name: 'save_type',
                value: save_type
            });

            $('.loading').show();

            $.ajax({
                url: BASE_URL + '/cms/user/password_edit_save',
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
                        $.notify(res.message,'success');
                        resetForm();
                    } else {

                        $.notify(res.message,'error');
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Veriler kaydedilemedi.','success');

                })
                .always(function () {
                    $('.loading').hide();
                    $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 1000);
                });
            return false;
        });
    });
</script>