<?php
Yii::import('application.controllers.AdminController');
class AdminPartnersController extends AdminController {
    /* Список помощи */

    public function actionAdminPartners() {

       $partnerslist = Partner::model()->with(array('translations'=>array('on'=>'`lang_id`= ' . $this->curlang->id)))->findAll();

        $this->assignAndRender('adminPartners', array('partnerslist' => $partnerslist));
    }

    /* Редактирование помощи */

    public function actionAdminPartnersEdit($id) {
        $model = Partner::model()->with('translations')->findByPk($id);
        $img = $model->image;
        $translations = array();
        if (count($model->translations))
        foreach($model->translations as $translation ){
            $translations[$translation->lang_id]=$translation;
        }
        
         foreach ($this->langs as $lang) {
             if(!isset($translations[$lang->id]))
                 $translations[$lang->id] = new Translations();
             $translations[$lang->id]->lang_id =$lang->id; 
         }
         
 
            if (isset($_POST['Partner'])) {
                $model->attributes = $_POST['Partner'];
                $valid = true;
                if ($model->validate()) {
                    
                    
                    foreach ($translations as $key => $translation) {
                        if (isset($_POST['Translations'][$key])) {
                            $translation->attributes = $_POST['Translations'][$key];
                            $translation->row_id = 1;
                            $translation->table_key = 'Partner';
                            $translation->lang_id = $key;
                            $valid = ($valid&&$translation->validate());
                        }
                    }
                    

                    
                    
                                        $fileU = CUploadedFile::getInstance($model, 'image');
                    if (isset($fileU)) {
                        $type = strtolower(end(explode('.', $_FILES['Partner']['name']['image'])));
                        $newname = CustomFunctions::gen(7) . "." . $type;
                        ImageProcessing::image()->saveImage($fileU, $newname, array(
                            'width' => 257, 'maindir' => '/uploads/partners/',
                            'overwrite' => true,));
                        $model->image = $newname;
                        ImageProcessing::image()->dropImage($_POST['Partner']['oldimage'], '/uploads/partners/');
                    }else{
                        $model->image = $img;
                    }

                    $model->translations = $translations;
                    if($valid){
                        $model->save();
                        $model->saveTranslations(true);
                        Yii::app()->user->setFlash('success', 'Изменения сохранены');
                        $this->redirect('/admin/partners/');
                    }
                } else {
                    Yii::app()->user->setFlash('error', 'Изменения не сохранены');
                }
            }
 
        $this->assignAndRender('adminPartnersEdit', array('EditForm' => $model, 'trans' => $translations));
    }

    /* Добавление помощи */

    public function actionAdminPartnersAdd() {
        $model = new Partner;
        $translations = array();
        foreach ($this->langs as $lang) {
            $translations[$lang->id] = new Translations();
        }
        if (isset($_POST['Partner'])) {
            $model->attributes = $_POST['Partner'];
            if ($model->validate()) {

                
                $valid = true;
                foreach ($translations as $key => $translation) {
                    if (isset($_POST['Translations'][$key])) {
                        $translation->attributes = $_POST['Translations'][$key];
                        $translation->row_id = 1;
                        $translation->table_key = 'Partner';
                        $translation->lang_id = $key;
                        $valid = ($valid&&$translation->validate());
                    }
                }

                
                
                    $fileU = CUploadedFile::getInstance($model, 'image');
                    if (isset($fileU)) {
                        $type = strtolower(end(explode('.', $_FILES['Partner']['name']['image'])));
                        $newname = CustomFunctions::gen(7) . "." . $type;
                        ImageProcessing::image()->saveImage($fileU, $newname, array(
                            'width' => 257, 'maindir' => '/uploads/partners/',
                            'overwrite' => true,));
                        $model->image = $newname;
                    } else {
                        $model->image = $model->image;
                    }
                    
                    
                    
                $model->translations = $translations;

                if($valid){
                $model->save();
                $model->saveTranslations(true);
                Yii::app()->user->setFlash('success', 'добавлено');
                $this->redirect('/admin/partners/');
                }else{
                    Yii::app()->user->setFlash('error', 'не сохранено');
                }

                
            } else {
                Yii::app()->user->setFlash('error', 'не сохранено');
            }
        }

        $this->assignAndRender('adminPartnersAdd', array('EditForm' => $model, 'trans' => $translations));
    }

    public function actionAdminPartnersDelete($id) {
        $model = Partner::model()->findByPk($id);
        $translist = Partner::model()->with('translations')->findByPk($id);
        if (Yii::app()->request->isAjaxRequest) {
            $model->deleteByPk($id);
             if (count($translist)) {
                foreach ($translist->translations as $t) {
                    $model->deleteByPk($t->row_id);
                }
            }
            echo 'удалена';
        } else {
            echo 'Не удалось удалить';
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