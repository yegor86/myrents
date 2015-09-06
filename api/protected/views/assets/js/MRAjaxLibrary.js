function ajaxSubmitForm (formid, sendurl, result, preloading) {
    var str = $(formid).serialize();
    if(preloading) $(preloading).css({'display':'inline'});
    str+='&isajax=isajax';
    $.post(sendurl, str, function(data) {
	if(preloading) $(preloading).css({'display':'none'});
	$(result).html(data);
    });
    return false;
}
function ToTop () {
$('body,html').animate({scrollTop: 380}, 1000);
}
function ajaxPreloadedSubmitForm (formid, sendurl, result) {
    $('.loading_box').css({
	'display':'block'
    });
    $('#body_loading').css({
	'display':'block'
    });
    var str = $(formid).serialize();
    str+='&isajax=isajax';    
    var xhr_re = $.ajax({
	url:sendurl,
	data:str,
	success:function(resultdata) {
            $(result).html(resultdata);
            $('.loading_box, #body_loading').css({
                'display':'none'
            });
        }
    });
    
    xhr_re.fail(function(jqXHR, textStatus) {
        $('#body_loading, .loading_box').css({
            'display':'none'
        });
    });
        
    return false;
}

function submitForm(formid){
    $(formid).submit();  
}

function timedsubmit(form,time, container, searchurl,pagenum){

    if(searchurl == undefined) searchurl = window.location;
    if(form.timer != undefined)  window.clearTimeout(form.timer);
    form.timer = window.setTimeout(function(){
	ajaxSearchSubmitForm(form,searchurl, container,pagenum);
    },time);

    
}
function ajaxSearchSubmitForm (formid, sendurl, result,pagenum) {
    $('.loading_box').css({
	'display':'block'
    });
    $('#body_loading').css({
	'display':'block'
    });
    var str = $(formid).serialize();
    if(pagenum !==undefined) str = str+ '&page='+pagenum;
    
    if (!!(window.history && history.replaceState)) {
	window.history.replaceState(null,null,sendurl+'?'+str);
    }

if($('#SearchForm_mapsearch').attr('checked')!= undefined){ //отправка JSON
    var xhr = $.ajax({
	url:sendurl,
	dataType: 'json',
	data:str,
	success:function(resultdata) {
	    api.clearAllMarks('full_map');
	    if(resultdata.length >0) api.setMarks(resultdata,'full_map');
	    $('#foundcount').html(resultdata.length);
            $('.loading_box, #body_loading').css({
                'display':'none'
            });
        }
    });
} else{
    var xhr = $.ajax({
	url:sendurl,
	data:str,
	success:function(resultdata) {
            $(result).html(resultdata);
            $('.loading_box, #body_loading').css({
                'display':'none'
            });
        }
    });
    
    xhr.fail(function(jqXHR, textStatus) {
        $('#body_loading, .loading_box').css({
            'display':'none'
        });
    });
}
    return false;
}
