<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
$imageClass = new imageClass();
$err='';
function GetTheSame($text,$db,$id=null)
{
    $id=is_null($id)?"":" AND id<>".$id;
    $sql="SELECT * FROM type WHERE title='".$text."'".$id;
    $db->query($sql);
    return $db->getCount()>0?$db->getCount():0;
}
function translit($text)
{
    $_ru = array(
        'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
        'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
        'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
        'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
        'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
        'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
    );
    $_en = array(
        'A', 'B', 'V', 'G', 'D', 'E', 'YO', 'ZH', 'Z', 'I', 'I',
        'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
        'H', 'C', 'CH', 'SH', 'SH', '\'', 'I', '\'', 'E', 'YU', 'YA',
        'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'i',
        'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
        'h', 'c', 'ch', 'sh', 'sh', '\'', 'i', '\'', 'e', 'yu', 'ya'
    );
    return strtolower(preg_replace('/[^0-9-_\+a-zA-Z]/', '', str_replace($_ru, $_en, preg_replace('/ +/', '_', trim(preg_replace('/\(.+?\)/si', '', $text))))));
}
$sql="UPDATE type SET reminder=0";
$db->query($sql);
$max_chars_length=30;
foreach($_POST as $index=>$row)
				{
					$expl=explode('_',$index);
					if($expl[0]=='record')
					{
					 if(empty($row)) {
					 	$err='<p style=\'color:red;\'>Заголовок не должен быть пустым</p>';
					 }
					 else{
                         if(GetTheSame($row,$db,$expl[1])==0)
                         {
                             $sql="UPDATE type SET title='".$row."',latin='".translit($row)."' WHERE id=".$expl[1];
                         }
                         else $err.='<p style=\'color:red;\'>Дублирование имен '.$row.'</p>';

					 }
					}
                    if($expl[0]=='titleseo')
                    {
                       $sql="UPDATE type SET title_seo='".$row."' WHERE id=".$expl[1];

                    }
                    if($expl[0]=='descriptionseo')
                    {
                        $sql="UPDATE type SET description_seo='".$row."' WHERE id=".$expl[1];

                    }
                    if($expl[0]=='keywordsseo')
                    {
                        $sql="UPDATE type SET keywords='".$row."' WHERE id=".$expl[1];

                    }
					if($expl[0]=='reminder')
					{
						if(!empty($row)) 
						{
							if(($row<101)AND($row>0))
							{
								$sql="UPDATE type SET reminder=".$row." WHERE id=".$expl[1];
							}
							else
							{
								$err='<p style=\'color:red;\'>Напоминание не может быть меньше 0 и больше 100</p>';
							}
						}
					}
					   if(($index=='new')AND($row!='')) {
                           if(GetTheSame($_POST['new'],$db)==0)
                           $sql='INSERT INTO type (id,title,latin) VALUES (NULL, "'.$_POST['new'].'", "'.translit($_POST['new']).'")';
                           else $err='<p style=\'color:red;\'>Дублирование имен '.$row.'</p>';
                       }
					    $db->query($sql);
				}
//выводим
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
					print '<tr><td><input class="float_left" '.$disable_.'	type="text" maxlength='.$max_chars_length.' id="record_'.$soft[0]['id'].'" name="record_'.$soft[0]['id'].'" value="'.$soft[0]['title'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="titleseo_'.$soft[0]['id'].'" value="'.$soft[0]['title_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="descriptionseo_'.$soft[0]['id'].'" value="'.$soft[0]['description_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="keywordsseo_'.$soft[0]['id'].'" value="'.$soft[0]['keywords'].'"></td>';

                    print '<td><input style="width:80px;" type="text" id="reminder" maxlength='.$max_chars_length.' name="reminder_'.$soft[0]['id'].'" value="'.$soft[0]['reminder'].'"></td>';
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
					print '<tr><td><input style="float:left;" '.$disable_.'	maxlength='.$max_chars_length.' type="text" id="record_'.$row['id'].'" name="record_'.$row['id'].'" value="'.$row['title'].'"></td>
					';
                    echo '<td><input style="width:150px;" type="text"  name="titleseo_'.$row['id'].'" value="'.$row['title_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="descriptionseo_'.$row['id'].'" value="'.$row['description_seo'].'"></td>';
                    echo '<td><input style="width:150px;" type="text"  name="keywordsseo_'.$row['id'].'" value="'.$row['keywords'].'"></td>';

                    print '<td><input style="width:80px;" type="text" id="reminder" maxlength='.$max_chars_length.' name="reminder_'.$row['id'].'" value="'.$row['reminder'].'"></td>';
					if($row['disabled']!=1)
					print '<td><span id="del" href="'.$row['id'].'">
  					<img src="img/b_drop.png" alt="Удалить" title="Удалить"></span></td></tr>';
				}
				print '<tr><td class="last" colspan="2"><input type="text" id="new" maxlength='.$max_chars_length.' name="new" value=""> Новый тип</td></tr>';
				 
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
