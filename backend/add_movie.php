<style>
.a{
  width:95%;
  margin:auto;
  display:flex;  
}
.a > div:nth-child(1){
    width:10%;
    text-align:right;
}
.a > div:nth-child(2){
    width:85%;
    background:#eee;

}
</style>
<h1 class="ct">新增院線片</h1>
<form action="api/add_movie.php" method="post" enctype="multipart/form-data">
    <div class="a">
        <div>影片資料</div>
        <div>
            <div>片名:<input type="text" name="name"></div>
            <div>分級:
                <select name="level" >
                    <option value="1">普遍級</option>
                    <option value="2">輔導級</option>
                    <option value="3">保護級</option>
                    <option value="4">限制級</option>
                </select>(請選擇分級)
            </div>
            <div>片長:<input type="text" name="length"></div>
            <div>上映日期:
                <select name="year" >
                    <?php
                    for($i=0;$i<3;$i++){
                        echo "<option>";
                        echo date("Y")+$i;
                        echo "</option>";
                    }
                    ?>
                
                </select>年
                <select name="month" >
                <?php
                    for($i=1;$i<=12;$i++){
                        echo "<option>";
                        echo $i;
                        echo "</option>";
                    }
                    ?>
                </select>月
                <select name="day" >
                <?php
                    for($i=1;$i<=31;$i++){
                        echo "<option>";
                        echo $i;
                        echo "</option>";
                    }
                    ?>
                </select>日
            
            </div>
            <div>發行商:<input type="text" name="publish"></div>
            <div>導演:<input type="text" name="driector"></div>
            <div>預告影片:<input type="file" name="trailer"></div>
            <div>電影海報:<input type="file" name="poster"></div>
        </div>
    </div>
    <div class="a">
        <div>劇情簡介</div>
        <div>
            <textarea name="intro" style="width:90%;height:50px;"></textarea>
        </div>
    </div>
    <hr>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>