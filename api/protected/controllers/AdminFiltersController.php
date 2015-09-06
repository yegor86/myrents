<?php
Yii::import('application.controllers.AdminController');
class AdminFiltersController extends AdminController{
    public function actionAdminMain(){
	$this->assignAndRender('adminMain');
	
    }
    /*Список Окрестностей*/
    public function actionAdminNeiborhood(){
        $criteria = new CDbCriteria();
        $pagination = $this->paginate($criteria,'Neighbor');
        $neiborhoodlist=Neighbor::model()->findAll($criteria);
	$this->assignAndRender('adminNeiborhood', array('neiborhoodlist'=>$neiborhoodlist,'pagination'=>$pagination));
    }
    
    /*Редактирование Окрестностей*/
    public function actionAdminNeirborhoodEdit($id=0){
        $neirborhood=Neighbor::model()->findByPk($id);
        $form = new AdminEditNeirborhoodForm();
        $form->attributes=$neirborhood->attributes;
        if(isset($_POST['AdminEditNeirborhoodForm'])){
             $form->attributes=$_POST['AdminEditNeirborhoodForm'];
             /***fine magic ***/
             if($form->validate()){
                 $neirborhood->attributes=$form->attributes;
                         $neirborhood->save();
                         Yii::app()->user->setFlash('success', 'Изменения сохранены');
             }else{
                Yii::app()->user->setFlash('error', 'Изменения не сохранены'); 
             }
        }
	$this->assignAndRender('adminNeirborhoodEdit',array('neirborhood'=>$neirborhood, 'EditForm'=>$form));
    }
    
    /*Список Удобств*/
    public function actionAdminAmenities(){
        $criteria = new CDbCriteria();
        $pagination = $this->paginate($criteria,'Amenity');
        $amenitieslist=Amenity::model()->findAll($criteria);
	$this->assignAndRender('adminAmenities', array('amenitieslist'=>$amenitieslist,'pagination'=>$pagination));
    }
    
    /*Редактирование Удобств*/
    public function actionAdminAmenitiesEdit($id=0){
        $amenitie=Amenity::model()->findByPk($id);
        $form = new AdminEditAmenitiesForm();
        $form->attributes=$amenitie->attributes;
        if(isset($_POST['AdminEditAmenitiesForm'])){
             $form->attributes=$_POST['AdminEditAmenitiesForm'];
             /***fine magic ***/
             if($form->validate()){
                 $amenitie->attributes=$form->attributes;
                         $amenitie->save();
                         Yii::app()->user->setFlash('success', 'Изменения сохранены');
             }else{
                Yii::app()->user->setFlash('error', 'Изменения не сохранены'); 
             }
        }
	$this->assignAndRender('adminAmenitiesEdit',array('amenitie'=>$amenitie, 'EditForm'=>$form));
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
            'jquery-ui-1.8.16.custom.min.js'

                )
	);
	$this->render($view, $params);
    }

}