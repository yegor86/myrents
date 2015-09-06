<?php
Yii::import('application.controllers.AdminController');
class AdminCommentsController extends AdminController {
    /* Список комментариев */

    public function actionAdminComments() {
        $criteria = new CDbCriteria();
        $criteria->with=array('sender','receiver', 'receiver.descriptions'=>array('on'=>'language=1'));
        $criteria->order='`t`.`id` DESC';
        $pagination = $this->paginate($criteria,'RentComment');
       $commentlist = RentComment::model()->findAll($criteria);
        if(isset($_POST['checked'])){
            foreach($_POST['checked'] as $ids){
                $model = RentComment::model()->findByPk($ids);
                $model->deleteByPk($ids);  
            }
            $this->redirect('/admin/comments/');
        }
        $this->assignAndRender('adminComments', array('commentlist' => $commentlist, 'pagination'=>$pagination));
    }

    public function actionAdminCommentsDelete($id) {
        $model = RentComment::model()->findByPk($id);

        if (Yii::app()->request->isAjaxRequest) {
            $model->deleteByPk($id);

            Yii::app()->user->setFlash('success', 'Комментарий удален');
        } else {
            Yii::app()->user->setFlash('error', 'Комментарий не удален');
        }
    }
    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params = array()) {
        $this->assignControllerJsCss(
                array(
            'admin_style.css',
            'jquery-ui-1.8.16.custom.css',
                ), array(
            'admin_func.js',
            'jquery-ui-1.8.16.custom.min.js'
                )
        );
        $this->render($view, $params);
    }

}