<?php
$quizHelper = MooCore::getInstance()->getHelper('Quiz_Quiz');
$oQuizModel = MooCore::getInstance()->getModel('Quiz.Quiz');
$aQuiz = $oQuizModel->findById($activity['Activity']['parent_id']);
?>

<div class="comment_message">
    <?php echo $this->viewMore(h($activity['Activity']['content']), null, null, null, true, array('no_replace_ssl' => 1)); ?>
    <?php if(!empty($activity['UserTagging']['users_taggings'])) $this->MooPeople->with($activity['UserTagging']['id'], $activity['UserTagging']['users_taggings']); ?>
</div>

<div class="share-content">
    <div class="activity_left">
        <a href="<?php echo $aQuiz['Quiz']['moo_href']; ?>">
        <img width="150" class="thum_activity" src="<?php echo $quizHelper->getImage($aQuiz, array('prefix' => '150_square')); ?>" />
        </a>
    </div>

    <div class="activity_right ">
        <div class="activity_header">
            <a href="<?php echo $aQuiz['Quiz']['moo_href'] ?>"><?php echo h($aQuiz['Quiz']['moo_title']); ?></a>
        </div>
        <?php echo  $this->Text->convert_clickable_links_for_hashtags($this->Text->truncate(strip_tags(str_replace(array('<br>', '&nbsp;'), array(' ', ''), $aQuiz['Quiz']['description'])), 200, array('exact' => false)), Configure::check('Quiz.quiz_enabled_hashtag') ? Configure::read('Quiz.quiz_enabled_hashtag') : 0); ?>
    </div>
    <div class="clear"></div>
</div>