<?php
Yii::import('application.controllers.AdminController');
class AdminSupportController extends AdminController {
    /* Список аренд */

    public function actionAdminSupport() {
        $this->assignAndRender('index');
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
?>
