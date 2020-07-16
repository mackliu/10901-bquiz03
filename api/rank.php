<?php
include_once "../base.php";

$table=$_POST['table'];
$db=new DB($table);

//分別取出要交換rank值的兩筆資料
$row1=$db->find($_POST['id'][0]);
$row2=$db->find($_POST['id'][1]);

//進行rank值的交換
$tmp=$row1;
$row1['rank']=$row2['rank'];
$row2['rank']=$tmp['rank'];

//回存至資料庫
$db->save($row1);
$db->save($row2);


?>