<?php
include_once "../base.php";

$movie=$_POST['movie'];
$date=$_POST['date'];
$session=$_POST['session'];
$seat=$_POST['seat'];
$db_movie=new DB("movie");
sort($seat);

$data['movie']=$db_movie->find($movie)['name'];
$data['date']=$date;
$data['session']=$sess[$session];
$data['qt']=count($seat);
$data['seat']=serialize($seat) ;

$sno=$db_movie->q("select max(`id`) from `ord`")[0][0]+1;
$dateNo=date("Ymd");

$data['no']=$dateNo.sprintf("%04d",$sno);

$db_ord=new DB("ord");
$db_ord->save($data);
echo $data['no'];

?>