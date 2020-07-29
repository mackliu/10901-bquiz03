<?php
include_once "../base.php";
    $type=$_POST['type'];
    $option=$_POST['option'];
   $Ord->del([$type=>$option]);

?>

