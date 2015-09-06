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
		$phonesArray[$key] = new PhonesForm();
		$phonesArray[$key]->attributes = $phone;
		$valid = $phonesArray[$key]->validate()&&$valid;
		$datatosave[] = $phonesArray[$key]->phone;
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
	else $phonesArray= $this->strToPhones($this->_phoneslist);
	
	//если нет и существующих - просто создаём одно пустое поле для каждого телефона
	$countnewphones = Yii::app()->params['phonesCount'] - count($phonesArray) ;
	for ($i=1;$i<=$countnewphones;$i++){
	    $phonesArray[]= new PhonesForm;
	}

	if ($this->_fast)  $this->render('PhonesEdit',array('phones'=>$phonesArray));
	else {
	echo('<div id="PhonesEditResult">');
	$this->render('PhonesEdit',array('phones'=>$phonesArray));
	echo('</div>');
	}
	
	} else throw new CHttpException(403, Yii::t('default','error.403.access.danied'));
    }

    /**
     * преобразование строки в массив форм
     * @param string  $str
     * @return \PhonesForm
     */
    private function strToPhones($str){
	$resultArray = array();
	$tempArr = preg_split('/[\r\n]+/',$this->_phoneslist);
	  foreach ($tempArr as $phone){
	      $tphone = new PhonesForm;
	      $tphone->phone = $phone;
	      $resultArray[]=$tphone;
	  }
	  return $resultArray;
    }




    private function addClientCsriptFiles(){
	$cs = Yii::app()->clientScript;
	//$cs->registerScriptFile($this->_assetsUrl . '/js/jquery.imagetick.js', CClientScript::POS_HEAD);
	//$cs->registerScriptFile($this->_assetsUrl . '/js/AmenityWidget.js', CClientScript::POS_HEAD);
    }

}

?>
