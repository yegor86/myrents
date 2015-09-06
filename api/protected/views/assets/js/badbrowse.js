

function badbrowser(assets){

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
    //clicker.style.backgroundColor = "white";
    clicker.style.backgroundImage = 'url(\'+assets+\'/images/opacity_white_40.png)';
   // clicker.style.opacity='0.5';

    popupbody.appendChild(clicker);

    popupdiv = document.createElement('div');
    popupdiv.className = "popup_edit_msg";

    popupdiv.style.width='500px';
    popupdiv.innerHTML='<div class="title_box" id="drag"><h3>Bad browser</h3><div class="close" onclick="document.body.removeChild(popupbody);return false;"></div></div><div class="popup_droprent_content" style="padding: 20px 20px;">Your browser "'+$.browser.version+'" is outdated upgrade to the latest version<div class="clr"></div></div>';
    wheight = popupbody.clientHeight ;
    wwidth = popupbody.clientWidth ;
    popupdiv.style.top=(wheight / 2 - 50)+ 'px';
    popupdiv.style.left=(wwidth / 2 - 225)+ 'px';
    popupbody.appendChild(popupdiv);
    
    
}


