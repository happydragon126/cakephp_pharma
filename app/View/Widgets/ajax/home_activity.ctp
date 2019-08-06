<?php if($this->request->is('ajax')):?>
<script type="text/javascript">
    require(["jquery","mooTab"], function($,mooTab) {$(document).ready(function(){
        mooTab.initActivitySwitchTabs();
    });
</script>
<?php else: ?>
<?php $this->Html->scriptStart(array('inline' => false, 'domReady' => true, 'requires'=>array('jquery','mooTab'), 'object' => array('$', 'mooTab'))); ?>
mooTab.initActivitySwitchTabs();
<?php $this->Html->scriptEnd(); ?>
<?php endif; ?>

<?php if(!$this->request->is('ajax')):?>
<div class="p_l_7 home_content_feed">
    <div id="home-content">
<?php endif;?>
        <?php if ( empty( $tab ) ): ?>
        <div class="p_l_7 check-home">
            <?php
            if(isset($title_enable)&&($title_enable)=== "") $title_enable = false; else $title_enable = true;
            ?>
            <div class="mo_breadcrumb">
                <?php if ( !empty( $uid ) || ( empty( $uid ) && !Configure::read('core.hide_activites') ) ): ?>
                <?php if($title_enable): ?>
                    <h1><?php echo __("What's New")?></h1>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ( !empty( $uid ) && Configure::read('core.feed_selection') ): ?>
                <ul class="list7 header-list" id="feed-type">
                    <li><a href="#" data-href="<?php echo $this->request->base?>/activities/ajax_browse/everyone" <?php if ( isset($activity_feed) && $activity_feed == 'everyone' ) echo 'class="current"'; ?>><?php echo __('Everyone')?></a></li>
                    <li><a href="#" data-href="<?php echo $this->request->base?>/activities/ajax_browse/friends" <?php if ( isset($activity_feed) && $activity_feed == 'friends' ) echo 'class="current"'; ?>><?php echo __('Friends & Me')?></a></li>
                    <li><a href="#" data-href="<?php echo $this->request->base?>/activities/ajax_browse/region" <?php if ( isset($activity_feed) && $activity_feed == 'region' ) echo 'class="current"'; ?>><?php echo __('My Region Only')?></a></li>
                    <li><a href="#" data-href="<?php echo $this->request->base?>/activities/ajax_browse/jobarea" <?php if ( isset($activity_feed) && $activity_feed == 'job_area' ) echo 'class="current"'; ?>><?php echo __('My Job Area Only')?></a></li>
                </ul>
                <?php endif; ?>
            </div>
            <?php $this->MooActivity->wall($homeActivityWidgetParams)?>
        </div>
        <?php else: ?>
         <?php echo __('Loading...')?>
        <?php endif; ?>
<?php if(!$this->request->is('ajax')):?>        
    </div>
</div>
<?php endif;?>