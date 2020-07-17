<?php
include_once "../base.php";

$table=$_POST['table'];
$id=$_POST['id'];

$db=new DB($table);
$row=$db->find($id);
$row['sh']=($row['sh']+1)%2;

$db->save($row);

?>

