<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
if(!empty($_POST['category']))
{
	$sql_select_='INSERT INTO type_for_pomesh (id,id_group,pomesh) VALUES (NULL,'.$_POST['category'].',"'.$_POST['pomesh'].'")';
    $db->query($sql_select_);
}


//вывод
  echo "<div id='replace_all_category'>";
  echo "<div class='float_left preview_text' > категории : </div>";  
	   $disable_select_pomesh='';
	  	$sql_select_numb='SELECT * FROM floors WHERE numb="'.$_POST['pomesh'].'"';
		$db->query($sql_select_numb);
		if($db->getCount()>0)
		{
			$est_v_base=true;
		}
	   else $est_v_base=false;
	  if(empty($_POST['pomesh']) OR ($_POST['pomesh']==-1) OR ($_POST['floors']==1 AND $est_v_base==false) OR ($_POST['floors']==2 AND $est_v_base==false) OR ($_POST['floors']==3 AND $est_v_base==false)) 
	  {
	  	$disable_select_pomesh="disabled='disabled'";
		echo "<select class='float_left' name='category' ".$disable_select_pomesh.">";	  	
	    echo "</select>";
	  }
	  else { $disable_select_pomesh='';
	  echo "<select class='float_left' name='category' ".$disable_select_pomesh.">";
	                $sql_select_from_type_for_pomesh_='SELECT id_group FROM type_for_pomesh WHERE pomesh="'.$_POST['pomesh'].'"';
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
						 $sql_all_type='SELECT ty.title,ty.id FROM type as ty, type_for_pomesh as t WHERE ty.id not in ('.$dataaaaa.')AND t.pomesh="'.$_POST['pomesh'].'" GROUP BY ty.title ORDER BY ty.reminder ASC';
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
	  if(empty($_POST['pomesh']) OR ($_POST['pomesh']==-1) OR ($_POST['floors']==1 AND $est_v_base==false) OR ($_POST['floors']==2 AND $est_v_base==false) OR ($_POST['floors']==3 AND $est_v_base==false)) {$disable_select_pomesh="disabled='disabled'";}
	  else { $disable_select_pomesh=''; }
      echo "<input type='button' value='Добавить' ".$disable_select_pomesh." class='float_left' style='margin-top: 4px;'>";
      echo "<div class='clear'></div>";
 //редатировать категории
        echo "<div  id='edit_category'>";
	    echo "<div class='float_left preview_text'>Редактировать категории: </div>";
	   if(!empty($_POST['pomesh']) AND ($_POST['pomesh']!=-1) AND ($_POST['floors']==1 AND $est_v_base==true) OR ($_POST['floors']==2 AND $est_v_base==true) OR ($_POST['floors']==3 AND $est_v_base==true))
	        //if(!empty($_GET['pomesh']) AND $_GET['pomesh']!=-1)
			{
				$sql='SELECT  ty.title, t.id FROM type_for_pomesh as t, type as ty WHERE t.pomesh="'.$_POST['pomesh'].'" AND  t.id_group=ty.id GROUP BY title';
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
?>