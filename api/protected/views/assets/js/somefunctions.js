
jQuery(function($){
    $("#tabs").tabs({
        show: function(event, ui) {
	    if(typeof api !== "undefined" && map)
            api.redraw();
        }
    });
    $("#tabs2").tabs();
});
jQuery(function($){
    $('.scroll-pane').jScrollPane({
        showArrows: true
    });  
});
function init_scrollpane(){
jQuery(function($){
    $('.scroll-pane').jScrollPane({
        showArrows: true
    });  
});
}

function init_tiptip(){
jQuery(function($){
    $(".pop").tipTip({
        maxWidth:"150px", 
        edgeOffset:1
    });
    $(".popEdge").tipTip({
        maxWidth:"150px", 
        edgeOffset:8
    });
});
}

init_tiptip();
