<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h1 class="box-title" style="color: tomato"><i
                            class="fa fa-list-alt"></i> Sorgu Sonucu</h1>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <?php foreach ($field_name as $field): ?>
                                <th><?= ucwords(str_replace(['_', '-'], ' ', $field)); ?></th>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($query->result() as $row): ?>
                            <tr>
                                <?php foreach ($field_name as $field){ ?>
                                    <td><?= $row->{$field}; ?></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


