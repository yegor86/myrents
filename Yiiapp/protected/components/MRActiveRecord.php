<?php
/*
 * MyRent Active Record class
 * содежрит перегруженную функцию вывода (добавлено htmlspecialchars)
 */
class MRActiveRecord extends CActiveRecord{
	/**
	 * PHP getter magic method.
	 * This method is overridden so that AR attributes can be accessed like properties.
	 * @param string $name property name
	 * @return mixed property value
	 * @see getAttribute
	* добавлено: если запрашиваемый параметр является атрибутом и имеет текстовый формат, то выдаётся htmlspecialchars этого параметра

	 */
    
	public function __get($name)
	{
	    $attrib = parent::__get ($name);
            //if (is_string($attrib)) $attrib = htmlspecialchars ($attrib,ENT_QUOTES);
            if (is_string($attrib)) $attrib = htmlspecialchars(html_entity_decode($attrib),ENT_QUOTES);
	    return $attrib;
	}
	
    //применяем пагнацию
    public function paginateCriteria($criteria, $Cassname = __CLASS__){
		  $model = new $Cassname;
		$Pagination = new CPagination($model->count($criteria));
		$Pagination->setPageSize(Yii::app()->params['resultsPerPage']);
		$Pagination->pageVar = 'page';
		$Pagination->applyLimit($criteria);
		return $Pagination;
    }
}

?>
