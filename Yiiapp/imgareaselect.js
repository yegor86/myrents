function imgCrop(img, selection)
{
	// загрузка...
	$('#result')
		.html('<img src="./ajax-loader.gif" alt="ajax" />')
		.css({display: "block"});
	
	// отправляем данные
	$.post(
		'./backend/index.php',
		{
			w: selection.width,
			h: selection.height,
			x: selection.x1,
			y: selection.y1,
			i: $('#photo > img').attr('src')
		},
		function(txt){
			$('#result').html(txt);
		},
		'text'
	);
}






// инициализируем плагин imgAreaSelect
$(window).load(function () {

function preview(img, selection) {
    if (!selection.width || !selection.height)
        return;
    
    var scaleX = 100 / selection.width;
    var scaleY = 100 / selection.height;

    $('#preview img').css({
        width: Math.round(scaleX * 402),
        height: Math.round(scaleY * 599),
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
x1: 50, y1:50,
x2: 330, y2: 200,
		aspectRatio: '2:1',
		handles: true,
		fadeSpeed: 100,
		onSelectChange: preview,
		movable: true,
		resizable: true, 

	});

});