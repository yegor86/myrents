<?php
Yii::import('application.controllers.MyRentsController');
class SupportController extends MyRentsController {
    //класс поддержки
    
/**
 *обращеие к файлу поддержки
 */
    public function actionSupport(){
	$vars = array();
	$vars['supportForm']=new SupportForm();
	
	if(isset($_POST['SupportForm'])){
	    //если пришли данные от формы
	    $this->applyForm($vars['supportForm']);	    
	    Yii::app()->end();
	}elseif
	    //если пользователь не гость, заполняем данные формы
	    (!Yii::app()->User->isGuest) {
	    $vars['supportForm']->name = $this->user->firstname . '  ' . $this->user->lastname;
	    $vars['supportForm']->email = $this->user->email;
	}	
        if(Yii::app()->request->isAjaxRequest){
	$this->renderPartial('support', $vars);
        }else $this->assignAndRender('support_full', $vars);
    }

    
    /**
     * заполняем форму данными и выполняем требуемые операции (отправка почты)
     * @param CActiveForm SupportForm  $formModel 
     */
    private function applyForm($formModel){
	$formModel->attributes = $_POST['SupportForm'];
	if($formModel->validate()){
	 $this->sendMailFromForm($formModel);
	 $this->renderPartial('support_sended',array('sended'=>$formModel));
	}
	else  $this->renderPartial('_support',array('supportForm'=>$formModel));
    }
    
    public function assignAndRender($view, $params=array()) {
	$this->assignControllerJsCss(
		array(
	    'style.css',

	    'slide.css',
	    'jquery-ui-1.8.16.custom.css',
	    'jquery.jscrollpane.css',
	    'jquery.ad-gallery.css',
                    'jquery.fancybox.css'
		), array(
	    'menu.js',

	    'jquery.jscrollpane.min.js',
	    'jquery.ad-gallery.js',
	    'jquery-ui-1.8.16.custom.min.js',
	    'jquery.jcarousel.min.js',

	    'somefunctions.js','jquery.fancybox.js',
		)
	);
	$this->render($view, $params);
    }
    
    /**
     *отправка сообщения из формы 
     */
    private function sendMailFromForm($formModel){
	$sender = Yii::app()->params['suport_sender']; //отправитель (настраивается в параметрах)
	$recipier = Yii::app()->params['support_recipier']; //получатель (настраивается в параметрах)
	
	//хидер письма, указывается тип и кодировка, важно чтобы небыло кракозябров
	$header = "Content-type: text/plain; charset=utf-8 \r\n";
	$header.="From: $sender";
	
	//тема письма, установлен енкодер, важно чтобы небыло кракозябров
	$theme =  '=?UTF-8?B?'.base64_encode("Обращение в службу поддержки от $formModel->email").'?=';
	
	//текст сообщения
	$message = "Обращение в службу поддержки\n\n\n";
	$message .= "время: " . date("d-m-y H:i:s") . "\n";
	$message .= "Имя отправителя: $formModel->name \n";
	$message .= "E-mail  отправителя: $formModel->email \n\n\n";
	$message .= "Текст сообщения: \n $formModel->description";

	//непосредственная отправка сформированного письма
	mail($recipier,$theme,$message,$header);
    }
    
    
}
?>
