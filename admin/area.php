<?php
require_once 'lock.php';
// Подключаем заголовок
include "blocks/head.php";
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
?>
<script type="text/javascript" src="js/myscripts.js"></script>

<table  id='rez' height='100%' cellpadding="2" cellspacing="0" class="main">
  <tr>
    <td class="head">
        <?php 
        // Вехнее меню
        $tut = 'area';
        include "blocks/menu.php"; 
        ?>
    </td>
  </tr>
  <tr>
    <td id='content'>
        <div id='actionContent'> 

<?php
$max_chars_length=30;
$db = db :: getInstance();	
$root = $_SERVER['DOCUMENT_ROOT'];
// Подключение к БД
$floor=1;
if(!empty($_GET['floor']))
{
	if($_GET['floor']>0 AND $_GET['floor']<4)
	{
		$floor=$_GET['floor'];
	}
}
$pomeshenie='';
if(!empty($_GET['pomesh']))
{
	$sql='SELECT parent FROM floors WHERE numb<>"106" AND numb<>"202" AND numb<>"210" AND numb<>"332" AND numb<>"333" AND numb<>"336" AND numb<>"337" AND numb="'.$_GET['pomesh'].'"'; 
	$db->query($sql);
	if($db->getCount()>0)
	{
		if($db->getValue()==0)
		{
			$pomeshenie=$_GET['pomesh'];
		}
		else
		{
			$pomeshenie=$db->getValue();
		}
	}
	else
	{
		$pomeshenie='';
	}
	
}
  if(!empty($_GET['pomesh']))
	  {
	  	$sql_select_numb='SELECT * FROM floors WHERE numb<>"106" AND numb<>"202" AND numb<>"210" AND numb<>"332" AND numb<>"333" AND numb<>"336" AND numb<>"337" AND numb="'.$_GET['pomesh'].'"';
		$db->query($sql_select_numb);
		if($db->getCount()>0)
		{
			$est_v_base=true;
		}
	  }
	  else $est_v_base=false;
	  
 if(!empty($_GET['pomesh']) AND ($_GET['pomesh']!=-1) AND ($floor==1 AND $est_v_base==true) OR ($floor==2 AND $est_v_base==true) OR ($floor==3 AND $est_v_base==true)) 
	  {
		$sql_select_='SELECT * FROM embl WHERE room_number="'.$pomeshenie.'" AND temp=0';
		$db->query($sql_select_);
		if($db->getCount()>0)
		{
			$arr=$db->getArray();
			foreach($arr as $index=>$value)
			{
				{
					//1000
					if(file_exists('../img/embl/1000/'.$value['file_name'].'.png'))
							{
											unlink('../img/embl/1000/'.$value['file_name'].'.png'); 
							}
					if(file_exists('../img/embl/1000/'.$value['file_name'].'_m.png'))
							{
											unlink('../img/embl/1000/'.$value['file_name'].'_m.png'); 
							}
					if(file_exists('../img/embl/1000/'.$value['file_name'].'_buble.png'))
							{
											unlink('../img/embl/1000/'.$value['file_name'].'_buble.png'); 
							}
					//1240
						if(file_exists('../img/embl/1240/'.$value['file_name'].'.png'))
							{
											unlink('../img/embl/1240/'.$value['file_name'].'.png'); 
							}
						if(file_exists('../img/embl/1240/'.$value['file_name'].'_m.png'))
							{
											unlink('../img/embl/1240/'.$value['file_name'].'_m.png'); 
							}
					    if(file_exists('../img/embl/1240/'.$value['file_name'].'_buble.png'))
							{
											unlink('../img/embl/1240/'.$value['file_name'].'_buble.png'); 
							}
					//1300
						if(file_exists('../img/embl/1320/'.$value['file_name'].'.png'))
							{
											unlink('../img/embl/1320/'.$value['file_name'].'.png'); 
							}
						if(file_exists('../img/embl/1320/'.$value['file_name'].'_m.png'))
							{
											unlink('../img/embl/1320/'.$value['file_name'].'_m.png'); 
							}
					    if(file_exists('../img/embl/1320/'.$value['file_name'].'_buble.png'))
							{
											unlink('../img/embl/1320/'.$value['file_name'].'_buble.png'); 
							}
					//1440
						if(file_exists('../img/embl/1400/'.$value['file_name'].'.png'))
							{
											unlink('../img/embl/1400/'.$value['file_name'].'.png'); 
							}
						if(file_exists('../img/embl/1400/'.$value['file_name'].'_m.png'))
							{
											unlink('../img/embl/1400/'.$value['file_name'].'_m.png'); 
							}
					    if(file_exists('../img/embl/1400/'.$value['file_name'].'_buble.png'))
							{
											unlink('../img/embl/1400/'.$value['file_name'].'_buble.png'); 
							}
				}
			}
		}
			$sql_delete_temp_zero_='DELETE FROM embl WHERE room_number="'.$pomeshenie.'" AND temp=0';
			$db->query($sql_delete_temp_zero_);
			
			
			//photos
			$sql_select_='SELECT * FROM photos WHERE room_number="'.$pomeshenie.'" AND temp=0';
		$db->query($sql_select_);
		if($db->getCount()>0)
		{
			$arr=$db->getArray();
			foreach($arr as $index=>$value)
			{
				{
					//1000
					if(file_exists('../img/photos/1000/'.$value['file_name'].'.jpg'))
							{
											unlink('../img/photos/1000/'.$value['file_name'].'.jpg'); 
							}
					if(file_exists('../img/photos/1000/'.$value['file_name'].'_p.jpg'))
							{
											unlink('../img/photos/1000/'.$value['file_name'].'_p.jpg'); 
							}
					//1240
						if(file_exists('../img/photos/1240/'.$value['file_name'].'.jpg'))
							{
											unlink('../img/photos/1240/'.$value['file_name'].'.jpg'); 
							}
						if(file_exists('../img/photos/1240/'.$value['file_name'].'_p.jpg'))
							{
											unlink('../img/photos/1240/'.$value['file_name'].'_p.jpg'); 
							}
					//1300
						if(file_exists('../img/photos/1320/'.$value['file_name'].'.jpg'))
							{
											unlink('../img/photos/1320/'.$value['file_name'].'.jpg'); 
							}
						if(file_exists('../img/photos/1320/'.$value['file_name'].'_p.jpg'))
							{
											unlink('../img/photos/1320/'.$value['file_name'].'_p.jpg'); 
							}
					//1440
						if(file_exists('../img/photos/1400/'.$value['file_name'].'.jpg'))
							{
											unlink('../img/photos/1400/'.$value['file_name'].'.jpg'); 
							}
						if(file_exists('../img/photos/1400/'.$value['file_name'].'_p.jpg'))
							{
											unlink('../img/photos/1400/'.$value['file_name'].'_p.jpg'); 
							}
				}
			}
		}
			$sql_delete_temp_zero_='DELETE FROM photos WHERE room_number="'.$pomeshenie.'" AND temp=0';
			$db->query($sql_delete_temp_zero_);
}
echo "<fieldset style='margin: 0 auto;width: 950px;'>";
echo "<form name='form' id='editForm' method='post'>";   
	  //id pomesh
	  //echo "<input type='hidden' name='temp' value='".md5(microtime())."'>";   	    
	  echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:7px;text-align:right;'>Этаж: </div>";  
  	  echo "<select class='float_left' style='width:150px;' name='floors' onchange='changeFloor(this.value)'>";
	        echo ($floor==1) ? "<option value='1' selected='selected'>Первый</option>" : "<option value='1'>Первый</option>";
			echo  ($floor==2) ? "<option value='2' selected='selected'>Второй</option>" : "<option value='2'>Второй</option>";
			echo  ($floor==3) ?  "<option value='3' selected='selected'>Третий</option>" : "<option value='3' >Третий</option>";
	  echo "</select>";
echo "<div class='clear'></div>";
echo "<div id='floor_info'>";

	  echo "<div class='clear'></div>";
	  echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:5px;text-align:right;'>Помещения: </div>";  
  	  echo "<select class='float_left' name='pomesh' onchange='changePomesh(this.value,".$floor.")'>";
	        if(empty($_GET['pomesh'])) { echo "<option value='-1' selected='selected'>Выберите помещение</option>"; }
			else {echo "<option value='-1' >Выберите помещение</option>";}	
	  		$sql='SELECT * FROM floors WHERE numb<>"106" AND numb<>"202" AND numb<>"210" AND numb<>"332" AND numb<>"333" AND numb<>"336" AND numb<>"337" AND floor='.$floor.' ORDER BY numb';
			$db->query($sql);
			if($db->getCount()>0)
			{
				$arr=$db->getArray();
				foreach($arr as $index=>$value)
				{
					$data_id='';
					if($value['parent']=='')
					{
						$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
						$data_id.=$value['numb'];
						$parent=$value['numb'];
						$db->query($sql_get_parent);
						if($db->getCount()>0)
						{
							$mass=$db->getArray();
							foreach($mass as $count=>$val)
							{
								$data_id.=', '.$val['numb'];
							}
						}
						if($pomeshenie==$parent)
						{
							echo "<option value='".$parent."' selected='selected'>".$data_id."</option>";
						}
						else
						{
							echo "<option value='".$parent."' >".$data_id."</option>";
						}
					}

				}
			}
	  echo "</select>";
	  ////занятость
	    echo "<div class='clear'></div>";
	   echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:5px;text-align:right;'> Занятость: </div>";  
	   $disable_select_pomesh='';
	  if(empty($_GET['pomesh']) OR ($_GET['pomesh']==-1) OR ($floor==1 AND $est_v_base==false) OR ($floor==2 AND $est_v_base==false) OR ($floor==3 AND $est_v_base==false)) 
	  {
	  	$disable_select_pomesh="disabled='disabled'";
		echo "<select class='float_left' name='color' ".$disable_select_pomesh.">";

				for($i=0;$i<4;$i++)
				{
					switch ($i)
					{
						case 0:
						$text_color='Белый';
						break;
						case 1:
						$text_color='Зеленый';
						break;
						case 2:
						$text_color='Желтый';
						break;
						case 3:
						$text_color='Голубой';
						break;
					}
					echo "<option value='".$i."'>".$text_color."</option>";
				}

	  echo "</select>";
	  }
	  else { $disable_select_pomesh='';
	  echo "<select class='float_left' name='color' ".$disable_select_pomesh.">";
				$color=0;
				//берем parent где помещение =$_GET['pomesh']
				$sql="SELECT parent,color FROM floors WHERE numb='".$_GET['pomesh']."'";
				$db->query($sql);
				if($db->getCount()>0)
				{
					$arr=$db->getArray();
					if($arr[0]['parent']=='') //если parent=0
					{
						$color=$arr[0]['color'];
					}
					else // иначе берем цвет его родителя
					{
						$sql="SELECT color,parent FROM floors WHERE numb='".$arr[0]['parent']."'";
						$db->query($sql);
						if($db->getCount()>0)
						{
							$arr=$db->getArray();
							$color=$arr[0]['color'];
						}
					}
				}
				for($i=0;$i<4;$i++)
				{
					($color==$i) ? $selected='selected="selected"' : $selected='';
					switch ($i)
					{
						case 0:
						$text_color='Белый';
						break;
						case 1:
						$text_color='Зеленый';
						break;
						case 2:
						$text_color='Желтый';
						break;
						case 3:
						$text_color='Голубой';
						break;
					}
					echo "<option value='".$i."' ".$selected.">".$text_color."</option>";
				}

	  echo "</select>"; 
	  }
     
	 if(!empty($_GET['pomesh']) AND ($_GET['pomesh']!=-1) AND ($floor==1 AND $est_v_base==true) OR ($floor==2 AND $est_v_base==true) OR ($floor==3 AND $est_v_base==true)) 
	  {
	  /////select parent
	  $sql='SELECT * FROM floors WHERE numb="'.$_GET['pomesh'].'"';
	  $db->query($sql);
	  if($db->getCount()>0)
	  {
	  	$parent=$db->getArray();
        echo "<div class='clear'></div>";	
	    echo "<div class='float_left preview_text' style='width: auto;'>Последняя дата изменения в истории цен:</div>";
        $sql_history="SELECT date_update FROM history WHERE floor=".$floor." AND numb='".$_GET['pomesh']."' ORDER BY date_update DESC LIMIT 1";
        $db->query($sql_history);
        if($db->getCount()>0)
        {
           $date=explode(' ',$db->getValue());
           $date=explode('-',$date[0]);
           echo "<div class='float_left preview_text' style='text-align:left;'>".$date[2].".".$date[1].".".$date[0]."</div>"; 
        }
        else
        {
            echo "<div class='float_left preview_text' style='text-align:left;'>Данные отсутствуют</div>"; 
        }
	    ////
		if($parent[0]['parent']=='') //если родителей нет
		{
		      
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Квадратура:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text'  name='kvadrat' id='kvadrat' ".$disable_select_pomesh." value='".$parent[0]['kvadrat']."'>";
			  echo "<div class='float_left' style='line-height:25px;'>кв.м</div>";
			  ////
			 
			  ////////сайт
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text' >Сайт:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text'  name='site' id='site' ".$disable_select_pomesh." value='".$parent[0]['site']."'>";
			  ////////название компании
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text' >Торговая марка:</div>";
			  echo "<input class='float_left ' style='width:600px;' input type='text' maxlength=".$max_chars_length." name='name_company' id='name_company' ".$disable_select_pomesh." value='".$parent[0]['name_company']."'>";
			  echo "<div class='clear'></div>";
			  //отображать развернутую информацию
			  if($parent[0]['plus_m']==1)
			  {
			  	$checked_plus_m='checked="checked"';
			  }
			  else
			  {
			  	$checked_plus_m='';
			  }
			  echo "<div class='float_left preview_text' >Отображать развернутую информацию:</div>";
			  echo '<input class="float_left" type="checkbox" id="plus_m" name="plus_m" '.$checked_plus_m.' title="отображать развернутую информацию">';
			  echo "<div class='clear'></div>";
			  echo "<div class='float_left help preview_text' style='line-height:15px;'>Телефоны должны записываться в формате: +38 (050) 620-71-16</div>";
			  ////////phone1
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 1: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone1' id='phone1' ".$disable_select_pomesh." value='".$parent[0]['phone1']."'>";
			   ////////phone2
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text' >Телефон 2: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone2' id='phone2' ".$disable_select_pomesh." value='".$parent[0]['phone2']."'>";
			   ////////phone3
			 /* echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 3: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone3' id='phone3' ".$disable_select_pomesh." value='".$parent[0]['phone3']."'>";
			  */
		}
		else //выбираем родителя
		{
			  $sql_parent='SELECT * FROM floors WHERE numb="'.$parent[0]['parent'].'"';
			  $db->query($sql_parent);
			  if($db->getCount()>0)
			  {
			  	$parent=$db->getArray();
				 echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Квадратура:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text'  name='kvadrat' id='kvadrat' ".$disable_select_pomesh." value='".$parent[0]['kvadrat']."'>";
			  echo "<div class='float_left' style='line-height:25px;'>кв.м</div>";
				////////сайт
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Сайт:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text'  name='site' id='site' ".$disable_select_pomesh." value='".$parent[0]['site']."'>";
			  ////////название компании
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Торговая марка:</div>";
			  echo "<input class='float_left' style='width:600px;' maxlength=".$max_chars_length." input type='text'  name='name_company' id='name_company' ".$disable_select_pomesh." value='".$parent[0]['name_company']."'>";
			 
			  echo "<div class='clear'></div>";
			    //отображать развернутую информацию
			  if($parent[0]['plus_m']==1)
			  {
			  	$checked_plus_m='checked="checked"';
			  }
			  else
			  {
			  	$checked_plus_m='';
			  }
			  echo "<div class='float_left preview_text' >Отображать развернутую информацию:</div>";
			  echo '<input class="float_left" type="checkbox" id="plus_m" name="plus_m" '.$checked_plus_m.' '.$disable_select_pomesh.' title="отображать развернутую информацию">';
			  echo "<div class='clear'></div>";
			  echo "<div class='float_left help preview_text' style='line-height:15px;'>Телефоны должны записываться в формате: +38 (050) 620-71-16</div>";
				 ////////phone1
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 1: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone1' id='phone1' ".$disable_select_pomesh." value='".$parent[0]['phone1']."'>";
			   ////////phone2
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 2: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone2' id='phone2' ".$disable_select_pomesh." value='".$parent[0]['phone2']."'>";
			   ////////phone3
			  /*echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 3: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone3' id='phone3' ".$disable_select_pomesh." value='".$parent[0]['phone3']."'>";
				*/
			  }    

		}
	  }
	  }	
	  else
	  {
	  		 echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text' >Квадратура:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text'  name='kvadrat' id='kvadrat' ".$disable_select_pomesh." value=''>";
			  echo "<div class='float_left' style='line-height:25px;'>кв.м</div>";
				  ////////сайт
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Сайт:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text'  name='site' id='site' ".$disable_select_pomesh." value=''>";
			  ////////название компании
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Торговая марка:</div>";
			  echo "<input class='float_left' style='width:600px;' input type='text' maxlength=".$max_chars_length." name='name_company' id='name_company' ".$disable_select_pomesh." value=''>";
			  
			  echo "<div class='clear'></div>";
			  //отображать развернутую информацию
			  echo "<div class='float_left preview_text' >Отображать развернутую информацию:</div>";
			  echo '<input class="float_left" type="checkbox" id="plus_m" name="plus_m" checked="checked" '.$disable_select_pomesh.' title="отображать развернутую информацию">';
			  echo "<div class='clear'></div>";
			  echo "<div class='float_left help preview_text' style='line-height:15px;'>Телефоны должны записываться в формате: +38 (050) 620-71-16</div>";
			  ////////phone1
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 1: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone1' id='phone1' ".$disable_select_pomesh." value=''>";
			   ////////phone2
			  echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 2: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone2' id='phone2' ".$disable_select_pomesh." value=''>";
			   ////////phone3
			 /* echo "<div class='clear'></div>";	
			  echo "<div class='float_left preview_text'>Телефон 3: </div>";
			  echo "<input class='float_left' style='width:400px;' input type='text'  name='phone3' id='phone3' ".$disable_select_pomesh." value=''>";
			*/
	  }
	  
echo "</div>";
//добавить категорию
 echo "<div class='clear'></div>";
 echo "<div id='replace_all_category'>";
  echo "<div class='float_left preview_text'>Категории : </div>";  
	   $disable_select_pomesh='';
	   
	  if(empty($_GET['pomesh']) OR ($_GET['pomesh']==-1) OR ($floor==1 AND $est_v_base==false) OR ($floor==2 AND $est_v_base==false) OR ($floor==3 AND $est_v_base==false)) 
	  {
	  	$disable_select_pomesh="disabled='disabled'";
		echo "<select class='float_left' name='category' ".$disable_select_pomesh.">";
			  	
	    echo "</select>";
	  }
	  else { $disable_select_pomesh='';
	  echo "<select class='float_left' name='category' ".$disable_select_pomesh.">";
	                $sql_select_from_type_for_pomesh_='SELECT id_group FROM type_for_pomesh WHERE pomesh="'.$pomeshenie.'"';
	                $db->query($sql_select_from_type_for_pomesh_);
	                $dataaaaa='';
	                if($db->getCount()>0)
	                {
	                	$arr=$db->getArray();
						foreach($arr as $index=>$val)
						{
							if($index==0) { $dataaaaa.=$val['id_group'];}
							else  $dataaaaa.=', '.$val['id_group'];
						}
	                }
					if(!empty($dataaaaa))
					{
						 $sql_all_type='SELECT ty.title,ty.id FROM type as ty, type_for_pomesh as t WHERE ty.id not in ('.$dataaaaa.')AND t.pomesh="'.$pomeshenie.'" GROUP BY ty.title ORDER BY ty.reminder ASC';
					}
					else
					{
						$sql_all_type='SELECT * FROM type ORDER BY reminder';//все категории
					}
					$db->query($sql_all_type);
					if($db->getCount()>0)
					{
						$arr=$db->getArray();
						foreach($arr as $index=>$val)
						{
							echo "<option value='".$val['id']."'>".$val['title']."</option>";
						}
					}
					
	  echo "</select>";
	  }
 
	  if(empty($_GET['pomesh']) OR ($_GET['pomesh']==-1) OR ($floor==1 AND $est_v_base==false) OR ($floor==2 AND $est_v_base==false) OR ($floor==3 AND $est_v_base==false)) {$disable_select_pomesh="disabled='disabled'";}
	  else { $disable_select_pomesh=''; }
      echo "<input type='button' value='Добавить' ".$disable_select_pomesh." class='float_left' style='margin-top: 4px;'>";
      echo "<div class='clear'></div>";
	  //редатировать категории
	    echo "<div id='edit_category'>";
	    echo "<div  class='float_left preview_text'>Редактировать категории: </div>";
		
	   if(!empty($_GET['pomesh']) AND ($_GET['pomesh']!=-1) AND ($floor==1 AND $est_v_base==true) OR ($floor==2 AND $est_v_base==true) OR ($floor==3 AND $est_v_base==true))
	        //if(!empty($_GET['pomesh']) AND $_GET['pomesh']!=-1)
			{
				$sql='SELECT  ty.title, t.id FROM type_for_pomesh as t, type as ty WHERE t.pomesh="'.$pomeshenie.'" AND  t.id_group=ty.id GROUP BY title';
			    $db->query($sql);
				if($db->getCount()>0)
					{
						print '<div class="float_left" style="line-height:30px;">';
						$arr=$db->getArray();
							foreach($arr as $index=>$value)
							{
								//достаем название категорий
								if($index+1==count($arr))
								{
									$coma='';
								}
								else
								{
									$coma=', ';
								}
								print $value['title'].$coma."<span><img title='Удалить' class='del_category' style='cursor:pointer;' data-id='".$value['id']."' src='img/b_drop.png' />";
							}

						print '</div>';
					}
				
			}		
echo "</div>";
echo "</div>";	
echo "<div class='clear'></div>";
   //////new
  if(!empty($_GET['pomesh']) AND ($_GET['pomesh']!=-1) AND ($floor==1 AND $est_v_base==true) OR ($floor==2 AND $est_v_base==true) OR ($floor==3 AND $est_v_base==true))
			  {
			  	
				   echo "<div class='float_left preview_text'>Описание:</div>";
				   echo "<div class='float_left' style='width:600px;'>";
				   $editorClass = new editorClass();
				   $sql='SELECT * FROM floors WHERE numb="'.$pomeshenie.'"';
				   $db->query($sql);
				   if($db->getCount()>0)
				     {
				     	$arr=$db->getArray();
						$description = $editorClass->replaceToDraw($arr[0]['description']);
					 }
				   else {$description = '';}
					
					$editorClass->drawEditor('description', $description);
 				  echo "</div>";
 				  echo "<div class='clear'></div>";
				  echo "<div class='preview_text' style='text-decoration:underline;'>РУКОВОДИТЕЛЯМ</div>";
				    echo "<div class='clear'></div>";
			  	  $sql='SELECT * FROM floors WHERE numb="'.$pomeshenie.'"';
				  $db->query($sql);
				 
				  if($db->getCount()>0)
				  {
				  	 $parent=$db->getArray();
					  echo "<div class='float_left preview_text'>Стоимость:</div>";
			         echo "<input class='float_left' style='width:600px;' input type='text'  name='price' id='price' ".$disable_select_pomesh." value='".$parent[0]['price']."'>";
			         echo "<div class='float_left' style='line-height:25px;' >грн.кв.м</div>";
					 
					 ////discount
					  echo "<div class='float_left preview_text'>Скидка:</div>";
					 echo "<input class='float_left' style='width:600px;' input type='text'  name='discount' id='discount' ".$disable_select_pomesh." value='".$parent[0]['discount']."'>";
			         echo "<div class='float_left' style='line-height:25px;' > %</div>";
				  }
				    echo "<div class='clear'></div>";
				
				////////фирма орендатора
				  $sql='SELECT c.namecontr,d.namedcontr FROM dcontr as d,contr as c,debtonrent as de WHERE c.idcontr=d.idcontr AND d.numbersq="'.$pomeshenie.'" ORDER BY de.month DESC LIMIT 1';
                  $db->query($sql);
				   
				  if($db->getCount()>0 AND $color!=0)
				  {
				  	 $arr=$db->getArray();	
                     if(!empty($arr[0]['namecontr']))
                     {
                        echo "<div class='float_left preview_text'>Фирма орендатора:</div>";
                         echo "<div class='float_left' style='line-height:25px;'>".$arr[0]['namecontr']."</div>";
     	                   echo "<div class='clear'></div>";
                     }
					
                     if(!empty($arr[0]['namedcontr']))
                     {
                        echo "<div class='float_left preview_text' > Номер договора:</div>";
                        echo "<div class='float_left' style='line-height:25px;'>".$arr[0]['namedcontr']."</div>";
                     }
					 
					 
				  }
 				
				
				  ///акт приема передачи
				  $sql='SELECT * FROM floors WHERE numb="'.$pomeshenie.'" AND floor='.$floor;
			$db->query($sql);
			if($db->getCount()>0)
				{
					    $arr=$db->getArray();
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Акт приема передачи: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='act' id='act' ".$disable_select_pomesh." value='".$arr[0]['act']."'>";
						//email
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Email: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='email' id='email' ".$disable_select_pomesh." value='".$arr[0]['email']."'>";
						//contacts_face
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Контактное лицо: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='contacts_face' id='contacts_face' ".$disable_select_pomesh." value='".$arr[0]['contacts_face']."'>";
						//phone_contacts_face
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Телефоны контактного лица: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='phone_contacts_face' id='phone_contacts_face' ".$disable_select_pomesh." value='".$arr[0]['phone_contacts_face']."'>";
						//comment
						echo "<div class='clear'></div>";
				        echo "<div class='float_left preview_text'>Примечание:</div>";
				   		echo "<div class='float_left'>";
					   $sql='SELECT * FROM floors WHERE numb="'.$pomeshenie.'"';
					   $db->query($sql);
					   if($db->getCount()>0)
					     {
					     	$arr=$db->getArray();
							
							$comment =$arr[0]['comment'];
							print '<textarea style="margin-top: 8px;max-height: 250px;height: 250px;max-width:600px;width:600px;" name="comment" id="comment" '.$disable_select_pomesh.'>'.$comment.'</textarea>';
						 }
 				 	     echo "</div>";	
						 
						 ////logo
						echo "<div class='clear'></div>";
						echo "<div>";
						
						echo "<div class='float_left preview_text'>Логотип:<div class=' help_'>".$text_baner."</div></div>";
						
						echo "<div class='text_align_left'>";
						   echo "<input type='file'  name='image' ".$disable_select_pomesh." accept='image/jpg'> ";
						   	echo "<input type='submit' id='load_image' ".$disable_select_pomesh." value='Загрузить лого'>";
							echo "<span id='img_loader_photo'></span>";
						echo "</div>";
						echo "</div>";
						echo "<div class='clear'></div>";
						
						
						echo "<div class='float_left preview_text'>&nbsp;</div>";
						echo "<div class='text_align_left'>";
							echo "<div id='loaded_image' class='float_left'>";
							   $sql='SELECT * FROM embl WHERE room_number="'.$pomeshenie.'" AND temp=1';
							   $db->query($sql);
							   if($db->getCount()>0)
							     {
							     		$arr=$db->getArray();
										print '<img src="../../../img/embl/1000/'.$arr[0]['file_name'].'.png" style="float:left;width:150px;height:100px;"><a href="#" id="del_embl" data-id="'.$arr[0]['id'].'"><img src="img/b_drop.png" title="удалить"/></a>';
								 }
							echo "</div>";
						echo "</div>";
						//фото
						
						echo "<div class='clear'></div>";
						echo "<div class='margin_top_20'>";
						
						echo "<div class='clear'></div>";
						echo "<div class='float_left preview_text'>Фото:<div class='help_'>".$text_photo."</div></div>";
						echo "<div class='text_align_left'>";
						   echo "<input type='file' name='image_preview[]' multiple='' ".$disable_select_pomesh." accept='image/jpg'>";
						   	echo "<input type='submit' id='load_image_preview' ".$disable_select_pomesh." value='Загрузить фото'>";
							echo "<span id='img_loader_photo_preview'></span>";
						echo "</div>";
						echo "</div>";
						
						echo "<div class='clear'></div>";
						   //echo "<div class='float_left preview_text'>&nbsp;</div>";
							echo "<div id='loaded_image_preview'>";
							 $sql='SELECT * FROM photos WHERE room_number="'.$pomeshenie.'"';
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
							echo "</div>";
						
				}
				
				  
			  }
else
	{
		       $disable_select_pomesh="disabled='disabled'";
		       echo "<div class='float_left preview_text'>Описание:</div>";
				   echo "<div class='float_left' style='width:600px;'>";
					$editorClass = new editorClass();
					$description = $editorClass->replaceToDraw('');
					$editorClass->drawEditor('description', $description, 'disabled="disabled"');
 				  echo "</div>";
 				  echo "<div class='clear'></div>";
				  echo "<div class='preview_text' style='text-decoration:underline;'>РУКОВОДИТЕЛЯМ</div>";
				    echo "<div class='clear'></div>";

				  echo "<div class='float_left preview_text'>Стоимость:</div>";

			         echo "<input class='float_left' style='width:600px;' input type='text' ".$disable_select_pomesh." name='price' id='price' ".$disable_select_pomesh." value=''>";
			         echo "<div class='float_left' style='line-height:25px;' >грн.кв.м</div>";
			
			 		 ////discount
			 		 echo "<div class='float_left preview_text'>Скидка:</div>";
					 echo "<input class='float_left' style='width:600px;' input type='text'  name='discount' id='discount' ".$disable_select_pomesh." value=''>";
			         echo "<div class='float_left' style='line-height:25px;' > %</div>";
			         
				     echo "<div class='clear'></div>";
					 echo "<div class='float_left preview_text'>Фирма орендатора:</div>";	
					 echo "<div class='float_left' style='line-height:25px;'></div>";
					 echo "<div class='clear'></div>";
					 echo "<div class='float_left preview_text' > Номер договора:</div>";	
					 echo "<div class='float_left' style='line-height:25px;'></div>";

						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Акт приема передачи: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='act' id='act' ".$disable_select_pomesh." value=''>";
						//email
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Email: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='email' id='email' ".$disable_select_pomesh." value=''>";
						//contacts_face
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Контактное лицо: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='contacts_face' id='contacts_face' ".$disable_select_pomesh." value=''>";
						//phone_contacts_face
						echo "<div class='clear'></div>";
						echo "<div  class='float_left preview_text' >Телефоны контактного лица: </div>";
						echo "<input class='float_left' style='width:600px;' input type='text'  name='phone_contacts_face' id='phone_contacts_face' ".$disable_select_pomesh." value=''>";
				        //comment
						echo "<div class='clear'></div>";
				        echo "<div class='float_left preview_text'>Примечание:</div>";
				   		echo "<div class='float_left'>";
						print '<textarea style="margin-top: 8px;max-height: 250px;height: 250px;max-width:600px;width:600px;" name="comment" id="comment" '.$disable_select_pomesh.' value=""></textarea>';
 				 	    echo "</div>";
						
						////logo
						echo "<div class='clear'></div>";
						echo "<div>";
						
						echo "<div class='float_left preview_text'>Логотип:<div class=' help_'>".$text_baner."</div></div>";
						
						echo "<div class='text_align_left'>";
						   echo "<input type='file'  name='image' ".$disable_select_pomesh." accept='image/jpg'> ";
						   	echo "<input type='submit' id='load_image' ".$disable_select_pomesh." value='Загрузить лого'>";
							echo "<span id='img_loader_photo'></span>";
						echo "</div>";
						echo "</div>";
						    echo "<div class='float_left preview_text'>&nbsp;</div>";
							echo "<div id='loaded_image' class='float_left'></div>";
						//фото
						
						echo "<div class='clear'></div>";
						echo "<div class='margin_top_20'>";
						
						
						echo "<div class='float_left preview_text'>Фото:<div class=' help_ '>".$text_photo."</div></div>";
						echo "<div class='text_align_left'>";
						   echo "<input type='file' name='image_preview[]' multiple='' ".$disable_select_pomesh." accept='image/jpg'>";
						   	echo "<input type='submit' id='load_image_preview' ".$disable_select_pomesh." value='Загрузить фото'>";
							echo "<span id='img_loader_photo_preview'></span>";
						echo "</div>";
						echo "</div>";
						
						   echo "<div class='clear'></div>";
						  // echo "<div class='float_left preview_text'>&nbsp;</div>";
							echo "<div id='loaded_image_preview'></div>";

						
						
}	

//
echo "<div class='clear'></div>";
  if(empty($_GET['pomesh']) OR ($_GET['pomesh']==-1) OR ($floor==1 AND $est_v_base==false) OR ($floor==2 AND $est_v_base==false) OR ($floor==3 AND $est_v_base==false)) {$disable_select_pomesh="disabled='disabled'";}
  else { $disable_select_pomesh=''; }
echo "<input class='margin_top_50' type='submit' value='Сохранить' ".$disable_select_pomesh.">";
echo "</form>";
echo "</fieldset>";
?>
<span id='progress-form'></span>
        </div>
    </td>
  </tr>
  <tr>
    <td class="foot" colspan='2'>
	<?php
            // Подключаем создателя
            include ("blocks/creator.php");
        ?>	
    </td>
  </tr>
</table>
<script type="text/javascript">
  function changeFloor(variable)
  {
  	var isMSIE = /*@cc_on!@*/false;
	(isMSIE ) ? window.location.href('area.php?floor='+variable ) : window.location.href ='area.php?floor='+variable;
  } 
  function changePomesh(variable,floor)
  {
  	var isMSIE = /*@cc_on!@*/false;
	if( isMSIE ) window.location.href('area.php?floor='+floor+'&pomesh='+variable );
 	else window.location.href ='area.php?floor='+floor+'&pomesh='+variable;
  }
    $('.del_pomesh').bind('click',function()
   {
   	var pom='<? echo $_GET['pomesh']?>';
   	var floor_='<? echo $_GET['floor']?>';
    $.ajax({
		url: 'ajax/area/del.php',
		type: "POST",  
		data: {numb:$(this).attr('data-id'),floor:floor_,pomesh: pom},
		success: function(data)
		{
			var isMSIE = /*@cc_on!@*/false;
			if( isMSIE )
			{
				if(pom!='')
		 		{
		 			window.location.href('area.php?floor='+floor_+'&pomesh='+pom );
		 		}
		 		else
		 		{
		 			window.location.href ='area.php';
		 		}
			} 
		 	else {
		 		if(pom!='')
		 		{
		 			window.location.href ='area.php?floor='+floor_+'&pomesh='+pom;
		 		}
		 		else
		 		{
		 			window.location.href ='area.php';
		 		}
		 	}
		 	
		}
	});
   	return false;
   })

    var optionsUpdate = {
        url:    "ajax/area/save.php",
        beforeSubmit: function(jqForm) { // Здесь проверяем данные формы
        	
            $('#progress-form').text('Обновление данных...');
        },
        success: function(responseText) {
        	 $('#progress-form').text('');
        	  if (responseText.indexOf("red") == -1) { 
        	 		var pom='<? echo $_GET['pomesh']?>';
		        	var floor_='<? echo $_GET['floor']?>';
		            var isMSIE = /*@cc_on!@*/false;
						if( isMSIE )
						{
							if(pom!='')
					 		{
					 			window.location.href('area.php?floor='+floor_+'&pomesh='+pom );
					 		}
					 		else
					 		{
					 			window.location.href ='area.php';
					 		}
						} 
					 	else {
					 		if(pom!='')
					 		{
					 			window.location.href ='area.php?floor='+floor_+'&pomesh='+pom;
					 		}
					 		else
					 		{
					 			window.location.href ='area.php';
					 		}
					 	}
        	 	 }
            else
            {
            	alert(responseText.replace(/<.*?>/g, ''));
            }
        	
        }
    };

    $('#editForm').submit(function() { 
        $(this).ajaxSubmit(optionsUpdate); 
            return false;

    });  
    
    //add category
    $('input[type=button]').live('click',function() {
    	    var optionsUpdate = {
        url:    "ajax/area/save_category.php",
        beforeSubmit: function(jqForm) { // Здесь проверяем данные формы
            $('#progress-form').text('Обновление данных...');
        },
        success: function(responseText) { // Здесь проверяем ответ
        	$('#replace_all_category').replaceWith(responseText);
        	 $('#progress-form').text('');
        }
    };
        $('#editForm').ajaxSubmit(optionsUpdate); 
    })
    ///del category
    $('.del_category').live('click',function ()
    {
    	var href=$(this).attr('data-id');
    	$.post("ajax/area/del_category.php", {id:href}, function(data){
   				  $('#replace_all_category').replaceWith(data);
			   })
    })
    
    
    //logo
  $('#load_image').live('click',function ()
   {
   	    var optionsUpdate2 = {
        url:    "ajax/area/save_banner.php",
        beforeSubmit: function(jqForm) { 
        	$('input[type=submit],input#load_image,input#load_image_preview').attr('disabled','disabled');
        	$('#img_loader_photo').replaceWith("<span id='img_loader_photo'><img style='margin-bottom:-3px;' src='../admin/img/ajax-loader.gif'/> Подождите идет загрузка фото</div>");
        },
        success: function(responseText) { 
        		$('#img_loader_photo').replaceWith("<span id='img_loader_photo'></span>");
        	 if (responseText.indexOf("red") == -1) { 
        	 	
        	 	 $('#loaded_image').replaceWith('<div id="loaded_image" class="float_left">'+responseText+'</div>'); 
        	 	 }
            else
            {
            	alert(responseText.replace(/<.*?>/g, ''));
            }
            $('#load_image').attr('value','Заменить')
            $('input[type=submit],input#load_image,input#load_image_preview').attr('disabled',false);
        }
    };

        $("#editForm").ajaxSubmit(optionsUpdate2); 
        return false;
   })
    //
    $('#del_embl').live('click',function ()
    {
    	var data_id=$(this).attr('data-id');
    	$.post("ajax/area/del_embl.php", {id:data_id}, function(data){
    		   	 $('#loaded_image').replaceWith('<div id="loaded_image" class="float_left"></div>');
			   })
	 	return false;
    })
    //preview
    $('#load_image_preview').live('click',function ()
   {
   	    var optionsUpdate2 = {
        url:    "ajax/area/save_photos.php",
        beforeSubmit: function(jqForm) { 
        	$('input[type=submit],input#load_image,input#load_image_preview').attr('disabled','disabled');
        	$('#img_loader_photo_preview').replaceWith("<span id='img_loader_photo_preview'><img style='margin-bottom:-3px;' src='../admin/img/ajax-loader.gif'/> Подождите идет загрузка фото</div>");
        },
        success: function(responseText) { 
        		$('#img_loader_photo_preview').replaceWith("<span id='img_loader_photo_preview'></span>");
        	 if (responseText.indexOf("red") == -1) { 
        	 	
        	 	 $('#loaded_image_preview').replaceWith('<div id="loaded_image_preview">'+responseText+'</div>'); 
        	 	  $('#load_image').attr('value','Заменить')
        	 	 }
            else
            {
            	alert(responseText.replace(/<.*?>/g, ''));
            }
           
            $('input[type=submit],input#load_image,input#load_image_preview').attr('disabled',false);
        }
    };

        $("#editForm").ajaxSubmit(optionsUpdate2); 
        return false;
   })
   //del_photo
    $('#del_photo').live('click',function ()
    {
    	var data_id=$(this).attr('data-id');
    	$.post("ajax/area/del_photos.php", {id:data_id}, function(data){
    		   	 $('#loaded_image_preview').replaceWith('<div id="loaded_image_preview">'+data+'</div>'); 
			   })
	 	return false;
    })
    //checkbox
    $("#loaded_image_preview :checkbox").live('click',function (){
    	var length_on_check=$("#loaded_image_preview input:checked").length;
    	if(length_on_check>3)
    	{
    		return false;
    	}
       
      })
 </script>
             