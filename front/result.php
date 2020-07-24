<?php

$sno=$_GET['ord'];
$db=new DB("ord");
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
           echo  $ord['seat'];
        ?>
        </td>

    </tr>
    <tr>
        <td colspan="2">
            <button onclick="location.hrf='index.php'">確認</button>
        </td>
    </tr>
</table>