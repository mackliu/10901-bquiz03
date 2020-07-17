<?php
include_once "../base.php";

$movie_id=$_GET['id'];
$db=new DB("movie");
$movie=$db->find($movie_id);

$today=strtotime(date("Y-m-d"));
$ondate=strtotime($movie['ondate']);

for($i=0;$i<3;$i++){
    $chk=strtotime("+$i days",$ondate);
    if($chk>=$today){
        echo "<option value='".date("Y-m-d",$chk)."'>".date("m月d日 l",$chk)."</option>";
    }
}

?>