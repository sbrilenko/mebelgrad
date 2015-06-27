<?php
require_once 'lock.php';
// Подключаем заголовок
include "blocks/head.php";
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
// Подключение отправки формы
echo '<script type="text/javascript" src="js/jquery.form.js"> </script>';

$db = db :: getInstance();   
print "<table height='100%' cellpadding='2' cellspacing='0' class='main'>
  <tr>
    <td class='head'>";

        // Вехнее меню
        $tut = 'home';
        include "blocks/menu.php"; 
   
   print "</td>
  </tr>
  <tr>
    <td class='photo_site'>
			<span>Бюро</span> 
			<span>Школа</span>
			<span>Клуб</span>
    </td>
  </tr>
  <tr>
    <td id='content'>
      <div>";
      
	      
            // Достаем категории
           $qwery = "SELECT * FROM back_photo ORDER BY id,site ASC";
           $db -> query($qwery);	
		   $f=$t=$th=$fo=$five='';
           $arr = $db -> getArray();
           print "<form name='form' id='editForm' method='post'>";
		  
            foreach ($arr as $myrow_) {
            	                if($myrow_['id']==1)
								{
									if(empty($myrow_['name']))
									{
										$f.='<span style="margin-right:70px;"><input style="width:220px" id="multi" type="file" name="url_image'.'_'.$myrow_['id'].'_'.$myrow_['site'].'" accept="image/jpg"></span>';
									}
									else
									{
										$f.= '<span style="margin-right:145px;"><img src="../img/img/thumb_'.$myrow_['name'].'.png" /><a href='.$myrow_['id'].'_'.$myrow_['site'].'><img src="img/b_drop.png" alt="Удалить" title="Удалить" /></a></span>';
									} 
								}
            	                if($myrow_['id']==2)
								{
									if(empty($myrow_['name']))
									{
										$t.='<span style="margin-right:70px;"><input style="width:220px" id="multi" type="file" name="url_image'.'_'.$myrow_['id'].'_'.$myrow_['site'].'" accept="image/jpg"></span>';
									}
									else
									{
										$t.= '<span style="margin-right:145px;"><img src="../img/img/thumb_'.$myrow_['id'].'_'.$myrow_['site'].'.png" /><a href='.$myrow_['id'].'_'.$myrow_['site'].'><img src="img/b_drop.png" alt="Удалить" title="Удалить" /></a></span>';
									} 
								}
								 if($myrow_['id']==3)
								{
									if(empty($myrow_['name']))
									{
										$th.='<span style="margin-right:70px;"><input style="width:220px" id="multi" type="file" name="url_image'.'_'.$myrow_['id'].'_'.$myrow_['site'].'" accept="image/jpg"></span>';
									}
									else
									{
										$th.= '<span style="margin-right:145px;"><img src="../img/img/thumb_'.$myrow_['id'].'_'.$myrow_['site'].'.png" /><a href='.$myrow_['id'].'_'.$myrow_['site'].'><img src="img/b_drop.png" alt="Удалить" title="Удалить" /></a></span>';
									} 
								}
								 if($myrow_['id']==4)
								{
									if(empty($myrow_['name']))
									{
										$fo.='<span style="margin-right:70px;"><input style="width:220px" id="multi" type="file" name="url_image'.'_'.$myrow_['id'].'_'.$myrow_['site'].'" accept="image/jpg"></span>';
									}
									else
									{
										$fo.= '<span style="margin-right:145px;"><img src="../img/img/thumb_'.$myrow_['id'].'_'.$myrow_['site'].'.png" /><a href='.$myrow_['id'].'_'.$myrow_['site'].'><img src="img/b_drop.png" alt="Удалить" title="Удалить" /></a></span>';
									} 
								}
								if($myrow_['id']==5)
								{
									if(empty($myrow_['name']))
									{
										$five.='<span style="margin-right:70px;"><input style="width:220px" id="multi" type="file" name="url_image'.'_'.$myrow_['id'].'_'.$myrow_['site'].'" accept="image/jpg"></span>';
									}
									else
									{
										$five.= '<span style="margin-right:145px;"><img src="../img/img/thumb_'.$myrow_['id'].'_'.$myrow_['site'].'.png" /><a href='.$myrow_['id'].'_'.$myrow_['site'].'><img src="img/b_drop.png" alt="Удалить" title="Удалить" /></a></span>';
									} 
								}
            				    	}
	       $f='<div style="	margin-bottom:20px;">1 фотография. '.$f.'</div>';
	       $t='<div style="	margin-bottom:20px;">2 фотография. '.$t.'</div>';
		   $th='<div style="margin-bottom:20px;">3 фотография. '.$th.'</div>';
		   $fo='<div style="margin-bottom:20px;">4 фотография. '.$fo.'</div>';
		   $five='<div style="margin-bottom:20px;">5 фотография. '.$five.'</div>';
           print $f.$t.$th.$fo.$five.' 
           <div style="color:blue;padding 10px;">* фотографии размером 1920*1080. Степень сжатия 60-70%, по возможности алгоритм сжатия - Progressiv, сглаживание не более 20%</div>
           <input type="submit" value="Сохранить" name ="input" /> </form><span id="progress-form"></span></div>
    </td>
  </tr>
  <tr>
    <td class="foot" colspan="2">';
            // Подключаем создателя
            include ("blocks/creator.php");
    print '</td></tr></table>';

	   
       
?>

<script type="text/javascript">

$(document).ready(function(){

    //------------------------------------------
    var optionsUpdate = {
        target: "#progress-form",
        url:    "ajax/index/index.php",
        
      beforeSubmit: function(jqForm) { // Здесь проверяем данные формы
            $('#progress-form').text('Обновление данных...');
        },
        success: function(responseText) { // Здесь проверяем ответ
	     //$('#progress-form').html(responseText);
	      if (responseText.indexOf("red") == -1) {
	      	    $('#progress-form').html(responseText);
                 location.href='/admin/index.php';
            }
	      else
	      {
	      	 $('#progress-form').html(responseText);
	      	
	      }
	      
	     //setTimeout("location.href='/admin/portfolio.php'",2500 );
          //location.href='/admin/portfolio.php?back_to_gal='+$(this).attr('name');
        }
    };

    // привязываем событие submit к форме
    $('#editForm').submit(function() { 
        $(this).ajaxSubmit(optionsUpdate); 
            return false;
    });     

	$( "a img" ).live('click',function() { 
		 $.post("ajax/index/del.php", {type: $(this).parents().attr('href')}, function(data){
           location.href='/admin/index.php';	
		});
		return false;	
		});

});

    
</script>