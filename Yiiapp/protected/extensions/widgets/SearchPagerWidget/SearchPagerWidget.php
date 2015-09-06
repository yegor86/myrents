<?php

//пагинатор для поиска, отправляет даные поиска и нормер страницы
class SearchPagerWidget extends CLinkPager {

    public function run() {
	$this->registerClientScript();
	$buttons = $this->createPageButtons();
	if (empty($buttons))
	    return;
	echo $this->header;
	echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
	echo $this->footer;
    }

    protected function createPageButton($label, $page, $mclass, $hidden, $selected) {
	$class = $mclass;
	if ($hidden || $selected)
	    $class= $mclass . ' ' . ($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
	
	$return_button = '<li class="' . $class . '">' . CHtml::link($label, 'javascript:void(0)',array(
	    'onclick'=>"timedsubmit(document.SearchForm,1,'#result', '/search/', ". ($page+1) . "); $('body,html').animate({scrollTop: 80}, 1000);"
	)) . '</li>';
	if($mclass==self::CSS_FIRST_PAGE)
	    $return_button.='<li class="dots ' . ($hidden ? self::CSS_HIDDEN_PAGE:'')  . '">&#133</li>' ;    
	elseif($mclass==self::CSS_LAST_PAGE)
	$return_button ='<li class="dots ' . ($hidden ? self::CSS_HIDDEN_PAGE:'')  . '">&#133</li>' . $return_button;    
	return $return_button;
    }

    /**
	 * Creates the page buttons.
	 * @return array a list of page buttons (in HTML code).
	 */
	protected function createPageButtons()
	{
		if(($pageCount=$this->getPageCount())<=1)
			return array();

		list($beginPage,$endPage)=$this->getPageRange();
		$currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
		$buttons=array();

		// first page
		$buttons[]=$this->createPageButton($this->firstPageLabel,0,self::CSS_FIRST_PAGE,$currentPage <= (int)(Yii::app()->params['maxbuttonCount']/2),false,$currentPage);

		// prev page
		if(($page=$currentPage-1)<0)
			$page=0;
		$buttons[]=$this->createPageButton($this->prevPageLabel,$page,self::CSS_PREVIOUS_PAGE,$currentPage<=0,false);

		// internal pages
		for($i=$beginPage;$i<=$endPage;++$i)
			$buttons[]=$this->createPageButton($i+1,$i,self::CSS_INTERNAL_PAGE,false,$i==$currentPage);

		// next page
		if(($page=$currentPage+1)>=$pageCount-1)
			$page=$pageCount-1;
		$buttons[]=$this->createPageButton($this->nextPageLabel,$page,self::CSS_NEXT_PAGE,$currentPage>=$pageCount-1,false);

		// last page
		$buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,self::CSS_LAST_PAGE,$currentPage >= ($pageCount - (int)(Yii::app()->params['maxbuttonCount']/2)),false);

		return $buttons;
	}

    
    
}

?>
