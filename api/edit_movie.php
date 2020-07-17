<?php
include_once "../base.php";

$db=new DB("movie");
$id=$_POST['id'];
$data=$db->find($id);

$data['name']=$_POST['name'];
$data['length']=$_POST['length'];
$data['publish']=$_POST['publish'];
$data['director']=$_POST['director'];
$data['level']=$_POST['level'];
$data['intro']=$_POST['intro'];

if(!empty($_FILES['trailer']['tmp_name'])){
    $data['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$data['trailer']);
}

if(!empty($_FILES['poster']['tmp_name'])){
    $data['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$data['poster']);
}

$data['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];

$db->save($data);

to("../admin.php?do=movie");

?>