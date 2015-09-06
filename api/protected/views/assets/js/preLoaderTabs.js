$(function(){
    $('.tabs li').bind({click: function() {
        $("#loading").html('<center><img src="<?php echo $this->assetsUrl; ?>/images/loader.gif" alt="Loading"></center>');
        $('.tabs li').removeClass('active');
        $(this).addClass('active');
        $("#subcontent").load( function(){
            $("#loading").remove();              
        });
    }});
});