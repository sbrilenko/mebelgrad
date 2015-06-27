<?php
require_once 'lock.php';
include "blocks/head.php";
$root = $_SERVER[DOCUMENT_ROOT];
require_once $root."/admin/blocks/include.php";
?>

<table  id='rez' height='100%' cellpadding="2" cellspacing="0" class="main">
  <tr>
    <td class="head">
        <?php 
        // Вехнее меню
        $tut = 'plan';
        include "blocks/menu.php"; 
        ?>
    </td>
  </tr>
  <tr>
    <td id='content'>
        <div id='actionContent'> 
<?php
$db = db :: getInstance();	
$root = $_SERVER['DOCUMENT_ROOT'];
// Подключение к БД
$floor=1;
$color_of_place='';
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
	$sql='SELECT parent FROM floors WHERE numb="'.$_GET['pomesh'].'"'; 
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
echo "<fieldset style='margin: 0 auto;width: 950px;'>";
echo "<form name='form' id='editForm' method='post'>";      
	  echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:7px;text-align:right;'>Этаж: </div>";  
  	  echo "<select class='float_left' style='width:150px;' name='floors' onchange='changeFloor(this.value)'>";
	        echo ($floor==1) ? "<option value='1' selected='selected'>Первый</option>" : "<option value='1'>Первый</option>";
			echo  ($floor==2) ? "<option value='2' selected='selected'>Второй</option>" : "<option value='2'>Второй</option>";
			echo  ($floor==3) ?  "<option value='3' selected='selected'>Третий</option>" : "<option value='3' >Третий</option>";
	  echo "</select>";
echo "<div class='clear'></div>";
 echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:5px;text-align:right;'>Помещения: </div>";  
  	  echo "<select class='float_left' name='pomesh' onchange='changePomesh(this.value,".$floor.")'>";
	  		if(empty($_GET['pomesh'])) { echo "<option value='-1' selected='selected'>Выберите помещение</option>"; }
			else {echo "<option value='-1' >Выберите помещение</option>";}		
	  		$sql='SELECT * FROM floors WHERE  numb<>"106" AND numb<>"202" AND numb<>"210" AND numb<>"332" AND numb<>"333" AND numb<>"336" AND numb<>"337" AND  floor='.$floor.' ORDER BY numb';
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
	  echo "<div class='clear'></div>";	 
	  echo "<div id='add_' style='width:540px;float:right;'></div>";
	  echo "<div class='clear'></div>";	
	  echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:5px;text-align:right;' >Обьединить с: </div>";  
	  $disable_select_pomesh='';
	  //есть ли такое помещение
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
	  
	  if(empty($_GET['pomesh']) OR ($_GET['pomesh']==-1) OR ($floor==1 AND $est_v_base==false) OR ($floor==2 AND $est_v_base==false) OR ($floor==3 AND $est_v_base==false)) {$disable_select_pomesh="disabled='disabled'";}
	  else { $disable_select_pomesh=''; }
  	  echo "<select class='float_left' name='add' ".$disable_select_pomesh.">";
	  		if(empty($pomeshenie) OR $pomeshenie==-1)
			{
				$max_record='SELECT COUNT(id) FROM floors  WHERE floor='.$floor.' AND color=0 AND parent=""';
				
				$db->query($max_record);
				$sql='SELECT * FROM floors WHERE floor='.$floor.' AND color=0 AND parent="" ORDER BY numb LIMIT 0, '.$db->getValue();	
			}
			else 
			{
				$sql='SELECT * FROM floors WHERE floor='.$floor.' AND numb<>"106" AND numb<>"202" AND numb<>"210" AND numb<>"332" AND numb<>"333" AND numb<>"336" AND numb<>"337" AND  numb<>"'.$pomeshenie.'" AND parent<>"'.$pomeshenie.'" ORDER BY numb';
			}
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
      if(empty($_GET['pomesh']) OR ($_GET['pomesh']==-1) OR ($floor==1 AND $est_v_base==false) OR ($floor==2 AND $est_v_base==false) OR ($floor==3 AND $est_v_base==false)) {$disable_select_pomesh="disabled='disabled'";}
	  else { $disable_select_pomesh=''; }
	  echo "<input type='submit' class='float_left' style=' margin-top: 4px;' value='Обьединить' ".$disable_select_pomesh.">";
	  
	  echo "<div class='clear'></div>";
	  //удаление всех детей
	   echo "<div class='float_left' style='width:400px;line-height: 30px;margin-right:7px;text-align:right;'>Редактировать помещения: </div>";
	   if(!empty($_GET['pomesh']) AND ($_GET['pomesh']!=-1) AND ($floor==1 AND $est_v_base==true) OR ($floor==2 AND $est_v_base==true) OR ($floor==3 AND $est_v_base==true))
	        //if(!empty($_GET['pomesh']) AND $_GET['pomesh']!=-1)
			{
				if(!empty($pomeshenie))
				{
					$sql='SELECT  * FROM floors WHERE floor='.$floor.' AND numb="'.$pomeshenie.'" ORDER BY numb';
				}
				else
				{
					$sql='SELECT * FROM floors WHERE floor='.$floor.' ORDER BY numb';
				}
			$db->query($sql);
				if($db->getCount()>0)
					{
						print '<div class="float_left" style="line-height:30px;">';
						$arr=$db->getArray();
						if(!empty($pomeshenie))
						{
							foreach($arr as $index=>$value)
							{
								$data_id='';
								if($value['parent']==0)
								{
									$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
									$parent=$value['numb'];
									$db->query($sql_get_parent);
									print '<span>'.$parent.'</span>';
									if($db->getCount()>0)
									{
										$mass=$db->getArray();
										$data_id=$parent;
										
										foreach($mass as $count=>$val)
										{
											if($pomeshenie==$parent)
												{
														echo "<span >, ".$val['numb']."</span><span><img title='Удалить' class='del_pomesh' style='cursor:pointer;' data-id='".$val['numb']."' src='img/b_drop.png' /></span>";
												}
										}
									}	
								}
							}
						}
						else
						{
							foreach($arr as $index=>$value)
							{
								$data_id='';
								if($value['parent']=='')
								{
									$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
									$parent=$value['numb'];
									$db->query($sql_get_parent);
									
									if($db->getCount()>0)
									{
										print '<span>'.$parent.'</span>';
										$mass=$db->getArray();
										$data_id=$parent;
										
										foreach($mass as $count=>$val)
										{
											
														echo "<span >, ".$val['numb']."</span><span><img title='Удалить' class='del_pomesh' style='cursor:pointer;' data-id='".$val['numb']."' src='img/b_drop.png' /></span>";
										
										}
										break;
									}	
								}	
								
							}
						}
						
						print '</div>';
					}
			}
			
			echo '<div class="clear"></div>';
			///////
			//checked
	echo '<div id="set_parent">';
	   echo "<div class='float_left'  style='width:400px;line-height: 30px;margin-right:7px;text-align:right;'>Назначить родителя: </div>";
	   if(!empty($_GET['pomesh']) AND ($_GET['pomesh']!=-1) AND ($floor==1 AND $est_v_base==true) OR ($floor==2 AND $est_v_base==true) OR ($floor==3 AND $est_v_base==true))
	        //if(!empty($_GET['pomesh']) AND $_GET['pomesh']!=-1)
			{
				if(!empty($pomeshenie))
				{
					$sql='SELECT  * FROM floors WHERE floor='.$floor.' AND numb="'.$pomeshenie.'" ORDER BY numb';
				}
				else
				{
					$sql='SELECT * FROM floors WHERE floor='.$floor.' ORDER BY numb';
				}
				$db->query($sql);
				if($db->getCount()>0)
					{
						print '<div class="float_left" style="line-height:30px;">';
						$arr=$db->getArray();
						if(!empty($pomeshenie))
						{
							foreach($arr as $index=>$value)
							{
								$data_id='';
								if($value['parent']==0)
								{
									$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
									$parent=$value['numb'];
									$db->query($sql_get_parent);
									//print '<span>'.$parent.'</span>';
									echo "<span >".$parent."</span><span><input type='checkbox' data-id='$parent' alt='$parent'  checked='checked' name='check_$parent' style='margin-left:5px;' title='поставить глвным'></span>";
									if($db->getCount()>0)
									{
										$mass=$db->getArray();
										$data_id=$parent;
										foreach($mass as $count=>$val)
										{
											if($pomeshenie==$parent)
												{
														echo "<span >, $val[numb]</span><span><input type='checkbox' data-id='$val[numb]' alt='$parent' style='margin-left:5px;' name='check_$val[numb]' title='поставить глвным'></span>";
												}
											
										}
									}	
								}
							}
						}
						else
						{
							foreach($arr as $index=>$value)
							{
								$data_id='';
								if($value['parent']=='')
								{
									$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
									$parent=$value['numb'];
									$db->query($sql_get_parent);
									
									if($db->getCount()>0)
									{
										echo "<span >".$parent."</span><span><input type='checkbox' name='check_$parent' data-id='$parent' alt='$parent' checked='checked' style='margin-left:5px;' title='поставить глвным'></span>";
										//print '<span>'.$parent.'</span>';
										$mass=$db->getArray();
										$data_id=$parent;
										
										foreach($mass as $count=>$val)
										{
											
											echo "<span >, $val[numb]</span><span><input type='checkbox' name='check_$val[numb]' alt='$parent' data-id='$val[numb]' style='margin-left:5px;' title='поставить глвным'></span>";
											//echo "<span >, ".$val['numb']."</span><span><img title='Удалить' class='del_pomesh' style='cursor:pointer;' data-id='".$val['numb']."' src='img/b_drop.png' /></span>";
										}
										break;
									}	
								}	
								
							}
						}
						
						print '</div>';
					}
			}
			echo '</div>';
			echo '<div class="clear"></div>';
			echo "<input type='button' id='save_parent' style=' margin-top: 4px;' value='Сохранить родителя' ".$disable_select_pomesh.">";
			echo '<div class="clear"></div>';
			/////// 
			

echo "<div id='floor_info'>";
if($floor==1) {$location_floor_info='top: 18px;left: -5px;';}
else if($floor==2) { $location_floor_info='top: 19px;left: -82px;';}
else if($floor==3) {$location_floor_info='top: 4px;left: 83px;';}
	  echo "<div id='floor_color' style='position:relative;".$location_floor_info."'>";
	        if(empty($_GET['pomesh']) OR $_GET['pomesh']==-1)
			{
				$sql='SELECT * FROM floors WHERE floor='.$floor.' ORDER BY numb';
				$db->query($sql);
				if($db->getCount()>0)
				{
					$arr=$db->getArray();
					foreach($arr as $index=>$value)
					{
						$color_of_place='';
						$data_id='';
						if($value['parent']=='')
						{
							switch ($value['color'])
							{
								case 0:
								$color_of_place='floor_color_white_white';
								break; 
								case 1:
								$color_of_place='floor_color_white_green';
								break;
								case 2:
								$color_of_place='floor_color_white_yellow';
								break;
								case 3:
								$color_of_place='floor_color_white_blue';
								break;
							}
							$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
							$data_id.=$value['numb'];
						}
						else
						{
							$sql_l='SELECT color FROM floors WHERE numb="'.$value['parent'].'"';
							$db->query($sql_l);
							if($db->getCount()>0)
							{
								switch ($db->getValue())
								{
									case 0:
									$color_of_place='floor_color_white_white';
									break; 
									case 1:
									$color_of_place='floor_color_white_green';
									break;
									case 2:
									$color_of_place='floor_color_white_yellow';
									break;
									case 3:
									$color_of_place='floor_color_white_blue';
									break;
								
								}
							}
							$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['parent'].'"';
							$data_id='';
						}
						
						$db->query($sql_get_parent);
						if($db->getCount()>0)
						{
							if($data_id!='') $data_id.='-';
							$mass=$db->getArray();
							foreach($mass as $count=>$val)
							{
								$data_id.=$val['numb'];
							}
						}
					
					if($floor==1 AND $value['numb']=="101")
					{
						$exaption='floor101_exaption';
						echo "<div class='$exaption $color_of_place' data-id='".$data_id."'></div>";
					}
					if($floor==1 AND $value['numb']=="106")
					{
						$exaption='floor106_exaption';
						echo "<div class='$exaption $color_of_place' data-id='".$data_id."'></div>";
					}
					if($floor==1 AND $value['numb']=="112")
					{
						echo "<div class='floor112_exaption_1 ".$color_of_place."' data-id='".$data_id."'></div>";
						/*echo "<div class='floor112_exaption_2 ".$color_of_place."' data-id='".$data_id."'></div>";*/
					}
					if($floor==1 AND $value['numb']=="116")
					{
						echo "<div class='floor116_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
					}
					if($floor==2 AND $value['numb']=="209")
					{
						echo "<div class='floor209_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
					}
					if($floor==2 AND $value['numb']=="223")
					{
						echo "<div class='floor223_exaption_2 ".$color_of_place."' data-id='".$data_id."'></div>";
					}
					if($floor==3 AND $value['numb']=="329")
				{
					echo "<div class='floor329_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				
				if($floor==3 AND $value['numb']=="333")
				{
					echo "<div class='floor333_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==3 AND $value['numb']=="оф.1")
				{
					echo "<div class='floor_of1 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==3 AND $value['numb']=="оф.2")
				{
					echo "<div class='floor_of2 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==3 AND $value['numb']=="оф.3")
				{
					echo "<div class='floor_of3 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
					else
					{
						$exaption='';
					}
					if($value['numb']!="оф.3" AND $value['numb']!="оф.2" AND $value['numb']!="оф.1")
					{
						echo "<div class='floor".$value['numb']." ".$color_of_place."' data-id='".$data_id."'></div>";
					}
					}
				}	
			}
			else
			{
			$sql_get_parent='SELECT parent FROM floors WHERE numb="'.$_GET['pomesh'].'"';
			$db->query($sql_get_parent);
			if($db->getCount()>0)
			{
				if($db->getValue()==0)
				{
					$sql='SELECT * FROM floors WHERE floor='.$floor.' AND parent="'.$_GET['pomesh'].'" or numb="'.$_GET['pomesh'].'" ORDER BY numb';
				}
				else
				{
					$sql='SELECT * FROM floors WHERE floor='.$floor.' AND parent="'.$db->getValue().'" or numb="'.$db->getValue().'" ORDER BY numb';
				}
			}
			$db->query($sql);
			if($db->getCount()>0)
			{
				$arr=$db->getArray();
				foreach($arr as $index=>$value)
				{
					$data_id='';
					if($value['parent']==0)
					{
						$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['numb'].'"';
						$data_id.=$value['numb'];
						$sql='SELECT DISTINCT color FROM floors WHERE floor='.$floor.' AND numb="'.$value['numb'].'" ORDER BY numb';
							$db->query($sql);
							if($db->getCount()>0)
							{
								switch ($db->getValue())
								{
									case 0:
									$color_of_place='floor_color_white_white';
									break; 
									case 1:
									$color_of_place='floor_color_white_green';
									break;
									case 2:
									$color_of_place='floor_color_white_yellow';
									break;
									case 3:
									$color_of_place='floor_color_white_blue';
									break;
									
								}
							}
					}
					else
					{
						    $sql='SELECT DISTINCT color FROM floors WHERE floor='.$floor.' AND numb="'.$value['parent'].'" ORDER BY numb';
							$db->query($sql);
							if($db->getCount()>0)
							{
								switch ($db->getValue())
								{
									case 0:
									$color_of_place='floor_color_white_white';
									break; 
									case 1:
									$color_of_place='floor_color_white_green';
									break;
									case 2:
									$color_of_place='floor_color_white_yellow';
									break;
									case 3:
									$color_of_place='floor_color_white_blue';
									break;
									
								}
							}
						$sql_get_parent='SELECT * FROM floors WHERE parent="'.$value['parent'].'"';
						$data_id='';
					}
					
					$db->query($sql_get_parent);
					if($db->getCount()>0)
					{
						if($data_id!='') $data_id.='-';
						$mass=$db->getArray();
						foreach($mass as $count=>$val)
						{
							$data_id.=$val['numb'];
						}
					}
				
				
				if($floor==1 AND $value['numb']=="101")
				{
					$exaption='floor101_exaption';
					echo "<div class='".$exaption." ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==1 AND $value['numb']=="106")
					{
						$exaption='floor106_exaption';
						echo "<div class='$exaption $color_of_place' data-id='".$data_id."'></div>";
					}
				if($floor==1 AND $value['numb']=="112")
				{
					echo "<div class='floor112_exaption_1 ".$color_of_place."' data-id='".$data_id."'></div>";
					/*echo "<div class='floor112_exaption_2 ".$color_of_place."' data-id='".$data_id."'></div>";*/
				}
				if($floor==1 AND $value['numb']=="116")
				{
					echo "<div class='floor116_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==2 AND $value['numb']=="209")
				{
					echo "<div class='floor209_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==2 AND $value['numb']=="223")
				{
					echo "<div class='floor223_exaption_2 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
					if($floor==3 AND $value['numb']=="329")
				{
					echo "<div class='floor329_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
				}
			
				if($floor==3 AND $value['numb']=="333")
				{
					echo "<div class='floor333_exaption ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==3 AND $value['numb']=="оф.1")
				{
					echo "<div class='floor_of1 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==3 AND $value['numb']=="оф.2")
				{
					echo "<div class='floor_of2 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				if($floor==3 AND $value['numb']=="оф.3")
				{
					echo "<div class='floor_of3 ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				else
				{
					$exaption='';
				}
				if($value['numb']!="оф.3" AND $value['numb']!="оф.2" AND $value['numb']!="оф.1")
				{
					echo "<div class='floor".$value['numb']." ".$color_of_place."' data-id='".$data_id."'></div>";
				}
				}
			}	
			}
	        		
	  echo "</div>";
	  if($floor==1) { $scr_img='first';}
	  else if($floor==2) { $scr_img='second';}
	  else if($floor==3) { $scr_img='threed';}
	  else {$scr_img='first';}
	  echo "<div id='picture_floor'><img src='img/".$scr_img.".jpg'/></div>";
echo "</div>";	 
echo "</form>";
echo "</fieldset>";
?>
<span id='progress-form'></span>

<script type="text/javascript">
  function changeFloor(variable)
  {
  	var isMSIE = /*@cc_on!@*/false;
	(isMSIE ) ? window.location.href('index.php?floor='+variable ) : window.location.href ='index.php?floor='+variable;
  } 
  function changePomesh(variable,floor)
  {
  	var isMSIE = /*@cc_on!@*/false;
  	if(variable==-1)
  	{
  		if( isMSIE ) window.location.href('index.php?floor='+floor );
 		else window.location.href ='index.php?floor='+floor;
  	}
  	else
  	{
  		if( isMSIE ) window.location.href('index.php?floor='+floor+'&pomesh='+variable );
 		else window.location.href ='index.php?floor='+floor+'&pomesh='+variable;
  	}
	
  }
    $('.del_pomesh').bind('click',function()
   {
   	var pom='<? echo $_GET['pomesh']?>';
   	var floor_='<? echo $_GET['floor']?>';
   	var data_id=$(this).attr('data-id');
    $.ajax({
		url: 'ajax/index/del.php',
		type: "POST",  
		data: {numb:data_id,floor:floor_,pomesh: pom},
		success: function(data)
		{
			var isMSIE = /*@cc_on!@*/false;
			if( isMSIE )
			{
				if(pom!='')
		 		{
		 			window.location.href('index.php?floor='+floor_+'&pomesh='+pom );
		 		}
		 		else
		 		{
		 			window.location.href ='index.php';
		 		}
			} 
		 	else {
		 		if(pom!='')
		 		{
		 			window.location.href ='index.php?floor='+floor_+'&pomesh='+pom;
		 		}
		 		else
		 		{
		 			window.location.href ='index.php';
		 		}
		 	}
		 	
		}
	});
   	return false;
   })

    var optionsUpdate = {
        url:    "ajax/index/save.php",
        beforeSubmit: function(jqForm) { // Здесь проверяем данные формы
            $('#progress-form').text('Обновление данных...');
            
        },
        success: function(responseText) { // Здесь проверяем ответ
        	var pom='<? echo $_GET['pomesh']?>';
        	var floor_='<? echo $_GET['floor']?>';
            var isMSIE = /*@cc_on!@*/false;
				if( isMSIE )
				{
					if(pom!='')
			 		{
			 			window.location.href('index.php?floor='+floor_+'&pomesh='+pom );
			 		}
			 		else
			 		{
			 			window.location.href ='index.php';
			 		}
				} 
			 	else {
			 		if(pom!='')
			 		{
			 			window.location.href ='index.php?floor='+floor_+'&pomesh='+pom;
			 		}
			 		else
			 		{
			 			window.location.href ='index.php';
			 		}
			 	}
        }
    };

    $('#editForm').submit(function() { 
        $(this).ajaxSubmit(optionsUpdate); 
        
            return false;

    });  
    $("#set_parent :checkbox").live('click',function (){
    	
    	var length_on_check=$("#set_parent input:checked").length;
    	if($(this).attr('checked')=='checked')
    	{
    		$('#set_parent :checkbox').attr('checked',false)
			$(this).attr('checked',true)
    	}
    	else
    	{
    		$(this).attr('checked',true)
    	}
    		
      })
  $('#save_parent').live('click',function()
  {
  	 var data_id=$('#set_parent :checked').attr('data-id');
  	 var alt=$('#set_parent :checked').attr('alt');
  	 if(data_id!=alt)
  	 {	
  	 	$.ajax({
		url: 'ajax/index/save_parent.php',
		type: "POST",  
		data: {data_id_:data_id,parent:alt},
		success: function(data)
		{
			var pom='<? echo $_GET['pomesh']?>';
        	var floor_='<? echo $_GET['floor']?>';
            var isMSIE = /*@cc_on!@*/false;
				if( isMSIE )
				{
					if(pom!='')
			 		{
			 			window.location.href('index.php?floor='+floor_+'&pomesh='+pom );
			 		}
			 		else
			 		{
			 			window.location.href ='index.php';
			 		}
				} 
			 	else {
			 		if(pom!='')
			 		{
			 			window.location.href ='index.php?floor='+floor_+'&pomesh='+pom;
			 		}
			 		else
			 		{
			 			window.location.href ='index.php';
			 		}
			 	} 	
		}
		});
  	 }
  	 
  })
 </script>

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

             