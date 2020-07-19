<?php
include_once "../base.php";

$db=new DB("poster");

//檢查每一筆表單傳過來的預告片資料,並進行相應的刪除及資料修改動作
foreach($_POST['id'] as $k => $id){
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){

        $db->del($id);

    }else{

        $row=$db->find($id);
        $row['name']=$_POST['name'][$k];
        $row['sh']=(!empty($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $row['ani']=$_POST['ani'][$k];
        $db->save($row);

    }
}

to("../admin.php?do=poster");

?>