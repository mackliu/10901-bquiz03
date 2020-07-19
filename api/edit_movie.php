<?php
include_once "../base.php";


$db=new DB("movie");
//取得表單傳過來的電影id，並將電影資料取出
$id=$_POST['id'];
$data=$db->find($id);

//將所有表單傳過來的欄位進行更新
$data['name']=$_POST['name'];
$data['length']=$_POST['length'];
$data['publish']=$_POST['publish'];
$data['director']=$_POST['director'];
$data['level']=$_POST['level'];
$data['intro']=$_POST['intro'];

//檢查是否有上傳檔案，如果有則更新檔名
if(!empty($_FILES['trailer']['tmp_name'])){
    $data['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$data['trailer']);
}

if(!empty($_FILES['poster']['tmp_name'])){
    $data['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$data['poster']);
}

//處理上映日期欄位的資料
$data['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];


//存回資料表
$db->save($data);

//導回院線片管理
to("../admin.php?do=movie");

?>