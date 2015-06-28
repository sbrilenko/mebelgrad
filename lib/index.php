<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/class.invis.db.php";
$db = db :: getInstance();
$qwery = "SELECT * FROM extra_price ORDER BY id ASC";
$db->query($qwery);
$arr=$db->getArray();
if(count($arr)!=null)
{
	    $str='';
		foreach($arr as $index=>$row)
		{
			$str.=$row['price'].'/';
		}
		
}
print $str;

?>