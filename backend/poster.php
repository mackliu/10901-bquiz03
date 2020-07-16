<style>
h4{
    margin:5px;
    background:#eee;
    padding:5px;

}
.header,.row{
    display:flex;
}
.header div{
    width:25%;
    margin:0 1px;
    background:#ccc;
    text-align:center;
}

.row div{
    width:25%;
    margin:0 1px;
    text-align:center;
}
</style>
<div style="width:98%;margin:auto;height:350px">
<h4 class="ct">預告片清單</h4>
<div class="header">
    <div>預告片海報</div>
    <div>預告片片名</div>
    <div>預告片排序</div>
    <div>操作</div>
</div>
<form action="api/edit_poster.php" method="post">
<div style="overflow:auto;height:250px" >

<?php
$db=new DB("poster");

//要以排序過後的方式來取出全部的資料
$rows=$db->all([]," order by `rank`");

foreach($rows as $k => $row){

    //判斷該筆資料的顯示狀態
    $isChecked=($row['sh']==1)?"checked":"";

    //找出排序後的上一筆和下一筆的資料id
    $prev=($k!=0)?$rows[$k-1]['id']:$row['id'];
    $next=($k!=(count($rows)-1))?$rows[$k+1]['id']:$row['id'];

?>
<div class="row">
<div><img src="img/<?=$row['path'];?>" style="width:90px;"> </div>
<div><input type="text" name="name[]" value="<?=$row['name'];?>"> </div>
<div>
    <!--
    上一筆$k-1 + 是否第一筆 $k == 0
    下一筆$k+1 + 是否最後一筆 $k == count($rows)-1
    將計算出來的上下筆id寫入到data-rank屬性中
    -->
    <button type="button" data-rank="<?=$row['id']."-".$prev;?>">往上</button>
    <button type="button" data-rank="<?=$row['id']."-".$next;?>">往下</button>
</div>
<div>
    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$isChecked;?>>顯示 
    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
    <select name="ani[]">
        <option value="1" <?=($row['ani']==1)?"selected":"";?>>淡入淡出</option>
        <option value="2" <?=($row['ani']==2)?"selected":"";?>>放大縮小</option>
        <option value="3" <?=($row['ani']==3)?"selected":"";?>>滑入滑出</option>
        <option value="4" <?=($row['ani']==4)?"selected":"";?>>縮放</option>
    </select>
    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
</div>
</div>
<?php
}

?>

</div>

<div class="ct">
    <input type="submit" value="編輯確定">
    <input type="reset" value="重置">
</div>
</form>
</div>
<hr>
<div style="width:98%;margin:auto;height:150px">
<h4 class="ct">新增預告片海報</h4>
<form action="api/add_poster.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td width="50%">
            <input type="file" name="poster">
            </td>
            <td width="50%">
            <input type="text" name="name">
            </td>
        </tr>
    </table>
    <div class="ct"><input type="submit" value="新增"><input type="reset" value="重置"></div>
</form>
</div>

<script>
//使用jquery來對button的點擊做處理
$("button").on("click",function(){

    //取得data屬性的值，並拆成一個id陣列
    let id=$(this).data("rank").split("-");

    //將id陣列連同要修改的資料表名稱一起用ajax的方式一直傳到後台
    $.post("api/rank.php",{id,"table":"poster"},function(){

        //後台api處理完畢後重新載入一次頁面
        location.reload();
    })
})



</script>