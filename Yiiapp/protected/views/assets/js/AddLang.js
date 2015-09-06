<!-- 
var nameLang = ['Русский', 'English', 'Украинский'];
var nameLangLavel = ['уровень', 'level', 'уровень'];

/*Функция отправки в Input уровень*/
function LoadGet(level, widthNum, keyID){
    $('#UserLang_'+keyID+'_value').val(level);
    var elem2 = $('.lang_'+keyID+' li')[0];
    $(elem2).css({'width' : ''+widthNum+'px'});
    return false;
}

/*Удаление Выборки уровня языка и добавление кнопки Добавление*/
function lang_del(IDs){
    jQuery(function($) {
    $('.show_'+IDs+', #table'+IDs+'').css({'display':'none'});
    $('#Language_'+IDs+'_id').attr('checked', false);
    $('#UserLang_'+IDs+'_value').val('0');
    $('select#SelectLang').eq(0).append('<option value="'+IDs+'">'+nameLang[IDs]+'</option>');
    if($('#Language_0_id').prop('checked') || $('#Language_1_id').prop('checked') || $('#Language_2_id').prop('checked')){
        $('#AddLangBox').css({'display':'block'});
    }

    var countopt = $('#SelectLang option').length;
    if(countopt > 2)$('.language_delete').css({'display':'none'});
    });
}
$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};

jQuery(function($) {
    $('#SelectLang').change(function(){


    if(!$('#SelectLang :selected').hasAttr('main')) {
        if(this.length == "2") $('#AddLangBox').css({'display':'none'}); // Спрятоть Selector при выборе всех языков!
        $('#Language_'+this.value+'_id').attr('checked', true);
        $('#UserLang_'+this.value+'_value').val('1');
        $('.lang_'+this.value+' .level').css({'width' : '20px'});  
        $('.language_delete').css({'display':'block'});
        $('.show_'+this.value+', #table'+this.value+'').css({'display':'block'});
        $("#SelectLang :selected").remove();


    }

    });
});


$(function() {
/*Цикл проверки ID-inputa и указание уровня*/
for(var k = 0; k < 3; k++) {
    $('span.lang_name'+k+'').append(nameLang[k]+' '+nameLangLavel[k]);
    if ($('#UserLang_'+k+'_value').val() == 1){
        $('.lang_'+k+' .level').css({'width' : '20px'});
    } else if ($('#UserLang_'+k+'_value').val() == 2){
        $('.lang_'+k+' .level').css({'width' : '42px'});
    } else if ($('#UserLang_'+k+'_value').val() == 3){
        $('.lang_'+k+' .level').css({'width' : '64px'});
    } else if ($('#UserLang_'+k+'_value').val() == 4){
        $('.lang_'+k+' .level').css({'width' : '84px'});
    } else if ($('#UserLang_'+k+'_value').val() == 5){
        $('.lang_'+k+' .level').css({'width' : '103px'});
    }
    
    
    if($('#Language_'+k+'_id').prop('checked')){
        $('.lang_btn'+k+'').html('<a href="javascript:void(0);" onclick="lang_del(\''+k+'\');" class="language_delete"></a>');
        $('.show_'+k+'').css({'display':'block'});
        if ($('#UserLang_'+k+'_value').val() == 1){
            $('.lang_'+k+' .level').css({'width' : '20px'});
        } else if ($('#UserLang_'+k+'_value').val() == 2){
            $('.lang_'+k+' .level').css({'width' : '42px'});
        } else if ($('#UserLang_'+k+'_value').val() == 3){
            $('.lang_'+k+' .level').css({'width' : '64px'});
        } else if ($('#UserLang_'+k+'_value').val() == 4){
            $('.lang_'+k+' .level').css({'width' : '84px'});
        } else if ($('#UserLang_'+k+'_value').val() == 5){
            $('.lang_'+k+' .level').css({'width' : '103px'});

        }

    }else{
        $('.lang_btn'+k+'').html('<a href="javascript:void(0);" onclick="lang_del(\''+k+'\');" class="language_delete"></a>');
        $('.show_'+k+', #table'+k+'').css({'display':'none'});
        $('select#SelectLang').eq(0).append('<option value="'+k+'">'+nameLang[k]+'</option>');
    }
}


if($('#SelectLang option').length==3){
    $('.language_delete').css({'display':'none'});
}else if($('#SelectLang option').length==1){
    $('#AddLangBox').css({'display':'none'});
}
});

-->