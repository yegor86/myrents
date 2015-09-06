document.onkeydown = keydownfunc;
document.onkeyup = keyupfunc;
shiftpressed = false;

function keydownfunc(event){
	var event = event || window.event;
	evt = (event.keyCode) ? event.keyCode : event.which;
        if (evt == 16) shiftpressed = true;
	if ((evt == 13)&&(!shiftpressed)) document.add_comment.submit();
}
function keyupfunc(event){
	var event = event || window.event;
	evt = (event.keyCode) ? event.keyCode : event.which;
        if (evt == 16) shiftpressed = false;
}


