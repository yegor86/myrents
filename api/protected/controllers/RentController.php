<?php
Yii::import('application.controllers.MyRentsController');
class RentController extends MyRentsController {
    
    public function actionRent($id = 0) {
	if ($id) {
	    $view = 'rent';
	    $lang = $this->curlang;
	    $prices_types = Yii::app()->params['current_price'];
	    $rent = Rent::model()->with(array(
			'renter', 'photos', 'amenities', 'rent_type', 'adress','currency',
			'descriptions' => array('on' => 'language=' . $lang->id,)
		    ))->findByPk($id);
	    if($rent->is_deleted){
			header("HTTP/1.0 410 Gone");
			$this->assignAndRender('404_rent_not_found');
	    }
	    else{
	    if (($rent) && (($rent->renter->id == Yii::app()->user->id) || ($rent->in_show))) {
		//отправка сообщения
		$comment = $this->SendComment($rent);
		$commentsList = $this->getCommentsList($rent);
		// если был аякс запрос - возвращаем ответ
		if (isset($_POST['isajax'])) {
		    $this->renderPartial('_rentcomment', array(
			'rent' => $rent,
			'AddComment' => $comment,
			'commentsList' => $commentsList,
		    ));
		    Yii::app()->end();
		}
		$exists_favorites = array();
		if ($rent->renter->id == Yii::app()->user->id)
		    $view = 'myrent';
		else if (!Yii::app()->user->isGuest){
		    $exFav = User::model()->with('favorites')->findByPk(Yii::app()->user->id);
		    if($exFav)
		    $exists_favorites = $this->modelsNamestoArray($exFav->favorites, 'id', 'id');}
		$similarRents = SearchEngine::engine()->getSimilar($rent);
		$this->assignAndRender($view, array('rent' => $rent,
		    'prices' => $prices_types,
		    'similarRents' => $similarRents,
		    'AddComment' => $comment,
		    'commentsList' => $commentsList,
		    'favorites' => $exists_favorites,
		    'showbutton'=>true
		));
	    } else{
			header("HTTP/1.0 404 Not Found");
			$this->assignAndRender('404_rent_not_found');}
	}
	}else	
	    throw new CHttpException(404, 'page not found');
    }

    
    
    
    /**
     * получение списка комментариев
     * @param type $rent
     * @return type 
     */
    public function getCommentsList($rent) {
	$commentCriteria = new CDbCriteria(
			array(
			    'condition' => '`t`.`receiver_id` = :rentid',
			    'params' => array(':rentid' => $rent->id),
			    'order' => '`date` DESC',
			)
	);
	$commentPagination = new CPagination(RentComment::model()->count($commentCriteria));
	$commentPagination->setPageSize(Yii::app()->params['resultsPerPage']);
	$commentPagination->pageVar = 'page';
	$commentPagination->applyLimit($commentCriteria);
	$comments = RentComment::model()->findAll($commentCriteria);
	return array('comments' => $comments, 'pagination' => $commentPagination);
    }

    /**
     * Отправка сообщения
     * @param type $rent 
     */
    private function SendComment($rent) {
	$comment = new RentComment();
	if (isset($_POST['RentComment']) && (!Yii::app()->user->isGuest) && ($this->user->active)) {
	    $comment->attributes = $_POST['RentComment'];
	    $comment->receiver_id = $rent->id;
	    $comment->sender_id = Yii::app()->user->id;
	    $comment->date = date(DATE_W3C);
	    if ($comment->save()) {
		$baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
		if($comment->sender_id!==$rent->user)
		$rent->renter->staticNotify(User::NOTIFY_RENT_COMMENT,array('{link}'=>"$baseUrl/rent/".$rent->id)); //отправка уведомления пользователю
		Yii::app()->user->setFlash('success', Yii::t('default', 'comment added on'));
		$comment->unsetAttributes();
		if (!isset($_POST['isajax']))
		    $this->redirect(Yii::app()->request->requestUri);
	    }
	    else
		Yii::app()->user->setFlash('error', Yii::t('default', 'comment not added'));
	}
	return $comment;
    }

    /**
     * подключение необходимых файлов и рендер
     * @param type $view
     * @param type $params 
     */
    public function assignAndRender($view, $params=array()) {
	$this->assignYandexMap();
	$this->assignControllerJsCss(
		array(
	    'style.css',
	    'tipTip.css',
	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'jquery.fancybox.css',
	    'jquery.ad-gallery.css',
		), array(
	    'menu.js',
	    'jquery.tipTip.js',
	    'jquery.jscrollpane.min.js',
	    'jquery.ad-gallery.js',
	    //'FormSubmitEnter.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',
	    'jquery.tipTip.js',
	    'somefunctions.js',
	    'jquery.fancybox.js',
	    'jquery.keyboard.js',
		    'searchMap2.js',
                      'upScript.js' //скрипт для апов
		)
	);
	$this->render($view, $params);
    }

}

?>
