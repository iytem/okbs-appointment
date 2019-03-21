<?= breadcrumbs("Kullanıcılar", "fa-user", array("Kullanıcılar", "Liste")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i> Kullanıcı Listesi</h1>

                    <a class="btn btn-flat btn-bitbucket btn_add_new btn-sm pull-right" id="btn_add_new"
                       data-toggle="tooltip" data-placement="top" title="Yeni Kullanıcı"
                       href="javascript:void(0)" onclick="generate_modal('add','','Kullanıcı Ekleme')"><i
                                class="fa fa-plus-square-o"></i> Kullanıcı Ekle</a>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="50">Sıra No</th>
                                <th width="50">Avatar</th>
                                <th width="20"> <i class="fa fa-folder-open fa-lg" style="color: tomato"></i></th>
                                <th>Adı Soyadı</th>
                                <th>E-Posta Adresi</th>
                                <th>Cinsiyet</th>
                                <th>Gruplar</th>
                                <th>Son Giriş</th>
                                <th>İp Adres</th>
                                <th width="50">Giriş Denemeleri <br>(<?php
                                    $this->config->load('aauth');
                                    $config_vars = $this->config->item('aauth');
                                    echo "Max: " . $config_vars['max_login_attempt'];

                                    ?>)
                                </th>
                                <th width="30">Durum</th>

                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var table;
    $(document).ready(function () {
        $('.fancybox').fancybox();

        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, -1], ["10 Satır", "25 Satır", "50 Satır", "100 Satır", "Tümü"]],
            "searching": true,
            "pageLength": 10,
            "order": [],

            "ajax": {
                "url": BASE_URL + "cms/user/grid_view",
                "type": "POST",
                "data": function (data) {
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'
                    data.find = $('#find').val();

                }
            },
            "columnDefs": [
                {
                    "targets": [0, 1, 2, 5, 6],
                    "orderable": false,
                },
            ],
        });

    });

    function generate_modal(par, id, title) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'cms/user/modal_render',
            data: {
                'param': par, 'value': id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function (res) {
                if (par == "add") {

                    $('.submit').html('<button type="button" class="btn btn-bitbucket" onclick="submit();"><i class="fa fa-save"></i> Kaydet</button>');
                } else if (par == "edit") {
                    $('.submit').html('<button type="button" class="btn btn-warning" onclick="submit();"><i class="fa fa-edit"></i> Güncelle</button>');
                } else {
                    $('.submit').html('');
                }
                $('#modal-default').modal({backdrop: 'static', keyboard: false});
                $('.modal-title').html(title);
                $('.modal-body').html(res);

            }
        });
    }

    function submit() {

        var form_user = $('#form_user');
        var data_post = form_user.serializeArray();

        $.ajax({
            url: form_user.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: data_post,
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
                $('.loading').hide();
            })

        return false;
    }

    function user_status(id, status) {
        var text_ = null;
        if (status == 0) {
            text_ = "Bu İşlem kullanıcı üzerindeki tüm grup ve yetkileri kaldıracaktır.";
        } else if (status == 1) {
            text_ = "Bu İşlem kullanıcı aktif hale getirecektir";
        }
        var url = $(this).attr('data-href');
        swal({
                title: "Emin misiniz?",
                text: text_,
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
                        url: BASE_URL + 'cms/user/set_status',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'id': id, 'status': status,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        }
                    })
                        .done(function (res) {

                            if (res.result) {
                                $.notify(res.message, 'success');
                            } else {
                                $.notify(res.message, 'error');
                            }
                        })
                        .fail(function () {
                            $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'info');
                        })
                        .always(function () {
                            table.ajax.reload(null, false);
                        })

                    return false;
                }
            });

        return false;


    }

    function user_login_attempts(id) {
        $.ajax({
            url: BASE_URL + 'cms/user/login_attempts_reset',
            type: 'POST',
            dataType: 'json',
            data: {
                'id': id, 'status': status,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        })
            .done(function (res) {

                if (res.result) {
                    $.notify(res.message, 'success');
                } else {
                    $.notify(res.message, 'error');
                }
            })
            .fail(function () {
                $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'info');
            })
            .always(function () {
                table.ajax.reload(null, false);
            })

        return false;

    }


</script>





