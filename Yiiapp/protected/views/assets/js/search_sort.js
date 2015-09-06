$(function(){ 
     if($('#SearchForm_order_1').prop('checked') == true){
        $('#sortPrice').addClass('active');
    }else{
        $('#sortPrice').removeClass('active');
    }
    if($('#SearchForm_order_0').prop('checked') == true){
        $('#sortNew').addClass('active');
    }else{
        $('#sortNew').removeClass('active');
    }
});


function search_sort(Mythis, order){
    if(order == 'new'){
        $('#sortPrice').removeClass('sort_up, active').addClass('sort_dw');
        $('#sortNew').addClass('active');
        if($(Mythis).hasClass('sort_up')){
             $('#SearchForm_asc').removeAttr('checked');
            $(Mythis).removeClass('sort_up').addClass('sort_dw');
            $('#SearchForm_order_0').attr('checked','checked');
        }else{
$('#SearchForm_asc').attr('checked','checked');
            $('#SearchForm_order_1').removeAttr('checked');
            $('#SearchForm_order_0').attr('checked','checked');

            $(Mythis).removeClass('sort_dw').addClass('sort_up');
        }
    }else{
        $('#sortNew').removeClass('sort_up, active').addClass('sort_dw');
        $('#sortPrice').addClass('active');

        if($(Mythis).hasClass('sort_up')){
            $('#SearchForm_asc').removeAttr('checked');
            $(Mythis).removeClass('sort_up').addClass('sort_dw');
            $('#SearchForm_order_1').attr('checked','checked');

        }else{
$('#SearchForm_asc').attr('checked','checked');
            $('#SearchForm_order_0').removeAttr('checked');
            $('#SearchForm_order_1').attr('checked','checked');
            $(Mythis).removeClass('sort_dw').addClass('sort_up');
        }  
    }
    return false;
}




/*
 * Function slider
 * min
 * max
 * smin
 * smax
 * cls_plus - Класс блока с плюсиком
 * id_slider
 * id_min - ID input min
 * id_max - ID input max
 * txt_load - текст загрузки
 */
function mr_slider(minimum, maximum, smin, smax, id_min, id_max, cls_plus, id_slider, txt_load, mr_step){


$(function(){




	$(id_slider).slider({
	    range: true,
            step: mr_step,
	    min: 1,
	    max: maximum,
	    values: [smin, smax],
	    slide: function( event, ui ) {
		$(id_max).val(ui.values[ 1 ]);
		$(id_min).val(ui.values[ 0 ]);
                if($(id_max).val() == maximum){
                    $(cls_plus).text('+');
                }else{
                    $(cls_plus).text('');
                }
	    },
	    change : function() {timedsubmit(document.SearchForm,50,'#result','/search/', txt_load)}
	});
	$(id_max).val($(id_slider).slider("values", 1));
	$(id_min).val($(id_slider).slider("values", 0));
   });
}


