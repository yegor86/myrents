var map = false;
var placemark = false;
var geobounds = false;

    map = new YMaps.Map(document.getElementById("YMapsID"));
    map.setCenter(new YMaps.GeoPoint(30.739846,46.469517), 10);
    //map.addControl(new YMaps.TypeControl());
    //map.addControl(new YMaps.ToolBar());
    map.addControl(new YMaps.Zoom({noTips : true}), new YMaps.ControlPosition(YMaps.ControlPosition.TOP_LEFT, new YMaps.Point(10, 10)));
  //  map.addControl(new YMaps.MiniMap());
    map.addControl(new YMaps.ScaleLine());
   
    //map.enableScrollZoom();
    


function clearAllMarks(){
    map.removeAllOverlays();
}

function refreshMap(marks){
    map.removeAllOverlays();
    for (var mark in marks){
	setMark (mark.geox,mark.geoy,mark.title);
    }
    
}

function setMark(geoX, geoY, title){
        	var s = new YMaps.Style();
	// Создает стиль значка метки
	s.iconStyle = new YMaps.IconStyle();
	s.iconStyle.href = document.getElementById('flat_indicator').src;
	s.iconStyle.size = new YMaps.Point(15, 22);
	s.iconStyle.offset = new YMaps.Point(-7, -22);
    placemark = new YMaps.Placemark(new YMaps.GeoPoint(geoX ,geoY),{style : s});
    placemark.setBalloonContent(title);
    //placemark.setIconContent(title);
    map.addOverlay(placemark);
}

function setCenteredMark(geoX, geoY, title){
    setMark(geoX, geoY, title);
    map.setCenter(new YMaps.GeoPoint(geoX,geoY), 12);
}
function setLink(geoX, geoY, title, link){
    // Создание стиля для содержимого балуна
            var s = new YMaps.Style();
            s.balloonContentStyle = new YMaps.BalloonContentStyle(
                new YMaps.Template("<a target=\"_blank\" href=\""+link+"\">$[description]</a>")
            );
	s.iconStyle = new YMaps.IconStyle();
	s.iconStyle.href = document.getElementById('flat_indicator').src;
	s.iconStyle.size = new YMaps.Point(17, 17);
            // Создание метки с пользовательским стилем и добавление ее на карту
            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(geoX,geoY), {style: s} );
            placemark.description = title;
            map.addOverlay(placemark);
    //setMark(geoX, geoY, title);
    
    
}

function setCenteredLink(geoX, geoY, title, link){
    setLink(geoX, geoY, title, link)
    map.setCenter(new YMaps.GeoPoint(geoX,geoY), 12);
}