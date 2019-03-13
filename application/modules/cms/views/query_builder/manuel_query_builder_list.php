<?= breadcrumbs("Veritabanı Sorguları", "fa-database", array("Veritabanı Sorguları", "Liste")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-filter"></i> Manuel Sorgu</h1>
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
                            <label for="">Sorgu Yazınız (insert,delete,update sorgularını çalıştırabilirsiniz...)</label>
                            <textarea name="manuel_query" id="manuel_query" cols="30" rows="5" class="form-control"></textarea>
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
        $('#btn_filter').click(function () {
            var manuel_query = $('#manuel_query').val();

            $('.loading').show();
            $.ajax({
                url: BASE_URL + '/cms/query_builder/manuel_execute_query',
                type: 'POST',
                dataType: 'json',
                data: {
                    'manuel_query': manuel_query,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
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
                    $('.loading').hide();
                })

            return false;

        })
    });
</script>