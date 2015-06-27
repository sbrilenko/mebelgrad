var opacity; // Avoid starting at 100% due to Mozilla bug
var slowly = {
	fadein : function (id) {
		opacity=99;
		this.fadeLoop(id, opacity);
	},
	fadeout : function (id) {
		opacity=3;
		this.fadePlus(id, opacity);
	},
	fadeLoop : function (id, opacity) {
		var object = document.getElementById(id);
		if (opacity >= 5) {
			slowly.setOpacity(object, opacity);
			opacity -= 4;
			window.setTimeout("slowly.fadeLoop('" + id + "', " + opacity + ")", 99);
		}else
		{
			slowly.fadeout('building');
		}
	},
	fadePlus : function (id, opacity) {
		var object = document.getElementById(id);
		if (opacity <100) {
			slowly.setOpacity(object, opacity);
			opacity +=4;
			window.setTimeout("slowly.fadePlus('" + id + "', " + opacity + ")", 99);
		} 
	},
	setOpacity : function (object, opacity) {
		object.style.filter = "alpha(style=0,opacity:" + opacity + ")";	// IE
		object.style.KHTMLOpacity = opacity / 100;				// Konqueror
		object.style.MozOpacity = opacity / 100;					// Mozilla (old)
		object.style.opacity = opacity / 100;					// Mozilla (new)
	}
}

var runOnce=0;
$(document).ready(function()
{				
	var time=800;
	var time_out=20;
				 setTimeout(function ()
				 {
				 	$('.floor_vid_3').show().animate({opacity: '1'}, time, function() {
	 				  $(this).animate({opacity: '0',filter: 'alpha(opacity:0)'}, time);
					  $('.floor_vid_2').show().animate({opacity: '1'}, time, function() {
					    $(this).animate({opacity: '0',filter: 'alpha(opacity:0)'}, time);
					  		$('.floor_vid_1').show().animate({opacity: '1'}, time, function() {
					  					  $(this).animate({opacity: '0',filter: 'alpha(opacity:0)'}, time);
					 				 });
					 				 });
 				 });  
				 },1000)
		 			 
	$('#linkonefloor, #linktwofloor, #linkthrfloor').mouseover(function() {
		var this_class=$(this).attr('id');
			switch (this_class)
			{
				case 'linkonefloor':
				$('.floor_vid_1').show().css('filter','').css('opacity','1');
				break;
				case 'linktwofloor':
				$('.floor_vid_2').show().css('filter','').css('opacity','1');
				break;
				case 'linkthrfloor':
				$('.floor_vid_3').show().css('filter','').css('opacity','1');
				break;
			}
		
	})
	$('#linkonefloor, #linktwofloor, #linkthrfloor').mouseout(function() {
		var this_class=$(this).attr('id');
				switch (this_class)
		{
			case 'linkonefloor':
			$('.floor_vid_1').hide();
			break;
			case 'linktwofloor':
			$('.floor_vid_2').hide();
			break;
			case 'linkthrfloor':
			$('.floor_vid_3').hide();
			break;
		}
		
	})
})
