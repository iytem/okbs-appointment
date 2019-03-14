<?= breadcrumbs("Menü","fa-list",array("Menü","Liste"))?>

<section class="content">
    <div class="row">
        <div class="col-lg-5">
            <div class="box box-solid">
                <div class="box-header with-border">

                    <h4 class="box-title">Menu Tipi </h4>

                </div>

                <div class="box-body">
                    <div class="menu-type-wrapper <?= $this->uri->segment(4) == 'side-menu' ? 'active' : ''; ?>">
                        <div data-href="<?= site_url('cms/menu/index/' . url_title('side menu')); ?>"
                             class="clickable btn-block menu-type btn-group "> Side Menü
                        </div>
                        <a class="menu-type-action">
                            &nbsp;
                        </a>
                    </div>
                    <?php foreach (db_get_all_data('cms_menu_type', 'name!= "side menu"') as $row): ?>
                        <div class="menu-type-wrapper  <?= $this->uri->segment(4) == url_title($row->name) ? 'active' : ''; ?>">
                 <span data-href="<?= site_url('cms/menu/index/' . url_title($row->name)); ?>"
                       class="clickable btn-block menu-type btn-group">
                    <?= _htmlent(ucwords($row->name)); ?>

                 </span>

                            <a class="menu-type-action remove-data"
                               data-href="<?= base_url('cms/menu_type/delete/' . $row->id); ?>"
                               href="javascript:void()">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <br>
                    <a href="<?= site_url('cms/menu_type/add'); ?>" class="btn btn-block btn-add btn-add-menu btn-flat"
                       data-toggle="tooltip" data-placement="top" title="Yeni Menü Tipi"><i class="fa fa-plus-square-o"></i> Yeni Menü Tipi</a>
                </div>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">Menü <?= ucwords(str_replace('-', ' ', $this->uri->segment(4))); ?></h4>
                    <span class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></span>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <div style="margin: 15px 0px 15px 0px !important;">

                                <a class="btn btn-flat btn-success btn_add_new" id="btn_add_new" data-toggle="tooltip" data-placement="top" title="Yeni Menü"
                                   href="<?= site_url('cms/menu/add/' . $this->uri->segment(4)) ?>"><i
                                            class="fa fa-plus-square-o"></i> Yeni Menü</a>

                        </div>
                        <div class="dd" id="nestable">
                            <?php

                            if (empty($menus)): ?>
                                <div class="box-no-data">Menü bulunamadı...</div>
                            <?php else:
                                echo $menus;
                            endif; ?>
                        </div>
                        <div class="nestable-output"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script>
    $(document).ready(function () {
        $('.loading').hide();
        var timeout;
        $('.dd').on('change', function () {
            clearTimeout(timeout);
            timeout = setTimeout(updateOrderMenu, 2000);
        });

        function updateOrderMenu() {
            $('.loading').show();
            var menu = $('.dd').nestable('serialize');


            $.ajax({
                url: BASE_URL + 'cms/menu/save_ordering',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'menu': menu,
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
                },
            })

                .done(function (res) {
                    if (res.success) {
                        $('.sidebar-menu').html(res.menu);
                        $.notify(res.message,'success');

                    } else {
                        $.notify(res.message,'error');
                    }
                })
                .fail(function () {
                    $.notify('Veri kaydedilirken hata oluştu, lütfen daha sonra tekrar deneyin.','error');
                })
                .always(function () {
                    $('.loading').hide();
                });
        }

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        });

        $('.clickable').on('click', function () {
            var href = $(this).attr('data-href');

            window.location.href = href;

            return false;
        });
    });
    /*end doc ready*/
</script>