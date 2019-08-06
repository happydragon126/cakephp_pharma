<?php $videoHelper = MooCore::getInstance()->getHelper('Video_Video'); ?>
<div class="comment_message">
    <?php echo $this->viewMore(h($activity['Activity']['content']), null, null, null, true, array('no_replace_ssl' => 1)); ?>
    <?php if(!empty($activity['UserTagging']['users_taggings'])) $this->MooPeople->with($activity['UserTagging']['id'], $activity['UserTagging']['users_taggings']); ?>
</div>
<div class="share-content">
    <?php
    $activityModel = MooCore::getInstance()->getModel('Activity');
    $parentFeed = $activityModel->findById($activity['Activity']['parent_id']);
    $video = MooCore::getInstance()->getItemByType($parentFeed['Activity']['item_type'], $parentFeed['Activity']['item_id']);
    ?>
    <div class="activity_feed_content">
        <?php echo $this->Moo->getName($parentFeed['User']) ?>
        <?php
        $subject = MooCore::getInstance()->getItemByType($parentFeed['Activity']['type'], $parentFeed['Activity']['target_id']);
        $name = key($subject);
        ?>
        
        <?php 
        $bFeeling = false;
        if (Configure::check('Feeling.feeling_enabled') && Configure::read('Feeling.feeling_enabled')): 
            $oFeelingActivityModel = MooCore::getInstance()->getModel('Feeling.FeelingActivity');
            $aFeeling = $oFeelingActivityModel->get_felling($parentFeed['Activity']);
            if(!empty($aFeeling)):
                $oCategoryModel = MooCore::getInstance()->getModel('Feeling.FeelingCategory');
                $aCategory = $oCategoryModel->findById($aFeeling['Feeling']['category_id']);
                if (!empty($aCategory)) :
                    $bFeeling = true;
                endif;
            endif; 
        endif; 
        ?>
        
        <?php if ($parentFeed['Activity']['target_id']): ?>
            <?php $show_subject = MooCore::getInstance()->checkShowSubjectActivity($subject); ?>
            <?php if ($show_subject): ?>
                &rsaquo; <a href="<?php echo $subject[$name]['moo_href'] ?>"><?php echo h($subject[$name]['moo_title']) ?></a>
            <?php elseif (!$bFeeling): ?>
                <?php echo __('shared a new video'); ?>
            <?php endif; ?>
        <?php elseif (!$bFeeling): ?>
            <?php echo __('shared a new video'); ?>
        <?php endif; ?>
        <div class="feed_time">
            <span class="date"><?php echo $this->Moo->getTime($parentFeed['Activity']['created'], Configure::read('core.date_format'), $utz) ?></span>
        </div>
    </div>
    <div class="clear"></div>
    
    <div class="activity_feed_content_text">
        <?php if (!empty($parentFeed['Activity']['content'])): ?>
        <div class="">
            <?php echo $this->viewMore(h($parentFeed['Activity']['content']), null, null, null, true, array('no_replace_ssl' => 1)); ?>
            <?php if(!empty($parentFeed['UserTagging']['users_taggings'])): $this->MooPeople->with($parentFeed['UserTagging']['id'], $parentFeed['UserTagging']['users_taggings']); endif;?>
        </div>
        <?php endif; ?>
        <div class="video-feed-content">
            <?php echo $this->element('Video./video_snippet', array('video' => $video)); ?>
        </div>
        <div class="video-feed-info video_feed_content">
            <div class="video-title">
                <a class="feed_title" href="<?php if (!empty($video['Video']['group_id'])): ?><?php echo $this->request->base ?>/groups/view/<?php echo $video['Video']['group_id'] ?>/video_id:<?php echo $video['Video']['id'] ?><?php else: ?><?php echo $this->request->base ?>/videos/view/<?php echo $video['Video']['id'] ?>/<?php echo seoUrl($video['Video']['title']) ?><?php endif; ?>">
                    <?php echo h($video['Video']['title']) ?>
                </a>
            </div>
            <div class="video-description comment_message feed_detail_text">
                <?php echo $this->Text->convert_clickable_links_for_hashtags($this->Text->truncate(strip_tags(str_replace(array('<br>', '&nbsp;'), array(' ', ''), $video['Video']['description'])), 200, array('exact' => false)), Configure::read('Video.video_hashtag_enabled')) ?>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>