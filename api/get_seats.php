<?php
include_once "../base.php";

$db=new DB("ord");
    $movie=$_GET['movieName'];
    $date=$_GET['date'];
    $session=$_GET['sessionName'];

    $ords=$db->all([
        "movie"=>$movie,
        "date"=>$date,
        "session"=>$session
    ]);

    $seat=[];

    foreach($ords as $ord){
        $seat=array_merge($seat,unserialize($ord['seat']));
    }
   /*  print_r($seat); */
    for($i=0;$i<20;$i++){
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


