<?php

class TopFunc extends CComponent{

private static  $_singletonObject = false;
    
    private function __construct(){//заприватим конструктор, дабы не плодить толпу объектов
    } 
    
    /**
     * вызов синглтона
     * @return TopFunc 
     */
    static  function init(){
	if(!self::$_singletonObject) self::$_singletonObject = new TopFunc();
	return self::$_singletonObject;
    }
    
    
    //получение списка топ
    public function getTopIds($todo=1, $type=1) {
	$varname = 'top_id_list'.$todo.$type;
	$result = Yii::app()->cache->get($varname);
	if (!$result)
	    $result = array();
	return $result;
    }

    /*
     * получение листа на главную страницу
     */
    public function getMainPageIds(){
	$result = Yii::app()->cache->get('mainpage_id_list');
	if (!$result)
	    $result = array();
	return $result;
    }
    
    //получение полного списка топ
    public function getFullTopIds() {
	$result=array();
	if(isset(Yii::app()->user->roles)&&(Yii::app()->user->roles=='admin'||Yii::app()->user->roles=='moderator')){
	    $TopRows = Top::model()->findAll('`start` <= :curdate AND `end` >= :curdate and `action` = :action ', 
		  array(':curdate'=>date("Y-m-d H:i:s"), ':action'=>'t'));
	    foreach ($TopRows as $row) $result[]=$row->rent_id;
	}
	return $result;
    }

    /*
     * получение полного листа на главную страницу
     */
    public function getFullMainPageIds(){
	$result=array();
	if(isset(Yii::app()->user->roles)&&(Yii::app()->user->roles=='admin'||Yii::app()->user->roles=='moderator')){
	$MainRows = Top::model()->findAll('`start` <= :curdate AND `end` >= :curdate and `action` = :action ', 
		  array(':curdate'=>date("y-m-d H:i:s"), ':action'=>'m'));
	foreach ($MainRows as $row) $result[]=$row->rent_id;
	}
	return $result;
    }
    
    
    
    
    /*
     * добавление в топ
     */
    public function addToTop($rentId,$countDays,$action='t'){
	//ищем запись о аренде в топе
	$top = Top::model()->findByPk(array('rent_id'=>$rentId,'action'=>$action));
	//если запись была найдена, смотрим время. 
	//если объявление всё-ещё в топе и происходит запрос на поднятие в топ, добавляем ко времени,
	//если-же объявление уже не в топе, то обновляем всю запись
	if(!$top){ 
	    $top=new Top;
	    $top->action=$action;
	    $top->rent_id=$rentId;
	}
	if($top->end && $top->end >date("Y-m-d H:i:s", time())){  
	       $top->end = date("Y-m-d H:i:s", strtotime($top->end) + ($countDays * 24 * 60 * 60));
	 }else{
	    $top->start = date("Y-m-d H:i:s");
	    $top->end = date("Y-m-d H:i:s", time() + ($countDays * 24 * 60 * 60));
	 }
	$top->save();
	
    }
    
    /**
     * удаление записи
     * @param int $rentId
     * @param Enum['m','t'] $action
     */
    public function remove($rentId, $action='t'){
        $result=true;
        $top = Top::model()->with(array('rent'))->findByPk(array('rent_id'=>$rentId,'action'=>$action));

        if ($top&& ($top->rent->user==Yii::app()->user->id || 
                (isset(Yii::app()->user->roles)&&(Yii::app()->user->roles=='admin'||Yii::app()->user->roles=='moderator')))  ){
        
            $top->delete();
        } else $result=false;
        return $result;
                
    }
}
