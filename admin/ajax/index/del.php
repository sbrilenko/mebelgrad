<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/class.invis.db.php";
$db = db :: getInstance();
$sql_update="UPDATE floors SET parent='' WHERE numb='$_POST[numb]'";
$db->query($sql_update);
?>