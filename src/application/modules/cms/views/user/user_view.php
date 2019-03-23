
<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/fancy-box/source/jquery.fancybox.css?v=2.1.5") ?>">

<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>
<script src="<?= cms_theme_assets_folder("plugins/fancy-box/source/jquery.fancybox.js?v=2.1.5") ?>"></script>

<a class="fancybox" rel="group"
   href="<?= get_user_picture("user", "350x217", $user->avatar, $user->gender) ?>">
    <img class="profile-user-img img-responsive img-circle"
         src="<?= get_user_picture("user", "70x70", $user->avatar, $user->gender); ?>"
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

<script>

    $(document).ready(function () {
        $('.fancybox').fancybox();
    });

</script>
