<?php

class TopswitcherCommand extends CConsoleCommand {
    private $_top_rf_shift;
    private $_top_rh_shift;
    private $_top_ro_shift;
    private $_top_sf_shift;
    private $_top_sh_shift;
    private $_top_so_shift;    
    private $_Top_rent_flat = array();
    private $_Top_rent_house = array();
    private $_Top_rent_office = array();
    private $_Top_sale_flat = array();
    private $_Top_sale_house = array();
    private $_Top_sale_office = array();
    private $_TopResult_rf = array();
    private $_TopResult_rh = array();
    private $_TopResult_ro = array();
    private $_TopResult_sf = array();
    private $_TopResult_sh = array();
    private $_TopResult_so = array();
    private $_MainList = array();

    
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
	$this->_top_rf_shift = Yii::app()->cache->get('top_rf_shift');
	if (!$this->_top_rf_shift) $this->_top_rf_shift =0;
	$this->_top_rh_shift = Yii::app()->cache->get('top_rh_shift');
	if (!$this->_top_rh_shift) $this->_top_rh_shift =0;
	$this->_top_ro_shift = Yii::app()->cache->get('top_ro_shift');
	if (!$this->_top_ro_shift) $this->_top_ro_shift =0;
	$this->_top_sf_shift = Yii::app()->cache->get('top_sf_shift');
	if (!$this->_top_sf_shift) $this->_top_sf_shift =0;
	$this->_top_sh_shift = Yii::app()->cache->get('top_sh_hift');
	if (!$this->_top_sh_shift) $this->_top_sh_shift =0;
	$this->_top_so_shift = Yii::app()->cache->get('top_so_shift');
	if (!$this->_top_so_shift) $this->_top_so_shift =0;

	
	//выбираем записи
	$TopRows = Top::model()->with('rent')->findAll(
		array(
		    'condition'=>'`start` < :curdate AND `end` > :curdate and `action` = :action ', 
		  'params'=>array(':curdate'=>date("y-m-d H:i:s"), ':action'=>'t')  
		    )
		  );
	$varname = '_Top_rent_flat';
	foreach ($TopRows as $row) {
	    switch ($row->rent->todo){
		case 1: switch($row->rent->type){
		    case 1: $varname = '_Top_rent_flat';break;
		    case 2: $varname = '_Top_rent_house';break;
		    case 3: $varname = '_Top_rent_office';break;
		};break;
		case 2: switch($row->rent->type){
		    case 1: $varname = '_Top_sale_flat';break;
		    case 2: $varname = '_Top_sale_house';break;
		    case 3: $varname = '_Top_sale_office';break;
		};break;
	    }
	    array_push($this->$varname, $row->rent->id);
	}
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
	$this->_TopResult_rf  = CustomFunctions::RoundedArraySlise($this->_Top_rent_flat, $this->_top_rf_shift, Yii::app()->params['topCount']);
	$this->_TopResult_rh  = CustomFunctions::RoundedArraySlise($this->_Top_rent_house, $this->_top_rh_shift, Yii::app()->params['topCount']);
	$this->_TopResult_ro  = CustomFunctions::RoundedArraySlise($this->_Top_rent_office, $this->_top_ro_shift, Yii::app()->params['topCount']);
	$this->_TopResult_sf  = CustomFunctions::RoundedArraySlise($this->_Top_sale_flat, $this->_top_sf_shift, Yii::app()->params['topCount']);
	$this->_TopResult_sh  = CustomFunctions::RoundedArraySlise($this->_Top_sale_house, $this->_top_sh_shift, Yii::app()->params['topCount']);
	$this->_TopResult_so  = CustomFunctions::RoundedArraySlise($this->_Top_sale_office, $this->_top_so_shift, Yii::app()->params['topCount']);
	//сдвиг
	$this->_top_rf_shift = CustomFunctions::shiftMarker($this->_top_rf_shift, Yii::app()->params['topCount'], count($this->_Top_rent_flat));
	$this->_top_rh_shift = CustomFunctions::shiftMarker($this->_top_rh_shift, Yii::app()->params['topCount'], count($this->_Top_rent_house));
	$this->_top_ro_shift = CustomFunctions::shiftMarker($this->_top_ro_shift, Yii::app()->params['topCount'], count($this->_Top_rent_office));

	$this->_top_sf_shift = CustomFunctions::shiftMarker($this->_top_sf_shift, Yii::app()->params['topCount'], count($this->_Top_sale_flat));
	$this->_top_sh_shift = CustomFunctions::shiftMarker($this->_top_sh_shift, Yii::app()->params['topCount'], count($this->_Top_sale_house));
	$this->_top_so_shift = CustomFunctions::shiftMarker($this->_top_so_shift, Yii::app()->params['topCount'], count($this->_Top_sale_office));

    }
    
    /**
     *сохранение значений в кеше 
     */
    private function saveVals(){
	//сохраняем в кеше
	Yii::app()->cache->set('top_id_list11', $this->_TopResult_rf , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_id_list12', $this->_TopResult_rh , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_id_list13', $this->_TopResult_ro , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_id_list21', $this->_TopResult_sf , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_id_list22', $this->_TopResult_sh , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_id_list23', $this->_TopResult_so , Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_rf_shift', $this->_top_rf_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_rh_shift', $this->_top_rh_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_ro_shift', $this->_top_ro_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_sf_shift', $this->_top_sf_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_sh_shift', $this->_top_sh_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('top_so_shift', $this->_top_so_shift, Yii::app()->params['cachetime']);
	Yii::app()->cache->set('mainpage_id_list', $this->_MainList, Yii::app()->params['cachetime']);
    }
    
   
}

