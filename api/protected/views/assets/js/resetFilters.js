/*
 * Resent Filters
 */

function resetFilter(price_min, price_max, pricesale_min, pricesale_max, square_min, square_max, floortxt, regiontxt) {
    /*Сброс Типов */
    $('.collector li input[type="radio"]').each( function(i) {
        $(this).removeAttr('checked');
        $(this).prev().removeClass('selected_radio');
    });
    $('#tick_img_SearchForm_type_0').addClass('selected_radio');
    $('#SearchForm_type_0').attr('checked','checked');
    /**********/
    
    
    
    /*Сброс сортировки */
    $('#sortNew').removeClass('sort_up').addClass('active sort_dw');
    $('#sortPrice').removeClass('active');
    $('#SearchForm_order_0').attr('checked','checked');
    $('#SearchForm_asc').removeAttr('checked');
    /**********/
    
    
        
    /*Сброс цена ЗА */
    $('#search_radio_type input[type="radio"]').each( function(i) {
        $(this).removeAttr('checked');
    });
    $('#Searchtype a').each( function(i) {
        $(this).removeClass('activated');
    });

    /*Сброс этожей */
    $('#SearchForm_floor').val(0);
    $('#cuselFrame-SearchForm_floor .cuselText').text(floortxt);
    $('#cuselFrame-SearchForm_floor span').removeClass('cuselActive');/*удаляем все классы*/
    $('#cuselFrame-SearchForm_floor span:first').addClass('cuselActive');/*теперь добавляем в перавый елемент класс*/

    /*Сброс регионов */
    $('#country_list').val(0);
    $('#region_list').val(0);
    $('#cuselFrame-country_list .cuselText').text(regiontxt);
    $('#cuselFrame-country_list span').removeClass('cuselActive');/*удаляем все классы*/
    $('#cuselFrame-country_list span:first').addClass('cuselActive');/*теперь добавляем в перавый елемент класс*/
    
        $('#cuselFrame-region_list .cuselText').text(regiontxt);
    $('#cuselFrame-region_list span').removeClass('cuselActive');/*удаляем все классы*/
    $('#cuselFrame-region_list span:first').addClass('cuselActive');/*теперь добавляем в перавый елемент класс*/
    
    $('#region_t, #region_list_box').css({'display':'none'});





$('input#autocomplete').val('');


    /*Сброс Слайдов цены и площади */
    resetSlider(price_min, price_max, pricesale_min, pricesale_max, square_min, square_max);
        
    /*Сброс у checkbox attr checked и удаление класса 'selected_radio' */
    $('.amenities_item_pop input[type="checkbox"], .num_rooms_box input[type="checkbox"], .neighborhoods_box input[type="checkbox"]').removeAttr('checked');
    $('.amenities_item_pop span, .num_rooms_box span').removeClass('selected_radio');
    $('#SearchForm_justwithphotos').removeAttr('checked');
        
}


function resetSlider(price_min, price_max, pricesale_min, pricesale_max, square_min, square_max) {
    $('.addplus').html('+');
    $('#slider-range').slider('refresh');
    
    
    
    
    if($('.nav li#SearchForm_todo_0s').hasClass('activated')){
        var vprice_min = price_min;
        var vprice_max = price_max;
    }else{
        var vprice_min = pricesale_min;
       var vprice_max = pricesale_max;
    }
    $( "#slider-range" ).slider({
        values: [ vprice_min, vprice_max],
        slide: function( event, ui ) {
            $("#price_max").val(ui.values[ 1 ]);
            $("#price_min").val(ui.values[ 0 ]);
            if($("#price_max").val() == vprice_max){
                $('.addplus').html('+');
            }else{
                $('.addplus').html('');
            }
        }
    });
    $( "#price_max" ).val($( "#slider-range" ).slider( "values", 1 ));
    $( "#price_min" ).val($( "#slider-range" ).slider( "values", 0 ));

    $('.addplus2').html('+');
    $( "#slider-range2" ).slider({
        values: [ square_min, square_max],
        slide: function( event, ui ) {
            $("#price_max2").val(ui.values[ 1 ]);
            $("#price_min2").val(ui.values[ 0 ]);
            if($("#price_max2").val() == square_max){
                $('.addplus2').html('+');
            }else{
                $('.addplus2').html('');
            }
        }
    });
    $( "#price_max2" ).val($( "#slider-range2" ).slider( "values", 1 ));
    $( "#price_min2" ).val($( "#slider-range2" ).slider( "values", 0 ));


}