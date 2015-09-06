<!-- The template to display files available for download -->

<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <span class="template-download fade">
        {% if (file.error) { %}
        <div class="place_box_pic">
            {%=file.error %}
<?php  //echo Yii::t('default','error')?>
<span class=" delete btndelete">
<button class="btn popEdge" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" title="<?php echo Yii::t('default','drop bill image')?>" href="javascript:void(0)"><?php echo Yii::t('default','drop bill image')?></button>
</span>

</div>

        {% } else { %}
                {% if (file.cover == 1) { %}
                <div class="popEdge" title="<?php echo Yii::t('default','photo.cover')?>" onclick="cover('{%=file.photo_id%}');return false" style="cursor: pointer;"><div class="place_box_pic cover" id="cover_id_{%=file.photo_id%}">


        <div class="im" style="background: url('{%=file.thumbnail_url%}') no-repeat center center; width:130px; height:105px;"></div>



        </div></div>
		
		        <span class="delete btndelete">
            <span class="loading_cover" style="display:none;top:1px;">Loading</span>
        <button class="btn popEdge" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" title="<?php echo Yii::t('default','drop bill image')?>" href="javascript:void(0)"><?php echo Yii::t('default','drop bill image')?></button>
        </span>
		
                {% } else { %}


                        <div class="popEdge" title="<?php echo Yii::t('default','photo.cover')?>" onclick="cover('{%=file.photo_id%}');return false" style="cursor: pointer;">
                            <div class="place_box_pic" id="cover_id_{%=file.photo_id%}">


        <div class="im" style="background: url('{%=file.thumbnail_url%}') no-repeat center center; width:130px; height:105px;"></div>



        </div>

                        </div>

				        <div class="delete btndelete">
            <span class="loading_cover" style="display:none;top:1px;">Loading</span>
        <button class="btn popEdge" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" title="<?php echo Yii::t('default','drop bill image')?>" href="javascript:void(0)"><?php echo Yii::t('default','drop bill image')?></button>
        </div>

		
                {% } %}
        
          {% } %}
            </span>
{% } %}


</script>
