    <div class="content">

        <div class="tab_content pdd_10">
            <h2>Общая структура &lt;advertisement&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
              <tr>
                <th>Код</th>
                <th>Описание</th>
              </tr>
              <tr>
                <td width="15%"><b>action *</b></td>
                <td width="85%">Действие с объявлением - <span class="popEdge" title="Добавить">&laquo;add&raquo;</span>, <span class="popEdge" title="Редактировать">&laquo;edit&raquo;</span>, <span class="popEdge" title="Удалить">&laquo;delete&raquo;</span></td>
              </tr>
              <tr>
                <td width="15%"><b>id</b></td>
                <td width="85%">Необходим только для действий &laquo;edit&raquo;, &laquo;delete&raquo; (числовое значение)</td>
              </tr>
              <tr>
                <td width="15%"><b>maininfo</b></td>
                <td width="85%">Основная информация объявления</td>
              </tr>
              <tr>
                <td width="15%"><b>text *</b></td>
                <td width="85%">Заголовок, описание объявления</td>
              </tr>
              <tr>
                <td width="15%"><b>address *</b></td>
                <td width="85%">Расположение объекта на карте (геокоординаты)</td>
              </tr>
              <tr>
                <td width="15%"><b>pricing *</b></td>
                <td width="85%">Цена за аренду либо стоимость продажи объекта объявления</td>
              </tr>
              <tr>
                <td width="15%"><b>amenities</b></td>
                <td width="85%">Удобства. Например: интернет, кабельное телевидение...</td>
              </tr>
              <tr>
                <td width="15%"><b>neighbors</b></td>
                <td width="85%">Находящиеся по близости объекты. Например: супермаркет, школа, ночной клуб...</td>
              </tr>
              <tr>
                <td width="15%"><b>photos</b></td>
                <td width="85%">Фотографии объекта</td>
              </tr>
            </table>
<h2>Описание формата</h2>
<pre class="example_code">
&lt;?xml version="1.0" encoding="UTF-8" standalone="yes"?&gt;
    &lt;advertisements&gt;
            &lt;advertisement&gt;
                    ...Объявление 1...
            &lt;/advertisement&gt;
            &lt;advertisement&gt;
                    ...Объявление 2...
            &lt;/advertisement&gt;
    &lt;/advertisements&gt;
</pre>
          <h2>Основная информация объявления &lt;maininfo&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                
                <tr>
                    <td width="15%"><b>todo</b></td>
                    <td width="85%"><b>Хочу:</b><br>
                  <span class="popEdge" title="Сдать">&laquo;rent&raquo;</span>, <span class="popEdge" title="Продать">&laquo;sell&raquo; (действие: аренда, продажа)</span></td>
                </tr>
                <tr>
                    <td width="15%"><b>type</b></td>
                    <td width="85%"><b>Тип:</b><br>
                  <span class="popEdge" title="Квартира">&laquo;flat&raquo;</span>, <span class="popEdge" title="Дом">&laquo;house&raquo;</span>, <span class="popEdge" title="Офис">&laquo;office&raquo; (тип помещения: квартира, дом, офис)</span></td>
                </tr>
                <tr>
                    <td width="15%"><b>square</b></td>
                    <td width="85%"><b>Площадь<sub>(m2)</sub>:</b><br>
                    площадь помещения (числовое значение)</td>
                </tr>
                <tr>
                    <td width="15%"><b>floor</b></td>
                    <td width="85%"><b>Этаж:</b><br>
                    от 1 до 15 (этажность здания,числовое значение)</td>
                </tr>
                <tr>
                    <td width="15%"><b>rooms</b></td>
                    <td width="85%"><b>Количество комнат:</b><br>                      
                      общее количество комнат (числовое значение)</td>
                </tr>
            </table>
    <br><br>
            <b>Пример</b>
<pre class="example_code">
&lt;maininfo&gt;
    &lt;todo&gt;sell&lt;/todo&gt;
    &lt;type&gt;office&lt;/type&gt;
    &lt;square&gt;152&lt;/square&gt;
    &lt;floor&gt;8&lt;/floor&gt;
    &lt;rooms&gt;3&lt;/rooms&gt;
&lt;/maininfo&gt;
</pre>
<br/><br/>
            <h2>Описание объявления &lt;text&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                
                <tr>
                    <td width="15%"><b>textpath *</b></td>
                    <td width="85%">Блок должен быть заключен в этот тэг</td>
                </tr>
                <tr>
                    <td width="15%"><b>language</b></td>
                    <td width="85%">Язык <span class="popEdge" title="Русский">&laquo;ru&raquo;</span>, <span class="popEdge" title="English">&laquo;en&raquo;</span>, <span class="popEdge" title="Украиский">&laquo;ua&raquo;</span></td>
                </tr>
                <tr>
                    <td width="15%"><b>title *</b></td>
                    <td width="85%">Заголовок оъявления</td>
                </tr>
                <tr>
                    <td width="15%"><b>description</b></td>
                    <td width="85%"><b>Описание:</b></td>
                </tr>
                <tr>
                    <td width="15%"><b>rules</b></td>
                    <td width="85%"><b>Правила:</b></td>
                </tr>
            </table>
          <br><br>
            <b>Пример</b>
<pre class="example_code">
&lt;text&gt;
    &lt;textpath&gt;
        &lt;language&gt;ru&lt;/language&gt;
        &lt;title&gt;Заголовок на русском&lt;/title&gt;
        &lt;description&gt;Описание на русском&lt;/description&gt;
        &lt;rules&gt;Правила на русском&lt;/rules&gt;
    &lt;/textpath&gt;
&lt;/text&gt;
</pre><br>
                        <b>Пример оформление объявления на нескольких языках</b>
                        <pre class="example_code">
&lt;text&gt;
    &lt;textpath&gt;
        &lt;language&gt;ru&lt;/language&gt;
        &lt;title&gt;Заголовок на русском&lt;/title&gt;
        &lt;description&gt;Описание на русском&lt;/description&gt;
        &lt;rules&gt;Правила на русском&lt;/rules&gt;
    &lt;/textpath&gt;
    &lt;textpath&gt;
        &lt;language&gt;en&lt;/language&gt;
        &lt;title&gt;title in english&lt;/title&gt;
        &lt;description&gt;description in english&lt;/description&gt;
        &lt;rules&gt;rules in english&lt;/rules&gt;
    &lt;/textpath&gt;
&lt;/text&gt;
</pre>
<br/><br/>
            <h2>Местоположение &lt;address&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                
                <tr>
                    <td width="15%"><b>textLocation *</b></td>
                    <td width="85%">Полный адрес</td>
                </tr>
                <tr>
                    <td width="15%"><b>geopoint *</b></td>
                    <td width="85%">Строки широты и долготы заключаем в этот тэг</td>
                </tr>
                <tr>
                    <td width="15%"><b>longitude *</b></td>
                    <td width="85%">Долгота</td>
                </tr>
                <tr>
                    <td width="15%"><b>latitude *</b></td>
                    <td width="85%">Широта</td>
                </tr>
            </table>
          <br><br>
            <b>Пример</b>
<pre class="example_code">
&lt;address&gt;
    &lt;textLocation&gt;Украина, Одесская область, Одесса, Киевский район, улица Ильфа и Петрова&lt;/textLocation&gt;
    &lt;geopoint&gt;
        &lt;longitude&gt;30.71587&lt;/longitude&gt;
        &lt;latitude&gt;46.394107&lt;/latitude&gt;
    &lt;/geopoint&gt; 
&lt;/address&gt;
</pre>
<br/><br/>
            <h2>Цена/стоимость &lt;pricing&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                
                <tr>
                    <td width="10%"><b>day</b></td>
                    <td width="90%">Цена за день</td>
                </tr>
                <tr>
                    <td width="10%"><b>week</b></td>
                    <td width="90%">Цена за неделю</td>
                </tr>
                <tr>
                    <td width="10%"><b>month</b></td>
                    <td width="90%">Цена за месяц</td>
                </tr>
                <tr>
                    <td width="10%"><b>currency *</b></td>
                    <td width="90%"><b>Тип валюты:</b><br><span class="popEdge" title="Гривна">&laquo;UAH&raquo;</span>, <span class="popEdge" title="Рубль">&laquo;RUR&raquo;</span>, <span class="popEdge" title="Dollar">&laquo;USD&raquo;</span>, <span class="popEdge" title="Евро">&laquo;EUR&raquo;</span></td>
                </tr>
                <tr>
                    <td width="10%"><b>default *</b></td>
                    <td width="90%"><b>Укажите цену, которая будет выводиться в поиске:</b><br><span class="popEdge" title="День">&laquo;day&raquo;</span>, <span class="popEdge" title="Неделя">&laquo;week&raquo;</span>, <span class="popEdge" title="Месяц">&laquo;month&raquo;</span></td>
                </tr>
                
            </table>
          <br><br>
       <div class="flt_l" style="width:45%;">
                       <b>Пример</b>
<pre class="example_code">
&lt;pricing&gt;
    &lt;day&gt;2145&lt;/day&gt;
    &lt;week&gt;21450&lt;/week&gt;
    &lt;month&gt;214500&lt;/month&gt;
    &lt;currency&gt;UAH&lt;/currency&gt;
    &lt;default&gt;week&lt;/default&gt;
&lt;/pricing&gt;
</pre> 
                       </div>
     
       <div class="flt_r" style="width:45%;">
                       <b>В случае если объявление о продаже блок имеет след. вид</b>
<pre class="example_code">
&lt;pricing&gt;
    &lt;price&gt;2145&lt;/price&gt;
    &lt;currency&gt;UAH&lt;/currency&gt;
&lt;/pricing&gt;
</pre></div>   <div class="clr"></div>
            <br/><br/>
            <h2>Удобства &lt;amenities&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                <tr>
                    <td width="10%"><b>amenities</b></td>
                    <td width="90%">Заключаем блок в этот тег</td>
                </tr>
                <tr>
                    <td width="10%"><b>amenity</b></td>
                    <td width="90%"><b>Удобства:</b><br>
                        <div class="amenities_box">
                
            <?php foreach($amenities as $amenity){
                echo "<div>";
                echo "<span class=\"icon popEdge\" title=\"".Yii::t('default', $amenity->name)."\" style=\"background-image:url(".$this->assetsUrl."/images/amenities/".$amenity->image.")\">код: &laquo;".substr($amenity->name, 8)."&raquo;</span>";
                echo "</div>";
            }?>
            </div>
                    </td>
                </tr>
            </table>
            <br><br>
            <b>Пример</b>
<pre class="example_code">
&lt;amenities&gt;
    &lt;amenity&gt;internet&lt;/amenity&gt;
    &lt;amenity&gt;microwave&lt;/amenity&gt;
    ...
&lt;/amenities&gt;
</pre><br/><br/>
            <h2>Окрестности &lt;neighbors&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                
                <tr>
                    <td width="15%"><b>neighbor</b></td>
                    <td width="85%"><b>Окрестности:</b><br>

                
            <?php foreach($neighbors as $neighbor){

                echo "<div class=\"neiborhood_item\" style=\"width:290px;\">";
                echo "<span class=\"popEdge\" title=\"".Yii::t('default', $neighbor->name)."\">".Yii::t('default', $neighbor->name)." - &laquo;".substr($neighbor->name, 9)."&raquo;</span>";
                echo "</div>";
            }?>

                    </td>
                </tr>
            </table>
          <br><br>
            <b>Пример</b>
<pre class="example_code">
&lt;neighbors&gt;
    &lt;neighbor&gt;mart&lt;/neighbor&gt;
    &lt;neighbor&gt;railway.station&lt;/neighbor&gt;
    &lt;neighbor&gt;cinema&lt;/neighbor&gt;
    ...
&lt;/neighbors&gt;
</pre>
            <br/><br/>
            <h2>Изображения &lt;photos&gt;</h2>
            <table border="0" width="100%" cellpadding="1" cellspacing="1" class="sort">
                <th>Код</th><th>Описание</th>
                
                <tr>
                    <td width="15%"><b>photo</b></td>
                    <td width="85%"><b>Изображения:</b><br>
                    Изображения должны быть доступны по URL адресу</td>
                </tr>
            </table>
          <br><br>
            <b>Пример</b>
<pre class="example_code">
&lt;photos&gt;
    &lt;photo&gt;http://example.com/myphoto_1.jpg&lt;/photo&gt;
    &lt;photo&gt;http://example.com/myphoto_2.jpg&lt;/photo&gt;
    &lt;photo&gt;http://example.com/myphoto_3.jpg&lt;/photo&gt;
    ...
&lt;/photos&gt;
</pre>     
            
   
            
            <br/><br/><br/><br/><br/>
            <h3>Полный пример:</h3>
            <pre>
&lt;?xml version="1.0" encoding="UTF-8" standalone="yes"?&gt;
    &lt;advertisements&gt;
        &lt;advertisement&gt;
        &lt;action&gt;edit&lt;/action&gt; <span class="popEdge" title="add, edit, delete">[i]</span>
        &lt;id&gt;1967107&lt;/id&gt;
        &lt;maininfo&gt;
            &lt;todo&gt;sell&lt;/todo&gt;
            &lt;type&gt;office&lt;/type&gt;
            &lt;square&gt;150&lt;/square&gt;
            &lt;floor&gt;10&lt;/floor&gt;
            &lt;rooms&gt;1&lt;/rooms&gt;
        &lt;/maininfo&gt;
        &lt;pricing&gt;
            &lt;day&gt;2145&lt;/day&gt;
            &lt;week&gt;21450&lt;/week&gt;
            &lt;month&gt;214500&lt;/month&gt;
            &lt;currency&gt;UAH&lt;/currency&gt; <span class="popEdge" title="UAH/RUR/EUR/USD">[i]</span>
            &lt;default&gt;week&lt;/default&gt;
        &lt;/pricing&gt;
        &lt;text&gt;
            &lt;textpath&gt;
                &lt;language&gt;ru&lt;/language&gt;
                &lt;title&gt;Квартира однокомнатная&lt;/title&gt;
                &lt;description&gt;Квартира у моря&lt;/description&gt;
                &lt;rules&gt;курить запрещено&lt;/rules&gt;
            &lt;/textpath&gt;
            &lt;textpath&gt;
                &lt;language&gt;en&lt;/language&gt;
                &lt;title&gt;Оne room flat&lt;/title&gt;
                &lt;description&gt;Flat by the sea&lt;/description&gt;
                &lt;rules&gt;no smoke&lt;/rules&gt;
            &lt;/textpath&gt;
            &lt;textpath&gt;
                &lt;language&gt;ua&lt;/language&gt;
                &lt;title&gt;Квартира однокімнатна&lt;/title&gt;
                &lt;description&gt;Квартира біля моря&lt;/description&gt;
                &lt;rules&gt;палити заборонено&lt;/rules&gt;
            &lt;/textpath&gt;
        &lt;/text&gt;
        &lt;address&gt;
            &lt;textLocation&gt;Украина, Одесская область, Одесса, Ильфа и петрова&lt;/textLocation&gt;
            &lt;geopoint&gt;
                &lt;longitude&gt;30.720065&lt;/longitude&gt;
                &lt;latitude&gt;46.462087&lt;/latitude&gt;
            &lt;/geopoint&gt; 
        &lt;/address&gt;
        &lt;amenities&gt;
            &lt;amenity&gt;internet&lt;/amenity&gt;
            &lt;amenity&gt;microwave&lt;/amenity&gt;
            ...
        &lt;/amenities&gt;
        &lt;neighbors&gt;
            &lt;neighbor&gt;beach&lt;/neighbor&gt;
            &lt;neighbor&gt;shop&lt;/neighbor&gt;
            ...
        &lt;/neighbors&gt;
        &lt;photos&gt;
            &lt;photo&gt;URL address to photo 1&lt;/photo&gt;
            &lt;photo&gt;URL address to photo 2&lt;/photo&gt;
            ...
        &lt;/photos&gt;
    &lt;/advertisement&gt;
&lt;/advertisements&gt;
</pre>

        </div></div>
