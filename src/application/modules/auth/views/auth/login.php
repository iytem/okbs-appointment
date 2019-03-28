<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="<?= get_option("author") ?>"/>
    <meta name="description" content="<?= get_option("meta_desc") ?>">
    <title><?= get_option("app_name") ?> | Giriş</title>

    <link rel="shortcut icon" href="<?= base_url("storage/app/ico/16x16/" . get_option("app_ico")) ?>"/>
    <link rel="stylesheet"
          href="<?= cms_theme_assets_folder("plugins/bootstrap/dist/css/bootstrap.min.css") ?>">
    <link rel="stylesheet"
          href="<?= cms_theme_assets_folder("plugins/font-awesome/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("css/AdminLTE.min.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/iCheck/all.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("css/login.css") ?>">
    <link rel="stylesheet" href="<?= cms_theme_assets_folder("css/animate.min.css") ?>">

    <style>
        @keyframes zoom {
            0% { transform:scale(1,1); }
            50% { transform:scale(1.2,1.2); }
            100% {
                transform:scale(1,1);
            }
        }
        #login-back {
            z-index: -1!important;
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("<?= base_url("storage/app/login/2048x1152/".get_option("app_login"))?>") !important;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #999;
            animation: zoom 30s infinite;
        }


    </style>
</head>
<body>
<div id="login-back">
    <div id="login-overlay"></div>
</div>



<div class="login-box animated wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".5s">
    <div class="login-box-body">
        <div class="login-logo">
            <img class="animated wow fadeInDown"  data-wow-duration="1s" data-wow-delay=".5s"
                 src="<?= get_picture("app/logo", "180x180", get_option("app_logo")) ?>" alt="">
        <h3><?= get_option("app_name")?></h3>
        </div>
        <?php if (isset($error) AND !empty($error)): ?>
            <div class="alert alert-danger" style="color:#C82626">
                <h4>Dikkat!</h4>
                <p><?= $error; ?></p>
            </div>
        <?php endif; ?>

        <?= form_open('', [
            'name' => 'form_login',
            'id' => 'form_login',
            'method' => 'POST'
        ]); ?>

        <div class="form-group animated wow fadeInRight has-feedback <?= form_error('username') ? 'has-error' : ''; ?>"
             data-wow-duration="1s" data-wow-delay=".5s">
            <input type="text" class="form-control" placeholder="E-Posta Adresiniz" name="username"
                   value="<?= set_value('username',''); ?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>



        <div class="form-group animated  wow fadeInLeft has-feedback <?= form_error('password') ? 'has-error' : ''; ?>"
             data-wow-duration="1s" data-wow-delay=".5s">
            <input type="password" class="form-control" placeholder="Parola" name="password" value="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-bitbucket btn-block btn-flat pull-right animated wow fadeInUp"
                        data-wow-duration="1s" data-wow-delay=".5s" style="color: #fff"><i class="fa fa-sign-in" ></i> Giriş
                </button>
            </div>
        </div>
        <?php form_close() ?>
    </div>
</div>

<script src="<?= cms_theme_assets_folder("plugins/jquery/jquery-2.2.0.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/iCheck/icheck.min.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/wow/wow.min.js") ?>"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });

    $(function () {
        new WOW().init();
    });
</script>
</body>
</html>
