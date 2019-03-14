<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title><?= get_option("app_name") ?> | {title}</title>

    <link rel="shortcut icon" href="<?= base_url("storage/app/ico/16x16/" . get_option("app_ico")) ?>"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/bootstrap/dist/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/font-awesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("css/AdminLTE.min.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("css/_all-skins.min.css") ?>">

    <link rel="stylesheet" href="<?= cms_theme_assets_folder("css/cms.css") ?>">
    {_styles}

    <script src="<?= cms_theme_assets_folder("plugins/jquery/jquery-2.2.0.min.js") ?>"></script>
    <script src="<?= cms_theme_assets_folder("plugins/jquery-ui/jquery-ui.js") ?>"></script>
    <script src="<?= cms_theme_assets_folder("plugins/bootstrap/dist/js/bootstrap.min.js") ?>"></script>

    <script src="<?= cms_theme_assets_folder("js/custom.js") ?>"></script>
    <script>
        var BASE_URL = "<?= base_url(); ?>";
        var URI = "<?= str_replace("-","_",$this->uri->segment(2)); ?>";
        var HTTP_REFERER = "<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/'; ?>";
        var csrf = '<?= $this->security->get_csrf_token_name(); ?>';
        var token = '<?= $this->security->get_csrf_hash(); ?>';
    </script>
</head>
<body class="hold-transition <?= get_option("theme"); ?> sidebar-mini  <?= $this->uri->segment(2) == "file_manager" ? "sidebar-collapse" : "" ?>">
<div class="wrapper">

    <header class="main-header">
        <a href="<?= base_url("") ?>" class="logo hidden-xs">
            <span class="logo-mini"><b><?= get_option("app_short_name") ?></b></span>
            <span class="logo-lg" style="margin-left: -15px;font-weight: bold"> <?= get_option("app_name") ?></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <img class="user-image"
                                 src="<?= get_user_picture("user", "70x70", $this->aauth->get_user()->avatar, $this->aauth->get_user()->gender); ?>"
                                 alt="<?= $this->aauth->get_user()->full_name ?>">

                            <span class="hidden-xs"><?= _htmlent(ucwords(clean_snake_case($this->aauth->get_user()->full_name))); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">

                                <img class="profile-user-img img-responsive img-circle"
                                     src="<?= get_user_picture("user", "70x70", $this->aauth->get_user()->avatar, $this->aauth->get_user()->gender); ?>"
                                     alt="<?= $this->aauth->get_user()->full_name ?>">


                                <p style="font-size: 12px;">
                                    <?= _htmlent(ucwords(clean_snake_case($this->aauth->get_user()->full_name))); ?><br>
                                    <?= _htmlent(ucwords(clean_snake_case($this->aauth->get_user()->name))); ?>
                                    <small>Son
                                        giriş, <?= date('d-m-Y', strtotime($this->aauth->get_user()->last_login)); ?></small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= site_url('cms/user/profile'); ?>" class="btn btn-default btn-flat">Profil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= site_url('auth/logout'); ?>"
                                       class="btn btn-default btn-flat">Çıkış</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>


    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu" data-widget="tree">
                <?= get_menu(0, 1, "side menu"); ?>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">

        {content}
        <img id="ScrollTop" src="<?= cms_theme_assets_folder("img/yukari.png") ?>" title="Yukarı çık"/>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> <?= get_option("version") ?>
        </div>
        <strong>&copy; <?= get_option("author") ?> - <?= get_option("app_name"); ?> - <?= date("Y") ?>  </strong>
    </footer>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"
                     style="background-color: <?= '#' . get_option('modal_title_color') ?>;color: <?= '#' . get_option('modal_title_font_color') ?>">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="color: <?= '#' . get_option('modal_title_font_color') ?>!important;">
                        <span aria-hidden="true"><i class="fa fa-window-close"></i></span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-toggle="tooltip"
                            data-placement="top" title="Kapat"><i class="fa fa-window-close"></i> Kapat
                    </button>
                    <div class="submit pull-right"></div>
                </div>
            </div>
        </div>
    </div>


    <?= $this->load->view("cms/popup/popup") ?>
</div>



<script src="<?= cms_theme_assets_folder("plugins/jquery-slimscroll/jquery.slimscroll.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/fastclick/fastclick.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/notify/notify.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("js/adminlte.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/jquery-mask/src/jquery.mask.js") ?>"></script>
{_scripts}

<script type="text/javascript">


    $(document).ready(function () {
        $('.time').mask('00:00:00', {reverse: true});

        $('.dateInput').datepicker({
            format: "yyyy-mm-dd",
            language: "tr",
            todayHighlight: true,

        });


    });
</script>
<?php

$getAlert = $this->session->userdata("alert");
if ($getAlert) {
    $message = $this->session->userdata("alert-message");
    $type = $this->session->userdata("alert-type");

    ?>
    <script>


        var f_message = '<?= $message; ?>';
        var f_type = '<?= $type; ?>';

        $.notify(f_message, f_type);

    </script>
    <?php
    $this->session->set_userdata("alert", false);
} ?>

</body>
</html>
