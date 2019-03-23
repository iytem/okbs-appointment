<style>
    p img {
        display: block;
        max-width: 100%;
        height: auto
    }

    p iframe {
        display: block;
        max-width: 100%;
        height: 300px;
    }
</style>
<?php
$popup = get_popup($this->uri->segment(1));
if ($popup):

    foreach ($popup as $row):
        $popup_cookie = get_cookie($row->popup_token_key);
        if ($popup_cookie != "true"):
            ?>

            <div class="modal fade popup_modal" id="modal-default">
                <div class="modal-dialog" style="margin-top: 50px">
                    <div class="modal-content">
                        <div class="modal-header"
                             style="background-color: <?= '#' . get_option('modal_title_color') ?>;color: <?= '#' . get_option('modal_title_font_color') ?>">

                            <button type="button" class="btn btn-default pull-right dont_show btn-sm"
                                    style="background-color: #<?= get_option("modal_title_color") ?>!important;color:#<?= get_option("modal_title_font_color") ?>!important; "
                                    data-dismiss="modal"
                                    data-toggle="tooltip"
                                    data-url="<?= base_url("cms/popup/dont_show") ?>"
                                    data-id="<?= $row->popup_token_key ?>"
                                    data-csrf-key="<?= $this->security->get_csrf_token_name() ?>"
                                    data-csrf-value="<?= $this->security->get_csrf_hash() ?>"
                                    data-placement="top" title="Bir Daha Gösterme"><i class="fa fa-close"></i>
                            </button>
                            <h4 class="modal-title"><?= $row->title ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><?= $row->description ?></p>
                        </div>

                    </div>
                </div>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    $(document).ready(function () {
        $('.popup_modal').modal("show");

    })
</script>
