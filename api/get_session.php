<?php
include_once "../base.php";
//建立一個場次的字串陣列
$sess=[
    1=>"14:00~16:00",
    2=>"16:00~18:00",
    3=>"18:00~20:00",
    4=>"20:00~22:00",
    5=>"22:00~24:00",
];

//取得前端傳過來的電影id及上映日期
$movie_id=$_GET['id'];
$movie_date=$_GET['date'];
//$db=new DB("order");
//$movie=$db->find($movie_id);

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
        echo "<option value='$i' data-session='".$sess[$i]."'>".$sess[$i]."</option>";
    }
}else{
    //如果選擇的日期不是今天，則五個場次都列出
    for($i=1;$i<=5;$i++){
        echo "<option value='$i' data-session='".$sess[$i]."'>".$sess[$i]."</option>";
    }
}

?>