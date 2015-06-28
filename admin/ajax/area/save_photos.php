<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance(); //Подключение базы
$imageClass = new imageClass(); // класс ля работы с изображением
if($_FILES['image_preview']['tmp_name'][0]!=null) 
{
	    
	    $err=''; //ошибки для каждого из файлов
		set_time_limit(0);
			$all_err='';
			foreach($_FILES['image_preview']['tmp_name'] as $index=>$val)
			{
				
			    if(!$image_info = $imageClass->getImageInfo($val)) 
				{
	            	$err.='<p style=\'color:red;\'>'.$_FILES['image_preview']['name'][$index].' - Обработка файла изображения невозможна</p>';
	            }	
		        if ($image_info['extension'] != "jpg") {
		           $err.='<p style=\'color:red;\'>'.$_FILES['image_preview']['name'][$index].' - Допустимые расширения для изображения *.jpg</p>';
		        }
		        if ($image_info['width'] <999) {
		           $err.='<p style=\'color:red;\'>'.$_FILES['image_preview']['name'][$index].' - Ширина должна быть не меньше 999 пикселей</p>';
		        } 
				if ($image_info['height'] <666) {
		           $err.='<p style=\'color:red;\'>'.$_FILES['image_preview']['name'][$index].' - Высота должна быть не меньше 666 пикселей</p>';
		        }
		        if ($image_info['size'] > (1024 * 1024 * 40)) {
		           $err.='<p style=\'color:red;\'>'.$val['name'].' - Файл изображения больше 40 Мб</p>';
		        }
				if ($image_info['width']*2/3!=$image_info['height']) {
		           $err.='<p style=\'color:red;\'>'.$_FILES['image_preview']['name'][$index].' - Файл изображения должен быть в соотношении 3*2</p>';
		        }
					if(empty($err))
					{
						 $md5=md5(microtime());
						//1000
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 687;
						$handle->image_y               = 458;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->process('../../../img/photos/1000');
						
						//middle
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 177;
						$handle->image_y               = 118;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->file_name_body_add = '_p';
						$handle->process('../../../img/photos/1000');
						
						//1240
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 825;
						$handle->image_y               = 550;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->process('../../../img/photos/1240');
						
						//middle
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 258;
						$handle->image_y               = 172;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->file_name_body_add = '_p';
						$handle->process('../../../img/photos/1240');
						
						//1320
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 882;
						$handle->image_y               = 588;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->process('../../../img/photos/1320');
						
						//middle
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 276;
						$handle->image_y               = 184;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->file_name_body_add = '_p';
						$handle->process('../../../img/photos/1320');
						
						//1400
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 999;
						$handle->image_y               = 666;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->process('../../../img/photos/1400');
						
						//middle
						$handle = new upload($val);
						$handle->file_new_name_body   = $md5;	
						$handle->image_convert = "jpg";
						$handle->image_resize          = true;
						//$handle->image_ratio_x         = true;
						$handle->image_x               = 294;
						$handle->image_y               = 196;
						$handle->jpeg_quality = 100;
						$handle->image_unsharp = false; //лучше true, но класс выдает ошибку
						$handle->file_name_body_add = '_p';
						$handle->process('../../../img/photos/1400');
						
						//add_to base
						$sql_delete_zero_records='DELETE FROM photos WHERE room_number="'.$_POST['pomesh'].'" AND temp=0 AND data_create <= "'.date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y"))).'"';
						$db->query($sql_delete_zero_records);
						
						$sql_insert_into_table_banners='INSERT INTO photos (id, room_number,data_create,temp,file_name) VALUES (NULL,"'.$_POST['pomesh'].'","'.date('Y-m-d').'",0,"'.$md5.'")';
						$db->query($sql_insert_into_table_banners);
					}
			else 
				{
					$all_err.=$err.'<br />';
				}
				    
			}

		//set first_thr=0
		$sql_how_much_='UPDATE photos SET first_thr=0 WHERE room_number="'.$_POST['pomesh'].'"';
		$db->query($sql_how_much_);
	    foreach($_POST as $index=>$rez)
		{
				$first_img=explode('first_',$index);
				if(!empty($first_img[1]))
				{
					$sql='UPDATE photos SET first_thr=1 WHERE id='.$first_img[1];
					$db->query($sql);
				}	
		}
		
	    $sql='SELECT * FROM photos WHERE room_number="'.$_POST['pomesh'].'"';
							   $db->query($sql);
							   if($db->getCount()>0)
							     {
							     		$arr=$db->getArray();
										foreach($arr as $index=>$val)
										{
											if($val['first_thr']!=0)
											{
												$ckecked='<input  type="checkbox" id="first_'.$val['id'].'" name="first_'.$val['id'].'" checked="checked" title="Поставить первой" >';
											}
											else
											{
												$ckecked='<input type="checkbox" id="first_'.$val['id'].'" name="first_'.$val['id'].'" title="Поставить первой" >';
											}
											print '<div style="float:left;margin:0 7px 7px 0;"><img src="../../../img/photos/1000/'.$val['file_name'].'.jpg" style="float:left;width:150px;height:100px;">
											<div style="float:left;width:15px;"><a href="#" id="del_photo" data-id="'.$val['id'].'" style=""><img src="img/b_drop.png" title="удалить"/></a>'.$ckecked.'</div></div>';
										}
										
								 }
		}						
else
{
	   $err.='<p style=\'color:red;\'>Файл отсутствует</p>';
	   print $err; 
}



			 
?>  
