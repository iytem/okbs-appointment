<link rel="stylesheet" href="<?= cms_theme_assets_folder("plugins/chosen/chosen.css")?>">
<script type="text/javascript" src="<?= cms_theme_assets_folder("plugins/chosen/chosen.jquery.js")?>"></script>



<div class="col-sm-12">
    <label for="">Alan Adı</label>
    <select class="form-control chosens" name="field_name" id="field_name"
            tabi-ndex="5" data-placeholder="Seçiniz" multiple="">
        <option value="">Alan Seçiniz</option>
        <?php
        $fields = $this->db->list_fields($table_name);
        foreach ($fields as $field)
        {
            echo '<option value="'.$field.'">'.$field.'</option>';
        }
        ?>
    </select>

</div>

<script>
    $(document).ready(function () {
        $(".chosens").chosen({
            width: "100%"
        });
    })
</script>