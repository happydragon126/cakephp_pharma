<?php
/**
 * Created by PhpStorm.
 * User: Social
 * Date: 12/14/2017
 * Time: 3:13 PM
 */
class Forum extends ForumAppModel
{
    public $actsAs = array(
        'MooUpload.Upload' => array(
            'thumb' => array(
                'path' => '{ROOT}webroot{DS}uploads{DS}forums{DS}forum_icons{DS}{field}{DS}',
                'thumbnailSizes' => array(
                    'size' => array()
                )
            )
        ),
        'Storage.Storage' => array(
            'type'=>array(
                'forum_thumb'=>'thumb',
            ),
        ),
    );
    public $validationDomain = 'forum';

    public $mooFields = array('title','href','plugin','type','url', 'thumb','privacy');

    public $belongsTo = array(
        'ForumCategory' => array(
            'className' => 'ForumCategory',
            'foreignKey' => 'category_id'
        )
    );

    public $validate = array(
        'name' => 	array(
            'rule' => 'notBlank',
            'message' => 'Forum\'s name is required',
        ),
        'description' => 	array(
            'rule' => 'notBlank',
            'message' => 'Description is required',
        ),

    );

    public function getTitle(&$row)
    {
        if (isset($row['name']))
        {
            $row['name'] = htmlspecialchars($row['name']);
            return $row['name'];
        }
        return '';
    }

    public function getHref($row)
    {
        $request = Router::getRequest();
        if (isset($row['id']))
            return $request->base.'/forums/view/'.$row['id'].'/'.seoUrl($row['moo_title']);

        return false;
    }

    public function getThumb($row){
        return 'thumb';
    }

    public function getForumByCatId($id = null)
    {
        $conditions = array('order' => 'Forum.order asc');
        if($id != null)
            $conditions += array(
                'conditions' => array(
                    'category_id' => $id,
                    'parent_id' => 0,
                ),
                'order' => 'Forum.order asc'
            );
        $data = $this->find('all',$conditions);
        return $data;
    }
    public function getSubForumByParentId($parent_id = null)
    {
        if($parent_id != null)
        {
            $conditions = array(
                'conditions' => array(
                    'parent_id' => $parent_id,
                ),
                'order' => 'Forum.order asc'
            );
            $data = $this->find('all',$conditions);
            return $data;
        }
    }

    public function genOrder($parent_id,$cat_id)
    {
        $max = $this->find('first', array(
            'conditions' => array(
                'Forum.parent_id' => $parent_id,
                'Forum.category_id' => $cat_id
            ),
            'fields' => 'MAX(Forum.order) as maxorder'
        ));
        if(empty($max)) return 1;
        return $max[0]['maxorder']+1;
    }

    public function setOrder($idForum,$orderNumber)
    {
        $this->id = $idForum;
        $data['order'] = $orderNumber;
        $this->set($data);
        $this->save();
    }

    public function getAllMod()
    {
        $forums = $this->find('all', array(
            'conditions' => array(
                'Forum.moderator not like \'\''
            ),
            'fields' => array('Forum.moderator')
        ));
        $res = array();
        foreach($forums as $forum)
        {
            $tmp = explode(',',$forum['Forum']['moderator']);
            $res = array_merge($res,array_diff($tmp,$res));
        }
        $m_user = new User();
        $users = $m_user->find('all',array(
            'conditions' => array(
                'User.id' => $res
            ),
            'fields' => array('User.id','User.name'),
        ));
        $users = Set::combine($users,'{n}.User.id','{n}');
        unset($res);unset($forums);unset($m_user);
        return $users;

    }

    public function updateLastTopic($forum_id, $topic_id){
        $this->id = $forum_id;
        $this->saveField('last_topic_id', $topic_id);
    }

    public function getListSubForum($parent_id){
        $results = $this->find('list', array(
            'conditions' => array('Forum.parent_id' => $parent_id),
            'fields' => array('Forum.id'),
        ));
        return $results;
    }

    public function afterSave($created, $options = array())
    {
        Cache::delete('permissionForum');
        parent::afterSave($created, $options); // TODO: Change the autogenerated stub
    }

}