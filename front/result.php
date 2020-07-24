<?php

//取得訂單編號
$sno=$_GET['ord'];
$db=new DB("ord");

//取得訂單資料
$ord=$db->find(['no'=>$sno]);

?>
<table>
    <tr>
        <td colspan="2">感謝您的訂購，您的訂單編號是：<?=$ord['no'];?></td>
    </tr>
    <tr>
        <td>電影名稱:</td>
        <td><?=$ord['movie'];?></td>
    </tr>
    <tr>
        <td>日期:</td>
        <td><?=$ord['date'];?></td>
    </tr>
    <tr>
        <td>場次時間:</td>
        <td><?=$ord['session'];?></td>
    </tr>
    <tr>
        <td colspan="2">
        座位:<br>
        <?php
            //還原座位資料為陣列並顯示為排及號
           $seat=unserialize($ord['seat']);
           foreach($seat as $s){
               echo floor($s/5)+1;
               echo "排";
               echo $s%5+1;
               echo "號";
               echo "<br>";
           }

           echo "共".$ord['qt']."張電影票";
        ?>
        </td>

    </tr>
    <tr>
        <td colspan="2">
            <button onclick="location.href='index.php'">確認</button>
        </td>
    </tr>
</table>