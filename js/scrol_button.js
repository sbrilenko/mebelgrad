(function($) {
    $.fn.scrollPlugin = function(options) {
           var el = $(this),
		    el_top = el.offset().top,
		    el_pos = el.offset().left,
		    all_car_pos=$('#metka').offset().top;
		   var size,css,minus_razmer,scrolltotop;
		size_(1)
		$(window).scroll(function() {
		    if (!el.hasClass('position_fixed') && $(this).scrollTop() > all_car_pos+minus_razmer) {
		        el.addClass('position_fixed ');
		        el.removeClass('display_none')
		        el.css({
		            "top": "0px"
		        })
		    } else if (el.hasClass('position_fixed') && $(this).scrollTop() <= all_car_pos+minus_razmer) {
		        el.removeClass('position_fixed');
		        el.addClass('display_none')
		        el.css({
		            "top": "0px"
		        })
		    }
});
			this.bind('click',function()
			{
				window.scrollTo(0, size_(2));
			})
			function size_(numb)
			{
				size=$(window).width()
			    if (size<='1100') { css='1000';minus_razmer=10;scrolltotop=450}
			    else
				if ((size>'1100')&&(size<='1285')) {css='1240';minus_razmer=-10;scrolltotop=450}
				else
				if ((size>'1285')&&(size<='1371')) {css='1320';minus_razmer=59;scrolltotop=490}
				else {css='1400';minus_razmer=55;scrolltotop=495} 
				if(numb==1) return minus_razmer;
				else if(numb==2) return scrolltotop;
			}
   };	
})(jQuery);
$(document).ready(function() {
 $('#button_up').scrollPlugin({ });
})