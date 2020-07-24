<?php
include_once "../base.php";

//取得前端傳過來的電影id及上映日期
$movie_id=$_GET['id'];
$movie_date=$_GET['date'];
$db_movie=new DB("movie");
$movieName=$db_movie->find($movie_id)['name'];
$db_ord=new DB("ord");

//計算今天的時間數值
$today=strtotime(date("Y-m-d"));
//$ondate=strtotime($movie['ondate']);


if(strtotime($movie_date)==$today){
    //如果選擇的日期為今天，則進一步檢查當下的訂票時間，來確認可以訂票的場次
    $now=floor((date("G")-12)/2);
    //$now=(floor((date("G")-12)/2)>0)?floor((date("G")-12)/2):0;
    $now=($now>0)?$now:0;

    //從下一場開始列出可以訂票的場次
    for($i=($now+1);$i<=5;$i++){

        //計算剩餘座位數 20-x
        $qt=$db_ord->q("select sum(`qt`) from `ord` where `movie`='$movieName' && `date`='$movie_date' && `session`='".$sess[$i]."'")[0][0];
        echo "<option value='$i' data-session='".$sess[$i]."'>".$sess[$i]." 剩餘座位 ".(20-$qt)."</option>";
    }
}else{
    //如果選擇的日期不是今天，則五個場次都列出
    for($i=1;$i<=5;$i++){
        $qt=$db_ord->q("select sum(`qt`) from `ord` where `movie`='$movieName' && `date`='$movie_date' && `session`='".$sess[$i]."'")[0][0];
        echo "<option value='$i' data-session='".$sess[$i]."'>".$sess[$i]." 剩餘座位 ".(20-$qt)."</option>";
    }
}

?>