<?php
App::uses('Widget','Controller/Widgets');

class most_popularForumWidget extends Widget {
    public function beforeRender(Controller $controller) {
        $num_item_show = $this->params['num_item_show'];
        $topicModel = MooCore::getInstance()->getModel('Forum.ForumTopic');

        $topics = $topicModel->getMostPopular((int)$num_item_show);
        $this->setData('topics', $topics);
    }
}