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
	    $('.addplus').html('+');
	    $( "#slider-range" ).slider({
		range: true,
		step: 5,
		min: <?php echo Yii::app()->params['prices']['min'] ?>,
		max:  <?php echo Yii::app()->params['prices']['max'] ?>,
		values: [ <?php echo Yii::app()->params['prices']['min'] ?>, <?php echo Yii::app()->params['prices']['max'] ?>],
		slide: function( event, ui ) {
		    $("#price_max").val(ui.values[ 1 ]);
		    $("#price_min").val(ui.values[ 0 ]);
		    if($("#price_max").val() == '<?php echo Yii::app()->params['prices']['max'] ?>'){
			$('.addplus').html('+');
		    }else{
			$('.addplus').html('');
		    }
		},
		change : function() {timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>')}

	    });
	    $( "#price_max" ).val($( "#slider-range" ).slider( "values", 1 ));
	    $( "#price_min" ).val($( "#slider-range" ).slider( "values", 0 ));
        });
        $('.nav li#SearchForm_todo_1s').click(function(){
	    $('.addplus').html('+');
	    $('#p_max').html('<?php echo Yii::app()->params['prices_sale']['max'] ?>');
	    $('#slider-range').slider('refresh');
	    $( "#slider-range" ).slider({
		range: true,
		step: 5,
		min: <?php echo Yii::app()->params['prices_sale']['min'] ?>,
		max: <?php echo Yii::app()->params['prices_sale']['max'] ?>,
		values: [ <?php echo Yii::app()->params['prices_sale']['min'] ?>, <?php echo Yii::app()->params['prices_sale']['max'] ?>],
		slide: function( event, ui ) {
		    $("#price_max").val(ui.values[ 1 ]);
		    $("#price_min").val(ui.values[ 0 ]);
		    if($("#price_max").val() == '<?php echo Yii::app()->params['prices_sale']['max'] ?>'){
			$('.addplus').html('+');
		    }else{
			$('.addplus').html('');
		    }
		},
		change : function() {timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>')}

	    });
	    $( "#price_max" ).val($( "#slider-range" ).slider( "values", 1 ));
	    $( "#price_min" ).val($( "#slider-range" ).slider( "values", 0 ));
        });
        
	if($('.nav li#SearchForm_todo_0s').hasClass('activated')){
	    $('.addplus').html('+');
	    $( "#slider-range" ).slider({
		range: true,
		step: 5,
		min: <?php echo Yii::app()->params['prices']['min'] ?>,
		max:  <?php echo Yii::app()->params['prices']['max'] ?>,
		values: [ <?php echo Yii::app()->params['prices']['min'] ?>, <?php echo Yii::app()->params['prices']['max'] ?>],
		slide: function( event, ui ) {
		    $("#price_max").val(ui.values[ 1 ]);
		    $("#price_min").val(ui.values[ 0 ]);
		    if($("#price_max").val() == '<?php echo Yii::app()->params['prices']['max'] ?>'){
			$('.addplus').html('+');
		    }else{
			$('.addplus').html('');
		    }
		},
		change : function() {timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>')}

	    });
	    $( "#price_max" ).val($( "#slider-range" ).slider( "values", 1 ));
	    $( "#price_min" ).val($( "#slider-range" ).slider( "values", 0 ));
	}else{
	    $('.addplus').html('+');
	    $('#p_max').html('<?php echo Yii::app()->params['prices_sale']['max'] ?>');
	    $( "#slider-range" ).slider({
		range: true,
		step: 5,
		min: <?php echo Yii::app()->params['prices_sale']['min'] ?>,
		max: <?php echo Yii::app()->params['prices_sale']['max'] ?>,
		values: [ <?php echo Yii::app()->params['prices_sale']['min'] ?>, <?php echo Yii::app()->params['prices_sale']['max'] ?>],
		slide: function( event, ui ) {
		    $("#price_max").val(ui.values[ 1 ]);
		    $("#price_min").val(ui.values[ 0 ]);
		    if($("#price_max").val() == '<?php echo Yii::app()->params['prices_sale']['max'] ?>'){
			$('.addplus').html('+');
		    }else{
			$('.addplus').html('');
		    }
		},
		change : function() {timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>')}

	    });
	    $( "#price_max" ).val($( "#slider-range" ).slider( "values", 1 ));
	    $( "#price_min" ).val($( "#slider-range" ).slider( "values", 0 ));
	}
        $('.addplus2').html('+');
	$( "#slider-range2" ).slider({
	    range: true,
	    // step: 5,
	    min: <?php echo $Squares['min'] ?>,
	    max:  <?php echo $Squares['max'] ?>,
	    values: [ <?php echo $searchForm->squaremin ?>, <?php echo $searchForm->squaremax ?>],
	    slide: function( event, ui ) {
		$( "#price_max2" ).val(ui.values[ 1 ]);
		$( "#price_min2" ).val(ui.values[ 0 ]);
                if($("#price_max2").val() == '<?php echo $Squares['max'] ?>'){
                    $('.addplus2').html('+');
                }else{
                    $('.addplus2').html('');
                }
	    },
	    change : function() {timedsubmit(document.SearchForm,50,'#result','/search/', '<?php echo Yii::t('default', 'loading') ?>')}
	});
	$( "#price_max2" ).val($( "#slider-range2" ).slider( "values", 1 ));
	$( "#price_min2" ).val($( "#slider-range2" ).slider( "values", 0 ));	
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
        
        $(".checkroom").imageTick({
	    image_tick_class: "checknum",
	    custom_button: function($label){
		$label.hide();
		return '<span>' + $label.text() + '</span>';
	    }
	});
    });

</script>
<script type="text/javascript">
    $(function(){
	var params = {
            changedEl: "#SearchForm_floor",
            visRows: 5,
            scrollArrows: false
        }
        cuSel(params);
        
	params_country = {
	    changedEl: "#country_list",
            visRows: 7,
	    scrollArrows: true
	}
        
        cuSel(params_country);
	
        
        params_region = {
	    changedEl: "#region_list",
	    visRows: 5,
	    scrollArrows: true
	}
	cuSel(params_region);
	
	//showvalue(document.getElementById('autocomplete'),true);
	
	$('#region_list_box, #regionloading, #region_t').css({'display':'none'});
	$('#country_list').change(function(){
            $('#regionloading').css({'display':'block'});
	    //   api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map');
	    $.ajax({
		url:'/regions',
		type:'post',
		dataType: 'json',
		data:{
		    getregions: $(this).val()
		},
		success:function(jsonarray){
		    $('#region_list').val('');
		    $('#regionloading').css({'display':'none'});
		    $('#region_t').css({'display':'inline'});
		    
		    if(jsonarray.length){
			var regionslist = '';
			for (var i = 0; i < jsonarray.length; i++) {
			    regionslist += '<span val="' + jsonarray[i].name + '" geocoords ="'+jsonarray[i].geox+', '+jsonarray[i].geoy +'">' + jsonarray[i].name + '</span>';
			}
			$("#cusel-scroll-region_list").html(regionslist);
			var paramsr = {
			    refreshEl: "#region_list",
			    visRows: 5,
                            scrollArrows: true
			}
			cuSelRefresh(paramsr);
			

			
			
			$('#region_list_box .cusel-scroll-wrap span').click(function(){
			    $('#region_list_box .cusel-scroll-wrap').css({'display':'none'});
			    valspan = $(this).text();
			    $('#region_list_box #region_list').val(valspan);
			    $('#region_list_box #cuselFrame-region_list .cuselText').html(valspan);
			    timedsubmit(document.SearchForm,50,"#result", "/search/" , "<?php Yii::t('default', 'loading') ?>")
			});
                        $('#cusel-scroll-country_list span, #cusel-scroll-region_list span').click(function() {
			    $('#SearchForm_radius').val('2000');
			    $('#SearchForm_coords').val($(this).attr('geocoords'));
			    api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map');
			});
			$("#region_list_box #cuselFrame-region_list .cuselText").html('<?php echo Yii::t('default', 'any') ?>');
			$('#region_list_box').css({'display':''});
                        timedsubmit(document.SearchForm,50,"#result", "/search/" , "<?php Yii::t('default', 'loading') ?>")
		    }
		    else {
                        $('#region_list_box').css({'display':'none'});
                        $('#region_t').css({'display':'none'});
                        $('#region_list').val('');
                    }timedsubmit(document.SearchForm,50,"#result", "/search/" , "<?php Yii::t('default', 'loading') ?>")
		    
		}
	    });
	});
    });
    
 $(function(){
        $('#cusel-scroll-country_list span, #cusel-scroll-region_list span').click(function() {
            $('#SearchForm_radius').val('2000');
            $('#SearchForm_coords').val($(this).attr('geocoords'));
           api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map');
        });
});

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
				    $avatar = $this->getAssetsUrl() . '/images/buy_image.png';
				} elseif ($topRent->cover){
				    $avatar = '/uploads/rentpic/' . $topRent->id . '/thumbs/' . $topRent->cover->file;
                                } elseif (($topRent->photos) && ($topRent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' . $topRent->id . '/thumbs/' . $topRent->photos[0]->file . '';
				} else {
                                    $avatar = $this->getAssetsUrl() . '/images/no_gallery_s.png';
				}
    
    				$description = (isset($topRent->descriptions[0]))?$topRent->descriptions[0]:
				RentDescription::model()->findByPk(array(
				    'rent'=>$topRent->id,
				    'language'=>'1'
				));
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
						<li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.bills'); ?></a></li>
	<?php if (!Yii::app()->user->isGuest) { ?><li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>/messages/send/<?php echo $topRent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.message'); ?></a></li><?php } ?>
                                                 <li><a target="_blank" href="/user/<?php echo $topRent->renter->id ?>/"><?php echo Yii::t('default', 'usermenu.profile'); ?></a></li>
					    </ul>
                    </div>
                    <div class="trans"><?php echo CHtml::link($description->name, '/rent/' . $topRent->id, array('class' => 'link')); ?><div class="trans_txt"></div><div class="clr"></div></div>
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
		    <?php if ($topRent->todo==1) { $tpriced = ($priced)?$priced:$topRent->current_price;?>
		    
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
			    $descriptions = array();
			    $count = count($rents);
			    foreach ($rents as $key => $rent) {
				$class_last = '';
				if (!--$count)
				    $class_last = " last";

				if ($rent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/buy_image.png';
				} elseif ($rent->cover)
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->cover->file;
				elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->photos[0]->file . '';
				} else {
				    $avatar = $this->getAssetsUrl() . '/images/no_gallery_s.png';
				}
				$descriptions[$key] = (isset($rent->descriptions[0])) ? $rent->descriptions[0] : RentDescription::model()->findByPk(array('rent' => $rent->id, 'language' => 1));
				?>




				<div class="search_box">
				    <a href="/rent/<?php echo $rent->id; ?>"><span class="search_img_box" style="background-image: url('<?php echo $avatar ?>')"></span></a>
				    <?php if (!Yii::app()->user->isGuest && $rent->user == Yii::app()->user->id) { ?> <?php echo CHtml::link('', '/up/' . $rent->id.'/', array('value' => $rent->id, 'class' => 'upbtn_search p_absolute uptop fancybox.ajax row')) ?> <?php } ?>
				    <?php if ((time() - strtotime($rent->creation_date) ) < Yii::app()->params['isnew']) { ?>
	    			    <div class="status_board popEdge new" title="<?php echo Yii::t('default', 'New') ?>"><?php echo Yii::t('default', 'New') ?></div>
	<?php } ?>

				    <a class="addfav pop" style="display:none" href="javascript:void(0)" title="<?php echo Yii::t('default', 'add to favorites'); ?>"></a>
				    <!--<div class="user"><a href="/user/<?php echo $rent->renter->id ?>"><img src="<?php echo Yii::app()->params['USERPHOTOSDIR'] . $rent->renter->image ?>" width="40" border="0" height="40" alt="" /></a></div>-->
				    <div class="user"><a href="/user/<?php echo $rent->renter->id ?>"><span style="background-image: url('<?php echo Yii::app()->params['USERPHOTOSDIR'] . 'little/' . $rent->renter->image ?>')"></span></a>

					    <ul class="controls">
						<li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.bills'); ?></a></li>
	<?php if (!Yii::app()->user->isGuest) { ?><li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>/messages/send/<?php echo $rent->renter->id ?>"><?php echo Yii::t('default', 'usermenu.message'); ?></a></li><?php } ?>
                                                 <li><a target="_blank" href="/user/<?php echo $rent->renter->id ?>/"><?php echo Yii::t('default', 'usermenu.profile'); ?></a></li>
					    </ul>

				    </div>
				    <div class="trans"><?php echo CHtml::link($descriptions[$key]->name, '/rent/' . $rent->id, array('class' => 'link')); ?><div class="trans_txt"></div><div class="clr"></div></div>
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
    'skin' => 'myrents'
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
 
	    <div class=""><div class="">

		</div></div>

	    <!----------------- / поиск по карте   ----------------------->

	    <b class="stl_2 op" style="color:#7c7c7c;padding:0 0 2px 20px"><?php echo Yii::t('default', 'enter the address') ?>:</b>
	    <div class="search_input_box"><div class="searchInput"><?php echo $form->textField($searchForm, 'searchString', array('onkeyup' => 'showvalue(this,true);timedsubmit(document.SearchForm,600,"#result", "/search/", "' . Yii::t('default', 'loading') . '");', 'id' => 'autocomplete')); ?></div></div>
	    <div class="example op" style="padding-left:22px;"><?php echo Yii::t('default', 'example'); ?>: <span><?php echo Yii::t('default', 'example street'); ?></span></div>

	    <b class="stl_2" style="color:#7c7c7c;padding:20px 0 0 20px"><?php echo Yii::t('default', 'or select of list') ?></b>
	    <div class="search_block">

		<div id="search_location">
		    <div class="search_region flt_l stl_2" id="country_t"><?php echo Yii::t('default', 'country'); ?>:</div>
		    <div id="city_list_box" class="cusel_list_box">

<?php
echo $form->dropDownList($searchForm, 'city', CHtml::listData($cityList, 'name', 'name'), array('id' => 'country_list', 'prompt' => Yii::t('default', 'any'),
    'options' => MRChtml::listGeocoordOptions($cityList)
));
?>
		    </div>
		    <div class="clr"></div>
		    <div id="regionloading"><center><img src="<?php echo $this->assetsUrl ?>/images/s-loading.gif" alt="<?php echo Yii::t('default', 'loading'); ?>" /></center></div>
		    <div class="search_region flt_l stl_2" id="region_t"><?php echo Yii::t('default', 'region'); ?>:</div>
		    <div id="region_list_box" class="cusel_list_box">
<?php echo $form->dropDownList($searchForm, 'region', CHtml::listData($cityList, 'name', 'name'), array('id' => 'region_list', 'onChange' => 'timedsubmit(document.SearchForm,50,"#result", "/search/", "' . Yii::t('default', 'loading') . '")', 'prompt' => Yii::t('default', 'any'))); ?>
		    </div></div>
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
<?php echo $form->textField($searchForm, 'pricemax', array('id' => 'price_max', 'class' => 'inp_max', 'readonly' => 'readonly')); ?> <div class="addplus"></div>    
			</div>
			<div id="slider-range"></div>
			<b class="flt_l" id="p_min"><?php echo $Prices['min'] ?></b>
			<b class="flt_r" id="p_max"><?php echo $Prices['max'] ?></b>
		    </div>
		</div>
	    </div>
	    <div id="multiAccordionNo">
		<h3 class="stl_3"><a href="#"><?php echo Yii::t('default', 'bill rooms count'); ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('default', 'bill floor'); ?>:</a></h3>
		<div>

		    <table border="0" cellpadding="0" cellspacing="0" class="num_rooms_box flt_l" style="margin-left:0px;width:auto">
			<tr>
			    <td><?php echo CHtml::checkBoxList("SearchForm[rooms_count][]", false, Yii::app()->params['rooms'], array('separator' => '', 'class' => 'checkroom')); ?></td>
			</tr>
		    </table>
		    <!--<div class="num_rooms_box flt_l" style="margin-left:0px;width:141px;">
<?php //echo CHtml::checkBoxList("SearchForm[rooms_count][]", false, Yii::app()->params['rooms'], array('separator' => '', 'class' => 'checkroom'));  ?>
			<div class="clr"></div>
		    </div>-->

		    <div class="flt_r" style=" margin-right:5px;">

<?php echo $form->dropDownList($searchForm, 'floor', Yii::app()->params['floors_to_search'][$this->curlang->language], array('onChange' => 'timedsubmit(document.SearchForm,400,"#result", "/search/", "loading")')); ?>
		    </div><div class="clr"></div>
		</div>
		<h3 class="stl_3"><a href="#"><?php echo Yii::t('default', 'set square range'); ?> (m<sub>2</sub>):</a></h3>
		<div>
		    <div class="trackbar" style="padding-bottom: 10px;">
			<div class="mrg_lft_10">
			    <div style="position: relative;">
			<?php echo $form->textField($searchForm, 'squaremin', array('id' => 'price_min2', 'class' => 'inp_min', 'readonly' => 'readonly')); ?>                    
			<?php echo $form->textField($searchForm, 'squaremax', array('id' => 'price_max2', 'class' => 'inp_max', 'readonly' => 'readonly')); ?><div class="addplus2"></div>  
			    </div><div id="slider-range2"></div>
			    <b class="flt_l"><?php echo $Squares['min'] ?></b>
			    <b class="flt_r"><?php echo $Squares['max'] ?></b>
			</div>
		    </div>

		</div>

		<h3 class="stl_3"><a href="#"><?php echo Yii::t('default', 'bill amenities'); ?>:</a></h3>
		<div>
		    <div class="amenities_box_search">
<?php foreach ($amenities as $key => $amenity) { ?>
    			<div class="pop amenities_item_pop" title="<?php echo Yii::t('default', $amenity->name); ?>">
			    <?php echo CHtml::checkBox("SearchForm[Amenity][$amenity->id]", false, array('class' => 'amenity', 'checked' => false, 'uncheckValue' => NULL)); ?>
    			    <label for="<?php echo 'SearchForm_Amenity_' . $amenity->id; ?>" imgname="<?php echo $amenity->image; ?>"></label>
    			</div>
<?php } ?>
			<div class="clr"></div>

		    </div>
		</div>

		<h3 class="stl_3"><a href="#"><?php echo Yii::t('default', 'bill neighborhood'); ?>:</a></h3>
		<div>
		    <div class="neighborhoods_box">
<?php foreach ($neighbors as $key => $neighbor) { ?>
    			<div class="neighbor_item">
    <?php echo CHtml::checkBox("SearchForm[Neighbor][$neighbor->id]", false, array('checked' => false, 'uncheckValue' => NULL)); ?>		
    			    <label for="<?php echo "SearchForm_Neighbor_" . $neighbor->id . ""; ?>"><?php echo Yii::t('default', $neighbor->name) ?></label>
    			</div>
<?php } ?>
		    </div>
		</div>
	    </div>
	    <div style="border-top:1px solid #c4c6cc; padding: 10px;"><div class="lebel_box"><?php echo $form->checkBox($searchForm, 'justwithphotos') ?> <label class="lab_checkbox" for="SearchForm_justwithphotos"><b><?php echo Yii::t('default', 'just with photo') ?></b></label></div>
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
    api.addMap('full_map');
    api.setSearchRadius({coordInput:'SearchForm_coords',radiusInput:'SearchForm_radius'},'full_map',<?php echo json_encode($cityList); ?>);
    $('#search input').on("change",function(){timedsubmit(document.SearchForm,50,"#result", "/search/", "<?php echo Yii::t('default', 'loading') ?>")});



<?php foreach ($rents as $key => $rent) { ?>
    
    <?php
    				if ($rent->todo == 3) {
				    $avatar = $this->getAssetsUrl() . '/images/buy_image_s.png';
				} elseif ($rent->cover)
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->cover->file;
				elseif (($rent->photos) && ($rent->photos[0]->file)) {
				    $avatar = '/uploads/rentpic/' . $rent->id . '/thumbs/' . $rent->photos[0]->file . '';
				} else {
				    $avatar = $this->getAssetsUrl() . '/images/nophoto.png';
				}
                                
                                ?>

<?php $shortname = Yii::t('default', $this->currentCurrency->short_name);?>
    <?php $cur_row = Yii::t('default', $prices_to_view[$rent->current_price]['row']); ?>
				    <?php if ($rent->todo == 1) { ?>
                                        <?php $price = number_format($rent->$prices_to_view[$rent->current_price]['row'] * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');?>
	    	
				<?php } else { ?>
	    			    <?php //$price .= '<div class="price" style="width:153px">';?>
	    			<?php $price = number_format($rent->price_day * $rent->currency->rate / $this->currentCurrency->rate, 0, ',', ' ');?>

	    			    <?php //$price .= '</div>';?>
				<?php } ?>


    <?php  echo 'api.setMark({
	geoX:' . $rent->adress->geox . ',
	geoY:' . $rent->adress->geoy . ',
	title:\'' . $descriptions[$key]->name . '\',
	link:"/rent/' . $rent->id . '",
	avatar:"' . $avatar . '",
	price:"'.$price.'", 
	shortname:"'.$shortname.'", 
	cur_row:"'.$cur_row.'"});' ?>
        if(min_x><?php echo $rent->adress->geox ?>)min_x = <?php echo $rent->adress->geox ?>;
        if(min_y><?php echo $rent->adress->geoy ?>)min_y = <?php echo $rent->adress->geoy ?>;
        if(max_x<<?php echo $rent->adress->geox ?>)max_x = <?php echo $rent->adress->geox ?>;
        if(max_y<<?php echo $rent->adress->geoy ?>)max_y = <?php echo $rent->adress->geoy ?>;
<?php } ?>
<?php if (count($rents)) echo 'api.setBounds([[min_y,min_x],[max_y,max_x]],"YMapsID");' ?>

init_uplink();
</script>

