function get_cookie(name)
{
cookie_name = name + "=";
cookie_length = document.cookie.length;
cookie_begin = 0;
while (cookie_begin < cookie_length)
{
value_begin = cookie_begin + cookie_name.length;
if (document.cookie.substring(cookie_begin, value_begin) == cookie_name)
{
var value_end = document.cookie.indexOf (";", value_begin);
if (value_end == -1)
{
value_end = cookie_length;
}
return unescape(document.cookie.substring(value_begin, value_end));
}
cookie_begin = document.cookie.indexOf(" ", cookie_begin) + 1;
if (cookie_begin == 0)
{
break;
}
}
return null;
}



function popup_edit(link){

    popupbody = document.createElement('div');
    popupbody.style.height='100%';
    popupbody.style.position='fixed';
    popupbody.style.top='0';
    popupbody.style.left='0';
    popupbody.style.width='100%';
    popupbody.style.zIndex='5000';
    document.body.appendChild(popupbody);
    
    clicker = document.createElement('div');
    clicker.style.height='100%';
    clicker.style.position='absolute';
    clicker.style.top='0';
    clicker.style.left='0';
    clicker.style.width='100%'; 
    //clicker.style.background = "url(../images/opacity_white_40.png)";
    clicker.style.backgroundColor = "white";
    clicker.style.opacity='0.5';
   /*    clicker.onclick = function(){
        document.body.removeChild(popupbody);
        return false;
        
    }*/
    popupbody.appendChild(clicker);



       
       
    popupdiv = document.createElement('div');
    popupdiv.className = "popup_edit_msg";

    getcook = get_cookie('lang');
if(getcook == "en"){
    width_for_lang='260px';
    t_btn_cancel = 'Cancel';
    t_btn_nosave = 'No';
    t_btn_save = 'Yes';
    t_title = 'Save change';
}else if(getcook == "ua"){
    t_btn_cancel = 'Отмена';
    t_btn_nosave = 'Нет';
    t_btn_save = 'Да';
    t_title = 'Сохранить изменения';
    width_for_lang='300px';
}else{
    t_btn_cancel = 'Отмена';
    t_btn_nosave = 'Нет';
    t_btn_save = 'Да';
    t_title = 'Сохранить изменения';
    width_for_lang='265px';
}

    popupdiv.style.width=width_for_lang;
    //btn_save ='<div class="pdd_5 flt_l"><a class="abutton yellow" href="javascript:void(0)" onclick="edit_save(\''+link+'\');"><span><b><i>'+t_btn_save+'</i></b></span></a></div>';
    btn_save ='<div calss="pdd_5 flt_l"><div class="btn7" onclick="edit_save(\''+link+'\');"><div><a href="javascript:void(0)">'+t_btn_save+'</a></div></div></div>';
    btn_nosave ='<div calss="pdd_5 flt_l"><div class="btn7" ><div><a href="'+link+'">'+t_btn_nosave+'</a></div></div></div>';
     
   // btn_nosave ='<div class="pdd_5 flt_l"><a class="abutton blue" href="'+link+'" ><span><b><i><strong>'+t_btn_nosave+'</strong></i></b></span></a></div>';
    btn_cancel ='<div calss="pdd_5 flt_l"><div class="btn7" id="close_edit_popup" onclick="document.body.removeChild(popupbody);return false;"><div><a href="javascript:void(0)">'+t_btn_cancel+'</a></div></div></div>';
       
    popupdiv.innerHTML='<div class="title_box" id="drag"><h3>'+t_title+'?</h3></div><div class="popup_edit_msg_content">'+btn_save+' '+btn_nosave+' '+btn_cancel+'<div class="clr"></div></div>';

    wheight = popupbody.clientHeight ;
    wwidth = popupbody.clientWidth ;

    popupdiv.style.top=(wheight / 2 - 50)+ 'px';
    popupdiv.style.left=(wwidth / 2 - 125)+ 'px';
    popupbody.appendChild(popupdiv);
}


function edit_save(link){
    $('#newdoc').val(link);
    document.editrent.submit();
    //ajaxSubmitForm  ("#editrent","","#returnform");
    //document.body.removeChild(popupbody);
    //    document.location.href=link;
    //return false;
}


    var hasChange = false;


/*
$(document).ready(function(){	
    $('#editrent input, #editrent textarea').change(function(){
        hasChange = true;
    });
    $('.controller_menu li a').click(function(){
        if(hasChange){
            popup_edit(this.href);
            return false;
        }else{
            return true;
        }
    });
});*/




function mr_dialog_del_rent(ttitle, tyes, tno){
    $(function() {   
            var buttons = {};
            buttons[ tyes ] = function() {
                document.droprent.submit();
            };
            buttons[ tno ] = function() {
                $(this).dialog("close");
            };

            $( "#dialog" ).dialog({
                title: ttitle,
                minHeight: 0,
                modal: true,
                autoOpen: true,
                resizable: false,
                width: 250,
                open : function(){
                    $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
                },
                draggable: false,
                buttons: buttons
            });
    });
}


function mr_dialog_edit_rent(ttitle, tyes, tno, tcancel){
    $(function() {
    $( "#dialog" ).dialog({autoOpen: false});
    $('#editrent input, #editrent textarea').change(function(){
        hasChange = true;
    });
    $('.controller_menu li a').click(function(){
        if(hasChange){
            var thislink = this.href;
            var buttons = {};
            buttons[ tyes ] = function() {
            $('#newdoc').val(thislink);
                document.editrent.submit();
            };
            buttons[ tno ] = function() {
                window.location.href = thislink;
            };
            buttons[ tcancel ] = function() {
                $(this).dialog("close");
            };

            $( "#dialog" ).dialog({
                title: ttitle,
                minHeight: 0,
                modal: true,
                autoOpen: true,
                resizable: false,
                width: 300,
                open : function(){
                    $(this).parent().children().children('.ui-dialog-titlebar-close').hide();
                },
                draggable: false,
                buttons: buttons
            });
            return false;
        }else{
            return true;
        }
    });
});
}









function popup_droprent(t_yes, t_no, t_title){

    popupbody = document.createElement('div');
    popupbody.style.height='100%';
    popupbody.style.position='fixed';
    popupbody.style.top='0';
    popupbody.style.left='0';
    popupbody.style.width='100%';
    popupbody.style.zIndex='5000';
    document.body.appendChild(popupbody);
    
    clicker = document.createElement('div');
    clicker.style.height='100%';
    clicker.style.position='absolute';
    clicker.style.top='0';
    clicker.style.left='0';
    clicker.style.width='100%'; 
    //clicker.style.background = "url(../images/opacity_white_40.png)";
    clicker.style.backgroundColor = "white";
    clicker.style.opacity='0.5';
   /*    clicker.onclick = function(){
        document.body.removeChild(popupbody);
        return false;
        
    }*/
    popupbody.appendChild(clicker);



       
       
    popupdiv = document.createElement('div');
    popupdiv.className = "popup_edit_msg";

    getcook = get_cookie('lang');
if(getcook == "en"){
    width_for_lang='255px';

}else if(getcook == "ua"){
    width_for_lang='300px';
}else{
    width_for_lang='255px';
}

    popupdiv.style.width=width_for_lang;
    btn_save ='<div class="btn7" onclick="document.droprent.submit()"><div><a href="javascript:void(0)">'+t_yes+'</a></div></div>';

    btn_cancel ='<div class="btn7" id="close_edit_popup" onclick="document.body.removeChild(popupbody);return false;"><div><a href="javascript:void(0)">'+t_no+'</a></div></div>';
       
    popupdiv.innerHTML='<div class="title_box" id="drag"><h3>'+t_title+'?</h3></div><div class="popup_droprent_content">'+btn_save+' '+btn_cancel+'<div class="clr"></div></div>';

    wheight = popupbody.clientHeight ;
    wwidth = popupbody.clientWidth ;

    popupdiv.style.top=(wheight / 2 - 50)+ 'px';
    popupdiv.style.left=(wwidth / 2 - 125)+ 'px';
    popupbody.appendChild(popupdiv);
}