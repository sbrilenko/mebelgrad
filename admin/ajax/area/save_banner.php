<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance(); //Подключение базы
$imageClass = new imageClass(); // класс ля работы с изображением
if($_FILES['image']['tmp_name']!=null) 
{
	    $err=''; //ошибки для каждого из файлов
	    if(!$image_info = $imageClass->getImageInfo($_FILES['image']['tmp_name'])) 
						{
			            	$err.='<p style=\'color:red;\'>'.$_FILES['image']['name'].' - Обработка файла изображения невозможна</p>';
			            }	
				        if ($image_info['extension'] != "png") {
				           $err.='<p style=\'color:red;\'>'.$_FILES['image']['name'].' - Допустимые расширения для изображения *.png</p>';
				        }
				        if ($image_info['width'] !=206) {
				           $err.='<p style=\'color:red;\'>'.$_FILES['image']['name'].' - Ширина должна быть 206 пикселей</p>';
				        } 
						 if ($image_info['height'] <70 OR $image_info['height'] >206) {
				           $err.='<p style=\'color:red;\'>'.$_FILES['image']['name'].' - Высота должна быть не меньше 70 пикселей и не больше 206 пикселей</p>';
				        }
				        if ($image_info['size'] > (1024 * 1024 * 40)) {
				           $err.='<p style=\'color:red;\'>'.$_FILES['image']['name'].' - Файл изображения больше 40 Мб</p>';
				        }
		if(empty($err)) {
		set_time_limit(0);
	    $md5=md5(microtime());
		//1000
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_y         = true;
		$handle->image_x               = 168;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->process('../../../img/embl/1000');
		
		//middle
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 56;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_m';
		$handle->process('../../../img/embl/1000');
		
		//buble
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 30;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_buble';
		$handle->process('../../../img/embl/1000');
		//
		//1240
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_y         = true;
		$handle->image_x               = 185;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->process('../../../img/embl/1240');
		
		//middle
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 62;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_m';
		$handle->process('../../../img/embl/1240');
		
		//buble
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 40;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_buble';
		$handle->process('../../../img/embl/1240');
		//
		//1320
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_y         = true;
		$handle->image_x               = 198;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->process('../../../img/embl/1320');
		
		//middle
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 67;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_m';
		$handle->process('../../../img/embl/1320');
		
		//buble
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 40;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_buble';
		$handle->process('../../../img/embl/1320');
		//
		
		//1400
		/*$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 129;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->process('../../../img/embl/1400');*/
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->process('../../../img/embl/1400');

		//middle
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 70;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_m';
		$handle->process('../../../img/embl/1400');
		
		//buble
		$handle = new upload($_FILES['image']);
		$handle->file_new_name_body   = $md5;	
		$handle->image_convert = "png";
		$handle->image_resize          = true;
		$handle->image_ratio_x         = true;
		$handle->image_y               = 42;
		$handle->jpeg_quality = 100;
		$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
		$handle->file_name_body_add = '_buble';
		$handle->process('../../../img/embl/1400');
		$handle->clean();	
		//удаляем все записи из banners где restaurant_id=0 and event_id=0 and data_create< сегодняшняя дата-1 день
		//сначала удаляем фотки
		/*$sql_select_zero_banners_photo='SELECT * FROM embl WHERE room_number='.$_POST['temp'].' AND temp=0 AND data_create <= "'.date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y"))).'"';
		$db->query($sql_select_zero_banners_photo);
		if($db->getCount()>0)
		{
			$arr=$db->getArray();
			foreach($arr as $in=>$value)
			{
				 if(file_exists('../../../img/embl/1000/'.$value['embl'].'.jpg'))
						{
							unlink('../../../img/embl/1000/'.$value['embl'].'.jpg');
						}
				 if(file_exists('../../../img/embl/1240/'.$value['embl'].'.jpg'))
						{
							unlink('../../../img/embl/1240/'.$value['embl'].'.jpg');
						}
				 if(file_exists('../../../img/embl/1320/'.$value['embl'].'.jpg'))
						{
							unlink('../../../img/embl/1320/'.$value['embl'].'.jpg');
						}
				 if(file_exists('../../../img/embl/1400/'.$value['embl'].'.jpg'))
						{
							unlink('../../../img/embl/1400/'.$value['embl'].'.jpg');
						}
			}
		}*/
		$sql_delete_zero_records='DELETE FROM embl WHERE room_number="'.$_POST['pomesh'].'" AND temp=0 AND data_create <= "'.date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y"))).'"';
		$db->query($sql_delete_zero_records);
		
		$sql_insert_into_table_banners='INSERT INTO embl (id, room_number,data_create,temp,file_name) VALUES (NULL,"'.$_POST['pomesh'].'","'.date('Y-m-d').'",0,"'.$md5.'")';
		$db->query($sql_insert_into_table_banners);
		
		}
		else
		{
			 print $err;	
		}						
}
else
{
	   $err.='<p style=\'color:red;\'>Файл отсутствует</p>';
	   print $err; 
}

if(empty($err))
{
	 $sql='SELECT * FROM embl WHERE room_number="'.$_POST['pomesh'].'" AND temp=0';
							   $db->query($sql);
							   if($db->getCount()>0)
							     {
							     		$arr=$db->getArray();
										print '<img src="../../../img/embl/1000/'.$arr[0]['file_name'].'.png" style="float:left;width:150px;height:100px;"><a href="#" id="del_embl" data-id="'.$arr[0]['id'].'"><img src="img/b_drop.png" title="удалить"/></a>';
								 }
}

			 
?>  
