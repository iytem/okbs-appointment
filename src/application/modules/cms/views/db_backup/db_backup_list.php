<?= breadcrumbs("Veritabanı Yedekleri", "fa-database", array("Veritabanı Yedekleri", "Liste")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-filter"></i> Yedek Al</h1>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-flat btn-bitbucket" id="btn_backup"
                            data-toggle="tooltip" data-placement="top" title="Yedek Al"><i
                                class="fa fa-database"></i> YEDEK AL
                    </button>
                    <br>
                    <div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
                            Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>
                </div>
            </div>
        </div>

    </div>
    <div class="backup-result"></div>
</section>

<script type="text/javascript">
    $(document).ready(function () {
        $('.loading').hide();
        $('#btn_backup').click(function () {
            $('.loading').show();
            $.ajax({
                url: BASE_URL + '/cms/database_backup/db_backup',
                type: 'POST',
                dataType: 'json',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
            })
                .done(function (res) {

                    if (res.result) {
                        $.notify(res.message, 'success');
                        backup_list();
                    } else {
                        $.notify(res.message, 'error');
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'info');
                })
                .always(function () {
                    $('.loading').hide();
                })

            return false;

        })

        backup_list();


    });

    function backup_list() {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/cms/database_backup/db_backup_list',
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function (res) {
                $('.backup-result').html(res);

            }
        });

    }

    function db_backup_delete(type, files) {
        $('.loading').show();


        swal({
                title: "Emin misiniz?",
                text: "Bu işlem geri alınamaz!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "green",
                confirmButtonText: "Evet",
                cancelButtonText: "Hayır",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: BASE_URL + '/cms/database_backup/db_backup_delete',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'files': files, 'type': type,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                    })
                        .done(function (res) {

                            if (res.result) {
                                $.notify(res.message, 'success');
                                backup_list();
                            } else {
                                $.notify(res.message, 'error');
                            }
                        })
                        .fail(function () {
                            $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'info');
                        })
                        .always(function () {
                            $('.loading').hide();
                            backup_list();
                        })
                } else {
                    $('.loading').hide();
                }
            });


        return false;

    }
</script>