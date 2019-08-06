

<?php
if(Configure::read('Topic.topic_enabled') == 1):
$topicHelper = MooCore::getInstance()->getHelper('Topic_Topic');
if (!empty($topics) && count($topics) > 0) {
    $i = 1;
    foreach ($topics as $topic):
        ?>
        <li class="full_content p_m_10" <?php if ($i == 1) echo 'style="border-top:0"'; ?>>
            <?php if(!empty( $ajax_view )): ?>
                <a class="ajaxLoadTopicDetail" href="javascript:void(0)" data-url="<?php echo  $this->request->base ?>/topics/ajax_view/<?php echo  $topic['Topic']['id'] ?>">
                <img width="140" src="<?php echo $topicHelper->getImage($topic, array('prefix' => '150_square'))?>" class="topic-thumb" />
                </a>
            <?php else: ?>
                <a href="<?php echo  $this->request->base ?>/topics/view/<?php echo  $topic['Topic']['id'] ?>/<?php echo  seoUrl($topic['Topic']['title']) ?>">
                <img width="140" src="<?php echo $topicHelper->getImage($topic, array('prefix' => '150_square'))?>" class="topic-thumb" />
                </a>
            <?php endif; ?>
            
        <?php if(!empty($uid) && (($topic['Topic']['user_id'] == $uid ) ||  (!empty($cuser) && $cuser['Role']['is_admin']) || in_array($uid, $topic['Topic']['admins']) ) ): ?>

            <div class="list_option">
                <div class="dropdown">
                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </button>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <?php if (!empty($cuser['Role']['is_admin']) || in_array($uid, $topic['Topic']['admins']) ): ?>
                            <?php if ( !$topic['Topic']['pinned'] ): ?>
                                <li><a href="<?php echo $this->request->base?>/topics/do_pin/<?php echo $topic['Topic']['id']?>"><?php echo __( 'Pin Topic')?></a></li>
                            <?php else: ?>
                                <li><a href="<?php echo $this->request->base?>/topics/do_unpin/<?php echo $topic['Topic']['id']?>"><?php echo __( 'Unpin Topic')?></a></li>
                            <?php endif; ?>

                            <?php if ( !$topic['Topic']['locked'] ): ?>
                                <li><a href="<?php echo $this->request->base?>/topics/do_lock/<?php echo $topic['Topic']['id']?>"><?php echo __( 'Lock Topic')?></a></li>
                            <?php else: ?>
                                <li><a href="<?php echo $this->request->base?>/topics/do_unlock/<?php echo $topic['Topic']['id']?>"><?php echo __( 'Unlock Topic')?></a></li>
                            <?php endif; ?>     
                        <?php endif; ?>
                                
                        <?php if ($uid == $topic['Topic']['user_id'] || ( !empty($cuser) && $cuser['Role']['is_admin'] ) || in_array($uid, $topic['Topic']['admins']) ): ?>
                        <li><a href="javascript:void(0);" class="ajaxLoadTopicEdit" data-url="<?php echo $this->request->webroot?>topics/group_create/<?php echo $topic['Topic']['id']?>"><?php echo __( 'Edit Topic'); ?></a></li>
                        <li><a href="javascript:void(0);" class="deleteTopic" data-id="<?php echo $topic['Topic']['id']?>" data-group="<?php echo $group_id?>"><?php echo  __( 'Delete') ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
            <div class="topic-info">
                <?php if(!empty( $ajax_view )): ?>
                <a class="ajaxLoadTopicDetail title" href="javascript:void(0)" data-url="<?php echo  $this->request->base ?>/topics/ajax_view/<?php echo  $topic['Topic']['id'] ?>"><?php echo  h($topic['Topic']['title']) ?></a>
                <?php else: ?>
                <a class="title" href="<?php echo  $this->request->base ?>/topics/view/<?php echo  $topic['Topic']['id'] ?>/<?php echo  seoUrl($topic['Topic']['title']) ?>"><?php echo  h($topic['Topic']['title']) ?></a>
                <?php endif; ?>
                &nbsp;
                <?php if ($topic['Topic']['pinned']): ?>
                    <i class="material-icons icon-small tip" title="<?php echo  __( 'Pinned') ?>">fiber_pin</i>
                <?php endif; ?>
                <?php if ($topic['Topic']['attachment']): ?>
                    <i class="material-icons icon-small tip" title="<?php echo  __( 'Attached files') ?>">attach_file</i>
                <?php endif; ?>
                <?php if ($topic['Topic']['locked']): ?>
                    <i class="material-icons icon-small tip" title="<?php echo  __( 'Locked') ?>">lock</i>
                    <?php endif; ?>
                
                
            </div>
        </li>
        <?php
        $i++;
    endforeach;
} else
    echo '<div class="clear text-center">' . __( 'No more results found') . '</div>';
?>

<?php if (!empty($more_result)): ?>
    <?php $this->Html->viewMore($more_url) ?>
<?php endif; endif; ?>

<?php if($this->request->is('ajax')): ?>
<script type="text/javascript">
    require(["jquery","mooTopic"], function($,mooTopic) {
        mooTopic.initOnGroupListing();
    });
</script>
<?php else: ?>
<?php $this->Html->scriptStart(array('inline' => false, 'domReady' => true, 'requires'=>array('jquery','mooTopic'), 'object' => array('$', 'mooTopic'))); ?>
mooTopic.initOnGroupListing();
<?php $this->Html->scriptEnd(); ?> 
<?php endif; ?>