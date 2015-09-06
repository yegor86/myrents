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

