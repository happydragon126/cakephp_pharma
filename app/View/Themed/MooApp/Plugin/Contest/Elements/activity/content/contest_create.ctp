<?php
$item = $object;
$helper = MooCore::getInstance()->getHelper('Contest_Contest');
?>
<?php if (!empty($activity['Activity']['content'])): ?>
    <div class="comment_message">
        <?php echo $this->viewMore(h($activity['Activity']['content']),null, null, null, true, array('no_replace_ssl' => 1)); ?>
    </div>
<?php endif; ?>

<div class="activity_item blog_feed">

    <div class="activity_left">
        <a href="<?php echo  $item[key($item)]['moo_href'] ?>">
            <img class="thum_activity" src="<?php echo $this->request->webroot ?>theme/<?php echo $this->theme ?>/img/s.png" style="background-image:url(<?php echo  $helper->getImage($item, array()) ?>)" />
        </a>
    </div>
    <div class="activity_right ">
        <div class="activity_header">
            <a href="<?php echo  $item[key($item)]['moo_href'] ?>"><?php echo  htmlspecialchars($item[key($item)]['moo_title']) ?></a>
        </div>
       <?php echo  $this->Text->convert_clickable_links_for_hashtags($this->Text->truncate(strip_tags(str_replace(array('<br>', '&nbsp;'), array(' ', ''), $item[key($item)]['description'])), 200, array('exact' => false)), Configure::read('Contest.contest_hashtag_enabled')) ?>
    </div>
    <div class="clear"></div>
</div>