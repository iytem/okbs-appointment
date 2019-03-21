<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css") ?>">


<script src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js") ?>"></script>


<?= form_open(base_url('cms/user/edit_save/' . $user->id), [
    'name' => 'form_user',
    'class' => 'form-horizontal',
    'id' => 'form_user',
    'enctype' => 'multipart/form-data',
    'method' => 'POST'
]); ?>



<div class="form-group ">
    <label for="email" class="col-sm-6">Adı Soyadı <i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Adı Soyadı"
               value="<?= set_value('full_name', $user->full_name); ?>">
    </div>
</div>


<div class="form-group ">
    <label for="email" class="col-sm-6">E-Posta Adresi<i class="required">*</i></label>
    <div class="col-sm-12">
        <input type="text" class="form-control" name="email" id="email" placeholder="E-Posta Adresi"
               value="<?= set_value('email', $user->email); ?>">
    </div>
</div>


<div class="form-group ">
    <label for="content" class="col-sm-3">Cinsiyet <i class="required">*</i></label>

    <div class="col-sm-12">
        <select class="form-control chosen" name="gender" id="gender" tabi-ndex="5"
                placeholder="Seçiniz">
            <option value=""></option>
            <option value="1" <?= $user->gender == 1 ? "selected" : "" ?>>Bay</option>
            <option value="2" <?= $user->gender == 2 ? "selected" : "" ?>>Bayan</option>
        </select>
    </div>
</div>

<div class="form-group ">
    <label for="content" class="col-sm-3">Birim <i class="required">*</i></label>

    <div class="col-sm-12">
        <select class="form-control chosen" name="user_birim" id="user_birim"
                tabi-ndex="5" data-placeholder="Seçiniz">
            <option value=""></option>
            <?php foreach (db_get_all_data('okbs_birim', ['birim_durum' => 1]) as $row): ?>
                <option value="<?= $row->birim_id; ?>" <?= $row->birim_id==$user->user_birim?"selected":""?>><?= ucwords($row->birim_adi); ?></option>
            <?php endforeach; ?>
        </select>


    </div>
</div>



<div class="form-group ">
    <label for="content" class="col-sm-3">Gruplar <i class="required">*</i></label>

    <div class="col-sm-12">
        <select class="form-control chosen" name="group[]" id="group" tabi-ndex="5" multiple
                placeholder="Seçiniz">
            <?php foreach (db_get_all_data('cms_aauth_groups') as $row): ?>
                <option <?= array_search($row->id, $group_user) !== false ? 'selected="selected"' : ''; ?>
                        value="<?= $row->id; ?>"><?= ucwords($row->name); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group ">
    <label for="password" class="col-sm-3">Parola <i class="required">*</i></label>

    <div class="col-sm-12">
        <div class="input-group col-md-12 input-password">
            <input type="password" class="form-control password" name="password" id="password"
                   placeholder="Parola" value="<?= set_value('password'); ?>">
            <span class="input-group-btn" style="border-left: 1px solid #d5d5d5">
                              <button type="button" class="btn btn-flat show-password"><i
                                          class="fa fa-eye eye"></i></button>
                            </span>
        </div>
    </div>
</div>

<?= form_close(); ?>

<div class="loading"><img src="<?= cms_theme_assets_folder("img/loading.svg"); ?>"> <i>Lütfen
        Bekleyiniz. İşleminiz Gerçekleştiriliyor.</i></div>
<script>
    $(document).ready(function () {
        $('.loading').hide();
        $(".chosen").chosen({
            width: "100%"
        });

        $('.input-password').each(function (index, el) {
            var eye = $(this).parent().parent().find('.eye');
            $(this).find('.show-password').mousedown(function () {
                $(this).parent().parent().find('.password').attr('type', 'text');
                eye.addClass('fa-eye-slash');
                eye.removeClass('fa-eye');
            });
            $(this).find('.show-password').mouseup(function () {
                $(this).parent().parent().find('.password').attr('type', 'password');
                eye.removeClass('fa-eye-slash');
                eye.addClass('fa-eye');
            });
        });

    });
</script>