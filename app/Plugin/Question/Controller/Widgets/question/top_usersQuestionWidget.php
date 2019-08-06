<?php
App::uses('Widget','Controller/Widgets');

class top_usersQuestionWidget extends Widget {
    public function beforeRender(Controller $controller) {    	
    	$num_item_show = $this->params['num_item_show'];
    	$userModel = MooCore::getInstance()->getModel("Question.QuestionUser");
    	$conditions = array('QuestionUser.total_question >'=> 0);
    	$conditions = $userModel->addBlockCondition($conditions);
    	$users = $userModel->find("all",array(
    			'conditions' => $conditions,
    			'limit' => $num_item_show,
    			'order' => array('QuestionUser.total_question DESC'),
    	));
    	$this->setData("users", $users);
    }
}