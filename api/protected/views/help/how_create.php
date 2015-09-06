<?php
//SEO block

$seo_title = Yii::t('SEO', 'how_create.title');
$seo_description = Yii::t('SEO', 'how_create.description');
$seo_keywords = Yii::t('SEO','how_create.keywords');

$this->pageTitle = $seo_title;
Yii::app()->clientScript->registerMetaTag($seo_description, 'description');
Yii::app()->clientScript->registerMetaTag($seo_keywords, 'keywords');

// end SEO Block
?>

<div class="main one">
    <div class="mainhead">
        <div>
            <div>
                <div></div>
                <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default', 'Help'); ?>: Как создать объявление?</h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content"><div class="help_box">
                <b class="stl_2">Разместить объявления на сайте <span style="color:#ea9b15">MyRents</span> можно в течение нескольких минут.</b>
<br/><br/>
                <b class="stl_2">Расскажите о себе</b>
<p>Для начала Вам необходимо <a href="/register/">зарегистрироваться</a> на сайте. Напишите несколько слов о себе, загрузите аватар, внесите контактные данные для обратной связи.</p><br/><br/><br/><br/>

                <b class="stl_2">Создайте объявление</b>
<p>Для того,чтобы сдать жилье,  нажмите кнопку “Сдать/Продать” в правом верхнем углу экрана.<br/><br/>В открывшемся окне укажите критерии, по которым Вы будете <b>сдавать/продавать</b>
Вашу <b>квартиру/дом/офис.</b></p>
                <center><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/help_pic_1.jpg" alt="" /></div></center>
                
                <br/>             
<p>Далее Вы увидите 3 поля. Обязательным для заполнения является поле “Название” , так как оно будет выводиться в поиске. Остальные пункты не обязательны, но при заполнении дадут клиенту более детальную информацию о Вашем объявлении.</p>
                <center><a name="desc"></a><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/help_pic_2.jpg" alt="" /></div></center>
                <p>Заполнив эти поля, нажмите кнопку “Создать” внизу страницы.</p><br/><br/><br/>
                
                
                    <b class="stl_2">Размещение обьявления</b>
<p>После создания обьявления у Вас появится несколько закладок, с помощью которых Вы сможете более детально описать Ваше жилье, его удобства, месторасположение и загрузить фотографии.</p>
 <center><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/help_pic_3.jpg" alt="" /></div></center>
 
 
 
 <div class="warning"><div class="warn"></div>Для того,  чтобы Ваше обьявление было размещено в поиске, Вам необходимо заполнить 2 пункта:</div>
 
                     <b class="stl_3">1. “Местоположение” квартиры/дома/офиса</b><a name="place"></a>
<p>Введите адрес квартиры и нажмите на кнопку со стрелочкой в конце строки. На карте появится флажок. <br/><br/>
Или кликните по карте в том месте, где находится Ваша квартира/дом/офис, сайт автоматически определит адрес. 
    <br/><br/>
Если по каким либо причинам Вам не удается указать месторасположение, свяжитесь с нами и мы обязательно поможем  решить проблему.
</p>
 <center><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/help_pic_4.jpg" alt="" /></div></center>
 
 
                      <b class="stl_3">2. “Цена”</b><a name="price"></a><br/><br/>
<p>Выберите один или несколько вариантов (день/ночь/месяц), по которым Вы будете сдавать квартиру/дом/офис, а также укажите цену (в гривнах). 
<br/><br/>
 В блоке ниже выберите вариант цены, который по умолчанию будет отображаться в поиске.</p>
 <center><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/help_pic_5.jpg" alt="" /></div></center>
 <br/><br/><b class="stl_2">После заполнения разделов  <a href="#desc">“Описание”</a> <a href="#price">“Цена”</a> и <a href="#place">“Местоположение”</a> уже через несколько минут Вы сможете найти свое объявление в  <a href="/search/">поиске</a></b>
  <br/><br/> <br/><br/>
 <center>
 <div class="no_component" style="width:490px;">Если у Вас возникли вопросы <a class="fancybox fancybox.ajax row" href="<?php echo Yii::app()->request->baseUrl; ?>/support">напишите нам</a> и мы постараемся Вам помочь.
С уважением администрация.</div></center> <br/><br/>
 
            </div>

        </div></div>
</div>