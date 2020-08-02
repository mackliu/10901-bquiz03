<?php
include_once "../base.php";
    $type=$_POST['type'];
    $option=$_POST['option'];

    //依照要快速刪除的條件來刪除資料
   $Ord->del([$type=>$option]);

?>

