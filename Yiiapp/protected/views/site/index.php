<?php //SEO block
$seo_title = Yii::t('SEO','seo.main.title');
$seo_description = Yii::t('SEO','seo.main.description');
$this->pageTitle=$seo_title;
Yii::app()->clientScript->registerMetaTag($seo_description , 'description');
Yii::app()->clientScript->registerMetaTag($this->toKeywords($seo_title) , 'keywords');
// end SEO Block
?>
<script type="text/javascript">
    jQuery(function($){
        $('.addplus').html('+');
        $( "#slider-range" ).slider({
	    range: true,
	    step: 5,
	    min: <?php echo $Prices['min'] ?>,
	    max:  <?php echo $Prices['max'] ?>,
	    values: [ <?php echo $Prices['min'] ?>, <?php echo $Prices['max'] ?>],
	    slide: function( event, ui ) {
		$( "#price_max" ).val(ui.values[ 1 ]);
		$( "#price_min" ).val(ui.values[ 0 ]);
               if($("#price_max").val() == '<?php echo $Prices['max'] ?>'){
                    $('.addplus').html('+');
                }else{
                    $('.addplus').html('');
                }
	    }
	});
	$( "#price_max" ).val($( "#slider-range" ).slider( "values", 1 ));
	$( "#price_min" ).val($( "#slider-range" ).slider( "values", 0 ));


    });
    
</script>
<script type="text/javascript">
jQuery(function($){
        $(".todo").imageTick({
		image_tick_class: "radios_todo",
		custom_button: function($label){
		    $label.hide();
		    return '<div><b>' + $label.text() + '</b></div>';
		}
	});

});
function showvalue(searchinput,getregions){
    if(getregions==undefined)getregions = false;
    $.ajax({
	url: "/short_name.php",
	dataType: 'json',
	type:'post',
	data:{search: searchinput.value, neededregions:getregions},
	success:function(data){
	    subsearch = $('#subsearch');
	    subsearch.children().remove();
	    if(data.adresses!=undefined) $("input#autocomplete").autocomplete({source: data.adresses});
	}
    })
}



$(function() {  
    $('#search input').keyboard('enter', function(e, bind) {
        $('#search').submit();
        return false;
    });
});


</script>

<script type="text/javascript">


    function goSearch(){
        if($('#autocomplete').val()== '<?php echo Yii::t("default", "enter the address");?>'){
            $('#autocomplete').val('');
            document.SearchForm.submit();
            
        }
        if($('#autocomplete').val()){
            document.SearchForm.submit();
            
        }
    }
</script>




<script type="text/javascript">
$(function() {
$('#home_rent_box').cycle({ 
    fx:     'fade', 
    timeout: 6000, 
    delay:  -2000,
    random:false,
    width: '500px',
    next:   '#next2', 
    prev:   '#prev2' 
});

});

</script>

<div class="main">
    <div class="home">
        <div class="left_side_box"><br /><br />
            <div class="no_component">
		<h2 class="title"><?php echo Yii::t('default','find a bill')?></h2></div>
<br /><br />


	<?php
	$form = $this->beginWidget('CActiveForm', array(
	    'id' => 'search',
	    'action'=>'/search/',
	    'method'=>'get',
	    'clientOptions' => array(
		'validateOnSubmit' => true,
	    ),
	    'htmlOptions' => array(
		'name' => 'SearchForm',

	    )
		));
	?>
    
    

<div class="pdd_10"></div>
<div class="home_todo">
<?php echo $form->radioButtonList($searchForm, 'todo', $Todos, array('separator' => '', 'class' => 'todo')); ?>
    <?php  $prices_to_view = Yii::app()->params['current_price'];?>
</div> <div class="clr"></div>
<div class="input_search">
    <div class="searchInput flt_l"><?php echo $form->textField($searchForm, 'searchString', array('onkeyup' => 'showvalue(this);', 'id' => 'autocomplete', 'onfocus'=>'if(this.value=="'.Yii::t("default", "enter the address").'") this.value="";', 'onblur'=>'if(this.value=="") this.value="'.Yii::t("default", "enter the address").'";', 'value'=>''.Yii::t("default", "enter the address").'')); ?></div>
<a class="search_btn flt_r" onclick="goSearch()" href="javascript:void(0)"></a>
    <div class="clr"></div>

</div>

      
   <div class="example"><?php echo Yii::t('default','example')?>: <span><?php echo Yii::t('default','example street');?></span></div>
         
            
   <div class="no_component"><?php echo Yii::t('default','go to');?> <a href="/search/"><b><?php echo Yii::t('default','full search');?></b></a></div>



                <br/>  <br/><br/>

 <br/>             
                 
                        
               

            <?php $this->endWidget(); ?> 
        </div>
        <div>
            

            
        <div id="home_rent_box" style="z-index: 1;width:523px;">
            <!--how guide-->
            

                        <?php

                        foreach($rents as $rent){
			    
			    if(isset($rent->photos[0]))
			    { 
			   
				
				?>
            <?php $cprice=Yii::app()->params['current_price'][$rent->current_price]['row'];
            $price =$rent->$cprice;?>
             <?php $todo = ($rent->todo==1)?Yii::t('default',$cprice):'';?>
		    <?php $avatar= 
                            (file_exists(Yii::getPathOfAlias('webroot') . Yii::app()->params['UPLOADDIR'] .  "userpic/" . $rent->renter->image))?
                            Yii::app()->params['USERPHOTOSDIR'] .'thumbs/'. $rent->renter->image:
                            Yii::app()->params['USERPHOTOSDIR'] .'thumbs/'. 'noimage.jpg';
                           
		
        			if ($rent->cover){
				    $photo = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($rent->id)
                        . '/' 
                        . $rent->cover->file;
                                } elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $photo = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($rent->id)
                        . '/' 
                        . $rent->photos[0]->file;
				} else {
                                    $photo = $this->getAssetsUrl() . '/images/no_gallery.gif';
				}
                                
                                
                                ?> 
                                
<div>

    <div class="image" onClick="window.location.href='/rent/<?php echo $rent->id?>/'" style="cursor:pointer;background-image:url('<?php echo ($photo);?>')"></div> 
    

            <div class="info_rent_user_box">
                <div class="info_rent_user_box-sub">
                    <div class="info_rent_user">
                        <div class="info_rent_user-sub">
                            <a href="/user/<?php echo $rent->renter->id?>" class="avatar" style="background-image: url(<?php echo $avatar?>)"></a>

                                <div class="text trans"><b><a href="/rent/<?php echo $rent->id?>"><?php echo $rent->description->name?></a><div class="trans_txt"></div></b>
                                <p><?php if (isset($rent->adress)) {
		    if(Yii::app()->language=='en'&&($rent->adress->name_en)) echo $rent->adress->name_en;
		    else    echo $rent->adress->name ;}?></p>
                                <div class="price_rent"><span style="top:-2px;position: relative"><?php echo Yii::t('mainpage',$rent->rent_todo->name.'.slideshow'); ?> <?php echo mb_strtolower(Yii::t('mainpage',$rent->rent_type->name.'.slideshow'), "UTF-8"); ?>:</span> <b><?php 

				if($rent->todo==1) $price = $rent->$prices_to_view[$rent->current_price]['row'];
				else $price = $rent->price_day;
				
				echo number_format($price  * $rent->currency->rate  / $this->currentCurrency->rate,0,',',' ')  ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b></div>
                            </div>
                            <div class="clr"></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
            

            
            <?php } }
	    
	    ?>
 <?php 

if(isset($rents)){

if(Yii::app()->params['ShowGuide'] >= count($rents)){?>

<div>
    <div class="image" onClick="window.location.href='/help/how_create/'" style="cursor:pointer;background-image:url('<?php echo $this->getAssetsUrl()?>/images/how_create_<?php echo Yii::app()->language;?>.png')"></div> 
             </div><div>
            <div class="image" onClick="window.location.href='/help/how_search/'" style="cursor:pointer;background-image:url('<?php echo $this->getAssetsUrl()?>/images/how_search_<?php echo Yii::app()->language;?>.png')"></div> 
 </div>

            
            
 
    
            
            <?php }}?>


         </div>

                              <a id="prev2" href="#"><span></span></a>
                <a id="next2" href="#"><span></span></a>

            
          
        </div>

        <div class="clr"></div>
    </div>
</div>
<div id="city_box">
<?php 
$links = $this->createSeoLinks();
foreach ($links as $key=>$value){?>
    <div>
   <?php echo CHtml::link($key,$value);?>
    </div>
<?php } ?>
    </div>
    <div class="clr"></div>
<table border="0" width="90%" id="indexLinks">
    <tr>


        <td valign="top"><span class="flt_l" style="line-height:21px;"><?php echo Yii::t('default','mr.social')?>:&nbsp;&nbsp;&nbsp;</span>
                        <a class="fb" target="_blank" href="https://www.facebook.com/pages/MyRentscomua/353381128066953"></a>
            <a class="vk" target="_blank" href="http://vk.com/myrents"></a>
            
            <a href="/staticpage/about_us/"><?php echo Yii::t('default', 'footer.nav.about_us') ?></a>
            <a href="/staticpage/term_of_use/"><?php echo Yii::t('default', 'footer.nav.term_of_use') ?></a>
            <a class="support fancybox.ajax" href="/support/"><?php echo Yii::t('default','Support')?></a>
            <a href="/help/"><?php echo Yii::t('default','Instruction')?></a>
            <a href="/partners/"><?php echo Yii::t('default','Partners')?></a>
        </td>
    </tr>
</table>
