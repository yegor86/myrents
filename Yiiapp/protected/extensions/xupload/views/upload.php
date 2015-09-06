<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}

<div id="" class="place_box_pic template-upload fade">{%=i%}
<div class="preview"><span class="fade"></span><div class="fade_place"></div></div>
        {% if (file.error) { %}
            <div class="error"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</div>
        {% } else if (o.files.valid && !i) { %}
    
                <div class="progress progress-success progress-striped active"><div class="bar" style="width:0%;"></div></div>
  

        {% } else { %}

        {% } %}
</div>



{% } %}
</script>
