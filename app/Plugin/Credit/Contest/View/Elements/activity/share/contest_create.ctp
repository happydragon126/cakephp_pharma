<?php
$item = $object;
$helper = MooCore::getInstance()->getHelper('Contest_Contest');
?>

<div class="activity_feed_image">
    <?php echo $this->Moo->getItemPhoto(array('User' => $item['User']), array('prefix' => '50_square'), array('class' => 'img_wrapper2 user_avatar_large')) ?>
</div>
<div class="activity_feed_content">
    <div class="comment">
        <div class="activity_text">
            <?php echo $this->Moo->getName($item['User']) ?>
            <?php echo __d('contest', 'posted a new contest'); ?>
        </div>

        <div class="parent_feed_time">
            <span class="date"><?php echo $this->Moo->getTime($item[key($item)]['created'], Configure::read('core.date_format'), $utz) ?></span>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="activity_feed_content_text">
    <div class="activity_left">
        <a href="<?php echo $item[key($item)]['moo_href'] ?>">
            <img src="<?php echo $helper->getImage($item, array('prefix' => '150_square')) ?>" class="img_wrapper2" />
        </a>
    </div>
    <div class="activity_right ">
        <a class="feed_title" href="<?php echo $item[key($item)]['moo_href'] ?>"><?php echo htmlspecialchars($item[key($item)]['moo_title']) ?></a>
        <div class="comment_message feed_detail_text">
            <?php echo $this->Text->convert_clickable_links_for_hashtags($this->Text->truncate(strip_tags(str_replace(array('<br>', '&nbsp;'), array(' ', ''), $item[key($item)]['description'])), 200, array('exact' => false)), Configure::read('Contest.contest_hashtag_enabled')) ?>

        </div>
    </div>
</div>
