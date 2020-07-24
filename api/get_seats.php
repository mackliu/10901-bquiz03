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

    print_r($ords);

    for($i=0;$i<20;$i++){
        echo "<div class='null'>";
        echo floor($i/5)+1;
        echo "排";
        echo $i%5+1;
        echo "號";
        echo "<input type='checkbox' name='num[]' value='".$i."' class='chkbox'>";
        echo "</div>";
    }



?>


