<?php

Yii::import('application.controllers.AdminController');

class AdminSeoPageController extends AdminController {
    
    /*
     * Список SEO страниц поиска
     */
    public function actionAdminSeoPage() {
        $langslist = array();
        foreach ($this->langs as $lang) {
            $langslist[$lang->name] = SeoPage::model()->with('language')->findAll('`lang`=:lang', array(':lang' => $lang->id));
        }
        $this->assignAndRender('adminSeoPage', array('langlist' => $langslist));
    }

    /*
     * SEO страниц радактирование
     */
    public function actionAdminSeoPageEdit($lang, $url) {
        $language = Language::model()->findByAttributes(array('language' => $lang));
        $param = (CustomFunctions::paramToUrl($url));
        $seoPage = SeoPage::model()->findByPk(array('url' => $param, 'lang' => $language->id));
        if (isset($_POST['SeoPage'])) {
            $seoPage->attributes = $_POST['SeoPage'];
            if ($seoPage->save()) {
                Yii::app()->user->setFlash('success', 'Изменения сохранены');
            } else {
                Yii::app()->user->setFlash('error', 'Изменения не сохранены');
            }
        }
        $this->assignAndRender('adminSeoPageEdit', array('seoPage' => $seoPage));
    }
    
    /*
     * SEO страниц добавление
     */
    public function actionAdminSeoPageAdd($lang) {
        $language = Language::model()->findByAttributes(array('language' => $lang));
        $seoPage = new SeoPage();
        $seoPage->lang = $language->id;
        if (isset($_POST['SeoPage'])) {
            $seoPage->attributes = $_POST['SeoPage'];
            if ($seoPage->save()) {
                Yii::app()->user->setFlash('success', 'Успештно добавлено');
            } else {
                Yii::app()->user->setFlash('error', 'Не удалось добавить');
            }
        }
        $this->assignAndRender('adminSeoPageAdd', array('seoPage' => $seoPage, 'language' => $language));
    }

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

?>
