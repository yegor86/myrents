<!doctype html public "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель управления MyRents</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'></link>
<script type="text/javascript" src="/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php" language="javascript"></script>
<script type="text/javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        skin : "o2k7",
        file_browser_callback : "tinyBrowser",
        skin_variant : "silver",
        plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
                                        
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,formatselect,|,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell",
        theme_advanced_buttons2 : "hr,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,media,cleanup,code,|,forecolor,backcolor,|,visualchars,|,ltr,rtl,|,fullscreen,|,search,replace,|,styleprops",
        theme_advanced_buttons3 : "cite,abbr,acronym,|,moveforward,movebackward,absolute,|,tablecontrols,|,save",
 
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
                                        
        language: "ru",
        width : "710",

                                        
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
                                        
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });
    
    $(function(){
       $('#tabs').tabs();
       //$(".sort tr:odd").addClass("odd");
    });
    
    function deleteForm(id, link, text){
    if(confirm('Удалить "'+text+'"?')){
        $('#loading_box').css({'display':'block'});
        $('#loading_box #loading_box_text').html('Loading...');
        $.ajax({
            url: link,
            success: function(data) {
                $('tr#'+id).remove();
                $('#loading_box').css({'display':'none'});
            }
        });
    }else{
        return false;
    }
}

$(function () {
    $('div#globalcontainer').append("<div id='top'></div>");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });
    $('#top').click(function () {
        $('body,html').animate({scrollTop: 0}, 1000);
        return false;
    });
});

</script>
</head>

<body id="warp">
    <div id="globalcontainer">
<script type="text/javascript" src="<?php echo $this->assetsUrl ?>/js/admin_tool_box.js"></script>
    <div id="loading"><div><b>Loading...</b></div></div>
    

    
    
    <div id="header">
    <?php
    $cId = Yii::app()->controller->id;
    $caId = Yii::app()->controller->action->id;
    ?>
        <div class="hello">Привет, <?php echo CHtml::link($this->user->firstname, '/user/'.$this->user->id, array('traget'=>'_blank'));?></div>
        <ul class="navi">
        <li class="navitem <?php if($cId == 'adminPage') echo 'active'?>"><?php echo CHtml::link('Главная', '/admin/', array('class'=>'navilink'));?></li>
        <li class="navitem <?php if($cId == 'adminUsers') echo 'active'?>"><?php echo CHtml::link('Пользователи', 'javascript:void(0)', array('class'=>'navilink'));?>
            <ul class="submenu">
                <li><?php echo CHtml::link('Список пользователей', '/admin/user/');?></li>
                <li><?php echo CHtml::link('Уведомление пользователю', '/admin/user/notify');?></li>
                <li><?php echo CHtml::link('Список почты', '/admin/user/emailList');?></li>
            </ul>
        </li>
        <li class="navitem <?php if($cId == 'adminRents') echo 'active'?>"><?php echo CHtml::link('Объявления', 'javascript:void(0)', array('class'=>'navilink'));?>
            <ul class="submenu">
                <li><?php echo CHtml::link('Список объявлений', '/admin/rents/');?></li>
                <li><?php echo CHtml::link('Список объявлений на главной', '/admin/rents/showmain');?></li>
            </ul>
        </li>
        <li class="navitem <?php if($cId == 'adminFilters') echo 'active'?>"><?php echo CHtml::link('Фильтра', 'javascript:void(0)', array('class'=>'navilink'));?>
             <ul class="submenu">
                <li><?php echo CHtml::link('Удобства', '/admin/filters/amenities');?></li>
                <li><?php echo CHtml::link('Окрестности', '/admin/filters/neiborhood');?></li>
            </ul>
        </li>
        <li class="navitem <?php if($cId == 'adminHelp' || $cId == 'adminPartners' || $cId == 'adminStaticPage') echo 'active'?>"><?php echo CHtml::link('Страницы', 'javascript:void(0)', array('class'=>'navilink'));?>
             <ul class="submenu">
                <li><?php echo CHtml::link('Статичные', '/admin/staticpage/');?></li>
                <li><?php echo CHtml::link('Помощь', '/admin/help/');?></li>
                <li><?php echo CHtml::link('Партнеры', '/admin/partners/');?></li>
            </ul>
        </li>
        <li class="navitem <?php if($cId == 'adminSeoPage') echo 'active'?>"><?php echo CHtml::link('SEO поиска', '/admin/seopage', array('class'=>'navilink'));?></li>
        <li class="navitem <?php if($cId == 'adminComments') echo 'active'?>"><?php echo CHtml::link('Комментарии', '/admin/comments', array('class'=>'navilink'));?></li>
        <li class="navitem <?php if($caId == 'adminClear' || $cId == 'adminMailer') echo 'active'?>"><?php echo CHtml::link('Дополнение', 'javascript:void(0)', array('class'=>'navilink'));?>
             <ul class="submenu">
                <li><?php echo CHtml::link('Удаление Assets', '/admin/clear/');?></li>
                <li><?php echo CHtml::link('Рассылка', '/admin/mailer/');?></li>
            </ul>
        </li>
        </ul>
        
    </div>
    
        <?php if(Yii::app()->user->hasFlash('error')):?>
<div class="flash-alert-error">
<?php echo Yii::app()->user->getFlash('error')?>
</div>
<?php endif?>

<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="flash-alert-success">
<?php echo Yii::app()->user->getFlash('success')?>
</div>
<?php endif?>
    
    
    <div id="container"><?php echo $content; ?></div>
    </div>
</body>
</html>