<?= breadcrumbs("Telefon Görüşmeleri", "fa-phone", array("Telefon Görüşmeleri", "Liste")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i> Telefon Görüşme Listesi</h1>


                    <a class="btn btn-flat btn-bitbucket btn_add_new btn-sm pull-right" id="btn_add_new"
                       data-toggle="tooltip" data-placement="top" title="Yeni Telefon Görüşmesi"
                       href="javascript:void(0)" onclick="generate_modal('add','','Telefon Görüşmesi Ekleme')"><i
                                class="fa fa-plus-square-o"></i> <span class="hidden-xs hidden-sm">Telefon Görüşmesi Ekle</span></a>

                    <?php if ($this->uri->segment(2) == ""): ?>
                    <a class="btn btn-flat btn-success btn_add_new btn-sm pull-right margin-r-5" id="btn_add_new"
                       data-toggle="tooltip" data-placement="top" title="Geri Dönüş Bekleyenler"
                       href="<?= base_url("telefon/1") ?>"><i
                                class="fa fa-reply-all"></i> <span class="hidden-xs hidden-sm">Geri Dönüş Bekleyenler</span></a>
                    <?php endif; ?>

                    <?php if ($this->uri->segment(2) == 1): ?>
                        <a class="btn btn-flat btn-success btn_add_new btn-sm pull-right margin-r-5" id="btn_add_new"
                           data-toggle="tooltip" data-placement="top" title="Geri Dönüş Bekleyenler"
                           href="<?= base_url("telefon") ?>"><i
                                    class="fa fa-list"></i> <span class="hidden-xs hidden-sm">Tüm Liste</span></a>
                    <?php endif; ?>

                    <?php if ($this->uri->segment(2) == 1): ?>
                        <?php if ($this->aauth->is_allowed('telefon-print')): ?>
                            <a class="btn btn-flat btn-danger btn_add_new btn-sm pull-right margin-r-5" id="btn_add_new"
                               data-toggle="tooltip" data-placement="top" title="Tarih Bazlı Telefon Listesi Dökümü"
                               href="javascript:void(0)"
                               onclick="generate_modal('print','','Tarih Bazlı Telefon Listesi Dökümü')"><i
                                        class="fa fa-file-pdf-o"></i> <span class="hidden-xs hidden-sm">Telefon Listesi Döküm</span></a>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="40">Sıra No</th>
                                <th width="20"><i class="fa fa-folder-open fa-lg" style="color: tomato"></i></th>
                                <th>Adı ve Soyadı</th>
                                <th>Çalıştığı Yer</th>
                                <th>Sebep</th>
                                <th>Telefon No</th>
                                <th>Telefon Tarih</th>
                                <th>Telefon Saat</th>
                                <th>Notlar</th>
                                <th>Durum</th>

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
            "dom": 'Bfrtip',
            "buttons": [


                {
                    extend: 'pageLength',
                    className: 'fa fa-eye btn btn-bitbucket margin-bottom',
                    text: ' Göster',
                }
            ],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[10, 25, 50, 100, -1], ["10 Satır", "25 Satır", "50 Satır", "100 Satır", "Tümü"]],
            "searching": true,
            "pageLength": 10,
            "order": [],
            "ajax": {
                "url": BASE_URL + "telefon/grid_view/" + '<?=$this->uri->segment(2)?>',
                "type": "POST",
                "data": function (data) {
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'

                }
            },

            "columnDefs": [
                {

                    "targets": [0, 1],
                    "orderable": false,
                },
            ],


        });

    });

    function generate_modal(par, id, title) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'telefon/modal_render',
            data: {
                'param': par, 'value': id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function (res) {
                if (par == "add") {
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.submit').html('<button type="button" class="btn btn-bitbucket" onclick="submit();"><i class="fa fa-save"></i> Kaydet</button>');
                } else if (par == "edit") {
                    $('.modal-dialog').removeClass('modal-sm');
                    $('.submit').html('<button type="button" class="btn btn-warning" onclick="submit();"><i class="fa fa-edit"></i> Güncelle</button>');
                } else if (par == "delete") {
                    $('.modal-dialog').addClass('modal-sm');
                    $('.submit').html('<button type="button" class="btn btn-danger" onclick="submit();"><i class="fa fa-trash-o"></i> Sil</button>');
                } else {
                    $('.modal-dialog').removeClass('modal-sm');
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
        var telefon = $('#form_telefon');
        var data_post = telefon.serializeArray();

        $.ajax({
            url: telefon.attr('action'),
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