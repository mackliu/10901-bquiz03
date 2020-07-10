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
<div style="overflow:auto;height:250px" >

<?php
$db=new DB("poster");
$rows=$db->all();
foreach($rows as $row){
    $isChecked=($row['sh']==1)?"checked":"";
?>
<div class="row">
<div><img src="img/<?=$row['path'];?>" style="width:90px;"> </div>
<div><input type="text" name="name" value="<?=$row['name'];?>"> </div>
<div>
    <button>往上</button>
    <button>往下</button>
</div>
<div>
    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$isChecked;?>>顯示 
    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
    <select name="ani">
        <option value="1" <?=($row['ani']==1)?"selected":"";?>>淡入淡出</option>
        <option value="2" <?=($row['ani']==2)?"selected":"";?>>放大縮小</option>
        <option value="3" <?=($row['ani']==3)?"selected":"";?>>滑入滑出</option>
    </select>
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