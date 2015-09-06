<?php
Yii::import('application.extensions.widgets.userEdit.PhonesEditorWidget.PhonesForm');

class PhonesEditorWidget extends BaseWidget {
    public $user=false;
    private $_phoneslist;
    public function init() {
	    $this->_phoneslist = $this->user['phone'];
	    parent::init(__FILE__);
	    $this->addClientCsriptFiles();
    }
    public function run() {
		if(!Yii::app()->User->isGuest){
	$phonesArray = array();
	
	//если данные пришли по запросу - создаём телефоны и валидируем
	if(isset($_POST['PhonesForm'])){
	    $valid=true; //флаг валидности, по-умолчанию считаем его верным
	    $datatosave = array();
	    foreach ($_POST['PhonesForm'] as $key=>$phone){
		if($_POST['PhonesForm'][$key]['phone']){
		$booferModel = new PhonesForm;
		$booferModel->attributes = $_POST['PhonesForm'][$key];
		$phonesArray[]=$booferModel;
		$valid = $valid&&$booferModel->validate();
		$datatosave[]=$booferModel->phone; //тет просто собираем массив значений, будет использоваться для сохранения
		}
	    }
	    //если все телефоны валидны, то преобразовуем полученные значения в строку и сохраняем
	    if($valid) {
		if(!$this->user) $this->user = User::model ()->findByPk (Yii::app ()->User->id);
		$this->user->phone = implode ("\n", $datatosave);
		$this->user->save();
		Yii::app()->user->setFlash('success', Yii::t('default', 'message.saved')); 
	    } else Yii::app()->user->setFlash('error', Yii::t('default', 'mesage.not.saved')); //иначе ошибка
	}
	//если данных постовых небло - берём существующие. 
	elseif($this->_phoneslist){	
	    //все телефоны хранятся в одном поле. разделённые переносом строк - разбиваем поле на строки и заполняем массив
	 $tempArr = preg_split('/[\r\n]+/',$this->_phoneslist);
	  foreach ($tempArr as $phone){
	      $tphone = new PhonesForm;
	      $tphone->phone = $phone;
	      $phonesArray[]=$tphone;
	  }
	}
	//если нет и существующих - просто создаём одно пустое поле для телефона
	$countnewphones = Yii::app()->params['phonesCount'] - count($phonesArray) ;
	for ($i=1;$i<=$countnewphones;$i++){
	    $phonesArray[]= new PhonesForm;
	}

	if ($this->_fast) $this->render('PhonesEdit',array('phones'=>$phonesArray));
	else {
	echo('<div id="PhonesEditResult">');
	$this->render('PhonesEdit',array('phones'=>$phonesArray));
	echo('</div>');
	}
	
	} else throw new CHttpException(403, Yii::t('default','error.403.access.danied'));
    }

    
   private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	//$cs->registerScriptFile($this->_assetsUrl . '/js/jquery.imagetick.js', CClientScript::POS_HEAD);
	//$cs->registerScriptFile($this->_assetsUrl . '/js/AmenityWidget.js', CClientScript::POS_HEAD);
    }

}

?>
