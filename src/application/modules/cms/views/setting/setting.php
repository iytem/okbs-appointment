<?= breadcrumbs("Ayarlar", "fa-cogs", array("Ayarlar")) ?>

<style type="text/css">
    .tab-pane {
        padding: 10px 0;
    }

    .col-md-2 {
        padding: 20px;
    }

</style>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h1 class="box-title" style="color: tomato"><i
                                class="fa fa-list-alt"></i> Uygulama Ayarları</h1>

                </div>
                <div class="box-body">


                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Logo
                                        Ayarları</a></li>
                                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Favicon
                                        Ayarları</a></li>
                                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Login Background
                                        Ayarları
                                    </a></li>
                                <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Genel
                                        Ayarlar</a></li>
                                <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Bakım
                                        Modu</a></li>
                                <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Oturum
                                        Ayarları</a></li>
                                <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">CSRF
                                        Ayarları</a></li>
                                <li class=""><a href="#tab_8" data-toggle="tab" aria-expanded="false">Tema
                                        Ayarları</a></li>
                                <li class=""><a href="#tab_9" data-toggle="tab" aria-expanded="false">Diğer
                                        Ayarlar</a></li>

                                <li class=""><a href="#tab_10" data-toggle="tab" aria-expanded="false">Dosya
                                        Ayarlar</a></li>

                            </ul>
                            <?= form_open('cms/setting/save', [
                                'name' => 'form_setting',
                                'class' => 'form-horizontal',
                                'id' => 'form_setting',
                                'method' => 'POST'
                            ]); ?>
                            <div class="tab-content">

                                <div class="tab-pane active" id="tab_1">
                                    <h3 style="color: tomato!important;"><i class="fa fa-picture-o"
                                                                            style="color: tomato!important;"></i>
                                        Uygulama
                                        Logo Ayarı</h3>
                                    <hr>
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="col-lg-12 onizleme_logo">
                                                    <img src="<?= get_picture("app/logo", "180x180", get_option('app_logo')) ?>"
                                                         alt="" class="img-responsive">
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="file" class="form-control"
                                                           style="border: none!important;" name="file_logo"
                                                           id="file_logo" onchange="onizle('onizleme_logo')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <h3 style="color: tomato!important;"><i class="fa fa-cogs"
                                                                            style="color: tomato!important;"></i>
                                        Uygulama
                                        Favicon Ayarı</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="col-lg-12 onizleme_ico">
                                                <img src="<?= get_picture("app/ico", "16x16", get_option('app_ico')) ?>"
                                                     alt="" class="img-responsive">
                                            </div>
                                            <div class="col-lg-12">

                                                <input type="file" class="form-control"
                                                       style="border: none!important;" name="file_ico"
                                                       id="file_ico" onchange="onizle('onizleme_ico')">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <h3 style="color: tomato!important;"><i class="fa fa-css3"
                                                                            style="color: tomato!important;"></i>
                                        Uygulama
                                        Login ArkaPlan Ayarı</h3>
                                    <hr>
                                    <div class="row">


                                        <div class="col-lg-12">
                                            <div class="col-lg-4">
                                                <div class="col-lg-12 onizleme_login">
                                                    <img src="<?= get_picture("app/login", "2048x1152", get_option('app_login')) ?>"
                                                         alt="" class="img-responsive">
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="file" class="form-control"
                                                           style="border: none!important;" name="file_login"
                                                           id="file_login" onchange="onizle('onizleme_login')">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_4">
                                    <h3 style="color: tomato!important;"><i class="fa fa-crosshairs"
                                                                            style="color: tomato!important;"></i> Genel
                                        Ayarlar</h3>
                                    <hr>
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <label>Uygulama Adı <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="app_name"
                                                   id="app_name"
                                                   value="<?= get_option('app_name'); ?>">
                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Uygulama Kısa Adı <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="app_short_name"
                                                   id="app_short_name"
                                                   value="<?= get_option('app_short_name'); ?>">
                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Uygulama Versiyonu <span
                                                        class="required">*</span></label>
                                            <input type="text" class="form-control" name="version"
                                                   id="version"
                                                   value="<?= get_option('version'); ?>">
                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Hazırlayan</label>
                                            <input type="text" class="form-control" name="author"
                                                   id="author"
                                                   value="<?= get_option('author'); ?>">
                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>E-Posta <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                   value="<?= get_option('email'); ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_5">
                                    <h3 style="color: tomato!important;"><i class="fa fa-crosshairs"
                                                                            style="color: tomato!important;"></i> Bakım
                                        Modu
                                    </h3>
                                    <hr>
                                    <div class="row">


                                        <div class="col-sm-12">
                                            <label>Bakım Modu <span
                                                        class="required">*</span></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control chosen"
                                                            name="under_construction"
                                                            id="under_construction">
                                                        <option value="TRUE" <?= $this->config->item('under_construction') == TRUE ? 'selected' : ''; ?>>
                                                            AÇIK
                                                        </option>
                                                        <option value="FALSE" <?= $this->config->item('under_construction') == FALSE ? 'selected' : ''; ?>>
                                                            KAPALI
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Bakım Modu Mesajı <span class="required">*</span></label>
                                            <textarea name="under_note" class="form-control" id="under_note"
                                                      cols="30"
                                                      rows="5"><?= get_option('under_note'); ?></textarea>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_6">
                                    <h3 style="color: tomato!important;"><i class="fa fa-users"
                                                                            style="color: tomato!important;"></i> Oturum
                                        Ayarları</h3>
                                    <hr>
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <label>Oturum Cookie Adı <span
                                                        class="required">* </span> <a
                                                        href="javascript:void(0);"
                                                        data-id="cookie" class="generate"><i
                                                            class="fa fa-key" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Key Üret"></i></a></label>

                                            <input type="text" class="form-control"
                                                   name="sess_cookie_name" id="sess_cookie_name"
                                                   value="<?= $this->config->item('sess_cookie_name'); ?>">

                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label> Oturum Süresi <span
                                                        class="required">*</span></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control chosen"
                                                            name="sess_expiration"
                                                            id="sess_expiration">
                                                        <?php foreach ($times as $time): ?>
                                                            <option value="<?= $time['value']; ?>" <?= $time['value'] == $this->config->item('sess_expiration') ? 'selected' : ''; ?>><?= $time['label']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Oturum Güncelleme Süresi <span
                                                        class="required">*</span></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control chosen"
                                                            name="sess_time_to_update"
                                                            id="sess_time_to_update">
                                                        <?php foreach ($times as $time): ?>
                                                            <option value="<?= $time['value']; ?>" <?= $time['value'] == $this->config->item('sess_time_to_update') ? 'selected' : ''; ?>><?= $time['label']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_7">
                                    <h3 style="color: tomato!important;"><i class="fa fa-user-secret"
                                                                            style="color: tomato!important;"></i> CSRF
                                        Ayarları</h3>

                                    <hr>
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <label>CSRF Token Adı <span
                                                        class="required">* </span>
                                                <a href="javascript:void(0);" data-id="token"
                                                   class="generate"><i
                                                            class="fa fa-key" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Key Üret"></i></a></label>
                                            <input type="text" class="form-control tooken_key"
                                                   name="csrf_token_name" id="csrf_token_name"
                                                   value="<?= $this->config->item('csrf_token_name'); ?>">

                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>CSRF Cookie Adı <span
                                                        class="required">*</span></label>
                                            <input type="text" class="form-control tooken_key"
                                                   name="csrf_cookie_name" id="csrf_cookie_name"
                                                   value="<?= $this->config->item('csrf_cookie_name'); ?>">

                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>CSRF Süresi <span
                                                        class="required">*</span></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control chosen"
                                                            name="csrf_expire" id="csrf_expire">
                                                        <?php foreach ($times as $time): ?>
                                                            <option value="<?= $time['value']; ?>" <?= $time['value'] == $this->config->item('csrf_expire') ? 'selected' : ''; ?>><?= $time['label']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_8">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 style="color: tomato!important;"><i class="fa fa-picture-o"></i> Tema
                                                Ayarları</h3>

                                            <hr>
                                        </div>


                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-blue-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Blue Light">
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px; background: #367fa9"></span><span
                                                            class="bg-light-blue"
                                                            style="display:block; width: 80%; float: left; height: 20px;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Blue
                                                Light</p>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-gray-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Gray Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#3c4859!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#3c4859!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Gray
                                                Light</p>
                                        </div>



                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-orange-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Orange Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#D66853!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#D66853!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Orange
                                                Light</p>
                                        </div>


                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-purple_2-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Purple_2 Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#59114D!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#59114D!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Purple_2
                                                Light</p>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-pink-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Pink Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#D81E5B!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#D81E5B!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Pink
                                                Light</p>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-plato-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Plato Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#9D8189!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#9D8189!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Plato
                                                Light</p>
                                        </div>


                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-green_2-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Pink Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#6494AA!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#6494AA!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Green_2
                                                Light</p>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-black-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Black Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#2A1F2D!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#2A1F2D!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Black
                                                Light</p>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-green_3-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Pink Light"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#4C6663!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#4C6663!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Green_3
                                                Light</p>
                                        </div>


                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-spanish_gray-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Spanish Gray"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#998DA0!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#998DA0!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Spanish Gray</p>
                                        </div>


                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-blue_sappire-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Blue Sappire"
                                            >
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 20px;   background-color:#005E7C!important;"></span><span
                                                            class="bg-light-gray"
                                                            style="display:block; width: 80%; float: left; height: 20px; background-color:#005E7C!important;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Blue Sappire</p>
                                        </div>


                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-purple-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Purple Light">
                                                <div><span style="display:block; width: 20%; float: left; height: 20px;"
                                                           class="bg-purple-active"></span><span
                                                            class="bg-purple"
                                                            style="display:block; width: 80%; float: left; height: 20px;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Purple
                                                Light</p>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-green-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Green Light">
                                                <div><span style="display:block; width: 20%; float: left; height: 20px;"
                                                           class="bg-green-active"></span><span
                                                            class="bg-green"
                                                            style="display:block; width: 80%; float: left; height: 20px;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Green
                                                Light</p>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-red-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Red Light">
                                                <div><span style="display:block; width: 20%; float: left; height: 20px;"
                                                           class="bg-red-active"></span><span
                                                            class="bg-red"
                                                            style="display:block; width: 80%; float: left; height: 20px;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Red
                                                Light</p>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:void(0)"
                                               data-skin="skin-yellow-light"
                                               style="display: block; box-shadow: 0 0 3px rgba(1,1,1,1)"
                                               class="clearfix full-opacity-hover skins"
                                               data-toggle="tooltip"
                                               data-placement="top" title="Yellow Light">
                                                <div><span style="display:block; width: 20%; float: left; height: 20px;"
                                                           class="bg-yellow-active"></span><span
                                                            class="bg-yellow"
                                                            style="display:block; width: 80%; float: left; height: 20px;"></span>
                                                </div>
                                                <div>
                                                    <span style="display:block; width: 20%; float: left; height: 50px; background: #f9fafc"></span><span
                                                            style="display:block; width: 80%; float: left; height: 50px; background: #f4f5f7"></span>
                                                </div>
                                            </a>
                                            <p class="text-center no-margin" style="font-size: 12px">Yellow
                                                Light</p>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">


                                        <div class="col-sm-12">
                                            <label>Modal Başlık Rengi<span class="required">*</span></label>
                                            <input type="text" class="form-control jscolor"
                                                   name="modal_title_color"
                                                   id="modal_title_color"
                                                   placeholder="Renk"
                                                   value="<?= set_value('modal_title_color', get_option("modal_title_color")); ?>">
                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Modal Başlık Yazı Rengi<span
                                                        class="required">*</span></label>
                                            <input type="text" class="form-control jscolor"
                                                   name="modal_title_font_color" id="modal_title_font_color"
                                                   placeholder="Renk"
                                                   value="<?= set_value('modal_title_font_color', get_option("modal_title_font_color")); ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_9">
                                    <h3 style="color: tomato!important;"><i class="fa fa-code"
                                                                            style="color: tomato!important;"></i> Diğer
                                        Ayarları</h3>

                                    <hr>
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <label> XSS Filtresi <i
                                                        class="required">*</i></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control chosen"
                                                            name="global_xss_filtering"
                                                            id="global_xss_filtering"
                                                            placeholder="Global XSS Filtering">
                                                        <?php
                                                        $global_xss_filtering = $this->config->item('global_xss_filtering');
                                                        ?>
                                                        <option value="TRUE" <?= $global_xss_filtering == TRUE ? 'selected' : ''; ?>>
                                                            EVET
                                                        </option>
                                                        <option value="FALSE" <?= $global_xss_filtering == FALSE ? 'selected' : ''; ?>>
                                                            HAYIR
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix margin-bottom"></div>
                                        <div class="col-sm-12">
                                            <label>Şifreleme Anahtarı <span
                                                        class="required">*</span> <a
                                                        href="javascript:void(0);"
                                                        data-id="key" class="generate"><i
                                                            class="fa fa-key" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Key Üret"></i></a></label>
                                            <input type="text" class="form-control"
                                                   name="encryption_key" id="encryption_key"
                                                   value="<?= $this->config->item('encryption_key'); ?>">

                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_10">
                                    <h3 style="color: tomato!important;"><i class="fa fa-folder"
                                                                            style="color: tomato!important;"></i> Dosya
                                        Ayarları</h3>

                                    <hr>
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <label> Dosya Upload İşlemi <i
                                                        class="required">*</i></label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-control chosen"
                                                            name="ft_folder_status"
                                                            id="ft_folder_status"
                                                            placeholder="Dosya Upload İşlemi">
                                                        <option value="1" <?= get_option("ft_folder_status") == 1 ? 'selected' : ''; ?>>
                                                            Dosya Yükleme Açık
                                                        </option>
                                                        <option value="0" <?= get_option("ft_folder_status") == 0 ? 'selected' : ''; ?>>
                                                            Dosya Yükleme Kapalı
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>

                    <div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
                            Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>
                </div>

                <div class="box-footer">
                    <button class="btn btn-flat btn-bitbucket btn_save btn_action" id="btn_save"
                            data-stype='stay' data-toggle="tooltip" data-placement="top" title="Kaydet">
                        <i
                                class="fa fa-save"></i> Kaydet
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.loading').hide();

        CKEDITOR.replace('under_note', {
            toolbarGroups: [
                {"name": "basicstyles", "groups": ["basicstyles"]},
                {"name": "links", "groups": ["links"]},
                {"name": "paragraph", "groups": ["list", "blocks"]},
                {"name": "document", "groups": ["mode"]},
                {"name": "insert", "groups": ["insert"]},
                {"name": "styles", "groups": ["styles"]},
            ],
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
        });


        $(".chosen").chosen({
            width: "100%"
        });


        $('.generate').click(function () {
            $('.loading').show();
            var data_id = $(this).attr("data-id");
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'cms/setting/generate_key',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },

                success: function (res) {

                    if (data_id == "key") {
                        $('.loading').hide();
                        $('#encryption_key').val(res);
                    } else if (data_id == "cookie") {
                        $('.loading').hide();
                        $('#sess_cookie_name').val(res);
                    } else if (data_id == "token") {
                        $('.loading').hide();
                        $('.tooken_key').val(res);
                    }

                }
            });
        });


        $('.btn_save').click(function () {
            $('.loading').show();
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();

            var form = $('#form_setting')[0];

            var data = new FormData(form);

            data.append('file_login', file_login);
            data.append('file_logo', file_logo);
            data.append('file_ico', file_ico);


            $.ajax({
                url: BASE_URL + '/cms/setting/save',
                type: 'POST',
                dataType: 'json',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,

            })
                .done(function (res) {

                    if (res.result) {
                        $.notify(res.message, 'success');

                    } else {
                        $.notify(res.message, 'error');
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Veriler kaydedilemedi.', 'error');

                })
                .always(function () {
                    $('.loading').hide();

                });

            return false;
        });

        $('.skins').click(function () {
            $('.loading').show();
            var data_post = $(this).attr("data-skin");

            var post_data = {
                'theme': data_post,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            };

            $.ajax({
                url: BASE_URL + '/cms/setting/theme_save',
                type: 'POST',
                dataType: 'json',
                data: post_data,
            })
                .done(function (res) {

                    if (res.result) {
                        window.location.href = res.redirect
                        return;
                    } else {
                        window.location.href = res.redirect
                        return;
                        ;
                    }
                })
                .fail(function () {
                    $.notify('Bir hata oluştu. Lütfen tekrar deneyiniz.', 'error');
                })
                .always(function () {
                    $('.loading').hide();
                });
            return false;
        });

        $('.open_email_modal').click(function () {
            var id = $(this).attr('data_value');
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'cms/setting/email_modal',
                data: {
                    'id': id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },

                success: function (res) {
                    $('.submit').html('<button type="button" class="btn btn-warning" onclick="submit();"><i class="fa fa-edit"></i> Güncelle</button>');
                    $('#modal-default').modal({backdrop: 'static', keyboard: false});
                    $('.modal-title').html("E-Posta Template Güncelleme");
                    $('.modal-body').html(res);
                    $('.modal-dialog').addClass('modal-lg');


                }
            });


        })


    });


</script>