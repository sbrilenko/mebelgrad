<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
$id_=$_POST['id'];
//узнаем номер помещения по этому id
$sql='SELECT * FROM embl WHERE id='.$id_;
$db->query($sql);
if($db->getCount()>0)
{
	$arr=$db->getArray();
		foreach($arr as $index=>$value)
	{
		{
			//1000
			if(file_exists('../../../img/embl/1000/'.$value['file_name'].'.png'))
					{
									unlink('../../../img/embl/1000/'.$value['file_name'].'.png'); 
					}
			if(file_exists('../../../img/embl/1000/'.$value['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1000/'.$value['file_name'].'_m.png'); 
					}
			if(file_exists('../../../img/embl/1000/'.$value['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1000/'.$value['file_name'].'_buble.png'); 
					}
			//1240
				if(file_exists('../../../img/embl/1240/'.$value['file_name'].'.png'))
					{
									unlink('../../../img/embl/1240/'.$value['file_name'].'.png'); 
					}
				if(file_exists('../../../img/embl/1240/'.$value['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1240/'.$value['file_name'].'_m.png'); 
					}
			    if(file_exists('../../../img/embl/1240/'.$value['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1240/'.$value['file_name'].'_buble.png'); 
					}
			//1300
				if(file_exists('../../../img/embl/1320/'.$value['file_name'].'.png'))
					{
									unlink('../../../img/embl/1320/'.$value['file_name'].'.png'); 
					}
				if(file_exists('../../../img/embl/1320/'.$value['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1320/'.$value['file_name'].'_m.png'); 
					}
			    if(file_exists('../../../img/embl/1320/'.$value['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1320/'.$value['file_name'].'_buble.png'); 
					}
			//1440
				if(file_exists('../../../img/embl/1400/'.$value['file_name'].'.png'))
					{
									unlink('../../../img/embl/1400/'.$value['file_name'].'.png'); 
					}
				if(file_exists('../../../img/embl/1400/'.$value['file_name'].'_m.png'))
					{
									unlink('../../../img/embl/1400/'.$value['file_name'].'_m.png'); 
					}
			    if(file_exists('../../../img/embl/1400/'.$value['file_name'].'_buble.png'))
					{
									unlink('../../../img/embl/1400/'.$value['file_name'].'_buble.png'); 
					}
		}
	}
  //delete from base
  $sql='DELETE FROM embl WHERE id='.$id_;
  $db->query($sql);
}
?>