<?php
/*
 * контроллер генерации файла XML
 */
Yii::import('application.controllers.AdminController');
class YrlController extends AdminController {

    public function actionXml() {
	//из-за большого количества записей во избежание таймаута и превышения лимита памяти обрабатываться будут не все строки сразу
	// а постепенно по 1000 за шаг итерации
	$offset =(isset($_POST['start']))?$_POST['start']:0;
	$count = Rent::model()->count($this->getCriteria(false));
	$limit =1000; //шаг итерации
	$fname = Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'].'yandex.xml';
	
	//header ("content-type: file/xml");
	if($offset==0){
	    $file = fopen($fname,'w');
	fwrite ($file,'<?xml version="1.0" encoding="utf-8"?>	    
	    <realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
	    <generation-date>'.date("Y-m-d\TH:i:s+02:00").'</generation-date>');
	} else {
	    $file = fopen($fname,'a');
	}
	if ($offset<$count){
	    fwrite ($file,$this->getEntry($offset,$limit));
	    $offset += $limit;
	    echo("\n");
	}
	if($offset>=$count) fwrite ($file,'</realty-feed>');
	fclose($file);
	if($offset>=$count)
	$this->show('xml_created');
	else $this->show('xml_creation',array('offset'=>$offset,'count'=>$count));
	
    }

    /**
     * текст - XML списка аренд
     * @param type $offset
     * @param type $limit
     * @return boolean 
     */
    private function getEntry($offset=0,$limit=1){
	ini_set('max_execution_time', 0);
	$criteria = $this->getCriteria();
	$criteria->offset = $offset;
	$criteria->limit = $limit;
	$rents = Rent::model()->findAll($criteria);
	
	$result = '';
	
	if(count($rents)) foreach ($rents as $rent){
	    if(isset($rent->descriptions[0]))
	    $result .= $this->getXmlFromRent($rent);
	}
	return $result;
    }
    
    
    private function getXmlFromRent($rent){
	$result ='';
	$adr = explode(', ', $rent->adress->name);
	if(count($adr)>3){
	$result = "<offer internal-id=\"$rent->id\" >\n";
	$result .='<type>'.(($rent->todo==1)?'аренда':'продажа').'</type>' ."\n";
	$result .='<property-type>'.(($rent->type!=3)?'жилая':'офис').'</property-type>'."\n";
	$result .='<category>'.Yii::t('default',$rent->rent_type->name,array(),null,'ru').'</category>'."\n";
	$result .='<url>'. $this->createAbsoluteUrl('/') .'/rent/' .$rent->id.'</url>';
	$result .='<creation-date>'. date("Y-m-d\TH:i:s+02:00",  strtotime($rent->creation_date)).'</creation-date>';
	$result .='<last-update-date>'. date("Y-m-d\TH:i:s+02:00",  strtotime($rent->last_modify)).'</last-update-date>';
	$result .='<location>'."\n";
	$result .='<country>'. $adr[0] .'</country>'."\n";
	$result .='<region>'. $adr[1] .'</region>'."\n";
	$result .='<locality-name>'. $adr[2] .'</locality-name>'."\n";
	$result .='<sub-locality-name>'. $adr[3] .'</sub-locality-name>'."\n";
	$address = implode(', ', array_slice($adr,4));
	if(!$address) return false;
	$result .='<address>'. $address .'</address>'."\n";
	$result .='<latitude>'. $rent->adress->geox .'</latitude>'."\n";
	$result .='<longitude>'. $rent->adress->geoy .'</longitude>'."\n";
	$result .='</location>'."\n";
	$result .='<sales-agent>'."\n";
	$result .='<name>'. $rent->renter->firstname.' '.$rent->renter->lastname .'</name>'."\n";
	$phoneArr = preg_split('/[\r\n]+/',$rent->renter->phone);
	if(!count($phoneArr)||(!$phoneArr[0])) return false;
	foreach($phoneArr as $phone){
	$result .='<phone>'. $phone .'</phone>'."\n";    
	}
	$result .='</sales-agent>'."\n";
	
	$result .='<price>'."\n";
	$rowname = Yii::app()->params['current_price'][$rent->current_price]['row'];
	$result .='<value>' . $rent->$rowname . '</value>'."\n";
	if($rent->todo==1)
	    $result .='<period>' . Yii::app()->params['current_price'][$rent->current_price]['sname'] . '</period>'."\n";
	$result .='<currency>'. $rent->currency->short_name .'</currency>'."\n";
	$result .='</price>'."\n";
	foreach ($rent->photos as $photo){
	    if(preg_match('/^[-a-z\d_\.]+$/ui', $photo->file))
	 $result .=    '<image>' 
        . $this->createAbsoluteUrl('/') 
        . '/uploads/rentpic/' 
        . Yii::app()->putils->fragment($rent->id) 
        . '/' 
        . $photo->file 
        .'</image>'
        ."\n";
	}
	$result .='<description>'.  $rent->descriptions[0]->overview.'</description>'."\n";
	$result .='<area>'."\n";
	$result .='<value>'. $rent->square .'</value>'."\n";
	$result .='<unit>кв.м.</unit>'."\n";
	$result .='</area>'."\n";	
	$result .='<rooms>'.$rent->rooms_count.'</rooms>';
	$result .= '</offer>';
	}
	return $result;
    }
    
    
    
    /**
     * преподготовленные критерии поиска аренд
     */
    private function getCriteria($full = true) {
	//создаём условие поиска аренд: аренды должны быть активны, иметь заполненные поля адреса,
	// цены и название на русском
	$criteria = new CDbCriteria();
	 /* Условия актуальности объявлений */
        $minLastUpdateFlat = 45; // квартира обновлена (дни)
        $minCreatedFlat = 90; // квартира создана (дни)
        $minLastUpdateRent = 14; // арнеда обновлена (дни)
        $minCreatedRent = 7; // аренда создана (дни)
	$criteria->condition = ' `in_show`=1 AND (CASE  `current_price` 
		   WHEN 1 THEN `index_price_day`
		   WHEN 2 THEN `index_price_week`
		   WHEN 3 THEN `index_price_month`
		   END)>0';
        $criteria->condition = '
            `todo` = 1 and 
                (`last_up` >= NOW() - INTERVAL '.$minLastUpdateRent.' DAY 
                    or `creation_date` >= NOW() - INTERVAL '.$minCreatedRent.' DAY 
                    or `last_modify` >= NOW() - INTERVAL '.$minLastUpdateRent.' DAY) 
            or
            `todo` = 2 and
                (`last_up` >= NOW() - INTERVAL '.$minLastUpdateFlat.' DAY 
                    or `creation_date` >= NOW() - INTERVAL '.$minCreatedFlat.' DAY 
                    or `last_modify` >= NOW() - INTERVAL '.$minLastUpdateFlat.' DAY)';
	if (!$full) { //если выборка для подсчёта
	    $criteria->with = array(
		'descriptions' => array('joinType' => 'INNER JOIN', 'on' => 'language=1',),
		'adress' => array('joinType' => 'INNER JOIN',),
	    );
	} else { //полная выборка (запрос гораздо сложнее)
	    $criteria->with = array(
		'photos', 'rent_todo', 'rent_type', 'renter', 'neighbors', 'amenities','currency',
		'descriptions' => array('joinType' => 'INNER JOIN', 'on' => 'language=1',),
		'adress' => array('joinType' => 'INNER JOIN',),
	    );
	}
	return $criteria;
    }
    

}