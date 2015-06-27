	
var doit,length;
$(document).ready(function() {
		var size=$(window).width();
	   if (size<='1100') { css='1000';}
		if ((size>'1100')&&(size<='1285')) {css='1240';}
		if ((size>'1285')&&(size<='1371')) {css='1320';}
		if (size>'1371') {css='1400';}
		$('#fsize').attr({	href: 'css/styles_'+css+'.css'});
	//document.getElementById('fsize').setAttribute('href', 'css/styles_'+css+'.css');
	$('img').each(function() {
	 	length=$(this).attr('src').length;
		file_name=$(this).attr('src').substr($(this).attr('src').lastIndexOf('/')+1);
		file_name_length=file_name.length;
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1000')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1000',css)+file_name);
		}
		else
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1240')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1240',css)+file_name);
		}
		else
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1320')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1320',css)+file_name);
		}
		else
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1400')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1400',css)+file_name);
		}
	 })
});
$(window).resize(function(){
  $('.galery').addClass('display_none');
  $('#for-map').empty();
  $('.galery_floors').addClass('display_none');
	$('.galery_floors .tenants_first_floor').addClass('display_none');
	$('.galery_floors .tenants_first_floor>div>div').addClass('display_none');
	$('.galery_floors .tenants_second_floor').addClass('display_none');
	$('.galery_floors .tenants_second_floor >div>div').addClass('display_none');
	$('.galery_floors .tenants_threed_floor').addClass('display_none');
	$('.galery_floors .tenants_threed_floor >div>div').addClass('display_none');
  clearTimeout(doit);
  doit = setTimeout(function(){
  	var size=$(window).width();
  	var height=$(window).height();
				var x,y;
				
			  	if (size<='1085') { x=100;y=115;}
			  	if ((size>'1085')&&(size<='1290')) {x=120;y=125;}
			  	if ((size>'1290')&&(size<='1371')) {x=130;y=125;}
			  	if(size>'1371') { if(height>=780) {height=height-940} else height=height-800;}
        	$('#form1').css('margin-top',height)
  		var size=$(window).width();
  		if (size<='1085') { css='1000'; }
	  	if ((size>'1085')&&(size<='1290')) {css='1240';}
	  	if ((size>'1290')&&(size<='1371')) {css='1320';}
	  	if(size>'1371') {css='1400';}
  	$('#fsize').attr({	href: 'css/styles_'+css+'.css'});;
  	$('img').each(function() {
		length=$(this).attr('src').length;
		file_name=$(this).attr('src').substr($(this).attr('src').lastIndexOf('/')+1);
		file_name_length=file_name.length;
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1000')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1000',css)+file_name);
		}
		else
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1240')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1240',css)+file_name);
		}
		else
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1320')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1320',css)+file_name);
		}
		else
		if($(this).attr('src').substr($(this).attr('src'),length-file_name_length).indexOf('1400')!=-1)
		{
			$(this).attr('src',$(this).attr('src').substr($(this).attr('src'),length-file_name_length).replace('1400',css)+file_name);
		}
		
    })
    }, 100);

});