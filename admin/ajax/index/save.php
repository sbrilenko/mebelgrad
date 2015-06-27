<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
//ищем является ли меньший из значение родителем кому нибудь
$sql="SELECT id from floors WHERE numb='$_POST[pomesh]'"; //id $_POST['pomesh'];
$db->query($sql);
if($db->getCount()>0)
{
	$id_pomesh=$db->getValue();
}
$sql="SELECT id from floors WHERE numb='$_POST[add]'"; //id $_POST['pomesh'];
$db->query($sql);
if($db->getCount()>0)
{
	$id_add=$db->getValue();
}
if($id_pomesh<$id_add)
{
	//print '<';
	$sql="SELECT * FROM floors WHERE parent='$_POST[pomesh]'";
	$db->query($sql);
	if($db->getCount()>0) 
	{
		$arr=$db->getArray();
		//выбираем записи где parent=$_POST['pomesh'];
		$sql_pomesh="SELECT numb FROM floors WHERE parent='$_POST[add]'";
		$db->query($sql_pomesh);
		if($db->getCount()>0) 
		{
			//сначала главному родителю
			$sql_update_parent_main="UPDATE floors SET parent='$_POST[pomesh]' WHERE parent='$_POST[add]'";
			//print $sql_update_parent_main;
			$db->query($sql_update_parent_main);
			$sql_update_parent_other="UPDATE floors SET parent='$_POST[pomesh]' WHERE numb='$_POST[add]'";
			//print $sql_update_parent_other;
			$db->query($sql_update_parent_other);
		}
		else
		{
			$sql_update_parent_main="UPDATE floors SET parent='$_POST[pomesh]' WHERE numb='$_POST[add]'";
			//print $sql_update_parent_main;
			$db->query($sql_update_parent_main);
		}
	}
	else 
	{
		$sql_update_parent_main="UPDATE floors SET parent='$_POST[pomesh]' WHERE numb='$_POST[add]'";
		//print $sql_update_parent_main;
		$db->query($sql_update_parent_main);
	}
}
else
{
	//print '>';
	$sql="SELECT * FROM floors WHERE parent='$_POST[add]'";
	$db->query($sql);
	if($db->getCount()>0) // 
	{
		$arr=$db->getArray();
		//выбираем записи где parent=$_POST['pomesh'];
		$sql_pomesh="SELECT numb FROM floors WHERE parent='$_POST[pomesh]'";
		$db->query($sql_pomesh);
		if($db->getCount()>0) 
		{
			//сначала главному родителю
			$sql_update_parent_main="UPDATE floors SET parent='$_POST[add]' WHERE parent='$_POST[pomesh]'";
			//print $sql_update_parent_main;
			$db->query($sql_update_parent_main);
			$sql_update_parent_main="UPDATE floors SET parent='$_POST[add]' WHERE numb='$_POST[pomesh]'";
			//print $sql_update_parent_main;
			$db->query($sql_update_parent_main);
		}
		else
		{
			$sql_update_parent_main="UPDATE floors SET parent='$_POST[add]' WHERE parent='$_POST[pomesh]'";
			//print $sql_update_parent_main;
			$db->query($sql_update_parent_main);
			$sql_update_parent_main="UPDATE floors SET parent='$_POST[add]' WHERE numb='$_POST[pomesh]'";
			//print $sql_update_parent_main;
			$db->query($sql_update_parent_main);
		}
	}
	else 
	{
		$sql_update_parent_main="UPDATE floors SET parent='$_POST[add]' WHERE parent='$_POST[pomesh]'";
		//print $sql_update_parent_main;
		$db->query($sql_update_parent_main);
		$sql_update_parent_main="UPDATE floors SET parent='$_POST[add]' WHERE numb='$_POST[pomesh]'";
		//print $sql_update_parent_main;
		$db->query($sql_update_parent_main);
	}
}

?>