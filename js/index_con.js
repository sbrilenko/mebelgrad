var Map = function(){
	var $this = this;
	var map;
	var eqLocation;
	var eqMarker;
	var homeMarker;
	var eqInfo;
	var travellingMode = google.maps.TravelMode.DRIVING;
	var geocoder = new google.maps.Geocoder();
	var info;
	var lang;
	var googleErrors = [];	
	var directionsRenderOptions = {
		suppressMarkers: true
	};
	var directionsDisplay = new google.maps.DirectionsRenderer(directionsRenderOptions);
	var directionsService = new google.maps.DirectionsService();
	this.route = function(){
		var request = {
		    origin: $('.groute input:first').val(),
		    destination: eqLocation,
		    travelMode: travellingMode
		};
		
		directionsService.route(request, function(response, status) {
			var address = $('input:first').val();
			switch (status){
				case google.maps.DirectionsStatus.OK: 
					directionsDisplay.setDirections(response);
					var address = $('.groute input:first').val();
					geocoder.geocode({'address' : address},function(results,status){
						addHomeMarker(results[0].geometry.location,address);
					});
					break;
				
			}
		});
	}
	
	
	this.changeTravellingMode = function(){
		$(this).siblings().removeClass('selected').end().addClass('selected');
		if ($('.travelling-mode').index($(this)) == 0){
			travellingMode = google.maps.TravelMode.DRIVING;
		} else {
			travellingMode = google.maps.TravelMode.WALKING;
		}
		if ($.trim($('.groute input:first').val()) != '') $this.route();
	}
	function addHomeMarker(position, content){
		if (typeof(info) != 'undefined'){
			info.close();
		}
		info = new google.maps.InfoWindow();
		info.setContent(content);
		info.setPosition(position);
		
		if (typeof (homeMarker) != 'undefined'){
			homeMarker.setPosition(position);
		} else {
			homeMarker = new google.maps.Marker({
				position: position,
				map: map,
				icon: 'img/point_a.png'
			});
			google.maps.event.addListener(homeMarker,'click',function(){
				info.open(map);
			});
		}
	}
	(function init(){
		googleErrors[0] = "Адрес не найден. Пожалуйста, проверьте правильность введенного адреса!";
		googleErrors[1] = "Адрес не найден. Пожалуйста, проверьте правильность введенного адреса.";	
	
		eqLocation = new google.maps.LatLng(48.01919593666517,37.84459916864773);
		var mapOptions = {
			zoom: 15,
			center: eqLocation,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: true
		}
		map = new google.maps.Map(document.getElementById('map'),mapOptions);
		var homeControlDiv = document.createElement('DIV');
		  homeControlDiv.style.padding = '5px';
		  var controlUI = document.createElement('DIV');
		  homeControlDiv.appendChild(controlUI);
		 var controlText = document.createElement('DIV');
		  controlText.innerHTML = "<div class='groute'><div class='element a'><input type='text' value='Донецк, пл. Ленина'/></div>		<div class='element b'>			<input type='text' readonly='readonly' value='ул. Сигова, 1 б, Донецк' />		</div>		<div class='travelling-mode driving selected'></div>		<div class='travelling-mode walking'></div>		<button id='marshrut_button' class='marshrut_button'>Проложить маршрут</button>	</div>";
		  
		  controlUI.appendChild(controlText);
		  var homeControlDiv2 = document.createElement('DIV');
		  var controlUI2 = document.createElement('DIV');

		  homeControlDiv2.appendChild(controlUI2);
		 var controlText2 = document.createElement('DIV');
		  controlText2.className = "gmap_shadow";
		  controlText2.innerHTML ="<div id='gmap-sh-top' style='margin-left:-2000px'><div  class='gmap_sh gm_op1'></div><div class='gmap_sh gm_op2'></div><div class='gmap_sh gm_op3'></div><div class='gmap_sh gm_op4'></div><div class='gmap_sh gm_op5'></div></div>";
		  controlUI2.appendChild(controlText2);
		  
		  ///
		   var homeControlDiv3 = document.createElement('DIV');
		   var controlUI3 = document.createElement('DIV');
		  homeControlDiv3.appendChild(controlUI3);
		 var controlText3 = document.createElement('DIV');
		  controlText3.innerHTML ="<div class='gmap-sh-bottom' style='margin-left:-2000px'><div  class='gmap_sh gm_op1 gm_b_mm1'></div> <div class ='gmap_sh gm_op2 gm_b_mm2'></div> <div class ='gmap_sh gm_op3 gm_b_mm3'></div> <div class ='gmap_sh gm_op4 gm_b_mm4'></div> <div class ='gmap_sh gm_op5 gm_b_mm5'></div>";
		  controlUI3.appendChild(controlText3);
		  ////
		 
		  map.controls[google.maps.ControlPosition.RIGHT].push(homeControlDiv);
		  map.controls[google.maps.ControlPosition.TOP].push(controlUI2);
		  	  map.controls[google.maps.ControlPosition.BOTTOM].push(homeControlDiv3);
		directionsDisplay.setMap(map);
		eqMarker = new google.maps.Marker({
					position: eqLocation,
					map: map,
					icon: 'img/bullon.png',
					title: 'Мебельград'
				});
		eqInfo = new google.maps.InfoWindow({
			content:"<div><img style='float:left;width:176px;height:141px;' src='../img/vid.png'/><div style='width:165px;float:left;'><img style='width:87px;margin-left:47px;' src='../img/logo.png'/><div style='margin-left:15px;font-family:Arial;font-size:12px;color:#000;margin-top: 10px;'>г. Донецк, ул. Сигова 1б<br />(рядом с ТСД \"ОЛДИ\")<br /><i style='color:#999999;'>+38&nbsp;(062)&nbsp;387-19-82<br />+38&nbsp;(050)&nbsp;692-94-09</i> </div> </div></div>"
		});
		 
		  //////
		   google.maps.event.addListener(eqMarker,'click',function(){
			var size=$(window).width();
			if (size<='1100') {map.setCenter(new google.maps.LatLng(48.01014499637134,37.17533505310025)); }
		    if ((size>'1100')&&(size<='1285')) {map.setCenter(new google.maps.LatLng(48.01868103306445,37.84911064421078));}
		    
			eqInfo.open(map,eqMarker)
		});
		
	})();
}

var enter = function(e){
	if (e.keyCode == 13){
		$('.marshrut_button').trigger('click');
	}
}

$(function(){
	var map = new Map();
	
	$('.groute input:first').focus();
	$('.marshrut_button').live('click',map.route);
	$('.travelling-mode').live('click',map.changeTravellingMode);
	$('input').live('keyup', enter);
});

function bindReady(handler){
	var called = false
	function ready() { // (1)
		if (called) return
		called = true
		handler()
	}
	if ( document.addEventListener ) { // (2)
		document.addEventListener( "DOMContentLoaded", function(){
			ready()
		}, false )
	} else if ( document.attachEvent ) {  // (3)
		// (3.1)
		if ( document.documentElement.doScroll && window == window.top ) {
			function tryScroll(){
				if (called) return
				if (!document.body) return
				try {
					document.documentElement.doScroll("left")
					ready()
				} catch(e) {
					setTimeout(tryScroll, 0)
				}
			}
			tryScroll()
		}
		// (3.2)
		document.attachEvent("onreadystatechange", function(){

			if ( document.readyState === "complete" ) {
				ready()
			}
		})
	}
	// (4)
    if (window.addEventListener)
        window.addEventListener('load', ready, false)
    else if (window.attachEvent)
        window.attachEvent('onload', ready)
    /*  else  // (4.1)
        window.onload=ready
	*/
}
 
		//$('head link:last').attr({	href: 'css/styles_'+css+'.css'});
///////////////////////

bindReady(function() {
	
	var size=$(window).width();
var height=$(window).height();
var  css,plus=0,style;
 if (size<='1100') { plus=41;style=1000;}
		if ((size>'1100')&&(size<='1285')) {plus=38;style=1240;}
		if ((size>'1285')&&(size<='1371')) {plus=40;style=1320;}
		if (size>'1371') {plus=39;style=1400;}
		document.getElementById('fsize').setAttribute('href', 'css/styles_'+style+'.css');
		css=height-(parseInt($('.header').css('height'))+parseInt($('.footer').css('height'))+plus);
		$('#map').css('height',css+'px')

    $('img').each(function() {
    	var splitin=this.getAattribute('src').split('/');
    	var size=window.innerWidth;
    	var css;
    	
	    if (size<='1100') { css='1000';}
		if ((size>'1100')&&(size<='1300')) {css='1240';}
		if ((size>'1300')&&(size<='1400')) {css='1320';}
    	this.setAttribute('src','img/'+css+'/'+splitin[2]);
    });
///////////////////////
var doit;
window.onresize = function() {

	clearTimeout(doit);
  	doit = setTimeout(function(){
	var size=$(window).width();
var height=$(window).height();
var  css,plus=0,style;
  	if (size<='1085') {  plus=48;style=1000; }
  	if ((size>'1085')&&(size<='1290')) {plus=58;style=1240;}
  	if ((size>'1290')&&(size<='1371')) {plus=58;style=1320;}
  	if(size>'1371') {plus=55;style=1400;}
	document.getElementById('fsize').setAttribute('href', 'css/styles_'+style+'.css');
	css=height-(parseInt($('.header').css('height'))+parseInt($('.footer').css('height'))+plus);
	$('#map').css('height',css+'px')
	
		},100);	
}
});
