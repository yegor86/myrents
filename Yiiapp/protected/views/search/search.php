                <a href="/staticpage/api/" target="_blank" id="api_bth"></a>
                <img style="display: none" src="<?php echo $this->assetsUrl ?>/images/map-indi.png" id="flat_indicator" alt="" />
            <script type="text/javascript">
                $('.uptop').fancybox({
                    'autoDimensions'	: false,
                    'padding'		: 0,
                    'autoScale':false,
                    'centerOnScroll':true,
                    'margin':5,
                    'showCloseButton':false,
                    'enableEscapeButton':false,
                    'scrolling'		: 'no'
                });
                

            </script>
<?php if($searchForm['mapsearch']==1){?>
<script type="text/javascript">
    $(function(){
            $('#SearchForm_mapsearch').attr('checked', true);
            $('#result, .search_sort').hide();
            $('.gmap').toggleClass('none');
            $('#full_map').show();
            $('.icon_map').addClass('active');
            $('.icon_list').removeClass('active');
	    api.redraw();
            $('.search_input_box, .op').addClass('opacity');
            $('.search_input_box input').attr('disabled', true);
            if(!api.hasMap('full_map')){
	   api.addMap('full_map');
	   api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map',<?php echo json_encode($cityList); ?>);
	};
        });
</script>
<?php }elseif(isset($searchForm['mapsearch'])==0){?>

<script>
    $(function(){
            $('#SearchForm_mapsearch').attr('checked', false);
            $('#full_map').hide();
            $('#result, .search_sort').show();
            $('.gmap').toggleClass('none');
            $('icon_list').addClass('active');
            $('.icon_map').removeClass('active');
            $('.search_input_box, .op').removeClass('opacity');
            $('.search_input_box input').attr('disabled', false);
        });
</script>
<?php } ?>

<script type="text/javascript">
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
		if(data.adresses!='undefined') $("input#autocomplete").autocomplete({
		    source: data.adresses,
		    select: function(evt, ui) {window.setTimeout(function(){showvalue(document.getElementById('autocomplete'),true)},100);}
		});

	    }
	});
    }




    var rent_min_price = '<?php echo Yii::app()->params['prices']['min'] ?>';
    var rent_max_price = '<?php echo Yii::app()->params['prices']['max'] ?>';
    var sale_min_price = '<?php echo Yii::app()->params['prices_sale']['min'] ?>';
    var sale_max_price = '<?php echo Yii::app()->params['prices_sale']['max'] ?>';



    jQuery(function($){
        
        $('.nav li#SearchForm_todo_0s').click(function(){
            $('#slider-range').slider('refresh');
	    $('#p_max').html('<?php echo Yii::app()->params['prices']['max'] ?>');
            
   mr_slider('<?php echo Yii::app()->params['prices']['min'] ?>','<?php echo Yii::app()->params['prices']['max'] ?>','<?php echo Yii::app()->params['prices']['min'] ?>','<?php echo Yii::app()->params['prices']['max'] ?>','#price_min','#price_max', '.addplus','#slider-range','<?php echo Yii::t('default', 'loading') ?>',5);
  
  

        });
        $('.nav li#SearchForm_todo_1s').click(function(){
	    $('#p_max').html('<?php echo Yii::app()->params['prices_sale']['max'] ?>');
	    $('#slider-range').slider('refresh');
            
            mr_slider('<?php echo Yii::app()->params['prices_sale']['min'] ?>','<?php echo Yii::app()->params['prices_sale']['max'] ?>','<?php echo Yii::app()->params['prices_sale']['min'] ?>','<?php echo Yii::app()->params['prices_sale']['max'] ?>','#price_min','#price_max', '.addplus','#slider-range','<?php echo Yii::t('default', 'loading') ?>',5);
  

        });
        
	if($('.nav li#SearchForm_todo_0s').hasClass('activated')){
        




mr_slider('<?php echo Yii::app()->params['prices']['min'] ?>','<?php echo Yii::app()->params['prices']['max'] ?>','<?php echo Yii::app()->params['prices']['min'] ?>','<?php echo Yii::app()->params['prices']['max'] ?>','#price_min','#price_max', '.addplus','#slider-range','<?php echo Yii::t('default', 'loading') ?>',5);
       

	}else{
               mr_slider('<?php echo Yii::app()->params['prices_sale']['min'] ?>','<?php echo Yii::app()->params['prices_sale']['max'] ?>','<?php echo Yii::app()->params['prices_sale']['min'] ?>','<?php echo Yii::app()->params['prices_sale']['max'] ?>','#price_min','#price_max', '.addplus','#slider-range','<?php echo Yii::t('default', 'loading') ?>',5);

	}
        
        
mr_slider('<?php echo $Squares['min'] ?>','<?php echo $Squares['max'] ?>','<?php echo $searchForm->squaremin ?>','<?php echo $searchForm->squaremax ?>','#price_min2','#price_max2', '.addplus2','#slider-range2','<?php echo Yii::t('default', 'loading') ?>',2);

    });
    jQuery(function($){
	$.imageTick.logging = false;
	$(".imageTickType").imageTick({
	    tick_image_path: "<?php echo $this->getAssetsUrl(); ?>/images/button.png", 
	    no_tick_image_path: "<?php echo $this->getAssetsUrl(); ?>/images/no_buttom.gif",
	    image_tick_class: "radios_type",
	    custom_button: function($label){
		$label.hide();
		return '<div><span>' + $label.text() + '</span></div>';
	    }
        });

        $(".amenity").imageTick({
	    custom_button: function($label){
		$label.hide();
		return '<span class="icon " style="background-image:url(\'<?php echo $this->getAssetsUrl(); ?>/images/amenities/'+$label.attr('imgname')+'\')">' + $label.text() + '</span>';
	    }
	});


        $("#city_list_box .city").imageTick({
	    custom_button: function($label){
		$label.hide();
		return '<span class="city">' + $label.text() + '</span>';
	    }
	});
        init_regions();
        
        
        $(".checkroom").imageTick({
	    image_tick_class: "checknum",
	    custom_button: function($label){
		$label.hide();
		return '<span>' + $label.text() + '</span>';
	    }
	});
    });


    
    function init_regions(){
	$("#region_list_box .region").imageTick({
	    image_tick_class: "region",
	    custom_button: function($label){
		$label.hide();
		return '<span>' + $label.text() + '</span>';
	    }
	});

    }   
    
    function init_close_accordion(){
	$(function(){
	    $('#city_list_box span, #region_list_box span').click(function() {
		$('#SearchForm_radius').val('2000');
		$('.accordion td').removeClass('active');
		$('.accordion h3').removeClass('minus');
		$('.accordion table .acc_content').hide();
		$('#SearchForm_coords').val($(this).next().attr('geocoords'));
		api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map');
	    });
	    $('#tick_img_city-0').click(function() { //при клики на любой, убираем значение value на пустое!
		$('#city-0').val('');
		$('#select_city').text($('label[for="city-0"]').text());
		$('#regions').hide();
	    });
	});
    }
    
    
    $(function(){
	var params = {
	changedEl: "#SearchForm_floor",
	visRows: 5,
	scrollArrows: false
	}
	cuSel(params);
	



	if($('#SearchForm_city_0').attr('checked')){
            $('#regions').hide();
        }else{
            $('#regions').show();
        }
        $('.regionloading').hide();
	$('.city').change(function(){

            ajax_region($(this).val());
	});
    });
    
    init_close_accordion();
    
    
    

            
            
  

</script>

<script type="text/javascript">
        $(function(){
            $('.icon_map').click(function(){
                $('#SearchForm_mapsearch').attr('checked', true);
                timedsubmit(document.SearchForm,50,"#result", "/search/" , "<?php Yii::t('default', 'loading') ?>");
                $('#full_map').show();
                $('#result, .search_sort').hide();
                $('.gmap').toggleClass('none');
                $(this).addClass('active');
                $('.icon_list').removeClass('active');
                $('.search_input_box, .op').addClass('opacity');
                $('.search_input_box input').attr('disabled', true);
	if(!api.hasMap('full_map')){
	   api.addMap('full_map');
	   api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map',<?php echo json_encode($cityList); ?>);
	};
	api.redraw('full_map');                
            });
            
            $('.icon_list').click(function(){
                $('#SearchForm_mapsearch').attr('checked', false);
                if($('#full_map #open_full_map').hasClass('active')){
                    $('#full_map #open_full_map').removeClass('active');
                    $('#full_map').css({'width':'673px'});
                    $('.right_side_box').show();

                }
                $('.search_input_box, .op').removeClass('opacity');
                $('.search_input_box input').attr('disabled', false);
                timedsubmit(document.SearchForm,50,"#result", "/search/" , "<?php Yii::t('default', 'loading') ?>");
                $('#full_map').hide();
                $('#result, .search_sort').show();
                $('.gmap').toggleClass('none');
                $(this).addClass('active');
                $('.icon_map').removeClass('active');
                api.redraw("YMapsID");
            });

        });
        



    
    $(function() { 

	$('#search #autocomplete').keyboard('enter', function(e, bind) {
	    timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>');
	    return false;
	});
        $("#open_full_map").click(function(){
            if($(this).hasClass('active')){
                $(this).parent().css({'width':'673px'});
                $(this).removeClass('active');
                $('.right_side_box').show();
            }else{
                $('#open_full_map').toggleClass('active').parent().css({'width':'983px'});
                $('.right_side_box').hide();
            }
           api.redraw('full_map');
        });
        
        
    });
    
    
function ajax_region(get){
        $(function(){
                        $('#select_region').text('<?php echo Yii::t('default', 'any') ?>');
	  // $('.regionloading').show();
	    
$('.region').attr('checked',false);
	    $.ajax({
		url:'/regions',
		type:'post',
		dataType: 'json',
		data:{
		    getregions: get
		},
		success:function(jsonarray){
	          if(jsonarray.length==1){
		    $('#regions').hide();
		  }else{
		    $('#regions').show();
		  }
		 $('.regionloading').hide();
		    if(jsonarray.length){
    			var regionslist = '';
			for (var i = 0; i < jsonarray.length; i++) {
			    regionslist += '<input class="region" name="SearchForm[region]" type="radio" id="r' + jsonarray[i].id + '" value="' + jsonarray[i].name + '" geocoords ="'+jsonarray[i].geox+', '+jsonarray[i].geoy +'" / ><label for="r' + jsonarray[i].id + '">' + jsonarray[i].name + '</label>';
			}
			$("#region_list_box").html(regionslist);
			$('#region_list_box .region').click(function(){
			   $('#select_region').text($(this).val());


                /*кагрывает аккардион*/           
                $('.accordion td').removeClass('active');
		$('.accordion h3').removeClass('minus');
                $('.accordion table .acc_content').hide();
                
			    $('#SearchForm_coords').val($(this).attr('geocoords'));
			    api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map');
			    timedsubmit(document.SearchForm,50,"#result", "/search/" , "<?php Yii::t('default', 'loading') ?>");
			});
			init_regions();
		    }
		}
	    });
          });
}
</script>

<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
		<table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default', 'founded <span id="foundcount">count_items</span> bills', array('count_items' => $count)); ?></h3></td>
			<td width="30%" align="right"><h3><span><?php echo Yii::t('default', 'I want') ?>:</span></h3></td><td width="22%">
			    <ul class="nav">
				<li class="btn3" id="SearchForm_todo_0s"><a href="javascript:void(0)" onclick="search_radio_todo('#SearchForm_todo_0', '#SearchForm_todo_0s', ['SearchForm_todo_1', 'SearchForm_todo_2'], 0);timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>');"><span class="btn_l"></span><span class="btn_c"><?php echo Yii::t('default', 'rent'); ?></span><span class="btn_r"></span></a></li>
				<li class="btn3" id="SearchForm_todo_1s"><a href="javascript:void(0)" onclick="search_radio_todo('#SearchForm_todo_1', '#SearchForm_todo_1s', ['SearchForm_todo_0', 'SearchForm_todo_2'], 1);timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>');"><span class="btn_l"></span><span class="btn_c"><?php echo Yii::t('default', 'buy'); ?></span><span class="btn_r"></span></a></li>
			    </ul>
			</td></tr></table>


            </div>
        </div>
    </div>

    <script>

    </script>


    <div class="clr"></div>
    <div style="width:996px">



	<?php if (isset($bcrumbs)) $this->widget('zii.widgets.CBreadcrumbs', $this->BreadCrumbs(true)); ?>


	<div class="LeftSide2">
	    <div style="padding:10px 0 5px 10px;">
                <a href="javascript:void(0);" class="btn6 icon_list <?php if(!isset($SearchForm['mapsearch'])) echo 'active';?>"><?php echo Yii::t('default', 'search.btn.list'); ?></a>
		<a href="javascript:void(0);" class="btn6 icon_map <?php if(isset($SearchForm['mapsearch'])) echo 'active';?>"><?php echo Yii::t('default', 'search.btn.map'); ?></a>

	    </div>




	    <div class="search_sort">

		<?php echo Yii::t('default', 'Sort by') ?>:<a class="sort_dw" href="javascript:void(0)" onclick="search_sort(this, 'new');timedsubmit(document.SearchForm,60,'#result', '/search/', '<?php echo Yii::t('default', 'loading') ?>');" id="sortNew"><?php echo Yii::t('default', 'Sort by new') ?></a><a class="sort_dw" href="javascript:void(0)" onclick="search_sort(this, 'price');timedsubmit(document.SearchForm,60,'#result', '/search/', '<?php echo Yii::t('default', 'loading') ?>');" id="sortPrice"><?php echo Yii::t('default', 'Sort by price') ?></a>
            

                <?php echo CHtml::link(Yii::t('default','user.billsmenu.how_place_top'), '/up/global', array('class' => 'how_place_top uptop fancybox.ajax row')); ?>

            </div>                    
            <div class="clr"></div>
	    <div id="full_map">
                <div id="open_full_map"></div>
            </div>

	    <div id="result" style="z-index:5;"><div style="position: fixed;z-index:6;"><div class="loading_box" style="margin-top: 20px"><div class="wborder"><h3><?php echo Yii::t('default', 'loading search') ?>...</h3><div class="loading_search"></div></div></div></div>
		<script> 
		    var min_x=999;
		    var max_x=0;
		    var min_y=999;
		    var max_y=0;
		</script>

                <div id="loading">
		<?php 
                if(count($top)){
		echo '<div id="top_rents">';
		foreach ($top  as $topRent) {
        				if ($topRent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/no_image_home.jpg';
				} elseif ($topRent->cover){
				    $avatar = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($topRent->id) 
                        . '/thumbs/' 
                        . $topRent->cover->file;
                                } elseif (($topRent->photos) && ($topRent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($topRent->id)
                        . '/thumbs/' 
                        . $topRent->photos[0]->file 
                        . '';
				} else {
                                    $avatar = $this->getAssetsUrl() . '/images/no_image_photo.jpg';
				}
?>
                <div class="search_box">


	                    <a href="/rent/<?php echo $topRent->id;?>"><span class="search_img_box" style="background-image: url('<?php echo $avatar ?>')"></span></a>
 		   		   <?php if(!Yii::app()->user->isGuest&&$topRent->user==Yii::app()->user->id){?> <?php echo CHtml::link('','/up/' . $topRent->id.'/', array('value'=>$topRent->id,'class'=>'upbtn_search p_absolute uptop fancybox.ajax'))?> <?php }?>
                    		     <?php if((time() - strtotime($topRent->creation_date) )< Yii::app()->params['isnew'] ) {  ?>
		    <div class="status_board new"><?php echo Yii::t('default','New')?></div>
		    <?php }?>
                    <a class="addfav pop" style="display:none" href="javascript:void(0)" title="<?php echo Yii::t('default','add to favorites');?>"></a>
                    <!--<div class="user"><a href="/user/<?php echo $topRent->renter->id ?>"><img src="<?php echo Yii::app()->params['USERPHOTOSDIR'] . $topRent->renter->image ?>" width="40" border="0" height="40" alt="" /></a></div>-->
                    <div class="user"><a href="/user/<?php echo $topRent->renter->id ?>"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR'] .'little/'. $topRent->renter->image ?>')"></span></a>
					    <ul class="controls">
	<?php  if ($topRent->renter->id!=Yii::app()->user->id) { ?><li><a target="_blank" href="/messages/send/<?php echo $topRent->renter->id ?>"><?php echo Yii::t('default', 'controls.sendmsg'); ?></a></li><?php } ?>
                                              	<li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>/"><?php echo Yii::t('default', 'controls.userinfo'); ?></a></li>   
					    </ul>
                    </div>
                    <div class="trans"><?php echo CHtml::link($topRent->description->name, '/rent/' . $topRent->id, array('class' => 'link')); ?><div class="trans_txt"></div><div class="clr"></div></div>
		    <!--<div class="trans"><small><span><?php echo Yii::t('default','bill address');?>:</span><?php if (isset($topRent->adress)) {
		    if(Yii::app()->language=='en'&&$topRent->adress->name_en) echo $topRent->adress->name_en;
		    else    echo $topRent->adress->name ;}?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
                    <div class="address_box">
                    <span><?php echo Yii::t('default','bill address');?>:</span>
                    <div style="max-width:390px;min-width:390px;"><?php if (isset($topRent->adress)) {
		    if(Yii::app()->language=='en'&&($topRent->adress->name_en)) echo $topRent->adress->name_en;
		    else    echo $topRent->adress->name ;}?></div>
                    </div>
                    
                   
                    <table border="0" cellpadding="0" cellspacing="0" width="382px">
                        <tr>
                            <td height="30">
          <?php   foreach ($topRent->amenities as $amenity)    {?>
           
        			<span class="pop icon_n" style="background-image:url('<?php echo ($this->getAssetsUrl()); ?>/images/amenities/<?php echo ($amenity->image); ?>')" title="<?php echo Yii::t('default',$amenity->name); ?>"></span>
  
          <?php }?>
                             </td>
                        </tr>
                    </table>
		    <?php if ($topRent->todo==1) { $tpriced = $topRent->current_price;?>
		    
                    <div class="price" style="width:153px"><b><?php echo number_format($topRent->$prices_to_view[$tpriced]['row'] * $topRent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b>
                        <p align="right"><?php echo Yii::t('default',  $prices_to_view[$tpriced]['row']);?></p>
                    </div>
		    <?php }else {?>
		    <div class="price" style="width:153px"><b><?php echo number_format($topRent->price_day * $topRent->currency->rate  / $this->currentCurrency->rate,0,',',' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name)?></b>
                    </div>	    
		    <?php }?>

                </div> <?php 

		};
		 echo '</div>';
                 };
		?>
                   
			<?php
			if ($rents && count($rents)) {
			    $count = count($rents);
			    foreach ($rents as $key => $rent) {
				$class_last = '';
				if (!--$count)
				    $class_last = " last";

				if ($rent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/no_image_home.jpg';
				} elseif ($rent->cover)
				    $avatar = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($rent->id)
                        . '/thumbs/' 
                        . $rent->cover->file;
				elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($rent->id)
                        . '/thumbs/' 
                        . $rent->photos[0]->file 
                        . '';
				} else {
				    $avatar = $this->getAssetsUrl() . '/images/no_image_photo.jpg';
				}
				?>




				<div class="search_box">
				    <a href="/rent/<?php echo $rent->id; ?>"><span class="search_img_box" style="background-image: url('<?php echo $avatar ?>')"></span></a>
				    <?php if (!Yii::app()->user->isGuest && $rent->user == Yii::app()->user->id) { ?> <?php echo CHtml::link('', '/up/' . $rent->id.'/', array('value' => $rent->id, 'class' => 'upbtn_search p_absolute uptop fancybox.ajax row')) ?> <?php } ?>
                                        <?php //if((time() - strtotime($rent->creation_date) ) < Yii::app()->params['isnew']){
                                        //    echo "<div class='status_board new'>".Yii::t('default', 'New')."</div>";
                                       // }else{
                                           if($rent->updatePeriod=='0'){
                                                echo "<div class='status_board new'>".Yii::t('default', 'New')."</div>";
                                           }elseif($rent->updatePeriod=='14'){
                                        echo '';
                                           }else{
                                                  echo "<div class='status_board day".$rent->updatePeriod."'>".Yii::t('default', 'updatePeriod.'.$rent->updatePeriod)."</div>";
                  
                  
                                           }
                                       // }
                                        ?>

				    <a class="addfav pop" style="display:none" href="javascript:void(0)" title="<?php echo Yii::t('default', 'add to favorites'); ?>"></a>
				    <!--<div class="user"><a href="/user/<?php echo $rent->renter->id ?>"><img src="<?php echo Yii::app()->params['USERPHOTOSDIR'] . $rent->renter->image ?>" width="40" border="0" height="40" alt="" /></a></div>-->
				    <div class="user"><a href="/user/<?php echo $rent->renter->id ?>"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR'] . 'little/' . $rent->renter->image ?>')"></span></a>

					    <ul class="controls">
	<?php if ($rent->renter->id!=Yii::app()->user->id) { ?><li><a target="_blank" href="/messages/send/<?php echo $rent->renter->id ?>"><?php echo Yii::t('default', 'controls.sendmsg'); ?></a></li><?php } ?>
                                              	<li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>/"><?php echo Yii::t('default', 'controls.userinfo'); ?></a></li>   
					    </ul>

				    </div>
				    <div class="trans"><?php echo CHtml::link($rent->description->name, '/rent/' . $rent->id, array('class' => 'link')); ?><div class="trans_txt"></div><div class="clr"></div></div>
				    <!--<div class="trans"><small><span><?php echo Yii::t('default', 'bill address'); ?>:</span> 		<?php
			    if ($rent->adress) {
				if (Yii::app()->language == 'en' && $rent->adress->name_en)
				    echo $rent->adress->name_en;
				else
				    echo $rent->adress->name;
			    }
	?></small><div class="trans_txt"></div><div class="clr"></div></div>-->
				    <div class="address_box">
					<span><?php echo Yii::t('default', 'bill address'); ?>:</span>
					<div style="max-width:390px;min-width:390px;"><?php
				    if (isset($rent->adress)) {
					if (Yii::app()->language == 'en' && $rent->adress->name_en)
					    echo $rent->adress->name_en;
					else
					    echo $rent->adress->name;
				    }
				    ?></div>
				    </div>



				    <table border="0" cellpadding="0" cellspacing="0" width="382px">
					<tr>
					    <td height="30">      <?php foreach ($rent->amenities as $amenity) { ?>
	    					<span title="<?php echo Yii::t('default', $amenity->name); ?>" class="pop icon_n" style="background-image:url('<?php echo ($this->getAssetsUrl()); ?>/images/amenities/<?php echo ($amenity->image); ?>');"></span>

	<?php } ?></td>
					</tr>
				    </table>
				    <?php if ($rent->todo == 1) { ?>
	    			    <div class="price" style="width:153px"><b><?php echo number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name) ?></b>
	    				<p align="right"><?php echo Yii::t('default', $prices_to_view[$rent->current_price]['row']); ?></p>
	    			    </div>
				<?php } else { ?>
	    			    <div class="price" style="width:153px">

	    				<b><?php echo number_format($rent->price_day * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ') ?> <?php echo Yii::t('default', $this->currentCurrency->short_name) ?></b>

	    			    </div>
				<?php } ?>

				</div> 
    <?php } ?>

			<?php
			} else {
			    echo '<div class="no_found">' . Yii::t('default', 'nothing.founded') . ', <a href="javascript:void(0)" id="reset_filter" onClick="resetFilter(\'' . $pricemin . '\', \'' . $pricemax . '\', \'' . Yii::app()->params['prices_sale']['min'] . '\',\'' . Yii::app()->params['prices_sale']['max'] . '\', \'' . $squaremin . '\', \'' . $squaremax . '\', \'' . Yii::app()->params['floors_to_search'][$this->curlang->language][0] . '\', \'' . Yii::t('default', 'any') . '\');">' . Yii::t('default', 'clear') . '</a> ' . Yii::t('default', 'search params') . '</div>';
			}
			?>



			<div class="clr"></div>
<?php
$this->widget('ext.widgets.SearchPagerWidget.SearchPagerWidget', array(
    'pages' => $pages,
    'maxButtonCount' => Yii::app()->params['maxbuttonCount'],
    'header' => '',
    'cssFile' => $this->getAssetsUrl() . '/css/pagination.css',
    'skin' => 'myrents',
    	              'firstPageLabel' => Yii::t('default','pagination.first.label'),
                                'lastPageLabel'  =>Yii::t('default','pagination.last.label')
))
?>


		    </div>
		</div>  







	</div>

	<!--правая часть -->
	<div class="right_side_box">
	   <!-- <a href="javascript:location.reload(true)" class="reset_filter flt_r"><?php echo Yii::t('default', 'clear filters'); ?></a>-->
	    <a href="javascript:void(0)" onClick="resetFilter('<?php echo Yii::app()->params['prices']['min']; ?>','<?php echo Yii::app()->params['prices']['max']; ?>','<?php echo Yii::app()->params['prices_sale']['min']; ?>','<?php echo Yii::app()->params['prices_sale']['max']; ?>','<?php echo $Squares['min'] ?>','<?php echo $Squares['max'] ?>', '<?php echo Yii::app()->params['floors_to_search'][$this->curlang->language][0] ?>', '<?php echo Yii::t('default', 'any') ?>');" class="reset_filter flt_r"><?php echo Yii::t('default', 'clear filters'); ?></a>
	    <div class="clr"></div>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'search',
    'clientOptions' => array(
	'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
	'name' => 'SearchForm'
    )
	));
?>
	    

	    <!-----------------   поиск по карте   ----------------------->
<?php /* ?>
<?php echo 'геокоординаты точки поиска по радиусу<br> (по умолчанию пустые)' ?>
	    <div class=""><div class="">
<?php echo $form->textField($searchForm, 'coords'); ?>
		</div></div>
<?php echo 'радиус (по умолчанию пустой)' ?>
	    <div class=""><div class="">
<?php echo $form->textField($searchForm, 'radius'); ?>
		</div></div>
 * <?php */ ?>
 


	    <!----------------- / поиск по карте   ----------------------->

	    <b class="stl_2 op" style="color:#7c7c7c;padding:0 0 2px 20px"><?php echo Yii::t('default', 'enter the address') ?>:</b>
	    <div class="search_input_box"><div class="searchInput"><?php echo $form->textField($searchForm, 'searchString', array('onkeyup' => 'showvalue(this,true);timedsubmit(document.SearchForm,600,"#result", "/search/", "' . Yii::t('default', 'loading') . '");', 'id' => 'autocomplete')); ?></div></div>
	    <div class="example op" style="padding-left:22px;"><?php echo Yii::t('default', 'example'); ?>: <span><?php echo Yii::t('default', 'example street'); ?></span></div>

	    <b class="stl_2" style="color:#7c7c7c;padding:20px 0 0 20px"><?php echo Yii::t('default', 'or select of list') ?></b>
 
            <script>
                $(function(){
                    $('.accordion .open').click(function(){
                        $(this).parent().next('tr').slideToggle(0);
                        $(this).toggleClass('active');
                        $(this).children('h3').toggleClass('minus');
                    });
                });
                </script>
           
            <div class="accordion">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="citys">
                    <tr>
                        <td height="50" valign="middle" class="open">
                            <h3 class="stl_2 plus"><?php echo Yii::t('default', 'country'); ?>: <span id="select_city">
                                <?php
                                if(isset($_GET['SearchForm']['city'])){
                                    echo $_GET['SearchForm']['city'];
                                }elseif(isset($_GET['city'])){
                                    echo Yii::t('urlnames',$_GET['city']);
                                }else{
                                    echo $cityList[0]['name'];
                                }
                                ?>
                                </span></h3></td>
                    </tr>
                    <tr class="acc_content">
                        <td colspan="2">
                            <div id="city_list_box">

          
<?php
/*
foreach($cityList as $city){

if($city['id']=='0'){ //any
  echo '<input id="city-'.$city["id"].'" class="city" name="SearchForm[city]" type="radio" value="'.$city["name"].'"  onchange="$(\'#select_city\').text($(this).val())" />';
  echo '<label for="city-'.$city["id"].'">'.$city["name"].'</label>';
}else{
  if(isset($_GET['SearchForm']['city'])){
      $checked = ($_GET['SearchForm']['city']==$city["name"]) ? 'checked' : '' ;
  }elseif(isset($_GET['city'])){
         $checked = (Yii::t('urlnames',$_GET['city'])==$city["name"]) ? 'checked' : '' ;
        }else{
      $checked='';
  }

  echo '<input '.$checked.' id="city-'.$city["id"].'" class="city" name="SearchForm[city]" type="radio" geocoords="'.$city["geox"].', '.$city["geoy"].'" value="'.$city["name"].'" onchange="$(\'#select_city\').text($(this).val())" />';
  echo '<label for="city-'.$city["id"].'">'.$city["name"].'</label>';
}

}
*/
echo $form->radioButtonList($searchForm, 'city', CHtml::listData($cityList, 'name', 'name'), array('separator' => '', 'id' => 'country_list', 'onchange'=>'$("#select_city").text($(this).val())', 'class'=>'city'));
?> 

                            </div>
                        </td>

                    </tr>
                </table>


                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="regions">
                    <tr>
                        <td height="50" valign="middle" class="open"><h3 class="stl_2 plus"><?php echo Yii::t('default', 'region'); ?>:<span class="regionloading"><center><img src="<?php echo $this->assetsUrl ?>/images/s-loading.gif" alt="<?php echo Yii::t('default', 'loading'); ?>" /></center></span> <span id="select_region">
                            <?php
                            if(isset($_GET['SearchForm']['region'])){
                                 if(!empty($_GET['SearchForm']['region'])){
                                    echo $_GET['SearchForm']['region']; 
                                 }else{
                                     echo Yii::t('default', 'any');
                                 }
                                }else{
                                    echo Yii::t('default', 'any');
                                    
                                    }?>
                                </span></h3></td>
                    </tr>
                    <tr class="acc_content">
                        <td>
                            <div class="regionloading"><center><img src="<?php echo $this->assetsUrl ?>/images/s-loading.gif" alt="<?php echo Yii::t('default', 'loading'); ?>" /></center></div>
                            	    <div id="region_list_box">
                        
                                        
                      
                                        
<?php echo $form->radioButtonList($searchForm, 'region', CHtml::listData($regionList, 'name', 'name'), array('separator' => '','id' => 'region_list', 'class'=>'region', 'onchange'=>'$("#select_region").text($(this).val())')); ?>
		    </div>
                        </td>

                    </tr>
                </table>
            </div>
            
            <div class="search_block">

                
                
                

		<div class="clr"></div>


		<div class="stl_2" style="padding-bottom:5px;"><?php echo Yii::t('default', 'bill type'); ?>:</div>

		<div class="panix">

		    <ul class="collector">
			<li>
<?php echo $form->radioButtonList($searchForm, 'type', $Types, array('separator' => '</li><li>', 'class' => 'imageTickType')); ?>
			</li>
		    </ul>
		</div>

		<div class="clr"></div>


                <div class="stl_2"><?php echo Yii::t('default', 'set price range'); ?>:</div><br /><br />
		<div><?php //echo $form->checkBoxList($searchForm, 'current_price', $prices_to_checkbox, array('separator' => '', 'class'=>'current_price'));  ?></div>
		<div id="Searchtype">
		    <a id="SearchForm_type_0s" href="javascript:void(0)" onclick="search_radio_type('#SearchForm_current_price_0', '#SearchForm_type_0s', ['SearchForm_current_price_1', 'SearchForm_current_price_2']);timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>');"><?php echo Yii::t('default', 'price_day') ?></a>
		    <a id="SearchForm_type_1s" href="javascript:void(0)" onclick="search_radio_type('#SearchForm_current_price_1', '#SearchForm_type_1s', ['SearchForm_current_price_2', 'SearchForm_current_price_0']);timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>');"><?php echo Yii::t('default', 'price_week') ?></a>
		    <a id="SearchForm_type_2s" href="javascript:void(0)" onclick="search_radio_type('#SearchForm_current_price_2', '#SearchForm_type_2s', ['SearchForm_current_price_1', 'SearchForm_current_price_0']);timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>');"><?php echo Yii::t('default', 'price_month') ?></a>
		</div>

		<div id="search_radio_type"><?php echo $form->radioButtonList($searchForm, 'current_price', $prices_to_checkbox, array('separator' => ' ', 'class' => 'hidden', 'labelOptions' => array('style' => 'display:none'))); ?></div>

		<div class="trackbar">

		    <div class="mrg_lft_10" style="padding-bottom:15px;">
			<div style="position: relative;">
<?php echo $form->textField($searchForm, 'pricemin', array('id' => 'price_min', 'class' => 'inp_min', 'readonly' => 'readonly')); ?>                    
<?php echo $form->textField($searchForm, 'pricemax', array('id' => 'price_max', 'class' => 'inp_max', 'readonly' => 'readonly')); ?> <div class="addplus">+</div>    
			</div>
			<div id="slider-range"></div>
			<b class="flt_l" id="p_min"><?php echo $Prices['min'] ?></b>
			<b class="flt_r" id="p_max"><?php echo $Prices['max'] ?></b>
		    </div>
		</div>
	    </div>
                
                
                
                
                
                
            <div class="accordion">
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="50" valign="middle" class="open"><h3 class="stl_2 plus"><?php echo Yii::t('default', 'bill rooms count'); ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('default', 'bill floor'); ?>:</h3></td>
                    </tr>
                    <tr class="acc_content">
                        <td colspan="2">
		    <table border="0" cellpadding="0" cellspacing="0" class="num_rooms_box flt_l" style="margin-left:0px;width:auto">
			<tr>
			    <td><?php echo CHtml::checkBoxList("SearchForm[rooms_count][]", false, Yii::app()->params['rooms'], array('separator' => '', 'class' => 'checkroom')); ?></td>
			</tr>
		    </table>


		    <div class="flt_r" style=" margin-right:5px;">

<?php echo $form->dropDownList($searchForm, 'floor', Yii::app()->params['floors_to_search'][$this->curlang->language], array('onChange' => 'timedsubmit(document.SearchForm,400,"#result", "/search/", "loading")')); ?>
		    </div><div class="clr"></div>
                        </td>

                    </tr>
                </table>


                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="50" valign="middle" class="open"><h3 class="stl_2 plus"><?php echo Yii::t('default', 'set square range'); ?> (m<sub>2</sub>):</h3></td>
                    </tr>
                    <tr class="acc_content">
                        <td>
		    <div class="trackbar" style="padding-bottom: 10px;">
			<div class="mrg_lft_10">
			    <div style="position: relative;">
			<?php echo $form->textField($searchForm, 'squaremin', array('id' => 'price_min2', 'class' => 'inp_min', 'readonly' => 'readonly')); ?>                    
			<?php echo $form->textField($searchForm, 'squaremax', array('id' => 'price_max2', 'class' => 'inp_max', 'readonly' => 'readonly')); ?><div class="addplus2">+</div>  
			    </div><div id="slider-range2"></div>
			    <b class="flt_l"><?php echo $Squares['min'] ?></b>
			    <b class="flt_r"><?php echo $Squares['max'] ?></b>
			</div>
		    </div>
                        </td>

                    </tr>
                </table>
                
                
                
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="50" valign="middle" class="open"><h3 class="stl_2 plus"><?php echo Yii::t('default', 'bill amenities'); ?></h3></td>
                    </tr>
                    <tr class="acc_content">
                        <td>
		    <div class="amenities_box_search">
<?php foreach ($amenities as $key => $amenity) { ?>
    			<div class="pop amenities_item_pop" title="<?php echo Yii::t('default', $amenity->name); ?>">
			    <?php echo CHtml::checkBox("SearchForm[Amenity][$amenity->id]", false, array('class' => 'amenity', 'checked' => false, 'uncheckValue' => NULL)); ?>
    			    <label for="<?php echo 'SearchForm_Amenity_' . $amenity->id; ?>" imgname="<?php echo $amenity->image; ?>"></label>
    			</div>
<?php } ?>
			<div class="clr"></div>

		    </div>
                        </td>

                    </tr>
                </table>
                
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="50" valign="middle" class="open"><h3 class="stl_2 plus"><?php echo Yii::t('default', 'bill neighborhood'); ?></h3></td>
                    </tr>
                    <tr class="acc_content">
                        <td>
		    <div class="neighborhoods_box">
<?php foreach ($neighbors as $key => $neighbor) { ?>
    			<div class="neighbor_item">
    <?php echo CHtml::checkBox("SearchForm[Neighbor][$neighbor->id]", false, array('checked' => false, 'uncheckValue' => NULL)); ?>		
    			    <label for="<?php echo "SearchForm_Neighbor_" . $neighbor->id . ""; ?>"><?php echo Yii::t('default', $neighbor->name) ?></label>
    			</div>
<?php } ?>
		    </div>
                        </td>

                    </tr>
                </table>
            </div>
                
                
                
                
                
                
                

	    <div style="padding: 10px;"><div class="lebel_box"><?php echo $form->checkBox($searchForm, 'justwithphotos') ?> <label class="lab_checkbox" for="SearchForm_justwithphotos"><b><?php echo Yii::t('default', 'just with photo') ?></b></label></div>
		<div class="gmap"><div id="YMapsID" style="width:280px;height:238px"></div></div>    

	    </div>


	    <br />





    <?php echo $form->radioButtonList($searchForm, 'todo', $Todos, array('separator' => ' ', 'class' => 'hidden', 'labelOptions' => array('style' => 'display:none'))); ?>
    <?php echo $form->radioButtonList($searchForm, 'order', $orderList, array('class' => 'hidden', 'labelOptions' => array('style' => 'display:none'))) ?>
<?php echo $form->checkBox($searchForm, 'asc', array('class' => 'hidden', 'style' => 'display:none')) ?>
            <?php // echo $form->checkBox($searchForm, 'mapsearch', array('class' => 'hidden', 'style' => 'display:none'));
	     echo $form->checkBox($searchForm, 'mapsearch', array('class' => 'hidden', 'style' => 'display:none'));
	     echo $form->hiddenField($searchForm, 'radius');
	     echo $form->hiddenField($searchForm, 'coords');
	    ?>
	    <div class="clr"></div>
    <?php $this->endWidget(); ?>
	</div></div>
    <div class="clr"></div>
<?php if(!empty($text)){?>
        <div class="search_context">
            <h1><?php if(isset($h1)) echo $h1; ?></h1>
<?php if ($text) { ?>
            <div><?php echo $text->content; ?></div>
	<?php } ?>
        </div>
	<?php } ?>



    <!-- СПИСОК ССЫЛОК -->
<?php if (isset($seolinks)) { ?>
        <div class="clr"></div><div class="setlinks" style="margin-bottom:10px;">


    <?php
    foreach ($seolinks as $key => $value) {
	echo CHtml::link($key, $value, array('style' => 'float:left'));
    }
    ?>



        </div><br/><br/><br/><div class="clr"></div>
<?php } ?>

    <!-- /СПИСОК ССЫЛОК -->


</div>

<script type="text/javascript">
        api.addMap('YMapsID');
//    api.addMap('full_map');

    $('#search input').on("change",function(){timedsubmit(document.SearchForm,50,"#result", "/search/", "<?php echo Yii::t('default', 'loading') ?>")});



<?php foreach ($rents as $key => $rent) { ?>
    
    <?php
    				if ($rent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/buy_image_s.png';
				} elseif ($rent->cover)
				    $avatar = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($rent->id)
                        . '/thumbs/' 
                        . $rent->cover->file;
				elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' 
                        . Yii::app()->putils->fragment($rent->id)
                        . '/thumbs/' 
                        . $rent->photos[0]->file 
                        . '';
				} else {
				    $avatar = $this->getAssetsUrl() . '/images/nophoto.png';
				}
                                
                                ?>

<?php $shortname = Yii::t('default', $this->currentCurrency->short_name);?>
    <?php $cur_row = Yii::t('default', $prices_to_view[$rent->current_price]['row']); ?>
				    <?php if ($rent->todo == 1) {
                                        $mytodo=1;
                                       $price = number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');
	    	
				 } else { 
 $mytodo=0;
	    			$price = number_format($rent->price_day * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');

	    			 
				} ?>


    <?php  echo 'api.setMark({
	geoX:' . $rent->adress->geox . ',
	geoY:' . $rent->adress->geoy . ',
	title:\'' . $rent->description->name . '\',
	link:"/rent/' . $rent->id . '",
	avatar:"' . $avatar . '",
        mytodo:"' .$mytodo. '",
	price:"'.$price.'", 
	shortname:"'.$shortname.'", 
	cur_row:"'.$cur_row.'"});' ?>
        if(min_x><?php echo $rent->adress->geox ?>)min_x = <?php echo $rent->adress->geox ?>;
        if(min_y><?php echo $rent->adress->geoy ?>)min_y = <?php echo $rent->adress->geoy ?>;
        if(max_x<<?php echo $rent->adress->geox ?>)max_x = <?php echo $rent->adress->geox ?>;
        if(max_y<<?php echo $rent->adress->geoy ?>)max_y = <?php echo $rent->adress->geoy ?>;
<?php } ?>
<?php if (count($rents)) echo 'api.setBounds([[min_y,min_x],[max_y,max_x]],"YMapsID");' ?>

</script>

