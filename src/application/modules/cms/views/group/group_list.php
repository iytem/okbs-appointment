<?= breadcrumbs("Kullanıcı Grupları","fa-group",array("Kullanıcı Grupları","Liste"))?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i>  Grup Listesi</h1>


                        <a class="btn btn-flat btn-bitbucket btn_add_new btn-sm pull-right" id="btn_add_new"
                           data-toggle="tooltip" data-placement="top" title="Yeni Grup"
                           href="javascript:void(0)" onclick="generate_modal('add','','Grup Ekleme')"><i
                                    class="fa fa-plus-square-o"></i> Grup Ekle</a>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="40">Sıra No</th>
                                <th width="20"> <i class="fa fa-folder-open fa-lg" style="color: tomato"></i></th>
                                <th>Grup Adı</th>
                                <th>Açıklama</th>

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

<script type="text/javascript">
    var table;

    $(document).ready(function () {
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, -1], ["10 Satır", "25 Satır", "50 Satır", "100 Satır", "Tümü"]],
            "searching": true,
            "pageLength": 10,
            "order": [],
            "ajax": {
                "url": BASE_URL + "cms/group/grid_view",
                "type": "POST",
                "data": function (data) {
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'

                }
            },

            "columnDefs": [
                {

                    "targets": [0,1],
                    "orderable": false,
                },
            ],


        });

    });

    function generate_modal(par, id, title) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'cms/group/modal_render',
            data: {
                'param': par, 'value': id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function (res) {
                if (par == "add") {

                    $('.submit').html('<button type="button" class="btn btn-bitbucket" onclick="submit();"><i class="fa fa-save"></i> Kaydet</button>');
                } else if (par == "edit") {
                    $('.submit').html('<button type="button" class="btn btn-warning" onclick="submit();"><i class="fa fa-edit"></i> Güncelle</button>');
                } else if (par == "delete") {
                    $('.submit').html('<button type="button" class="btn btn-danger" onclick="submit();"><i class="fa fa-trash-o"></i> Sil</button>');
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
        $('.loading').show();
        var form_group = $('#form_group');
        var data_post = form_group.serializeArray();

        $.ajax({
            url: form_group.attr('action'),
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


</script>