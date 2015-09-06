/*
 * version 1.2
 * Функция всплывающего окна для не активированого пользователя
 * author: panix
 * 
 * t_title - заголовок окна
 * content - содержание окна
 */
function mr_popup(t_title,content){
    var popupbody = $('<div>', {id: 'no_active_user_box'});
    var clicker = $('<div>', {id: 'no_active_user_box_div'});
    var popupdiv = $('<div>', {class: 'popup_edit_msg'});
    $(popupdiv).css({
        'top':($(document).height() / 2 - 60)+ 'px', 
        'left':($(document).width() / 2 - 225)+ 'px', 
        'width':'500px'
    });
    $(popupdiv).html('<div class="title_box"><h3>'+t_title+'</h3><div class="close" onClick="$(\'#no_active_user_box\').remove();"></div></div><div class="popup_droprent_content" style="padding: 20px 20px;">'+content+'<div class="clr"></div></div>');    
    $('body').append(popupbody);
    $(popupbody).append(clicker);
    $(popupbody).append(popupdiv);
}