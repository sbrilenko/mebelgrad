<?php
$root = $_SERVER['DOCUMENT_ROOT'];	
require_once $root."/lib/class.invis.db.php";
$db = db :: getInstance();
//get number_room
$sql_room_number='SELECT room_number FROM photos WHERE file_name="'.$_POST['file_name'].'"';
$db->query($sql_room_number);
$elements = "pictures=[";
if($db->getCount()>0)
{
	$room_number=$db->getValue();
	$sql='SELECT * FROM photos WHERE room_number='.$room_number.' ORDER BY first_thr DESC';
	$db->query($sql);
	if($db->getCount()>0)
	{
		$arr=$db->getArray();
		foreach($arr as $index=>$value)
		{
			$elements .= '"'.$value['file_name'].'"';
            if ($index+1 != count($arr)) $elements .= ",";
            
        }
        //echo $elements."];";
	}
}
print  $elements."];";
?>