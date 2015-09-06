<?php
//SEO block

$seo_title = Yii::t('SEO', 'how_search.title');
$seo_description = Yii::t('SEO', 'how_search.description');
$seo_keywords = Yii::t('SEO','how_search.keywords');

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
                <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default', 'Help'); ?>: Как найти объявление?</h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content"><div class="help_box">
                <b class="stl_2">Поиск объявлений.</b>


<p>На главной странице, в левой части выберите интересующий Вас критерий поиска и введите название улицы<br/>
или города.</p>


                <center><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/now_search/1.jpg" alt="" /></div></center>
                          <b class="stl_2">Дополнительные фильтры.</b>      
                <br/>             
<p>В результате отобразится список объявлений по введенному адресу либо все объявления одного из выбраных Вами 
разделов <b>Снять/Купить</b> (в случае если адрес не заполнен).<br/><br/>С помощью фильтров попробуем <a href="/search">найти</a> подходящее объявление.</p>


<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="49%"><center><img class="image" src="<?php echo $this->getAssetsUrl(); ?>/images/help/now_search/2.jpg" alt="" /><br/><br/><img class="image" src="<?php echo $this->getAssetsUrl(); ?>/images/help/now_search/3.jpg" alt="" /></center></td>
        <td width="51%" valign="top">
         <div style="margin-top: 60px">- Например Вас интересует<br/>&nbsp;&nbsp;аренда квартиры.</div>

        <div style="margin-top: 55px">- Интересует посуточная аренда.</div>

        <div style="margin-top: 45px">- Указываем диапазон стоимости.</div>

        <div style="margin-top: 160px">- Выбираем количество комнат и этаж.</div>
        
         
         <div style="margin-top: 110px">- Приблизительно выставляем площадь.</div>
         
          <div style="margin-top: 100px">- Отметим интересующие нас удобсва в квартире.</div>
          
           <div style="margin-top: 130px">- Выберем интересующие заведения и места,<br/>&nbsp;&nbsp;что находятся недалеко от квартиры.</div>
                     
           <div style="margin-top: 340px">- Отметив пункт <b>только с фото</b> в<br/>&nbsp;&nbsp;результате поиска будут выводиться<br/>&nbsp;&nbsp;только те объявления у которых загружены изображения.</div>
        </td>
    </tr>
</table>


                
                    <b class="stl_2">Результаты поиска.</b>
<p>После настройки фильтров отобразится список объявлений, которые соответствуют <br/>
Вашим требованиям.</p>

  <center><div class="image"><img src="<?php echo $this->getAssetsUrl(); ?>/images/help/now_search/4.jpg" alt="" /></div></center>
            </div>

        </div></div>
</div>