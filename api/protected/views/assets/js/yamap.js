var map = false;
var placemark = false;
var geobounds = false;
window.onload = function () {
    map = new YMaps.Map(document.getElementById("YMapsID"));
    var pointval = document.editrent.elements['AdressForm[geopoint]'].value.split(',');
    map.setCenter(new YMaps.GeoPoint(pointval[0],pointval[1]), 10);
    map.addControl(new YMaps.TypeControl());
    map.addControl(new YMaps.ToolBar());
    map.addControl(new YMaps.Zoom());
    //  map.addControl(new YMaps.MiniMap());
    map.addControl(new YMaps.ScaleLine());

    // Создает стиль
    var s = new YMaps.Style();
    // Создает стиль значка метки
    s.iconStyle = new YMaps.IconStyle();
    s.iconStyle.href = document.getElementById('flat_indicator').src;
    s.iconStyle.size = new YMaps.Point(15, 22);
    s.iconStyle.offset = new YMaps.Point(-7, -22);
    placemark = new YMaps.Placemark(map.getCenter(),{
	draggable: true, 
	style: s
    });
    map.addOverlay(placemark);
    map.enableScrollZoom();
    
    //клик по карте    
    YMaps.Events.observe(map,map.Events.Click, function (map, mEvent) {
	placemark.setGeoPoint(mEvent.getGeoPoint());
	document.editrent.elements['AdressForm[geopoint]'].value = mEvent.getGeoPoint();
	geopointToAddr();
    
    });

    //перетаскивание 
    YMaps.Events.observe(placemark, placemark.Events.DragEnd, function (obj) {
	document.editrent.elements['AdressForm[geopoint]'].value= obj.getGeoPoint();
	geopointToAddr();
    });

   
}


function geopointToAddr(){
    inputs = document.editrent.elements;
    document.editrent.elements['hasgeo'].value = 1;
    addr = document.editrent.elements['AdressForm[geopoint]'].value;
    var geocoder = new YMaps.Geocoder(addr,{
	result : 1, 
	boundedBy: geobounds
    });
    YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
	if (this.length()) {
	    map.panTo(placemark.getGeoPoint());
	    addr = this.get(0).AddressDetails;
	    if (addr.Country.CountryName!=undefined) {
		replacer = inputs['AdressForm[adress_prefix]'].value;
		newvalue = addr.Country.CountryName+', '+ addr.Country.AddressLine;
		inputs['AdressForm[adress_name]'].value = newvalue.replace(replacer, '');
	    } else ;// alert('не тыкай в море, там живет Ктулху');
	}else {
	    alert("не найдено")
	}
	hasChange = true;
    });

    YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
	alert("Произошла ошибка: " + error.message)
    });
}



function addrToGeopoint(){
    inputs = document.editrent.elements;
    var addr = '';
    addr= inputs['AdressForm[adress_name]'].value;
    var geocoder = new YMaps.Geocoder(addr,{
	result : 1, 
	boundedBy: geobounds
    });
    YMaps.Events.observe(geocoder, geocoder.Events.Load, function () {
	if (this.length()) {
	    geopoint = this.get(0).getGeoPoint();
	    addr = this.get(0).AddressDetails;
	    placemark.setGeoPoint(geopoint);
	    map.panTo(geopoint);
	    inputs['AdressForm[geopoint]'].value = geopoint;
	        document.editrent.elements['hasgeo'].value = 1;
	    inputs['AdressForm[adress_name]'].value =  (addr.Country.CountryName+', '+ addr.Country.AddressLine).replace(inputs['AdressForm[adress_prefix]'].value,'');
	}else {
	    alert("не найдено")
	}
    });

    YMaps.Events.observe(geocoder, geocoder.Events.Fault, function (geocoder, error) {
	alert("Произошла ошибка: " + error.message)
    });
   
}


			
//нажатие кнопки
document.onkeydown = key;
//document.onkeyup = key;
			
function key(evt)
{ 
    evt = (evt) ? evt : ((window.event) ? window.event : null);
    if(evt) {
	evcode = (evt.keyCode) ? evt.keyCode : evt.which;
	//если нажали ентер
	if (evcode === 13) {
	    addrToGeopoint();
	    // Отменяем действие браузера
	    return false;
	}
    }
}