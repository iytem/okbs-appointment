<?= breadcrumbs("Veritabanı Sorguları", "fa-database", array("Veritabanı Sorguları", "Liste")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-filter"></i> Sorgu</h1>
                </div>
                <div class="box-body">
                    <?= form_open('', [
                        'name' => 'form-filter',
                        'class' => 'form-horizontal',
                        'id' => 'form-filter',
                        'method' => 'POST'
                    ]); ?>

                    <div class="form-group">

                        <div class="col-sm-12">

                            <input type="hidden" class="form-control" name="select_query" id="select_query"
                                   placeholder="" value="SELECT" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="">Tablo Adı</label>
                            <select class="form-control chosen" name="table_name" id="table_name"
                                    tabi-ndex="5" data-placeholder="Seçiniz">
                                <option value="">Tablo Seçiniz</option>
                                <?php
                                $tables = $this->db->list_tables();
                                foreach ($tables as $table)
                                {
                                    echo '<option value="'.$table.'">'.$table.'</option>';
                                }
                              ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group" id="field-div">


                    </div>

                    <div class="form-group" id="where-div">

                        <div class="col-sm-12">
                            <label for="">Sorgu Koşulu</label>
                            <input type="text" class="form-control" name="where" id="where"
                                   placeholder="" value="WHERE ">
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-flat btn-bitbucket" id="btn_filter"
                            data-toggle="tooltip" data-placement="top" title="Sorguyu Çalıştır"><i
                                class="fa fa-database"></i>
                    </button>
                    <br>

                </div>
                <?= form_close(); ?>
                <div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
                        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>
            </div>
        </div>
    </div>
    <div class="query-result"></div>
</section>


<script type="text/javascript">
    $(document).ready(function () {
        $('.loading').hide();
        $(".chosen").chosen({
            width: "100%"
        });
        $('#field-div').hide();
        $('#where-div').hide();

        $('#table_name').change(function () {
            $('.loading').show();
            var table_name = $('#table_name').val();
            $.ajax({
                url: BASE_URL + '/cms/query_builder/field_query',
                type: 'POST',
                dataType: 'json',
                data: {
                    'table_name': table_name,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
            })
                .done(function (res) {

                    if (res.result) {
                        $('#field-div').show();
                        $('#where-div').show();
                        $('#field-div').html(res.message);

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





        $('#btn_filter').click(function () {
            var select_query = $('#select_query').val();
            var table_name = $('#table_name').val();
            var field_name = $('#field_name').val();
            var where = $('#where').val();

            $('.loading').show();
            $.ajax({
                url: BASE_URL + '/cms/query_builder/execute_query',
                type: 'POST',
                dataType: 'json',
                data: {
                    'select_query': select_query,'table_name': table_name,'field_name': field_name,'where': where,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
            })
                .done(function (res) {

                    if (res.result) {
                        $('.query-result').html(res.message);
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
    });
</script>