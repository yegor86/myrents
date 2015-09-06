<?php

/**
 * SearchForm class.
 * Форма поисковой страницы
 */
class SearchForm extends CFormModel {

    /**
     * @property string $searchString  строка поискового запроса
     * @property integer $rooms_count  количество комнат
     * @property integer $type
     */
    public $searchString;
    public $rooms_count = array(1, 2, 3, 4, 5);
    public $floor = 0;
    //public $type = 1;
    //public $todo = 1;
    public $type;
    public $todo;
    
    public $justwithphotos = 0;
    public $pricemin = 1; 
    public $pricemax = 0;
    public $current_price = 0;
    public $amenities = array();
    public $neiborhood = array();
    public $squaremin = 1;
    public $squaremax = 0;
    public $city = false;
    public $region = false;
    public $order = 'creation_date';
    public $asc = false;
    public $coords = '0, 0';
    public $radius = 5000;
    public $mapsearch = false;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
	return array(
	    // username and password are required
	    //array('searchString', 'required', 'enableClientValidation' => true),
	    array('searchString', 'length', 'max' => 250,  
		'message' => Yii::t('default','message.SearchForm.searchstring.max.250')),
	    array('region, city, coords', 'type','type'=>'string'),
	    array('order','match','pattern'=>'/[a-z_]+/iu'),
	    array('asc','boolean'),
	    array('pricemin, pricemax', 'numerical', 'enableClientValidation' => true),
	    array('radius', 'numerical'),
	    array('type, justwithphotos, todo, squaremin, squaremax, floor, mapsearch', 'numerical', 'integerOnly' => true)
	);
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
	return array(
	    'searchString' => Yii::t('default','AR.SearchForm.searchString'),
	    'rooms_count' =>  Yii::t('default','AR.SearchForm.rooms_count'),
	    'type' => Yii::t('default','AR.SearchForm.type'),
	    'justwithphotos' => Yii::t('default','AR.SearchForm.justwithphotos'),
	);
    }

}
