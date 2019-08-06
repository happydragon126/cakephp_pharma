<script>
    $(document).ready(function () {
        $('#everyone').click(function () {
            if ($('#everyone').is(':checked'))
            {
                $('#permission_list li').hide();
                $('#permission_list li').first().show();
            }
            else
                $('#permission_list li').show();
        });
        $('#createButton').click(function () {
            checked = false;
            $('#permission_list :checkbox').each(function () {
                if ($(this).is(':checked'))
                    checked = true;
            })

            if (!checked)
            {
                $(".error-message").show();
                $('.error-message').html('<?php echo __d('question','Please check at least one user role in the Permissions tab');?>');
                return;
            }

            disableButton('createButton');
            $.post("<?php echo  $this->request->base ?>/admin/question/question_categories/save", $("#createForm").serialize(), function (data) {
                enableButton('createButton');
                var json = $.parseJSON(data);

                if (json.result == 1)
                    location.reload();
                else
                {
                    $(".error-message").show();
                    $(".error-message").html(json.message);
                }
            });

            return false;
        });

        $('#type').change(function () {
            mooAjax.post({
                url: '<?php echo  $this->request->base ?>/admin/categories/load_parent_categories/' + $('#type').val(),
            }, function (data) {
                
                $('#parent_id').html(data);
            });
        });
    });

    function toggleField()
    {
        $('.opt_field').toggle();
    }
</script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?php echo __d('question','Add a new Category');?></h4>
</div>
<div class="modal-body">
    <form id="createForm" class="form-horizontal" role="form">
        <?php echo $this->Form->hidden('id', array('value' => $category['Category']['id'])); ?>
        <div class="form-body">
            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo __d('question','Name');?></label>
                <div class="col-md-9">
                    <?php echo $this->Form->text('name', array('placeholder' => __d('question','Enter text'), 'class' => 'form-control', 'value' => $category['Category']['name'])); ?>

                </div>
                <?php if (!$bIsEdit) : ?>
                    <div class="tips" style="margin-left: 165px;">*<?php echo  __d('question','You can add translation phrase after creating category') ?></div>
                <?php else : ?>
                    <div class="tips" style="margin-left: 165px;">
                        <a href="<?php echo  $this->request->base ?>/admin/categories/ajax_translate/<?php echo  $category['Category']['id'] ?>"  data-toggle="modal" data-target="#ajax-translate" ><?php echo  __d('question','Translation') ?></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->hidden('type', array('value' => 'Question')); ?>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo __d('question','Header');?></label>
                <div class="col-md-9">
                    <div class="checkbox-list">
                        <label class="checkbox-inline">
                            <?php echo $this->Form->checkbox('header', array('checked' => $category['Category']['header'], 'onclick' => 'toggleField()', 'id' => 'cat_header')); ?>
                            <span class="help-block">
                                <?php echo __d('question','Category header is top level category<br />which does not allow items to be posted');?>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group opt_field <?php if ($category['Category']['header']): ?>hide<?php endif; ?>">
                <label class="col-md-3 control-label"><?php echo __('Parent Category');?></label>
                <div class="col-md-9">
                    <?php echo $this->Form->select('parent_id', $headers, array('class' => 'form-control', 'value' => $category['Category']['parent_id'], 'empty' => false)); ?>

                </div>
            </div>
            <div class="form-group opt_field <?php if ($category['Category']['header']): ?>hide<?php endif; ?>">
                <label class="col-md-3 control-label"><?php echo __d('question','Description');?></label>
                <div class="col-md-9">
                    <?php echo $this->Form->textarea('description', array('class' => 'form-control', 'value' => $category['Category']['description'])); ?>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo __d('question','Active');?></label>
                <div class="col-md-9">
                    <div class="checkbox-list">
                        <label class="checkbox-inline">
                            <?php echo $this->Form->checkbox('active', array('checked' => $category['Category']['active'])); ?>

                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <h4><?php echo __d('question','Post Permission');?></h4>
            <?php echo $this->element('admin/permissions', array('permission' => $category['Category']['create_permission'])); ?>
        </div>
    </form>
    <div class="alert alert-danger error-message" style="display:none;margin-top:10px;">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal"><?php echo  __d('question','Close') ?></button>
    <a href="#" id="createButton" class="btn btn-action"><?php echo  __d('question','Save') ?></a>

</div>