<h3 class="ct">訂單清單</h3>
<div>
快速刪除：
<input type="radio" name="type"  value="date">
依日期<input type="text" name="date" id="date">
<input type="radio" name="type"  value="movie">
依電影
<select name="movie" id="movie">
<?php
$mlist=$Ord->all([]," group by `movie`");
foreach($mlist as $m){
    echo "<option value='".$m['movie']."'>".$m['movie']."</option>";
}

?>
</select>
<button onclick="qDel()">刪除</button>
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
    <li><button onclick="del('ord',<?=$ord['id'];?>)">刪除</button></li>
</ul>
<hr>
<?php
}
?>
</div>

</div>

<script>
//刪除資料表資料的函式
function del(table,id){
    if(confirm("你確定要刪除該筆資料嗎?")){
        $.post("api/del.php",{table,id},function(){
            location.reload();
        })
    }
}

function qDel(){
    let type=$("input[name='type']:checked").val()
    let option="";
    switch(type){
        case 'date':
            option=$("#date").val()
                    break;
        case 'movie':
            option=$("#movie").val()
            
        break;
    }

    if(confirm("你確定要刪除"+option+"的所有訂單嗎?")){
        $.post('api/qdel.php',{type,option},function(){
                    location.reload()
                })
    }

}
</script>