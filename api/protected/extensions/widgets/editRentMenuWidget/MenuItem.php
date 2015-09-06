<?php
/**
 * класс элемента пункта меню
 */
class MenuItem extends CComponent{
    private $_opname;
    private $_name;
    private $_rent;
    private $_linker;
    public function __construct($rentId, $opname='', $name='', $linker = false) {
	$this->_rent = Rent::model()->findByPk($rentId); 
	$this->_opname = $opname;
	$this->_name = $name;
	$this->_linker = ($linker)?$linker:$opname;
    }
    
    public function setOption($opname){
	$this->_opname = $link;
    }
    
    public function getOption(){
	return $this->_opname;
    }
    
    public function setName($name){
	$this->_name = $name;
    }
    
    public function getname(){
	return $this->_name;
    }
    
    /**
     * генерация и вывод ссылки 
     */
    
    public function getLink($params = array()){
	if($this->isNeeded){
	    if(isset($params['class'])) $params['class'] .= ' isneeded';
	    else $params['class'] = 'isneeded';
	}
	return CHtml::link($this->_name, '/rent/'.$this->_rent->id.'/edit/'.$this->_linker,$params);
    }
    
     /**
     * проверка необходимости заполнения элемента меню
     *  чтобы добавить новую проверку досаточно написать для неё функцию с названием need_имяполя
     * @param type $menuItem
     * @return type 
     */
    public function getIsNeeded(){
	$result = false;
	$methodname =  'need_'.$this->option;
	    if(method_exists($this, $methodname)) $result = $this->$methodname();
	return $result;
    }
    
    /**
     *установщики функций определения необходимости заполнения меню 
     * все типы Boolean
     */

    //по цене - проверяем не нулевое ли хоть одно поле цены
    private function need_price(){
	$result = ($this->_rent->price_day || $this->_rent->price_month || $this->_rent->price_week)?false:true;
	return $result;
    }
    
    //по адресу - проверяем существование адреса для аренды
    private function need_place(){
	$address = isset($this->_rent->adress)?false:true;
	return $address;
    }
}
?>
