<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Access_group extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model([
            'model_group_access',
            'model_group'
        ]);

        $this->is_allowed("yetki-islemleri");
    }

    public function index($offset = 0)
    {


        $this->data['groups'] = $this->model_group->get_all();


        $this->template->write('title', 'Yetki İşlemleri', TRUE);
        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");
        $this->template->add_css("assets/cms/default/plugins/iCheck/all.css");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");
        $this->template->add_js("assets/cms/default/plugins/iCheck/icheck.js");
        $this->template->write_view('content', 'access/access_group_list', $this->data, TRUE);
        $this->template->render();

    }

    public function save()
    {

        $permissions = $this->input->post('id');
        $group_id = $this->input->post('group_id');

        $this->db->delete('cms_aauth_perm_to_group', ['group_id' => $group_id]);
        if (@count($permissions)) {
            $data = [];
            foreach ($permissions as $perms) {
                $data[] = [
                    'perm_id' => $perms,
                    'group_id' => $group_id,
                ];
            }
            $save_access = $this->db->insert_batch('cms_aauth_perm_to_group', $data);
        } else {
            $save_access = true;
        }

        if ($save_access) {
            $this->data = array(
                'result' => true,
                'message' => "Grup Erişim izni başarıyla kaydedildi",

            );
        } else {
            $this->data = array(
                'result' => true,
                'message' => "Bir hata oluştu. Grup Erişim İzni Kaydedilemedi."

            );

        }

        return $this->response($this->data);
    }

    public function get_access_group($group_id)
    {

        $group_perms_groupping = [];

        $group_perms = $this->model_group->get_permission_group($group_id);
        foreach (db_get_all_data('cms_aauth_perms',"","definition","asc") as $perms) {

            $group_name = 'other';
            $perm_tmp_arr = explode('_', $perms->name);

            if (isset($perm_tmp_arr[0]) AND !empty($perm_tmp_arr[0])) {
                $group_name = strtolower($perm_tmp_arr[0]);
            }
            $group_perms_groupping[$group_name][] = $perms;
        }
        ob_start();
        ?>

        <h1 style="background-color: #dd4b39;color: #ffffff"><?= $this->model_group_access->get_group_name($group_id) ?>
            Grubu Yetki Listesi</h1>
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <td width="40"></td>
                <th>Yetki Kısa Adı</th>
                <th>Yetki Adı</th>
                <th>Yetki Açıklaması</th>

            </tr>
            <?php

            foreach ($group_perms_groupping as $group_name => $childs) { ?>


                <?php
                $i = 0;
                foreach ($childs as $perms) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="flat-red check <?= $group_name; ?>" name="id[]"
                                   value="<?= $perms->id; ?>" <?= array_search($perms->id, $group_perms) ? 'checked' : ''; ?>>
                        </td>
                        <td>
                            <?= _htmlent($perms->name); ?>
                        </td>
                        <td>
                            <?= _htmlent(ucwords(clean_snake_case($perms->name))); ?>
                        </td>
                        <td>
                            <?= _htmlent(ucwords(clean_snake_case($perms->definition))); ?>
                        </td>


                    </tr>

                <?php }
            } ?>
        </table>
        </div>
        <?php
    }
}


