<?php
Yii::import('application.controllers.MyRentsController');
class MembersController extends MyRentsController {

    public function actionIndex() {

           
    }
    public function assignAndRender($view, $params = array()) {
        $this->assignControllerJsCss(
                array(
            'style.css',
            'tipTip.css',
            'jquery-ui-1.8.16.custom.css',
            'members.css',
            'jquery.fancybox.css'
                ), array(
            'menu.js',
            'jquery.tipTip.js',
            'jquery.jscrollpane.min.js',
            'jquery-ui-1.8.16.custom.min.js',
            'jquery.jcarousel.min.js',
            'jquery.tipTip.js',
            'somefunctions.js', 'jquery.fancybox.js',
                )
        );
        $this->render($view, $params);
    }
    
    public function actionUsers($usertype='users'){
	
	
	
	$criteria = new CDbCriteria();

	$criteria->with = 'fullRentsCount';
	$criteria->order='`id` DESC';
	$selflink ="/members";
	/*switch ($usertype){
	    case 'users':$criteria->scopes = 'is_renter';break;
	    case 'realtors':$criteria->scopes = 'realtor';break;
	    case 'private':$criteria->scopes = 'private_renter';break;
	}
	  */
	$rentertype = false;
	switch ($usertype){
	    case 'private':$rentertype = 'user';$selflink = '/members/private';break;
	    case 'realtors':$rentertype = 'renter';$selflink = '/members/realtors'; break;
	    case 'agency':$rentertype = 'agency';$selflink = '/members/agency';break;
	}
	if($rentertype)
	$criteria->scopes = array(
	    'renterType'=>$rentertype
	);
	$count = User::model()->count($criteria);
	$pagination = new CPagination($count);
	$pagination->setPageSize(Yii::app()->params['memberlistPerPage']);
	$pagination->pageVar = 'page';
	$pagination->applyLimit($criteria);
	/*$criteria->with = array(
	    'fullRentsCount','validAgencies'=>array(
		'scopes'=>array('texted'=>$this->curlang->id)
	    )
	);*/
	$users = User::model()->findAll($criteria);
	$viewparams = array(
	    'view'=>'_userlist',
	    'params'=>array(
	    'pagination'=>$pagination,
	    'users'=>$users,
	    'selflink'=>$selflink,
		'JSNoReload'=>true
		)
	);

	$this->show('index', $viewparams);
    }
    /*
    public function actionAgency() {
	$criteria = new CDbCriteria();
	$criteria->scopes=array(
	    'texted'=>$this->curlang->id,
	    'active'
	);
	$pagination = new CPagination(Agency::model()->count($criteria));
	$pagination->setPageSize(Yii::app()->params['memberlistPerPage']);
	$pagination->pageVar = 'page';
	$pagination->applyLimit($criteria);
	$agencies = Agency::model()->findAll($criteria);
	$viewparams = array(
	    'view' => '_agencylist',
	    'params' => array(
		'selflink'=>'/members/agency',
		'pagination'=>$pagination,
		'agencies'=>$agencies,
	    ));
	$this->show('index', $viewparams);
    }
*/
}