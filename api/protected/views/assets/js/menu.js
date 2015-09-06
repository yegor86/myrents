function ajaxSubmitForm (formid, url, result, preloading) {
    var str = $(formid).serialize();
    if(preloading) $(preloading).css({'display':'inline'});
    str+='&isajax=isajax';
    $.post(url, str, function(data) {
        if(preloading) $(preloading).css({'display':'none'});
        $(result).html(data);
    });
    return false;
}
function submitForm(formid){
    $(formid).submit();
  
}


// Отслежка переходов стрелочки Назад
//$(function() {
  //  if(!document.referrer){
        $('.back_to_search_btn').css({'display': 'none'});
   // }else{
    //    $('.back_to_search_btn').attr('href', document.referrer);
    //    $('.search_btn').css({'display': 'none'});
   // } 
//});


function dropimg(imgid, countID, assets){
    $('#c'+countID+'').html('<img src="'+assets+'/images/s-loading.gif" alt="" />');
    $.ajax({
        type:'post',
        data:{
            dropimage: true, 
            imageid: imgid
        },
        success:function(html){
            $("#returnform").html(html);
        }
    });
}
function popup_currency(actual, cur_array){
    var counter = cur_array.length;
    var content = document.createElement('ul');
    content.id='lang_list';
    for (start in cur_array) {
        li = document.createElement('li');
        alink = document.createElement('a');
        alink.href = '#ss';
        alink.innerHTML = cur_array[start];
        li.appendChild(alink);
        content.appendChild(li);
    }
    div = document.createElement('div');
    div.className="headmenu_popup";
    div.appendChild(content);
    curpop=document.getElementById('currency_pop');
    curpop.innerHTML ='<span class="popup_title"><a id="close_lang_pop"  href="#">'+ actual +' <img src="images/arr_up.gif" border="0" alt="" /></a></span>';
    curpop.appendChild(div);


}
	
		

		
$(function() {   
    $("#advanced_option #open_advanced").click(function(){
        $('#open_advanced').toggleClass('active').siblings('#options_win').slideToggle(0);
        return false;
    });
});




	$(function() {
	var zIndexNumber = 5001;
	$('#multiAccordionNo div, #multiAccordionNo h3').each(function() {
	$(this).css('zIndex', zIndexNumber);
	zIndexNumber -= 1;
	});
	});



















