<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/admin/blocks/include.php";
$db = db :: getInstance();
$sql_set_parent="UPDATE floors SET parent='$_POST[data_id_]' WHERE parent='$_POST[parent]'";
$db->query($sql_set_parent);
//print $sql_set_parent;
$sql_set_parent_z="UPDATE floors SET parent='' WHERE numb='$_POST[data_id_]'";
$db->query($sql_set_parent_z);
//print $sql_set_parent_z;

$sql_set_parent_z="UPDATE floors SET parent='$_POST[data_id_]' WHERE numb='$_POST[parent]'";
$db->query($sql_set_parent_z);
//print $sql_set_parent_z;
?>
