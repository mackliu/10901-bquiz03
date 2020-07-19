<?php
include_once "../base.php";

$db=new DB("movie");

//將表單傳過來的資料先存到一個$data的陣列中，陣列的key和資料表的欄位是一致的
$data['name']=$_POST['name'];
$data['length']=$_POST['length'];
$data['publish']=$_POST['publish'];
$data['director']=$_POST['director'];
$data['level']=$_POST['level'];
$data['intro']=$_POST['intro'];

//判斷是否有上傳短片或是海報檔案
if(!empty($_FILES['trailer']['tmp_name'])){
    $data['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$data['trailer']);
}

if(!empty($_FILES['poster']['tmp_name'])){
    $data['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$data['poster']);
}

//單獨處理上映日期的格式呈現
$data['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];

//計算或產生一個排序值，我們使用資料表的id最大值加1來代表這個排序值
$data['rank']=$db->q("select max(`id`) from `movie`")[0][0]+1;
$data['sh']=1;

//儲存資料
$db->save($data);

//導回後台的院線片管理
to("../admin.php?do=movie");

?>