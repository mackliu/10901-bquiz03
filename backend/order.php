<h3 class="ct">訂單清單</h3>
<div>
快速刪除：
<input type="radio" name="bydate" id="bydate">
依日期<input type="text" name="date" id="date">
<input type="radio" name="bymovie" id="bymovie">
依電影
<select name="movie" id="movie">
<?php
$mlist=$Ord->all([]," group by `movie`");
foreach($mlist as $m){
    echo "<option value='".$m['movie']."'>".$m['movie']."</option>";
}

?>
</select>
<button>刪除</button>
</div>

<div>
<style>
ul{
    display:flex;
    list-style-type:none;
    padding:0;
}
ul li{
width:14%;

}

</style>
<ul style="background:#eee">
    <li>訂單編號</li>
    <li>電影名稱</li>
    <li>日期</li>
    <li>場次時間</li>
    <li>訂購數量</li>
    <li>訂購位置</li>
    <li>操作</li>
</ul>
<div style="overflow:auto;height:400px">
<?php
$orders=$Ord->all([]," order by no desc");

foreach($orders as $ord){
?>

<ul>
    <li><?=$ord['no'];?></li>
    <li><?=$ord['movie'];?></li>
    <li><?=$ord['date'];?></li>
    <li><?=$ord['session'];?></li>
    <li><?=$ord['qt'];?></li>
    <li><?php
        $seat=unserialize($ord['seat']);
        foreach($seat as $s){
            echo floor($s/5)+1;
            echo "排";
            echo $s%5+1;
            echo "號<br>";
        }
    
    ?>
    </li>
    <li><button>刪除</button></li>
</ul>
<hr>
<?php
}
?>
</div>

</div>