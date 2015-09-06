<?php
Yii::import('application.controllers.AdminController');
class AdminHelpController extends AdminController {
    /* Список помощи */

    public function actionAdminHelp() {

                $criteria->condition = '`translations`.`lang_id`= ' . $this->curlang->id;
       $helplist = Help::model()->with(array('translations'=>array('on'=>'`lang_id`= ' . $this->curlang->id)))->findAll();

        $this->assignAndRender('adminHelp', array('helplist' => $helplist));
    }

    /* Редактирование помощи */

    public function actionAdminHelpEdit($id) {
        $model = Help::model()->with('translations')->findByPk($id);
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
         
 
            if (isset($_POST['Help'])) {
                $model->attributes = $_POST['Help'];
                $valid = true;
                if ($model->validate()) {
                    
                    
                    foreach ($translations as $key => $translation) {
                        if (isset($_POST['Translations'][$key])) {
                            $translation->attributes = $_POST['Translations'][$key];
                            $translation->row_id = 1;
                            $translation->table_key = 'Help';
                            $translation->lang_id = $key;
                            $valid = ($valid&&$translation->validate());
                        }
                    }
                    //  print_r($translation->attributes);
                    $model->translations = $translations;
                    //print_r($model->translations);die();
                    if($valid){
                    $model->save();
                    $model->saveTranslations(true);
                    Yii::app()->user->setFlash('success', 'Изменения сохранены');
                    }
                    // $this->redirect('/admin/help/');
                } else {
                    Yii::app()->user->setFlash('error', 'Изменения не сохранены');
                }
            }
 
        $this->assignAndRender('adminHelpEdit', array('EditForm' => $model, 'trans' => $translations));
    }

    /* Добавление помощи */

    public function actionAdminHelpAdd() {
        $model = new Help;
        $translations = array();
        foreach ($this->langs as $lang) {
            $translations[$lang->id] = new Translations();
        }
        if (isset($_POST['Help'])) {
            $model->attributes = $_POST['Help'];
            if ($model->validate()) {

                
                $valid = true;
                foreach ($translations as $key => $translation) {
                    if (isset($_POST['Translations'][$key])) {
                        $translation->attributes = $_POST['Translations'][$key];
                        $translation->row_id = 1;
                        $translation->table_key = 'Help';
                        $translation->lang_id = $key;
                        $valid = ($valid&&$translation->validate());
                    }
                }

                $model->translations = $translations;

                if($valid){
                $model->save();
                $model->saveTranslations(true);
                Yii::app()->user->setFlash('success', 'добавлено');
                $this->redirect('/admin/help/');
                }else{
                    Yii::app()->user->setFlash('error', 'не сохранено');
                }

                
            } else {
                Yii::app()->user->setFlash('error', 'не сохранено');
            }
        }

        $this->assignAndRender('adminHelpAdd', array('EditForm' => $model, 'trans' => $translations));
    }

    
    public function actionAdminHelpDelete($id) {
        $model = Help::model()->findByPk($id);
        $translist = Help::model()->with('translations')->findByPk($id);
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