<?php

//Класс наследует стандартный ХТМЛ,
class MRChtml extends CHtml {

    //метод - ajaxLink взят из стандартного, но добавлена возможность указывать прелоадер
    //и изменять хистори броузера
    //$ajaxOptions['preloadUrl'] - указывает на изображение, которое будет использоваться как прелоадер
    //$ajaxOptions['preloadBlock'] - указывает место, в которое будет загружен прелоадер,
    // если параметр не передан, то будет использоваться блок, преданый в update  или  replace
    // если-же и те не указаны, то не исполняется
    /**
     *
     * @param type $text
     * @param type $url
     * @param array $ajaxOptions
     * @param type $htmlOptions
     * @return type 
     */
    public static function ajaxLink($text, $url, $ajaxOptions = array(), $htmlOptions = array()) {
        if (!isset($ajaxOptions['url']))
            $ajaxOptions['url'] = $url;
        if (!isset($htmlOptions['href']))
            $htmlOptions['href'] = $url;

	
        //добавленный код

        $updUrlFunction = '';
        if (isset($ajaxOptions['updateUrl'])) {
            $updUrlFunction = 'if (!!(window.history && history.replaceState)) 
		window.history.replaceState("","","' . ($ajaxOptions['url']) . '");';
            $ajaxOptions['complete'] = 'function(){' . $updUrlFunction . '}';
        }

        //здесть проверка и добавление прелоадера
        $blockTOShowPreloader = (isset($ajaxOptions['preloadBlock'])) ? $ajaxOptions['preloadBlock'] : (
                (isset($ajaxOptions['update'])) ? $ajaxOptions['update'] : (
                        (isset($ajaxOptions['replace'])) ? $ajaxOptions['replace'] : false
                        )
                );

        if ($blockTOShowPreloader)
            if (isset($ajaxOptions['append_or_html'])=='html') {
                if (isset($ajaxOptions['preloadImage'])) {
                    $ajaxOptions['beforeSend'] = 'function(){
               
                    
                      $("' . $blockTOShowPreloader . '").html(\'<span class="mr_loading">' . $ajaxOptions['preloadImage'] . '</span>\');}';
                    $ajaxOptions['complete'] = 'function(){
                          $("#tiptip_holder").css({"display":"none"});
                          $("#tiptip_content").text("");
	    ' . $updUrlFunction . '
		}';
                }
            } else {
                if (isset($ajaxOptions['preloadImage'])) {
                    $preloaderId = uniqid('preloader');
                    $ajaxOptions['beforeSend'] = 'function(){
               
                    
                      $("' . $blockTOShowPreloader . '").append(\'<span id="' . $preloaderId . '" class="mr_loading">' . $ajaxOptions['preloadImage'] . '</span>\');}';
                    $ajaxOptions['complete'] = 'function(){
         
                      $("#' . $preloaderId . '").remove();
	    ' . $updUrlFunction . '
		}';
                }
            }
        //конец добавленного кода

	    
        if(!isset($ajaxOptions['url'])) $ajaxOptions['url'] = $url;
        $htmlOptions['ajax'] = $ajaxOptions;
        self::clientChange('click', $htmlOptions);
        return self::tag('a', $htmlOptions, $text);
    }

    
    	/**
	* лист-дата с триммом вместо группировки
	 */
	public static function listData($models,$valueField,$textField,$trim="\n")
	{
		$listData=array();
			foreach($models as $model)
			{
				$value= str_replace($trim,'',self::value($model,$valueField));
				$text= str_replace($trim,'',self::value($model,$textField)); 
				$listData[$value]=$text;
			}
		return $listData;
	}
    
    	/**
	* лист-дата с переводом, переводится только текст, но не значение
	 */
	public static function tlistData($models,$valueField,$textField,$dictionary = 'default',$tparams = array())
	{
		$listData=array();
			foreach($models as $model)
			{
				$value= self::value($model,$valueField);
				$text= Yii::t($dictionary,self::value($model,$textField)); 
				$listData[$value]=$text;
			}
		return $listData;
	}
 
	/**
	 *генератор оптионов с геокоординатами для дропдаун списка
	 * @param type $models  - массив с городами и их геокоординатами
	 */
	public static function listGeocoordOptions($models){
	    $optionsArray=array();
	    foreach ($models as $model){
		$value = $model['name'];
		$geo = $model['geox'].', '.$model['geoy'];
		$optionsArray[$value]=array('geocoords'=>$geo);
	    }
	    return $optionsArray;
	}
	
	
	
public static function enumItem($model,$attribute)
        {
                $attr=$attribute;
                self::resolveName($model,$attr);
                preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
                foreach(explode(',', $matches[1]) as $value)
                {
                        $value=str_replace("'",null,$value);
                        $values[$value]=Yii::t('enumItem',$attribute.'.'.$value);
                }
                return $values;
		
        }  

       public static function enumDropDownList($model, $attribute, $htmlOptions=array())
       {
          return CHtml::activeDropDownList( $model, $attribute,  MRChtml::enumItem($model,  $attribute), $htmlOptions);
       
       
       }

}

?>
