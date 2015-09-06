<?php
//SEO block

$seo_title = Yii::t('SEO', 'news.title');
$seo_description = Yii::t('SEO', 'news.description');
$seo_keywords = Yii::t('SEO','news.keywords');

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
                <table border="0" cellpadding="0" cellspacing="0" width="99%"><tr><td valign="middle"><h3 class="flt_l"><?php echo Yii::t('default', 'News'); ?>:</h3></td></tr></table>


            </div>
        </div>
    </div>
    <div class="content"><div class="tab_content" id="news_page">

<div class="news">
    <div class="stl_7 news_title">Средняя ставка по депозитам снизилась до 18-23% годовых</div><span class="news_date">24 декобря 2013г.</span>
    <div class="clr"></div>
    <div class="news_text"><p>
            
            
            Процентные ставки по депозитам в гривне в среднем находятся на уровне 18-23% годовых.

Об этом рассказал заместитель главы правления коммерческого банка Роман Горбачов в эфире Первого делового канала.

"Если посмотреть аналитику по ставкам, то, на мой взгляд, она не так уж сильно разнится. Безусловно, есть лидеры по высоким ставкам, есть лидеры по низким ставкам. Но в среднем на сегодня процентные ставки в зависимости от сроков колеблятся на уровне 18-23% годовых", - сказал Горбачев.

Рассказывая о том, какими критериями руководствуется население Украины, выбирая, в каком банке открыть депозит, эксперт отметил:

"Если людям удобно обслуживаться в крупном банке, где они понимают, что если не заработают, то не потеряют, что идут туда. Если люди понимают, что готовы приумножить свои деньги, то выбирают средние или мелкие банки. В основном люди выбирают по таким критериям: удобство обслуживания плюс рейтинг плюс репутация плюс доходность".

Напомним, по данным экспертов, с начала 2013 года ставки по депозитам в гривне снизились на 3 процентных пункта.
Джерело: <a href="http://gazeta.ua/ru/articles/business/_srednyaya-stavka-po-depozitam-snizilas-do-18-23-godovyh/483530">Gazeta.ua</a>
        </p></div>
</div>
<div class="news">
    <div class="news_title stl_7">Заголовок</div><span class="news_date">24 декобря 2013г.</span>
    <div class="clr"></div>
    <div class="news_text">ТЕКСТ</div>
</div>
<div class="news">
    <div class="news_title stl_7">Заголовок Заголовок ЗаголовокЗаголовок ЗаголовокЗаголовокЗаголовок Заголовок Заголовок Заголовок Заголовок Заголовок Заголовок Заголовок</div><span class="news_date">24 декобря 2013г.</span>
    <div class="clr"></div>
    <div class="news_text">ТЕКСТ</div>
</div>

        </div></div>
</div>