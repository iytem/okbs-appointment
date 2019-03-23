<div class="row">
    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="40">#</th>
                        <th>Yedek Adı</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $dir = FCPATH . "storage/backup/db/";
                    $url = base_url("storage/backup/db/");
                    if (is_dir($dir)) {
                        if ($handle = opendir($dir)) {

                            while (($file = readdir($handle)) !== false) {
                                if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store") {
                                    echo ' <tr>
                                             <td><i class="fa fa-database fa-2x" style="color: tomato"></i></td>
                                             <td><a target="_blank" href="' . $url . $file . '">' . $file . '</a></td>
                                      <td><a  href="javascript:void(0)" onclick="db_backup_delete(\'db\' ,\''   . $file . '\');" ><i class="fa fa-trash-o fa-2x text-red"></i></a></td>
                                            </tr>';
                                }

                            }
                            closedir($handle);
                        }
                    }


                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-solid">
            <div class="box-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="40">#</th>
                        <th>Kullanıcı Aktivitileri ve Uygulama Logları Yedek Adı</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $dir = FCPATH . "storage/backup/log_deleted_before/";
                    $url = base_url("storage/backup/log_deleted_before/");
                    if (is_dir($dir)) {
                        if ($handle = opendir($dir)) {

                            while (($file = readdir($handle)) !== false) {
                                if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store") {
                                    echo ' <tr>
                                             <td><i class="fa fa-database fa-2x" style="color: tomato"></i></td>
                                             <td><a target="_blank" href="' . $url . $file . '">' . $file . '</a></td>
                                                 <td><a  href="javascript:void(0)" onclick="db_backup_delete(\'log\' ,\''  . $file . '\');" ><i class="fa fa-trash-o fa-2x text-red"></i></a></td>
                                            </tr>';
                                }

                            }
                            closedir($handle);
                        }
                    }


                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
