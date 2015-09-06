<div id="subcontent"><div id="loading">
        <div class="sub_content_tabs">
    <ul class="sub_tabs">
	   <li class="boardtabsajax<?php if($todo==1){?> active<?php }?>">
	      
	      <?php echo MRChtml::ajaxLink(
		      Yii::t('default', 'user.billsmenu.rent'), 
		      '/user/' . $user->id . '/hostings/rent/', 
		      array('id'=>'check1','update' => '#subcontent','updateUrl'=>true,'cache'=>false,'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>', 'type' => 'post',
			'data'=>array('filter'=>'js:$("#rents_sort").val()')
		  ),
		    array('id'=>'yf'.uniqid()) 
		); ?>
	  </li>
         <li class="boardtabsajax<?php if($todo==2){?> active<?php }?>">
	    <?php echo MRChtml::ajaxLink(
		    Yii::t('default','user.billsmenu.sell'),
		    '/user/'.$user->id.'/hostings/sale', 
		    array('update'=>'#subcontent', 'cache'=>false,'updateUrl'=>true,'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>','type'=>'post',
			'data'=>array('filter'=>'js:$("#rents_sort").val()')
			), 
		    array('id'=>'yf'.uniqid())
		); ?>
         </li>
         <li class="boardtabsajax active_top">
	    <?php echo MRChtml::ajaxLink(
		    Yii::t('default','user.billsmenu.how_place_top'),
		    '/user/'.$user->id.'/hostings/how_place_top', 
		    array('update'=>'#subcontent', 'cache'=>false,'updateUrl'=>true,'preloadImage'=> '<div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3>'.Yii::t('default','loading').'...</h3><div class="loading_search"></div></div></div>','type'=>'post',
			'data'=>array('filter'=>'js:$("#rents_sort").val()')
			), 
		    array('id'=>'yf'.uniqid())
		); ?>
         </li>
      </ul>
            <div class="flt_r">
            <span class="flt_l" style="padding:6px 8px 0 0;font-size:11px;"><?php echo Yii::t('default','rent.filter.by');?>:</span>
	    <?php echo CHtml::dropDownList('filter', $filter, MRChtml::tlistData(Type::model()->findAll(), 'id', 'name'), 
		    array('id'=>'rents_sort','class'=>'flt_r','prompt'=>Yii::t('default','all'),
			'onchange'=>'applyFilter()'
			)); ?>
            </div>
            
            <div class="clr"></div>
      
      
      
        </div>
<script type="text/javascript">

function applyFilter(){
    $.ajax({
	type:'post',
	url: window.location,
	data:{filter:$("#rents_sort").val()},
	beforeSend: function(){
                      $('#subcontent').append('<span id="preloader" class="mr_loading"><div class="free_layer" style="display:block;"></div><div class="loading_box_profile" style="left:150px;top:70px"><div class="wborder"><h3><?php echo Yii::t('default','loading'); ?>...</h3><div class="loading_search"></div></div></div></span>');},
	complete:function(){
                      $("#preloader").remove();
	},
	success:function(html){
	    $("#subcontent").html(html)
	}
	
    })
}
    var params = {
            changedEl: "#rents_sort",
            visRows: 5,
            scrollArrows: false

    }
    cuSel(params);


</script>
<div class="profile_box " style="padding:0;">
    <?php if(count($rents)){ ?>
        <?php $count = count($rents); ?>
 <?php foreach ($rents as $rent){ 
     $class_last = '';
     if(!--$count) $class_last = " last"; 
  	 if($rent->cover) $avatar = "/uploads/rentpic/"
        .Yii::app()->putils->fragment($rent->id)
        ."/thumbs/"
        .$rent->cover->file;
                  elseif(count($rent->photos)&&($rent->photos[0]->file)){
        $avatar = '/uploads/rentpic/'
            .Yii::app()->putils->fragment($rent->id)
            .'/thumbs/'
            .$rent->photos[0]->file;
    }else{
        $avatar= $this->assetsUrl.'/images/no_gallery_s.png';
        
    } ?>

              <div class="board_box">
                  <div class="p_absolute">
                      <a href="/rent/<?php echo $rent->id?>" style="background-image: url('<?php echo $avatar;?>')" class="avatar_box"></a>
                <?php if((time() - strtotime($rent->creation_date) )< Yii::app()->params['isnew'] ) {  ?>
		    <div class="status_board new"><?php echo Yii::t('default','New')?></div>
		    <?php }?></div>


                    <div style="margin-left: 15px;width:780px;" class="flt_r">
                    <div class="trans"><?php echo CHtml::link($rent->description->name,'/rent/'.$rent->id,array('class'=>'link'));?><div class="trans_txt"></div><div class="clr"></div></div>
		    <!--<div class="trans"><small><span><?php echo Yii::t('default','bill address');?>:</span> 
			<?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&($rent->adress->name_en)) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
                     <div class="address_box">
                    <span><?php echo Yii::t('default','bill address');?>:</span>
                    <div><?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&($rent->adress->name_en)) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></div>
                    </div>
                    <div class="clr"></div>
                    
                  
		    <?php $prices_to_view = Yii::app()->params['current_price']; if($rent->todo==1) {?>
	<div class="price" style="width:500px;float:left;">
		  <?php echo number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ')  ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?>
		  <div><?php {echo Yii::t('default',$prices_to_view[$rent->current_price]['row']);}?></div>
                   </div>
                                      <?php } else {?>
		    
              <div class="price" style="width:500px;float:left;">
		      <?php echo number_format($rent->price_day * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?>

              </div>
                   <?php }?>
                  
                  
                  <div class="rent_control">

		  <span id="viewbuttn<?php echo $rent->id?>">
		    <?php echo MRChtml::ajaxLink('', '/switchRentView', array(
			'update' => '#viewbuttn' . $rent->id,
                        'preloadImage'=> '<img src="'.$this->getAssetsUrl().'/images/s-loading.gif" border="0" alt="">','append_or_html'=>'html', 
			'type'=>'post',
			'data'=>array('rentId'=>$rent->id, 'type'=>'rent')
		    ), array('class'=>'view popEdge viewstatus' . $rent->in_show,'id'=>uniqid('aview'),'title'=>Yii::t('default','show/hide'))) ?>
		  </span>

		<?php echo CHtml::link('','/rent/'.$rent->id.'/edit',array('class'=>'edit popEdge', 'title'=>Yii::t('default','edit'))) ?>

		      
			  <?php echo CHtml::link('','/up/' . $rent->id.'/',array('title'=>Yii::t('default','up.rent up'), 'value'=>$rent->id,'class'=>'upbtn popEdge uptop fancybox.ajax row'))?>
		    

                  </div>
                    <div class="clr"></div>
            </div></div>
                 
              <?php }?>
        <?php }else{ ?>
                      <div class="no_component"><p><?php echo Yii::t('default','your.have.not.created.bills')?>.</p><br /><br />
                      <a class=" btn_border abutton blue" href="/rent/list"><span><b><i><?php echo Yii::t('default', 'add.bill') ?></i></b></span></a>
                      </div>
        
              <?php }?>

    	<?php
	$this->widget('ext.widgets.MRPaginator.MRAjaxPaginator', array(
	    'pages' => $pagination,
	    'return'=>'#subcontent',
	    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
	    'header' => '',
	    'cssFile' => $this->getAssetsUrl() . '/css/pagination.css',
	    'skin' => 'myrents',
	    'userfulUrl'=>'/user/'.$user->id.'/hostings/'.(isset($_GET['todourl'])?$_GET['todourl']:'rent/')
	))
	?>
    <div class="clr"></div>
</div>
    </div>
</div>

<script type="text/javascript">
    init_uplink();
    init_tiptip();
</script>