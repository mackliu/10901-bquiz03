<?php
include_once "../base.php";

$table=$_POST['table'];
$id=$_POST['id'];

$db=new DB($table);
$row=$db->find($id);
//利用餘數的特性來製作顯示/隱藏的切換效果
$row['sh']=($row['sh']+1)%2;

$db->save($row);

?>

