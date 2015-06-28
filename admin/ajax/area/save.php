<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
$err='';
if($_POST['plus_m']=='on')
{
	$plus_m=1;
}
else
{
	$plus_m=0;			
}
$editorClass = new editorClass();
if(isset($_POST ['description'])) 
    if (!$description = $editorClass->replaceToInsert($_POST['description']))
       unset($description); 
if(isset($_POST ['comment'])) 
    if (!$comment = $editorClass->replaceToInsert($_POST['comment']))
       unset($comment); 
if(!empty($_POST['site']))
{
		if((substr(trim($_POST['site']), 0, strlen('http://'))=='http://'))
		{
			$site=$_POST['site'];
		}
		else
		{
			$site='http://'.$_POST['site'];
		}

	
}

function rusDoubleQuotes($string) {
	$string=str_replace('«', '&laquo;', $string);
	$string=str_replace('»', '&raquo;', $string);
	$string=preg_replace("/(?:\"([^\"]+)\")/","&laquo;\\1&raquo;",$string);
	
	$vowels = array("'", '"', );
	$string=str_replace($vowels, '&quot;', $string);
	return $string;		
}
$_POST['kvadrat'] = rusDoubleQuotes(trim($_POST['kvadrat']));
$_POST['price']= rusDoubleQuotes(trim($_POST['price']));
$_POST['name_company']=rusDoubleQuotes($_POST['name_company']);
$_POST['firma']=rusDoubleQuotes(trim($_POST['firma']));
$description=rusDoubleQuotes(trim($description));
$_POST['act']=rusDoubleQuotes(trim($_POST['act']));
$_POST['email']=rusDoubleQuotes(trim($_POST['email']));
$_POST['contacts_face']=rusDoubleQuotes(trim($_POST['contacts_face']));
$_POST['phone_contacts_face']=rusDoubleQuotes(trim($_POST['phone_contacts_face']));
$_POST['phone3']=rusDoubleQuotes(trim($_POST['phone3']));
$_POST['discount']=rusDoubleQuotes(trim($_POST['discount']));
$comment=rusDoubleQuotes(trim($comment));
//history
$sql_get_old_values="SELECT kvadrat,price,discount FROM floors WHERE floor=".$_POST['floors']." AND numb='".$_POST['pomesh']."'";
$db->query($sql_get_old_values);
if($db->getCount()>0)
{
    $arr_get_old_val=$db->getArray();
    $kvadrat=$arr_get_old_val[0]['kvadrat'];
    $price=$arr_get_old_val[0]['price'];
    $discount=$arr_get_old_val[0]['discount'];
    if($kvadrat!=trim($_POST['kvadrat']) OR $price!=trim($_POST['price']) OR $discount!=trim($_POST['discount']))
    {
       $sql_insert="INSERT INTO history (numb,floor,kvadrat,price,discount,date_update) VALUES ('".$_POST['pomesh']."',".$_POST['floors'].",'".trim($_POST['kvadrat'])."','".trim($_POST['price'])."','".trim($_POST['discount'])."','".date('Y-m-d H:i:s')."')";
       $db->query($sql_insert);
    }
}

$sql_select_='UPDATE floors SET 
    color='.$_POST['color'].', 
    kvadrat="'.trim($_POST['kvadrat']).'", 
    price="'.trim($_POST['price']).'", 
    site="'.$site.'",
    name_company="'.trim($_POST['name_company']).'", 
    firma="'.trim($_POST['firma']).'",
    phone1="'.trim($_POST['phone1']).'",
    phone2="'.trim($_POST['phone2']).'", 
    description="'.trim($description).'",
    act="'.trim($_POST['act']).'",
    email="'.trim($_POST['email']).'",
    contacts_face="'.trim($_POST['contacts_face']).'",
    phone_contacts_face="'.trim($_POST['phone_contacts_face']).'",
    phone3="'.trim($_POST['phone3']).'",
    discount="'.trim($_POST['discount']).'",
    comment="'.trim($comment).'",
    plus_m='.$plus_m.'
    WHERE floor='.$_POST['floors'].' AND numb="'.$_POST['pomesh'].'"';

    
    
$db->query($sql_select_);

		$count=0;
		foreach($_POST as $index=>$rez)
		{
				$first_img=explode('first_',$index);
				if(!empty($first_img[1]))
				{
					$count++;
				}	
		}
		$sql_how_much_='SELECT * FROM photos WHERE room_number="'.$_POST['pomesh'].'"';
		$db->query($sql_how_much_);
		if($db->getCount()>0)
		{
			$arr=$db->getArray();
			if(count($arr)>3 AND $count<3)
			{
				$err='<p style=\'color:red;\'>Отметьте 3 фото</p>';
			}
			else
			{
				$sql_how_much_='UPDATE photos SET first_thr=1 WHERE room_number="'.$_POST['pomesh'].'"';
				$db->query($sql_how_much_);
			}
		}
if(empty($err))
{
	//удаляем из базы  запись с temp=1 AND room_number='.$_POST['pomesh'] если конечно мы его заменяем, то есть в базе есть запись с таким же $_POST['pomesh'] и temp=0
$sql_embl_update='SELECT * FROM embl WHERE room_number="'.$_POST['pomesh'].'" AND temp=0';
$db->query($sql_embl_update);
if($db->getCount()>0)
{
	$sql='SELECT * FROM embl WHERE temp=1 AND room_number="'.$_POST['pomesh'].'"';
	$db->query($sql);
	if($db->getCount()>0)
	{
	$arr=$db->getArray();
	foreach($arr as $index=>$val)
		{
			       //1000
			        if(file_exists('../../../img/embl/1000/'.$val['file_name'].'.png'))
					{
									unlink('../../../img/embl/1000/'.$val['file_name'].'.png'); 
					}
					if(file_exists('../../../img/embl/1000/'.$val['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1000/'.$val['file_name'].'_m.png'); 
					}
					if(file_exists('../../../img/embl/1000/'.$val['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1000/'.$val['file_name'].'_buble.png'); 
					}
				  //1240
				if(file_exists('../../../img/embl/1240/'.$val['file_name'].'.png'))
					{
									unlink('../../../img/embl/1240/'.$val['file_name'].'.png'); 
					}
				if(file_exists('../../../img/embl/1240/'.$val['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1240/'.$val['file_name'].'_m.png'); 
					}
					if(file_exists('../../../img/embl/1240/'.$val['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1240/'.$val['file_name'].'_buble.png'); 
					}
                 //1320
				if(file_exists('../../../img/embl/1320/'.$val['file_name'].'.png'))
					{
									unlink('../../../img/embl/1320/'.$val['file_name'].'.png'); 
					}
			     if(file_exists('../../../img/embl/1320/'.$val['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1320/'.$val['file_name'].'_m.png'); 
					}
				if(file_exists('../../../img/embl/1320/'.$val['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1320/'.$val['file_name'].'_buble.png'); 
					}
				//1400
				if(file_exists('../../../img/embl/1400/'.$val['file_name'].'.png'))
					{
									unlink('../../../img/embl/1400/'.$val['file_name'].'.png'); 
					}
				if(file_exists('../../../img/embl/1400/'.$val['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1400/'.$val['file_name'].'_m.png'); 
					}
				if(file_exists('../../../img/embl/1400/'.$val['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1400/'.$val['file_name'].'_buble.png'); 
					}
		}
	}

	$sql_delete_old_logo='DELETE FROM embl WHERE room_number="'.$_POST['pomesh'].'" AND temp=1';
	$db->query($sql_delete_old_logo);
	//записываем новый
	$sql_embl_update='UPDATE embl SET temp=1 WHERE room_number="'.$_POST['pomesh'].'" AND temp=0';
	$db->query($sql_embl_update);
	//
	
}
//photos
//обновляем все first_thr=0
$sql_how_much_='SELECT * FROM photos WHERE room_number="'.$_POST['pomesh'].'"';
		$db->query($sql_how_much_);
		if($db->getCount()>0)
		{
			$arr=$db->getArray();
			if(count($arr)>3)
			{
				$sql='UPDATE photos SET first_thr=0 WHERE room_number="'.$_POST['pomesh'].'"';
				$db->query($sql);
				foreach($_POST as $index=>$rez)
						{
								$first_img=explode('first_',$index);
								if(!empty($first_img[1]))
								{
									$sql='UPDATE photos SET first_thr=1 WHERE id='.$first_img[1];
									$db->query($sql);
								}	
						}
			}
			}
//записываем новый
$sql_embl_update='UPDATE photos SET temp=1 WHERE room_number="'.$_POST['pomesh'].'" AND temp=0';
$db->query($sql_embl_update);
//возьмем имя из embl где room_number=$_POST['pomesh'] AND temp=0
}
else
{
	print $err;
}

?>