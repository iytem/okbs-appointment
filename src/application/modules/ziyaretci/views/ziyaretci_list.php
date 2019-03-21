<?= breadcrumbs("Ziyaretçi İşlemleri","fa-users",array("Ziyaretçi İşlemleri","Liste"))?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i>  Ziyaretçi Listesi</h1>


                        <a class="btn btn-flat btn-bitbucket btn_add_new btn-sm pull-right" id="btn_add_new"
                           data-toggle="tooltip" data-placement="top" title="Yeni Ziyaretçi"
                           href="javascript:void(0)" onclick="generate_modal('add','','Ziyaretçi Ekleme')"><i
                                    class="fa fa-plus-square-o"></i> <span class="hidden-xs hidden-sm"> Ziyaretçi Ekle</span></a>

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th width="40">Sıra No</th>
                                <th width="20"> <i class="fa fa-folder-open fa-lg" style="color: tomato"></i></th>
                                <th>Adı ve Soyadı</th>
                                <th>Telefon No</th>
                                <th>Ziyaretçinin Geldiği Yer</th>
                                <th>Referans</th>
                                <th>Geldiği Tarih</th>
                                <th>Geldiği Saat</th>
                                <th>Notlar</th>

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


            "ajax": {
                "url": BASE_URL + "ziyaretci/grid_view",
                "type": "POST",
                "data": function (data) {
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>'

                }
            },

            "dom": 'Bfrtip',
            "buttons": [

                {
                    extend: 'excelHtml5',
                    className: 'fa fa-file-excel-o btn btn-success margin-bottom',
                    text: ' Excel\'e Aktar',
                    filename: 'ziyaretci_<?= generate_key()?>',
                    title: 'Ziyaretçi Listesi',
                    exportOptions: {
                        columns: [0, 2, 3,4,5,6,7,8]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    className: 'fa fa-file-pdf-o btn btn-danger margin-bottom',
                    text: ' PDF\'e Aktar',
                    filename: 'ziyaretci_<?= generate_key()?>',
                    title: 'Ziyaretçi Listesi',
                    exportOptions: {
                        columns: [0, 2, 3,4,5,6,7,8]
                    },customize: function (doc) {
                        var tblBody = doc.content[1].table.body;
                        doc.content[1].layout = {
                            hLineWidth: function(i, node) {
                                return (i === 0 || i === node.table.body.length) ? 2 : 1;},
                            vLineWidth: function(i, node) {
                                return (i === 0 || i === node.table.widths.length) ? 2 : 1;},
                            hLineColor: function(i, node) {
                                return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';},
                            vLineColor: function(i, node) {
                                return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';}
                        };
                        $('#gridID').find('tr').each(function (ix, row) {
                            var index = ix;
                            var rowElt = row;
                            $(row).find('td').each(function (ind, elt) {
                                tblBody[index][ind].border
                                if (tblBody[index][1].text == '' && tblBody[index][2].text == '') {
                                    delete tblBody[index][ind].style;
                                    tblBody[index][ind].fillColor = '#FFF9C4';
                                }
                                else
                                {
                                    if (tblBody[index][2].text == '') {
                                        delete tblBody[index][ind].style;
                                        tblBody[index][ind].fillColor = '#FFFDE7';
                                    }
                                }
                            });
                        });
                    }
                },
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

        });

    });

    function generate_modal(par, id, title) {
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'ziyaretci/modal_render',
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
        var ziyaretci = $('#form_ziyaretci');
        var data_post = ziyaretci.serializeArray();

        $.ajax({
            url: ziyaretci.attr('action'),
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