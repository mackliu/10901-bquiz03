<?php
include_once "../base.php";

    $db=new DB("ord");

    //取得ajax傳來的資料
    $movie=$_GET['movieName'];
    $date=$_GET['date'];
    $session=$_GET['sessionName'];

    //取得符合條件的訂單資料
    $ords=$db->all([
        "movie"=>$movie,
        "date"=>$date,
        "session"=>$session
    ]);

    $seat=[];

    //將訂單的座位資料合併成一個陣列
    foreach($ords as $ord){
        $seat=array_merge($seat,unserialize($ord['seat']));
    }
   
    //使用迴圈來劃20個座位
    for($i=0;$i<20;$i++){

        //用判斷式來決定座位是否被訂走，並顯示對應的class
        if(in_array($i,$seat)){
            echo "<div class='booked'>";
        }else{
            echo "<div class='null'>";
            echo "<input type='checkbox' name='num[]' value='".$i."' class='chkbox'>";
        }
        echo floor($i/5)+1;
        echo "排";
        echo $i%5+1;
        echo "號";
        echo "</div>";
    }



?>


