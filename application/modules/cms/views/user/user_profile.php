<?= breadcrumbs("Kullanıcı Profili", "fa-user", array("Kullanıcılar", "Profil")) ?>

<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-body box-profile">

                    <a class="fancybox" rel="group"
                       href="<?= get_picture("user", "base", $user->avatar) ?>">
                        <img class="profile-user-img img-responsive img-circle"
                             src="<?= get_picture("user", "base", $user->avatar); ?>"
                             alt="<?= $user->full_name ?>">
                    </a>


                    <h3 class="profile-username text-center"><?= _htmlent(ucwords($user->full_name)); ?></h3>
                    <h3 class="profile-username text-center"><?= _htmlent(ucwords($user->name)); ?></h3>
                    <p class="text-muted text-center"><?= _htmlent($user->email); ?></p>
                    <p class="text-muted text-center"><?= _htmlent($user->birim_adi); ?></p>
                    <ul class="list-group list-group-unbordered">
                        <?php foreach ($this->aauth->get_user_groups($user->id) as $row): ?>
                            <li class="list-group-item">
                                <a href="#"><i class="fa fa-chevron-right"></i> <?= $row->name; ?></a></li>
                        <?php endforeach; ?>

                    </ul>
                    <div class="row-fluid col-md-12">


                        <a class="btn btn-flat btn-info btn-warning btn_edit btn_action" id="btn_edit"
                           data-stype='back' title="edit user"
                           href="<?= site_url('cms/user/password_edit'); ?>"><i class="fa fa-edit"></i>
                            Parola Güncelle</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detay</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="nav nav-stacked">
                        <li><a href="#"><i class='fa fa-shield color-orange'></i> Durum
                                <?php if ($user->banned) : ?>
                                <span class="pull-right badge bg-red">Pasif</span></a>
                            <?php else: ?>
                                <span class="pull-right badge bg-blue">Aktif</span></a>
                            <?php endif; ?>
                        </li>
                        <li><a href="#"><i class='fa  fa-safari  color-orange'></i> Son Giriş <span
                                        class="pull-right "><?= _htmlent($user->last_login); ?></span></a></li>
                        <li><a href="#"><i class='fa fa-history color-orange'></i> Son Aktivite <span
                                        class="pull-right "><?= _htmlent($user->last_activity); ?></span></a></li>
                        <li><a href="#"><i class='fa fa-chrome color-orange'></i> IP Adres <span
                                        class="pull-right "><?= _htmlent($user->ip_address); ?></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    $(document).ready(function () {
        $('.fancybox').fancybox();
    });

</script>





