

            
                  <link rel="stylesheet" type="text/css" href="/css/imgareaselect-animated.css" />
        <script type="text/javascript" src="/jquery.imgareaselect.js"></script>
<script>
    $(function(){
        $('#result_crop').scroll(function () { 
            var ias = $('#photo').imgAreaSelect({ instance: true });
            ias.update();
        });
    });
function preview(img, selection) {
    if (!selection.width || !selection.height)
        return;
    
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;

    $('#preview img').css({
        width: Math.round(scaleX * 580),
        height: Math.round(scaleY * 550),
        marginLeft: -Math.round(scaleX * selection.x1),
        marginTop: -Math.round(scaleY * selection.y1)
    });

    $('#x1').val(selection.x1);
    $('#y1').val(selection.y1);
    $('#x2').val(selection.x2);
    $('#y2').val(selection.y2);
    $('#w').val(selection.width);
    $('#h').val(selection.height);    
}

    $('#photo').imgAreaSelect({

                zIndex: 5555,
                minHeight: 130,
                minWidth: 100,
		aspectRatio: '1.5:1',
		handles: true,
		fadeSpeed: 100,
		onSelectChange: preview,
		movable: true,
		resizable: true

	});
        

        
$('#ajax_query').click(function(){
    
var ias = $('#photo').imgAreaSelect({ instance: true });


ias.cancelSelection();
ias.setOptions({ show: false });
ias.update();






             
             
    var str = $('#cropimg').serialize();
    $.ajax({
	url:'/crop.php',
	type: "POST",
        cache:false,
	data:str,
	success:function(data){

            $('.avatar').html(data);
            $.fancybox.close();

	}
    });
});
</script>
<style>
    /*
 * imgAreaSelect animated border style
 */

.imgareaselect-border1 {
	background: url(/css/border-anim-v.gif) repeat-y left top;
}

.imgareaselect-border2 {
    background: url(/css/border-anim-h.gif) repeat-x left top;
}

.imgareaselect-border3 {
    background: url(/css/border-anim-v.gif) repeat-y right top;
}

.imgareaselect-border4 {
    background: url(/css/border-anim-h.gif) repeat-x left bottom;
}

.imgareaselect-border1, .imgareaselect-border2,
.imgareaselect-border3, .imgareaselect-border4 {
    filter: alpha(opacity=50);
	opacity: 0.5;
}

.imgareaselect-handle {
    background-color: #fff;
	border: solid 1px #000;
    filter: alpha(opacity=50);
	opacity: 0.5;
}

.imgareaselect-outer {
	background-color: #000;
    filter: alpha(opacity=50);
	opacity: 0.5;
}

.imgareaselect-selection {

}
.frame{
    z-index: 5525;
}
</style>        <div id="crop_box_popup">
            <div id="result_crop" style="width:900px; overflow-y:scroll; height:100%;z-index:5500;">




                <div class="frame">
                    <img id="photo" src="/crop_img.jpg" alt="" />
                </div>


            <div>

                <a href="javascript:void(0)" id="ajax_query">Save image</a>

                <form action="/crop.php" method="post" id="cropimg">
                    <p><input type="hidden" name="image" value="crop_img.jpg" /></p>
                    <p><input type="hidden" name="x1" id="x1" value="-" /></p>
                    <p><input type="hidden" name="w" id="w" value="-" /></p>
                    <p><input type="hidden" name="y1" id="y1" value="-" /></p>
                    <p><input type="hidden" name="h" id="h" value="-" /></p>
                    <p><input type="hidden" name="x2" id="x2" value="-" /></p>
                    <p><input type="hidden" name="y2" id="y2" value="-" /></p>

                </form>

            </div>

  </div>  </div>


