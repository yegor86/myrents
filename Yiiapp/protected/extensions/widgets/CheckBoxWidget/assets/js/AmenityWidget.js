jQuery(function($){
    $.imageTick.logging = true;
       
    $(".amenity").imageTick({
	image_tick_class: "checknum",
	custom_button: function($label){
	    $label.hide();//'+$label.attr('for')+'
	    return '<span class="icon " style="background-image:url('+$label.attr('imgname')+')">' + $label.text() + '</span>';
	}
    });
});
