<h3 class="ct">訂單清單</h3>
<div>
快速刪除：
<input type="radio" name="type"  value="date">
依日期<input type="text" name="date" id="date">
<input type="radio" name="type"  value="movie">
依電影
<select name="movie" id="movie">
<?php
//利用group by來取得訂單資料表中的電影做為選單
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

//取得全部的訂單，並依編號排序
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
        //將座位資料還原為陣列後再計算出對應的排及號
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

//快速刪除的函式
function qDel(){
    //取得目前選擇的快速刪除項目
    let type=$("input[name='type']:checked").val()
    let option="";

    //依據要刪除的項目來取得對應的欄位內容
    switch(type){
        case 'date':
            option=$("#date").val()
                    break;
        case 'movie':
            option=$("#movie").val()
            
        break;
    }

    //先進行確認的動作，再用ajax的方式傳送要刪除的內容
    if(confirm("你確定要刪除"+option+"的所有訂單嗎?")){
        $.post('api/qdel.php',{type,option},function(){
                    location.reload()
                })
    }

}
</script>