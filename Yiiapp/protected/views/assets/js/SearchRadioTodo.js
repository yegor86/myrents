/*
  * Проверка на checked
  * Author: Andrew (Panix)
  **/

jQuery(function($){
    //$('#SearchForm_todo_0').attr('checked','checked');
    if($('#SearchForm_todo_0').prop('checked')){
	$('#SearchForm_todo_0').attr('checked','checked');
	$('#SearchForm_todo_0s').addClass('activated');
	$('#ytSearchForm_todo').val($('#SearchForm_todo_0').val());
    }
    if($('#SearchForm_todo_1').prop('checked')){
	$('#SearchForm_todo_1').attr('checked');
	$('#SearchForm_todo_1s').addClass('activated');
	$('#ytSearchForm_todo').val($('#SearchForm_todo_1').val());
    }
    if($('#SearchForm_todo_2').prop('checked')){
	$('#SearchForm_todo_2').attr('checked','checked');
	$('#SearchForm_todo_2s').addClass('activated');
	$('#ytSearchForm_todo').val($('#SearchForm_todo_3').val());
    }
});
/*
  * Клик для скрытых 'radio buttons'
  * Author: Andrew (Panix)
  **/
function search_radio_todo(radiobj, myself, drop, like){

    if (!$(radiobj).prop('checked')) {
	$(radiobj).attr('checked', 'checked');
	$(myself).addClass('activated');
                    
	$('#'+drop[0]+', #'+drop[1]+'').removeAttr('checked');
	$('#'+drop[0]+'s, #'+drop[1]+'s').removeClass('activated');
    } else {
	//$(radiobj).removeAttr('checked');
	//$(myself).removeClass('activated');

    }
    $('#ytSearchForm_todo').val($(radiobj).val());

    if(like){
        $('#Searchtype').css({'display':'none'});
        $('#Searchtype input').removeAttr('checked');
        $('#Searchtype a').removeClass('checked');

        
        
    }else{
        $('#Searchtype').css({'display':'block'});
        $('#Searchtype input').removeAttr('checked');
        $('#Searchtype a').removeClass('checked');

    }





    
    
}




function search_radio_type(radiobj, myself, drop){

   /* if (!$(radiobj).prop('checked')) {
	$(radiobj).attr('checked', 'checked');
	$(myself).addClass('activated');
                    
	$('#'+drop[0]+', #'+drop[1]+'').removeAttr('checked');
	$('#'+drop[0]+'s, #'+drop[1]+'s').removeClass('activated');
    } else {
	$(radiobj).removeAttr('checked');
	$(myself).removeClass('activated');

    }*/

    if (!$(radiobj).prop('checked')) {
        $('#Searchtype a').removeClass('activated');
        $('#SearchForm_current_price input').removeAttr('checked');
        $(radiobj).attr('checked', 'checked');
        $(myself).addClass('activated');
    } else {
        $(radiobj).removeAttr('checked');
        $('#Searchtype a').removeClass('activated');
    }

}



jQuery(function($){
    if ($('#SearchForm_current_price_0').prop('checked')) {
        $('#SearchForm_type_0s').addClass('activated');
    } else {
        $('#SearchForm_type_0s').removeClass('activated');
    }
    if ($('#SearchForm_current_price_1').prop('checked')) {
        $('#SearchForm_type_1s').addClass('activated');
    } else {
        $('#SearchForm_type_1s').removeClass('activated');
    }
    if ($('#SearchForm_current_price_2').prop('checked')) {
        $('#SearchForm_type_2s').addClass('activated');
    } else {
        $('#SearchForm_type_2s').removeClass('activated');
    }
});