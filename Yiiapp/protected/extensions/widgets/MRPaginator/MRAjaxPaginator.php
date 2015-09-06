<?php

//пагинатор для поиска, отправляет даные поиска и нормер страницы
class MRAjaxPaginator extends CLinkPager {
    public $return = false;
    public $userfulUrl = false;
    
    public function run() {
	rtrim('/',$this->userfulUrl);
	$this->registerClientScript();
	$buttons = $this->createPageButtons();
	if (empty($buttons))
	    return;
	echo $this->header;
	echo CHtml::tag('ul', $this->htmlOptions, implode("\n", $buttons));
	echo $this->footer;
    }

    
    private function createUserfulUrl($page){
	$spage = (++$page<=1)?'':'/?page='.$page;
	$result = $this->userfulUrl. $spage;
	return $result;
    }
    protected function createPageButton($label, $page, $mclass, $hidden, $selected) {
	$class = $mclass;
	if ($hidden || $selected)
	    $class= $mclass . ' ' . ($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
	    $link = '';
	    $Url =($this->userfulUrl)?$this->createUserfulUrl($page): $this->createPageUrl($page);
	if($this->return){
	    $link = MRChtml::ajaxLink($label,$Url,
		array( 
		    'update'=>$this->return,
		    'updateUrl'=>true,
		    'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:50px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>',
		    'type'=>'post',
		),array(
		    'href'=>$Url,
		    'id'=>  uniqid('paginator'),
		    )	
		    );

	}else 
	    $link = CHtml::link($label,$Url,array('id'=>  uniqid('pginator',true)));
	
	 $return_button = '<li class="'.$class.'" onClick="$(\'body,html\').animate({scrollTop: 80}, 1000);">'.$link.'</li>';
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
