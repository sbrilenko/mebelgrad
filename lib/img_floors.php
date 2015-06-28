<?php
$root = $_SERVER['DOCUMENT_ROOT'];	
require_once $root."/lib/class.invis.db.php";
$db = db :: getInstance();		
$elements = "pictures=[";
$array;
$count=0;
$number=0;
$dir='';
if($_POST['id']=='1')
{
	$dir = $root."/img/photos_floors/1/1000/";
}
else
if($_POST['id']=='2')
{
	$dir = $root."/img/photos_floors/2/1000/";
}	
else
{
	$dir = $root."/img/photos_floors/3/1000/";
}
	if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if(substr(strrchr($file, '.'), 1)=='jpg')
			{
				 $count++;
			}
			
        }
    }
}
			
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
           // echo "файл: $file : тип: " . filetype($dir . $file) . "";
            if(substr(strrchr($file, '.'), 1)=='jpg')
			{
				 $array[]=$file;
				 /*$elements .= '"'.$file.'"';
           		 if ($count!=$number) $elements .= ",";
				 $number++;*/
			}
			
        }
      
    }
 
}
sort($array);
for($i=0;$i<count($array);$i++)
{
	 $elements .= '"'.$array[$i].'"';
     if ($i+1!=count($array)) $elements .= ",";
}
closedir($dh);
print  $elements."];";

?>