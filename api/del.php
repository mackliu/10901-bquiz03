<?php
include_once "../base.php";

$table=$_POST['table'];
$id=$_POST['id'];

$db=new DB($table);
$db->del($id);


?>

