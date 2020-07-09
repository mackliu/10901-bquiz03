<style>
h4{
    margin:5px;
    background:#eee;
    padding:5px;

}

</style>
<div style="width:98%;margin:auto;height:350px">
<h4 class="ct">預告片清單</h4>
<div style="overflow:auto;height:300px" >
<?php
$db=new DB("poster");
$rows=$db->all();
foreach($rows as $row){
?>
<div><img src="img/<?=$row['path'];?>" style="width:90px;"> </div>
<div><input type="text" name="name" value="<?=$row['name'];?>"> </div>
<div>
    <button>往上</button>
    <button>往下</button>
</div>
<div>
    <input type="checkbox" name="sh[]" value="<?=$row['id'];?>">
    <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
</div>
<?php
}

?>
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