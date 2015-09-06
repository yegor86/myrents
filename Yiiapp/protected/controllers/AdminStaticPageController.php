<?php
Yii::import('application.controllers.AdminController');
class AdminStaticPageController extends AdminController {
    /* Список помощи */

    public function actionAdminStaticPage() {

       $list = StaticPage::model()->with(array('translations'=>array('on'=>'`lang_id`= ' . $this->curlang->id)))->findAll();

        $this->assignAndRender('adminStaticPage', array('list' => $list));
    }

    /* Редактирование помощи */

    public function actionAdminStaticPageEdit($id) {
        $model = StaticPage::model()->with('translations')->findByPk($id);
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
         
 
            if (isset($_POST['StaticPage'])) {
                $model->attributes = $_POST['StaticPage'];
                $valid = true;
                if ($model->validate()) {
                    
                    
                    foreach ($translations as $key => $translation) {
                        if (isset($_POST['Translations'][$key])) {
                            $translation->attributes = $_POST['Translations'][$key];
                            $translation->row_id = 1;
                            $translation->table_key = 'StaticPage';
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
 
        $this->assignAndRender('adminStaticPageEdit', array('EditForm' => $model, 'trans' => $translations));
    }

    /* Добавление помощи */

    public function actionAdminStaticPageAdd() {
        $model = new StaticPage;
        $translations = array();
        foreach ($this->langs as $lang) {
            $translations[$lang->id] = new Translations();
        }
        if (isset($_POST['StaticPage'])) {
            $model->attributes = $_POST['StaticPage'];
            if ($model->validate()) {

                
                $valid = true;
                foreach ($translations as $key => $translation) {
                    if (isset($_POST['Translations'][$key])) {
                        $translation->attributes = $_POST['Translations'][$key];
                        $translation->row_id = 1;
                        $translation->table_key = 'StaticPage';
                        $translation->lang_id = $key;
                        $valid = ($valid&&$translation->validate());
                    }
                }

                $model->translations = $translations;

                if($valid){
                $model->save();
                $model->saveTranslations(true);
                Yii::app()->user->setFlash('success', 'добавлено');
                $this->redirect('/admin/staticpage/');
                }else{
                    Yii::app()->user->setFlash('error', 'не сохранено');
                }

                
            } else {
                Yii::app()->user->setFlash('error', 'не сохранено');
            }
        }

        $this->assignAndRender('adminStaticPageAdd', array('EditForm' => $model, 'trans' => $translations));
    }

    public function actionAdminStaticPageDelete($id) {
        $model = StaticPage::model()->findByPk($id);
        $translist = StaticPage::model()->with('translations')->findByPk($id);
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
            'admin-jquery-ui.css',
                ), array(
            'admin_func.js',
            'jquery-ui-1.8.16.custom.min.js'
                )
        );
        $this->render($view, $params);
    }

}