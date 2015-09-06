<?php

class GetcurrencyCommand extends CConsoleCommand {

private $_src_text = '';         // National Bank page content
private $_matches = array();     // Filtered Bank page content by regexp
                                                                                                                             
private $_regexp = false ;
private $_limit_try = 10; // Attempt connections
                                                                                                                                   
private $_mysql_query = '';                                                                                                       
private $_mysql_result = false;                                                                                              
private $_result_row = false;                                                                                                        
private $_key    =false;                                                                                                               
private $_rate = 1; 
    
    public function run() {
	Yii::log('GetCurrencyCommand job started', 'info','CRONINFO');
	$this->initVars();
	Yii::log('gtting file', 'info','CRONINFO');
	if (!$this->downloadPage()) {
	Yii::log('cannot get file, check internet connection', 'info','CRONINFO');
	    return;
	}else Yii::log('file geted', 'info','CRONINFO');;
	
	Yii::log('parsing source', 'info','CRONINFO');
	if(!$this->parcePage()){
	    	Yii::log('Cannot parce source', 'info','CRONINFO');
	    return;
	} else 	Yii::log('data is selected', 'info','CRONINFO');
	Yii::log('processing', 'info','CRONINFO');
	Yii::log('refreshing currency', 'info','CRONINFO');
	if(!$this->updateCurrency()){
	   Yii::log('currensy is not updated', 'info','CRONINFO');
	    return;
	} else Yii::log('currensy updated', 'info','CRONINFO');
	Yii::log('update pricing indexes', 'info','CRONINFO');
	if(!$this->updatePricesIndex()){
	    Yii::log('prising indexes  is not updated', 'info','CRONINFO');
	    return;	    
	} else Yii::log('pricing indexes updated', 'info','CRONINFO');
	Yii::log('Job complete', 'info','CRONINFO');
    }
    
    /**
     * Init vars
     */
    private function initVars(){
	$this->_regexp = '~                                                                                                                                                  
            <tr>\s*                                                                                                                                          
            <td[^>]*>([^<]*)</td>\s* #код цифровой                                                                                                           
            <td[^>]*>([^<]*)</td>\s* #код буквенный                                                                                                          
            <td[^>]*>([^<]*)</td>\s* #количество единиц                                                                                                      
            <td[^>]*>([^<]*)</td>\s* #название валюты                                                                                                        
            <td[^>]*>([^<]*)</td>\s* #официальный курс нацбанка                                                                                              
            </tr>                                                                                                                                            
        ~uimx';    
    }
    
    /**
     * Download Page
     * @return boolean
     */
    private function downloadPage() {
	$geted = false;
	$tryNumber = 1;
	while ((!$geted)&&($tryNumber<=$this->_limit_try)) { //выполняем в цикле до тех пор, пока не получим, на случай недоступности сайта нацбанка
	    Yii::log('try ' .$tryNumber.': ', 'info','CRONINFO');
	    $src_text = file_get_contents('http://www.bank.gov.ua/control/uk/curmetal/detail/currency?period=daily');
	    if ($src_text) {
		$this->_src_text = $src_text;
		$geted = true;
	    }else {
		Yii::log('file not geted, waiting', 'info','CRONINFO');
		$tryNumber++;
		sleep(10);
	    }
	}
	return $geted;
    }


    /**
     * Parsing page
     * @return boolean 
     */
    private function parcePage() {
	$result = false;
	
	if (preg_match_all($this->_regexp, $this->_src_text, $matches)) { // search by text
	    $result = true;
	    Yii::log('data is selected', 'info','CRONINFO');
	    unset($matches[0]);  // Remove useless array from found resuts
	    $this->_matches = $matches;
	}
	else
	  Yii::log('cannot select data', 'info','CRONINFO');
	return $result;
    }

    
    /**
     * Select data from DB
     * @return boolean
     */
    private function updateCurrency(){
	$result=true;
	$currencyArray = Currency::model()->findAll();
	foreach ($currencyArray as $currency){
	    if($currency->id!=1){ // skip UAH
		echo "обработка ".$currency->short_name.": ";
		$key = array_search($currency->short_name,$this->_matches[2]);     // find currency ID
		if($key){
		$currency->rate = (float)$this->_matches[5][$key] / (float)$this->_matches[3][$key];
		$result = $result&&($currency->save());
		if($result) Yii::log('refreshed', 'info','CRONINFO');
		}
		else Yii::log('Currency not found', 'info','CRONINFO');
		
	    }
	}
	return $result;
    }
    
    /**
     * Update indexed prices for items
     * @return boolean 
     */
    private function updatePricesIndex(){
	$result = false;
	
	$result = Yii::app()->db->createCommand('UPDATE Rent JOIN Currency ON Currency.id=Rent.currency_id set Rent.index_price_day = Rent.price_day * Currency.rate, Rent.index_price_month = Rent.price_month*Currency.rate, Rent.index_price_week=Rent.price_week*Currency.rate;')
		->query();
	return $result;
    }
}

