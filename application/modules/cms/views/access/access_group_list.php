<?= breadcrumbs("Yetki İşlemi","fa-thumb-tack",array("Yetki İşlemi","Yetki Verme"))?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i> Yetki Listesi</h1>

                </div>
                <div class="box-body">
                    <div class="form-group ">
                        <label for="content" class="col-sm-2 control-label">Grup</label>

                        <div class="col-sm-10">
                            <select class="form-control chosen  chosen-select-deselect group" name="group" id="group"
                                    tabi-ndex="5" data-placeholder="Seçiniz">
                                <option value=""></option>
                                <?php foreach ($groups as $group): ?>
                                    <option value="<?= $group->id; ?>"><?= _htmlent($group->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row-fluid">

                        <?= form_open('cms/access/save', [
                            'name' => 'form_access',
                            'class' => 'form-horizontal',
                            'id' => 'form_access',
                            'method' => 'POST'
                        ]); ?>

                        <input type="hidden" name="group_id" id="group_id"
                               value="<?= isset($groups[0]->id) ? $groups[0]->id : 0; ?>"><br>

                        <div class="box-footer">
                            <div class="form-group ">
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="search" name="search"
                                           placeholder="Filtrele">
                                </div>
                                <br>
                                <br><br>
                                <div class="col-sm-3">
                                    <label><input type="checkbox" class="flat-red toltip" id="check_all"
                                                  name="check_all"
                                                  title="check all"> <span style="padding-left: 10px;">Tümünü Seç</span></label>
                                </div>
                            </div>

                        </div>
                        <div class="multi-column" id="container_permission">

                        </div>
                    </div>
                    <div class="message">

                    </div>
                </div>
                <div class="box-footer">


                        <button class="btn btn-flat btn-default btn_save btn_action" id="btn_save" data-stype='stay'
                                data-toggle="tooltip" data-placement="top" title="Kaydet"><i class="fa fa-save"></i> Kaydet
                        </button>


                </div>
                <?= form_close(); ?>


                <div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
                        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>


            </div>
        </div>
    </div>

</section>


<script>
    $(document).ready(function () {
        $('.loading').hide();
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' /* optional */
        });

        $('.row-fluid').hide();
        $(".chosen").chosen({
            width: "100%"
        });
        $('.btn_save').hide();
        $('#search').on('keyup', function () {
            var filter = $(this).val();
            var regex = new RegExp(filter, "gi");

            $(document).find('#container_permission tr').hide();
            $(document).find('#container_permission tr').filter(function () {

                if ($(this).text().match(regex)) {
                    return true;
                }
                return false;
            }).show();
        });

        //check all
        var checkAll = $('#check_all');
        var checkboxes = $(document);

        checkAll.on('ifChecked ifUnchecked', function (event) {
            if (event.type == 'ifChecked') {
                checkboxes.iCheck('check');
            } else {
                checkboxes.iCheck('uncheck');
            }
        });

        $(document).on('click', 'label.toggle-select-all-access', function (event) {
            var checkgroup = $(document).find($(this).attr('data-target'));
            var state = $(this).data('state');

            switch (state) {
                case 1:
                case undefined:
                    $(this).data('state', 2);
                    checkgroup.iCheck('check');
                    break;
                case 2:
                    $(this).data('state', 1);
                    checkgroup.iCheck('uncheck');
                    break;
            }
        });

        checkboxes.on('ifChanged', 'input.check', function (event) {
            if (checkboxes.filter(':checked').length == checkboxes.length) {
                checkAll.prop('checked', 'checked');
            } else {
                checkAll.removeProp('checked');
            }
            checkAll.iCheck('update');
        });

        /*load access from server*/
        function refresh_access(group_id) {
            $('.loading').show();
            $.ajax({
                url: BASE_URL + 'cms/access_group/get_access_group/' + group_id,
                type: 'GET',
                dataType: 'html',
            })
                .done(function (res) {
                    $('#container_permission').html(res);
                    $('.check').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    $('.loading').hide();
                });
        }

        var id_group = "<?= isset($groups[0]->id) ? $groups[0]->id : 0; ?>";

        refresh_access(id_group);

        $('.group').change(function () {
            $('.row-fluid').show();
            $('.btn_save').show();
            var id = $(this).val();
            $('#group_id').val(id);

            refresh_access(id);
        });

        $('.btn_save').click(function () {


            var form_access = $('#form_access');
            var data_post = form_access.serialize();

            $('.loading').show();

            $.ajax({
                url: BASE_URL + '/cms/access_group/save',
                type: 'POST',
                dataType: 'json',
                data: data_post,
            })
                .done(function (res) {

                    if (res.result) {
                    $.notify(res.message,'success');
                    } else {
                        $.notify(res.message,'error');
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Veriler kaydedilemedi.','error');

                })
                .always(function () {
                    $('.loading').hide();

                });
            return false;
        });

    });
</script>