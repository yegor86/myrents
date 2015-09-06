<?php
Yii::import('application.controllers.RentEditMainController');
class RentDropController extends RentEditMainController {

    /**
     * экшн удаления аренды
     * @param type $id
     * @throws CHttpException 
     */
    public function actionDrop($id) {
	$rent = Rent::model()->findByPk($id);
	//проверка прав и существования аренды
	if (!$rent)
	    throw new CHttpException(404, 'page not found');
	//если всё норм
	else {
	    if (!$this->dropRent($rent))
		$this->assignAndRender('dropview', array('rent' => $rent));
	}
    }

    //функция удаления аренды
    private function dropRent($rent) {
	if (!isset($_POST['dropRent']))
	    return false; //если небыло запроса на удаление - возвращаем false
	else {	   //иначе помечаем аренду как удалённую
	    if ($rent->markAsDeleted()) { //если успешно удалили, то редирект на список аренд
		Yii::app()->user->setFlash('success', Yii::t('default', 'flash.bill.saved'));
		$this->redirect('/user/' . Yii::app()->user->id . '/hostings');
	    } else {     //иначе сообщение об ошибке и снова на страницу удаления
		Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved'));
		return false;
	    }
	}
    }

 /**
 * подключение необходимых файлов и рендер
 * @param type $view
 * @param type $params 
 */
    public function assignAndRender($view, $params) {
	$this->assignControllerJsCss(
		array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
                    'jquery.fancybox.css',
	    'cusel.css'
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jScrollPaneSelect.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'somefunctions.js',
	    'jquery.imagetick.js',
	    'edit.js',
	    'cusel.js',
	    'charCount.js','jquery.fancybox.js',
		)
	);
	$this->render($view, $params);
    }

}

?>