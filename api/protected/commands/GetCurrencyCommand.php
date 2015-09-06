<?php

class GetcurrencyCommand extends CConsoleCommand {
//work variables
private $_src_text = '';         //сюда будет загружен исходный код страницы нацбанка
private $_matches = array();     //сюда будет помещён результат выбора регуляркой
//в  $regexp хранится регулярка                                                                                                                              
private $_regexp = false ;
private $_limit_try = 100; //количество попыток соединения
//динамические переменные                                                                                                                                    
private $_mysql_query = ''; //временная переменная для запросов                                                                                                       
private $_mysql_result = false; //переменная для складывания результатов                                                                                              
private $_result_row = false;//переменная для перебора записей                                                                                                        
private $_key    =false;     //ключ найденного значения                                                                                                               
private $_rate = 1; //тут будет хранится отношение для валюты 
    
    public function run() {
	
	$this->initVars();
	
	echo "получение файла: \n";
	if (!$this->downloadPage()) {
	    echo "файл не получен\n проверьте путь и  подключение к интернету\n";
	    return;
	}else echo "файл получен\n";
	
	echo "парсинг иcходного текста:";
	if(!$this->parcePage()){
	    echo "данные не выбраны \n Проверьте содержимое исходного файла и регулярное выражение \n";
	    return;
	} else echo "данные выбраны\n";
	echo "обработка\n";
	echo "Обновление валют:";
	if(!$this->updateCurrency()){
	    echo "Валюты не обновлены \n";
	    return;
	} else echo "Валюты обновлены\n";
	echo "Обновление индексов цен:";
	if(!$this->updatePricesIndex()){
	    echo "Индексы не обновлены \n";
	    return;	    
	} else echo "Индексы обновлены\n";

    }
    
    /**
     *инициализация значений 
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
     * скачивание страницы
     * @return boolean
     */
    private function downloadPage() {
	$geted = false;
	$tryNumber = 1;
	while ((!$geted)&&($tryNumber<=$this->_limit_try)) { //выполняем в цикле до тех пор, пока не получим, на случай недоступности сайта нацбанка
	    echo("попытка ".$tryNumber.":");
	    $src_text = file_get_contents('http://www.bank.gov.ua/control/uk/curmetal/detail/currency?period=daily');
	    if ($src_text) {
		$this->_src_text = $src_text;
		$geted = true;
	    }else {
		echo "3";
		echo ("файл не получен, ожидание 10 секунд\n");
		$tryNumber++;
		sleep(10);
	    }
	}
	return $geted;
    }


    /**
     * обработка страницы
     * @return boolean 
     */
    private function parcePage() {
	$result = false;
	
	if (preg_match_all($this->_regexp, $this->_src_text, $matches)) { //поиск по тексту
	    $result = true;
	    echo "данные выбраны\n";
	    unset($matches[0]);  //  убираем ненужный массив из результатов поиска
	    $this->_matches = $matches;
	}
	else
	    echo "данные не выбраны \n Проверьте содержимое исходного файла и регулярное выражение \n";
	return $result;
    }

    
    /**
     *выбор данных из БД 
     * @return boolean
     */
    private function updateCurrency(){
	$result=true;
	$currencyArray = Currency::model()->findAll();
	foreach ($currencyArray as $currency){
	    if($currency->id!=1){ //пропускаем гривну
		echo "обработка ".$currency->short_name.": ";
		$key = array_search($currency->short_name,$this->_matches[2]);     //поиск ключа для валюты
		if($key){
		$currency->rate = (float)$this->_matches[5][$key] / (float)$this->_matches[3][$key];
		$result = $result&&($currency->save());
		if($result) echo "обновлено\n";
		}
		else echo "валюта не найдена \n";
		
	    }
	}
	return $result;
    }
    
    /**
     *обновление Индексных цен объявлений
     * @return boolean 
     */
    private function updatePricesIndex(){
	$result = false;
	
	$result = Yii::app()->db->createCommand('UPDATE Rent JOIN Currency ON Currency.id=Rent.currency_id set Rent.index_price_day = Rent.price_day * Currency.rate, Rent.index_price_month = Rent.price_month*Currency.rate, Rent.index_price_week=Rent.price_week*Currency.rate;')
		->query();
	return $result;
    }
}

