<?php
Yii::import('application.controllers.AdminController');
class AdminUsersController extends AdminController{
    public function actionAdminUsers(){
        

        if(isset($_POST['Delete'])) {$this->UserDelete($_POST['Delete']['id']);};
       $form = new AdminAddRoleUserForm();
       
       
        $criteria = new CDbCriteria();
        $criteria->order ='`t`.`member_since` DESC';
        if(isset($_POST['searchUser'])){

            $string = $_POST['searchUser']['string'];
            $type = $_POST['searchUser']['type'];
if($type=='---'){


}else{
                $criteria->condition = "".$type." LIKE :match";
                $criteria->params= array(':match' => "%$string%");
}





        }else{

        }
                if(isset($_POST['sortRole'])) $criteria->condition='`role` ="'.$_POST['sortRole'].'"';

        $pagination = $this->paginate($criteria,'User');
        $userlist=User::model()->findAll($criteria);
       
        $this->assignAndRender('adminUsers', array('userlist'=>$userlist,'pagination'=>$pagination,'AddRole'=>$form));
    }
    
    public function actionAdminUsersEmailList($show=false){

if($show == 'all'){
        $userlist=User::model()->findAll();
}else{
       $userlist=User::model()->subscribed()->findAll();
}
        $this->assignAndRender('adminUsersEmailList', array('userEmailList'=>$userlist));
    }
    
    /*Редактирование пользователя*/
    public function actionAdminUsersEdit($id=0){
        $user=User::model()->findByPk($id);
        if(isset($_POST['User'])){
             $user->attributes=$_POST['User'];
             if($user->validate()){
                 if(!empty($_POST['User']['new_password'])) $form->password = md5($_POST['User']['new_password']);
                 $user->save();
                 Yii::app()->user->setFlash('success', 'Изменения сохранены');
             }else{
                Yii::app()->user->setFlash('error', 'Изменения не сохранены'); 
             }
        }
	$this->assignAndRender('adminUsersEdit',array('user'=>$user));
    }

    
    /*Удаление пользователя*/
   public function UserDelete($id=0){
        if(User::model()->deleteByPk($id)){
          Yii::app()->user->setFlash('success', 'Пользователь удален');
        }else{
          Yii::app()->user->setFlash('error', 'Пользователь не удален'); 
        }
    }
    
    
        /**
     *экшн отправка штучного уведомления 
     */
    public function actionAdminSingleNotify(){
	$form = new AdminNotifyForm();
	if(isset($_POST['AdminNotifyForm'])){
	    $form->attributes = $_POST['AdminNotifyForm'];
	    if($form->validate()){
		$user = User::model()->findByPk($form->user);
		if($user) $user->notify($form->message);
		Yii::app()->user->setFlash('success', 'Уведомление отправлено');
	    } else Yii::app()->user->setFlash('success', 'Уведомление не отправлено');

	}
	$userslist = User::model()->findAll();
	$users=array();
	foreach ($userslist as $user){
	    $users[$user->id] = $user->firstname.' '. $user->lastname . ' ('.$user->nick .')';
	}
	$this->assignAndRender('adminUsersNotify',array('notifyForm'=>$form,'users'=>$users));
    }
    
        public function actionAdminUsersDate($date) {
        $criteria = new CDbCriteria();
        $criteria->condition = '`member_since` between :data AND :ndata';
        $criteria->params = array(
            ':data' => substr($date, 0, 10),
            ':ndata' => date('Y-m-d', strtotime($date) + 86400)
        );
        $userlist = User::model()->findAll($criteria);
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('_adminUsersDate', array('userlist' => $userlist));
        } else {
            $this->assignAndRender('adminUsersDate', array('userlist' => $userlist));
        }
    }
        /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
                array(
            'admin_style.css',
            'admin-jquery-ui.css',
                ), array(
            'admin_func.js',
            'jquery-ui-1.8.16.custom.min.js',
                    'admin_ajax.js',
                    'jquery.md5.js'
                )
	);
	$this->render($view, $params);
    }

}