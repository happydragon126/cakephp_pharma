
    <?php if (!empty($is_profile_page)): ?>
       
        <?php echo $this->element('user/header_profile'); ?>
    <?php endif; ?>
     <div class="main_content">
        <?php if( !$this->isEmpty('east') ): ?>
        <div id="right"  class="sl-rsp-modal col-md-4 pull-right">
            <div class="visible-xs visible-sm closeButton">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> <span class="sr-only">Close</span></button>
            </div>
            <?php echo $east; ?>
        </div>
        <?php endif; ?>
        <div id="center" <?php if( !$this->isEmpty('east')): echo 'class="col-md-8"'; 
                               endif; ?>>
        <?php echo $center; ?>
        </div>
    


<div class="clear"></div>
</div>
<?php if( !$this->isEmpty('south') ): ?>
<?php echo $south; ?>
 <?php endif; ?>

