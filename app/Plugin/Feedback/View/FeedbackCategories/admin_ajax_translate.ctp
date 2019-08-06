<script>
    function Translate(url) {
        disableButton('tCreateButton');
        $.post(url, $("#tCreateForm").serialize(), function(data) {
        enableButton('tCreateButton');
                var json = $.parseJSON(data);
                if (json.result == 1)
                location.reload();
                else
        {
        $(".error-message").show();
                $(".error-message").html('<strong>Error!</strong>' + json.message);
        }
        });
        return false;
    }
</script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?php echo  __d('feedback', "Translation") ?></h4>
</div>
<div class="modal-body">
    <form id="tCreateForm" class="form-horizontal" role="form">
        <?php echo $this->Form->hidden('id', array('value' => $category['FeedbackCategory']['id'])); ?>
        <?php foreach ($languages as $key => $language) : ?>
            <?php $lval = ""; ?>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo $language; ?></label>
                    <div class="col-md-9">
                        <?php foreach ($category['nameTranslation'] as $translation) : ?>
                            <?php if ($translation['locale'] == $key) : ?>
                                <?php $lval = $translation['content'];
                                break; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php echo $this->Form->text('name.' . $key, array('placeholder' => 'Enter text', 'class' => 'form-control', 'value' => $lval)); ?>
                    </div>
                </div>
            </div>
<?php endforeach; ?>

    </form>

    <div class="alert alert-danger error-message" style="display:none;margin-top:10px;">

    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
    <a href="#" id="tCreateButton" onclick='Translate("<?php echo  $this->request->base; ?>/admin/feedback/feedback_categories/ajax_translate_save")' class="btn btn-action">Save Change</a>
</div>