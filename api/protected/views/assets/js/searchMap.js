var map = false;
var placemark = false;
var geobounds = false;


    //миникарта
    map = new YMaps.Map(document.getElementById("YMapsID"));
    //большая карта
    fmap = new YMaps.Map(document.getElementById("full_map"));
    
    map.setCenter(new YMaps.GeoPoint(30.739846,46.469517), 10);
    fmap.setCenter(new YMaps.GeoPoint(30.739846,46.469517), 10);
    //map.addControl(new YMaps.TypeControl());
    //map.addControl(new YMaps.ToolBar());
    map.addControl(new YMaps.Zoom({noTips : true}), new YMaps.ControlPosition(YMaps.ControlPosition.TOP_LEFT, new YMaps.Point(10, 10)));
    fmap.addControl(new YMaps.Zoom({noTips : true}), new YMaps.ControlPosition(YMaps.ControlPosition.TOP_LEFT, new YMaps.Point(10, 10)));
  //  map.addControl(new YMaps.MiniMap());
    map.addControl(new YMaps.ScaleLine());
    fmap.addControl(new YMaps.ScaleLine());
    map.enableScrollZoom();
    fmap.enableScrollZoom();
    


function clearAllMarks(){
    map.removeAllOverlays();
    fmap.removeAllOverlays();
}

function refreshMap(marks){
    map.removeAllOverlays();
    fmap.removeAllOverlays();
    for (var mark in marks){
	setMark (mark.geox,mark.geoy,mark.title);
    }
    
}

function setMark(geoX, geoY, title){	// Создает стиль
	var s = new YMaps.Style();
	// Создает стиль значка метки
	s.iconStyle = new YMaps.IconStyle();
	s.iconStyle.href = document.getElementById('flat_indicator').src;
	s.iconStyle.size = new YMaps.Point(15, 22);
	s.iconStyle.offset = new YMaps.Point(-7, -22);
    placemark = new YMaps.Placemark(new YMaps.GeoPoint(geoX ,geoY),{ style: s});
    placemark.setBalloonContent(title);
    //placemark.setIconContent(title);
    map.addOverlay(placemark);
    fmap.addOverlay(placemark);
}

function setCenteredMark(geoX, geoY, title){
    setMark(geoX, geoY, title);
    map.setCenter(new YMaps.GeoPoint(geoX,geoY), 12);
    fmap.setCenter(new YMaps.GeoPoint(geoX,geoY), 12);
}



function setLink(geoX, geoY, title, link, avatar, price, shortname, cur_row){
    // Создание стиля для содержимого балуна
    
              var s = new YMaps.Style();
            s.balloonContentStyle = new YMaps.BalloonContentStyle(
                new YMaps.Template("<div class=\"search_map_hint\"><a target=\"_blank\" href=\""+link+"\"><span style=\"background: url('"+avatar+"') no-repeat center center; width:75px; height:60px;float:left;display:block;margin-right:10px;\"></span></a><div class=\"trans_map\"><a target=\"_blank\" href=\""+link+"\" class=\"link\" style=\"float:left;\">$[description]</a><div class=\"trans_txt\"></div><div class=\"clr\"></div></div><div class=\"price\"><b>"+price+" "+shortname+"</b></div><p>"+cur_row+"</p></div>")
            );
	s.iconStyle = new YMaps.IconStyle();
	s.iconStyle.href = document.getElementById('flat_indicator').src;
	s.iconStyle.size = new YMaps.Point(15, 22);
	s.iconStyle.offset = new YMaps.Point(-7, -22);
        
        
           s.hintContentStyle = new YMaps.HintContentStyle(
                new YMaps.Template("<div class=\"search_map_hint\"><a target=\"_blank\" href=\""+link+"\"><span style=\"background: url('"+avatar+"') no-repeat center center; width:75px; height:60px;float:left;display:block;margin-right:10px;\"></span></a><div><div class=\"trans_map\"><a target=\"_blank\" href=\""+link+"\" class=\"link\">$[description]</a><div class=\"trans_txt\"></div><div class=\"clr\"></div></div><div class=\"price\"><b>"+price+" "+shortname+"</b></div><p>"+cur_row+"</p></div></div>")
            );
  /*          var s = new YMaps.Style();
            s.balloonContentStyle = new YMaps.BalloonContentStyle(
                new YMaps.Template("<a target=\"_blank\" href=\""+link+"\">$[description]</a>")
            );
	s.iconStyle = new YMaps.IconStyle();
	s.iconStyle.href = document.getElementById('flat_indicator').src;
	s.iconStyle.size = new YMaps.Point(15, 22);
	s.iconStyle.offset = new YMaps.Point(-7, -22);
        
        
           s.hintContentStyle = new YMaps.HintContentStyle(
                new YMaps.Template("<div class=\"search_map_hint\"><a target=\"_blank\" href=\""+link+"\"><span style=\"background: url('"+avatar+"') no-repeat center center; width:75px; height:60px;float:left;display:block;margin-right:10px;\"></span></a><div><div class=\"trans_map\"><a target=\"_blank\" href=\""+link+"\" class=\"link\">$[description]</a><div class=\"trans_txt\"></div><div class=\"clr\"></div></div><div class=\"price\"><b>"+price+" "+shortname+"</b></div><p>"+cur_row+"</p></div></div>")
            );
*/
                
            // Создание метки с пользовательским стилем и добавление ее на карту
            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(geoX,geoY), {style: s} );
            placemark.description = title;
   //         var splacemark = new YMaps.Placemark(new YMaps.GeoPoint(geoX,geoY), {hasHint: 1, style: s} );
            var splacemark = new YMaps.Placemark(new YMaps.GeoPoint(geoX,geoY), { style: s} );
            splacemark.description = title;

	    
            map.addOverlay(placemark);
           fmap.addOverlay(splacemark);
    //setMark(geoX, geoY, title);
    
    
}

function setCenteredLink(geoX, geoY, title, link){
    setLink(geoX, geoY, title, link)
    map.setCenter(new YMaps.GeoPoint(geoX,geoY), 12);
    fmap.setCenter(new YMaps.GeoPoint(geoX,geoY), 12);
}

function setCenter(geoX, geoY){
    map.setCenter(new YMaps.GeoPoint(geoX,geoY), 10);
    fmap.setCenter(new YMaps.GeoPoint(geoX,geoY), 10);
}
function setBounds(min_x,min_y,max_x,max_y){
    map.setBounds(new YMaps.GeoBounds(new YMaps.GeoPoint(min_x, min_y), new YMaps.GeoPoint(max_x, max_y)));
   fmap.setBounds(new YMaps.GeoBounds(new YMaps.GeoPoint(min_x, min_y), new YMaps.GeoPoint(max_x, max_y)));
}