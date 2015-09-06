<?php
Yii::import('application.controllers.AdminController');
class AdminRentsController extends AdminController {
    /* Список аренд */

    public function actionAdminRents() {
        if (isset($_POST['DeleteRent'])) {
            $rentDel = Rent::model()->findByPk($_POST['DeleteRent']['id']);
            $rentDel->markAsDeleted();
            Yii::app()->user->setFlash('success', 'Аренда удалена');
        }

        if (isset($_POST['searchID'])) {
            $criteria = new CDbCriteria();
            $criteria->condition = '`id` =' . $_POST['searchID'];
            $pagination = $this->paginate($criteria, 'Rent');
            $rentlist = Rent::model()->findAll($criteria);
        } else {
            $criteria = new CDbCriteria();
            $criteria->order ='`t`.`creation_date` DESC';

            $criteria->with = array(
                'renter'
            );
            $pagination = $this->paginate($criteria, 'Rent');
            $rentlist = Rent::model()->texted()->findAll($criteria);
        }


        $this->assignAndRender('adminRents', array('rentlist' => $rentlist, 'pagination' => $pagination));
    }

    
    
    
   
    /* Список аренд на главной */

    public function actionAdminRentsShowmain() {
        $form = new AdminTop();
        if (isset($_POST['Delete'])) {
            if(TopFunc::init()->remove($_POST['Delete']['id'], $_POST['Delete']['action'])){
                Yii::app()->user->setFlash('success', 'Объявление удалено');
            }else{
                Yii::app()->user->setFlash('error', 'Объявление не удалено');
            }

        }

        
        
        
        if (isset($_POST['AdminTop'])) {
            $form->attributes = $_POST['AdminTop'];
             $rent  = Rent::model()->findByPk($form->rent_id);
           if($form->validate()&&$rent){
                if($rent->isCompleted()){
                        $newlog = new OperationLog;
                        $newlog->operation_id=5;
                        $newlog->comment='Добавлено объявление администратором: '.Yii::app()->user->id.'<br/> ID объявния: '.$form->rent_id;
                        $newlog->user_id=$rent->user;
                        TopFunc::init()->addToTop($form->rent_id, $form->days,$form->to);
                        Yii::app()->user->setFlash('success', 'Объявление добавлено');
                }else{
                    Yii::app()->user->setFlash('error', 'Объявление не правлено заполенно');
                        print_r($form->getErrors());
                }
            }else{
                print_r($form->getErrors());
                Yii::app()->user->setFlash('error', 'Объявление не добавлено!');
            }
        }

        $rentTopMain = Rent::model()->with(array('renter', 'atmain'))
                ->texted()->findAllByPk(TopFunc::init()->getFullMainPageIds());
        $rentTop = Rent::model()->with(array('renter', 'top'))
                ->texted()->findAllByPk(TopFunc::init()->getFullTopIds());
        if (Yii::app()->request->isAjaxRequest) {
            $this->show('addtop', array( 'topForm' => $form));
        }else
            $this->assignAndRender('adminRentsShowmain', array('rentTopMain' => $rentTopMain, 'rentTop'=>$rentTop, 'topForm' => $form));
    }
    

    public function actionAdminRentsDate($date) {
        $criteria = new CDbCriteria();
        $criteria->condition = '`creation_date` between :data AND :ndata';
        $criteria->params = array(
            ':data' => substr($date, 0, 10),
            ':ndata' => date('Y-m-d', strtotime($date) + 86400)
        );

        $rentlist = Rent::model()->findAll($criteria);
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('_adminRentsDate', array('rentlist' => $rentlist));
        } else {
            $this->assignAndRender('adminRentsDate', array('rentlist' => $rentlist));
        }
    }


    public function actionAdminRentsUser($userId) {
        $criteria = new CDbCriteria();
        $criteria->with = array('renter');

        $criteria->condition = '`t`.`user`= :userid';
        $criteria->params = array(':userid' => $userId);
        $pagination = $this->paginate($criteria, 'Rent');
        $rentlist = Rent::model()-texted()->findAll($criteria);
        $this->assignAndRender('adminRentsUser', array('rentlist' => $rentlist, 'pagination' => $pagination));
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
            'admin-jquery-ui.css',
                ), array(
            'admin_func.js',
            'jquery-ui-1.8.16.custom.min.js',
                    'admin_ajax.js'
                )
        );
        $this->render($view, $params);
    }

}