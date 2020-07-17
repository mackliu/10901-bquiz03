<?php
include_once "../base.php";

$sess=[
    1=>"14:00~16:00",
    2=>"16:00~18:00",
    3=>"18:00~20:00",
    4=>"20:00~22:00",
    5=>"22:00~24:00",
];


$movie_id=$_GET['id'];
$movie_date=$_GET['date'];
//$db=new DB("order");
//$movie=$db->find($movie_id);

$today=strtotime(date("Y-m-d"));
$ondate=strtotime($movie['ondate']);


if(strtotime($movie_date)==$today){
    $now=floor((date("G")-12)/2);
    for($i=($now+1);$i<=5;$i++){
        echo "<option value='$i'>".$sess[$i]."</option>";
    }


}else{

    for($i=1;$i<=5;$i++){
        echo "<option value='$i'>".$sess[$i]."</option>";
    }
}

?>