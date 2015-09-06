<?php

class TopswitcherCommand extends CConsoleCommand {
    private $_top_shift;
    private $_main_shift;
    private $_TopList = array();
    private $_MainList = array();
    private $_TopResult = array();
    private $_MainResult = array();

    
    public function run($args) {
	$this->initVars();
	$this->process();
	$this->saveVals();
    }
    
    /**
     *инициализация значений 
     */
    private function initVars(){
	//проверяем наличие сдвига топдичта, и если его нет создаём переменную, равную нулю
	$this->_top_shift = Yii::app()->cache->get('top_shift');
	if (!$this->_top_shift) $this->_top_shift =0;
	//сдвиг на главной
	$this->_main_shift = Yii::app()->cache->get('mainpage_shift');
	if (!$this->_main_shift) $this->_main_shift =0;	
	
	//выбираем записи
	$TopRows = Top::model()->findAll(
		array(
		    'condition'=>'`start` < :curdate AND `end` > :curdate and `action` = :action ', 
		  'params'=>array(':curdate'=>date("y-m-d H:i:s"), ':action'=>'t')  
		    )
		  );
	foreach ($TopRows as $row) $this->_TopList[]=$row->rent_id;
	$MainRows = Top::model()->findAll(		array(
		    'condition'=>'`start` < :curdate AND `end` > :curdate and `action` = :action ', 
		  'params'=>array(':curdate'=>date("y-m-d H:i:s"), ':action'=>'m')  
		    )
);
	foreach ($MainRows as $row) $this->_MainList[]=$row->rent_id;
	
    }
    
    /**
     * определение результирующего массива и сдвиг 
     */
    private function process(){
	//выбор значений из "закольцованого" массива
	$this->_TopResult  = CustomFunctions::RoundedArraySlise($this->_TopList, $this->_top_shift, Yii::app()->params['topCount']);
	$this->_MainResult = CustomFunctions::RoundedArraySlise($this->_MainList, $this->_main_shift, Yii::app()->params['mainpageListCount']);
	//сдвиг
	$this->_top_shift = CustomFunctions::shiftMarker($this->_top_shift, Yii::app()->params['topCount'], count($this->_TopList));
	$this->_main_shift = CustomFunctions::shiftMarker($this->_main_shift, Yii::app()->params['mainpageListCount'], count($this->_MainList));

    }
    
    /**
     *сохранение значений в кеше 
     */
    private function saveVals(){
	//сохраняем в кеше
	Yii::app()->cache->set('top_id_list', $this->_TopResult , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('mainpage_id_list', $this->_MainResult, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_shift', $this->_top_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('mainpage_shift', $this->_main_shift, Yii::app()->params['cachetime']);

    }
    
   
}

