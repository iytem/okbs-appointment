<?= breadcrumbs("Kullanıcı Logları","fa-user-secret",array("Kullanıcı Logları","Liste"))?>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i>  Kullanıcı Log Listesi</h1>

                    <a class="btn btn-flat btn-danger btn-sm btn_add_new pull-right"
                       data-toggle="tooltip" data-placement="top" title="Logu Sil" style="margin-right: 10px"
                       href="javascript:void(0)" onclick="deleted_user_log()"><i
                                class="fa fa-trash-o"></i> Sil</a>



                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="40">Sıra No</th>
                                <th width="20"> <i class="fa fa-folder-open fa-lg" style="color: tomato"></i></th>
                                <th>Tarih</th>
                                <th>Kullanıcı</th>
                                <th>Tablo Adı</th>
                                <th>İşlem</th>
                                <th>ID</th>
                                <th>URL</th>
                                <th>İp Adres</th>


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
        $(".chosen").chosen({
            width: "100%"
        });

        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, -1], ["10 Satır", "25 Satır", "50 Satır", "100 Satır", "Tümü"]],
            "searching": true,
            "pageLength": 10,
            "order": [],
            "ajax": {
                "url": BASE_URL + "cms/log/grid_view_user_activity",
                "type": "POST",
                "data": function (data) {
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'
                    data.find = $('#find').val();
                    data.find_user = $('#find_user').val();

                }
            },

            "columnDefs": [
                {

                    "targets": [0,1],
                    "orderable": false,
                },
            ],


        });

        $('#btn_filter').click(function () {
            table.ajax.reload(null, false);

        });

        $('#btn_reset').click(function () {
            $('#form-filter')[0].reset();
            $(".chosen").trigger('chosen:updated');
            table.ajax.reload(null, false);
        });


    });

    function submit() {
        var form_log = $('#form_log');
        var data_post = form_log.serializeArray();

        $.ajax({
            url: form_log.attr('action'),
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
            })

        return false;
    }


    function log_detail(id, title) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'cms/log/user_log_detail',
            data: {
                'id': id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function (res) {
                $('#modal-default').modal({backdrop: 'static', keyboard: false});
                $('.modal-dialog').addClass('modal-lg');
                $('.modal-title').html(title);
                $('.modal-body').html(res);

            }
        });
    }


    function deleted_user_log() {

        swal({
                title: "Emin misiniz?",
                text: "Bu işlem logları veritabanından siler.\n Yanlız silmeden önce veritabanın yedeğini alır",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "green",
                confirmButtonText: "Evet",
                cancelButtonText: "Hayır",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    var url = BASE_URL + 'cms/log/deleted_user_log';
                    window.location.href = url;
                }
            });


    }


</script>