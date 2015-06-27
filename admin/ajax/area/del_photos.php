<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
$id_=$_POST['id'];
//узнаем номер помещения по этому id
$sql='SELECT * FROM photos WHERE id='.$id_;
$db->query($sql);
if($db->getCount()>0)
{
	$arr=$db->getArray();
		foreach($arr as $index=>$value)
	{
		{
			//1000
			if(file_exists('../../../img/photos/1000/'.$value['file_name'].'.jpg'))
					{
									unlink('../../../img/photos/1000/'.$value['file_name'].'.jpg'); 
					}
			if(file_exists('../../../img/photos/1000/'.$value['file_name'].'_p.jpg'))
					{
									unlink('../../../img/photos/1000/'.$value['file_name'].'_p.jpg'); 
					}
		
			//1240
				if(file_exists('../../../img/photos/1240/'.$value['file_name'].'.jpg'))
					{
									unlink('../../../img/photos/1240/'.$value['file_name'].'.jpg'); 
					}
				if(file_exists('../../../img/photos/1240/'.$value['file_name'].'_p.jpg'))
					{
									unlink('../../../img/photos/1240/'.$value['file_name'].'_p.jpg'); 
					}
			   
			//1300
				if(file_exists('../../../img/photos/1320/'.$value['file_name'].'.jpg'))
					{
									unlink('../../../img/photos/1320/'.$value['file_name'].'.jpg'); 
					}
				if(file_exists('../../../img/photos/1320/'.$value['file_name'].'_p.jpg'))
					{
									unlink('../../../img/photos/1320/'.$value['file_name'].'_p.jpg'); 
					}
			    
			//1440
				if(file_exists('../../../img/photos/1400/'.$value['file_name'].'.jpg'))
					{
									unlink('../../../img/photos/1400/'.$value['file_name'].'.jpg'); 
					}
				if(file_exists('../../../img/photos/1400/'.$value['file_name'].'_p.jpg'))
					{
									unlink('../../../img/photos/1400/'.$value['file_name'].'_p.jpg'); 
					}
			   
		}
	}

}

//out
//pomesh number
$sql='SELECT room_number FROM photos WHERE id='.$id_;
$db->query($sql);
$room_number= $db->getValue(); 
  //delete from base
  $sql='DELETE FROM photos WHERE id='.$id_;
  $db->query($sql);
  
$sql='SELECT * FROM photos WHERE room_number='.$room_number;
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
?>