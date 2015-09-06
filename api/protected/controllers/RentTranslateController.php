<?php
//перевод аренды на другой язык
Yii::import('application.controllers.MyRentsController');
class RentTranslateController extends MyRentsController {
    public function actionTranslate($id = 0) {
	$rent=false;
	if ($id)  $rent = Rent::model()
			->with(array('descriptions' => array('on' => 'language=1')))
			->findByPk($id,'`is_deleted` <> 1');
	
	if ($rent&&isset($rent->descriptions[0])) {
	    $description = $rent->descriptions[0];
	    $description->name = Yii::app()->bing->translate($description->name);
	    $description->overview = Yii::app()->bing->translate($description->overview);
	    $description->rules = Yii::app()->bing->translate($description->rules);
	    
	    if(Yii::app()->request->isAjaxRequest){
		$this->renderPartial('_rent_overview',array('description'=>$description,'rent'=>$rent,'showbutton'=>false));
	    }else throw new CHttpException(404, 'page not found');
	}else
	    throw new CHttpException(404, 'page not found');
    }

}
