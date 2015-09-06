
function init_uplink(){

$(".uplink").click(function(){
        var doc_width = $(window).width();
        var doc_height = $(window).height();
        var load_h = (doc_height / 2 - 11)+ 'px';
        var load_w = (doc_width / 2 - 100)+ 'px';
        $('#load_ups').css({'display':'block','top':load_h,'left':load_w});
	var a = $(this);
	var xhr = $.ajax({
	    url:a.attr('href'),
	    success:function(resultdata) {
                $('#upsContainer').css({'display':'block'});
		$('#upsDiv').html(resultdata);
                var height = $('#upsDiv').height();
                var width = $('#upsDiv').width();
                $('#upsDiv').css({'top':(doc_height / 2 - height / 2)+ 'px','left':(doc_width / 2 - width / 2)+ 'px'});
                $('#load_ups').css({'display':'none'});
	    }
	});

        xhr.fail(function(jqXHR, textStatus) {
            $('#upsContainer, #load_ups').css({'display':'none'});     
           // alert( "Request failed: " + textStatus );
        });
        
	return false;



    });
    $("#upsCloseLayer, #closeUps").click(function(){
		$('#upsContainer, #load_ups').css({
		    'display':'none'
		});
	return false;
    });

}