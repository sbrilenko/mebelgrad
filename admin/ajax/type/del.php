﻿<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$targetPath = $root . '/img/calendar/';	
require_once $root."/lib/class.invis.db.php";
$db = db :: getInstance();
$var=$_POST['id'];
$qwery = "DELETE FROM type WHERE id=".$var;
$db->query($qwery);
$max_chars_length=30;
 if($err=='') {
echo "<div id='actionContent'>";
print '<div class="title">Категории</div>';
	echo "<form name='form' id='add_type' method='post'>";
     print '<table id="calendar"><tr><th width="200">Название</th><th width="200">Заголовок seo</th><th width="200">Описание seo</th><th width="200">Ключевые слова seo</th><th>Вес 0..100</th><th width="130">Удалить</th></tr>';
             $qwery = "SELECT * FROM type WHERE id=282";
				$db->query($qwery);
				if($db->getCount()>0)
				{
					$soft=$db->getArray();
					if($soft[0]['disabled']==1) { $disable_='disabled="disabled"';} else {$disable_='';}
					print '<tr><td><input class="float_left" '.$disable_.'	maxlength='.$max_chars_length.' type="text" id="record_'.$soft[0]['id'].'" name="record_'.$soft[0]['id'].'" value="'.$soft[0]['title'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="titleseo_'.$soft[0]['id'].'" value="'.$soft[0]['title_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="descriptionseo_'.$soft[0]['id'].'" value="'.$soft[0]['description_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="keywordsseo_'.$soft[0]['id'].'" value="'.$soft[0]['keywords'].'"></td>';

                    print '<td><input style="width:80px;" type="text" id="reminder" maxlength='.$max_chars_length.'  name="reminder_'.$soft[0]['id'].'" value="'.$soft[0]['reminder'].'"></td>';
					if($soft[0]['disabled']!=1)
					print '<td></td></tr>';
				}
            // Достаем категории
            $qwery = "SELECT * FROM type WHERE id<>282 ORDER BY disabled DESC";
            $db -> query($qwery);	
            $arr = $db -> getArray();
		
			if($db ->getCount()!=0)
			{
				
				foreach($arr as $row)
				{
					if($row['disabled']==1) { $disable_='disabled="disabled"';} else {$disable_='';}
					print '<tr><td><input style="float:left;" '.$disable_.'	maxlength='.$max_chars_length.' type="text" id="record_'.$row['id'].'" name="record_'.$row['id'].'" value="'.$row['title'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="titleseo_'.$row['id'].'" value="'.$row['title_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="descriptionseo_'.$row['id'].'" value="'.$row['description_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="keywordsseo_'.$row['id'].'" value="'.$row['keywords'].'"></td>';

                    print '<td><input style="width:80px;" type="text" id="reminder" maxlength='.$max_chars_length.' name="reminder_'.$row['id'].'" value="'.$row['reminder'].'"></td>';
					if($row['disabled']!=1)
					print '<td><a id="del" href="'.$row['id'].'">
  					<img src="img/b_drop.png" alt="Удалить" title="Удалить"></a></td></tr>';
				}
				print '<tr><td class="last" colspan="2"><input type="text" maxlength='.$max_chars_length.' id="new" name="new" value=""> Новая категория</td></tr>';
				 
			}
			else
			{
				print '<tr><td class="last" colspan="2" ><input type="text" maxlength='.$max_chars_length.' id="new" name="new" value=""> Новый тип</td></tr>';
			}
			print "</table>";
echo "<div style='clear:both;'></div>";
echo "<input type='submit' value='Сохранить / обновить'>";
echo "</form>
<span id='progress-form'></span></div>";
echo "</div>";
}
else
{
	print $err;
}
?>