<script>
    $(document).on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal');
    });
    $(document).ready(function() {

        $('#tCreateButton').click(function() {

            disableButton('tCreateButton');
            $.post("<?php echo $this->Html->url(array('plugin' => 'feeling', 'controller' => 'feelings', 'action' => 'admin_ajax_translate_save')); ?>", $("#tCreateForm").serialize(), function(data) {
                enableButton('tCreateButton');
                var json = $.parseJSON(data);

                if (json.result == 1){
                    window.location.reload();
                }
                else
                {
                    $(".error-message").show();
                    $(".error-message").html('<strong>Error!</strong>' + json.message);
                }
            });

            return false;
        });


    });

</script>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?php echo  __("Translation") ?></h4>
</div>
<div class="modal-body">
    <form id="tCreateForm" class="form-horizontal" role="form">
        <?php echo $this->Form->hidden('id', array('value' => $feeling['Feeling']['id'])); ?>
        <?php foreach ($languages as $key => $language) : ?>
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo $language; ?></label>
                    <div class="col-md-9">
                        <?php
                        foreach ($feeling['labelTranslation'] as $translation)
                        {
                            if ($translation['locale'] == $key)
                            {
                                echo $this->Form->text('label.' . $key, array('placeholder' => 'Enter text', 'class' => 'form-control', 'value' => $translation['content']));
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
<?php endforeach; ?>

    </form>

    <div class="alert alert-danger error-message" style="display:none;margin-top:10px;">

    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal"><?php echo __('Close');?></button>
    <a href="#" id="tCreateButton" class="btn btn-action"><?php echo __('Save Change');?></a>

</div>