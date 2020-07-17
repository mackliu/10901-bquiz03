<form>
    <h3 class="ct">線上訂票</h3>
    <table style="width:70%;margin:auto">
        <tr>
            <td width="10%">電影:</td>
            <td>
            <select name="movie" id="movie">
            <?php

                $db=new DB("movie");
                $today=date("Y-m-d");
                $ondate=date("Y-m-d",strtotime("-2 days"));
                $rows=$db->all(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today' ");
                foreach($rows as $row){
                    if(!empty($_GET['id'])){
                        $selected=($_GET['id']==$row['id'])?"selected":"";
                        echo "<option value='".$row['id']."' $selected>".$row['name']."</option>";

                    }else{

                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td>日期:</td>
            <td><select name="date" id="date"></select></td>
        </tr>
        <tr>
            <td>場次:</td>
            <td><select name="session" id="session"></select></td>
        </tr>
    </table>
    <div class="ct"><input type="button" value="確定"><input type="reset" value="重置"></div>
</form>

<script>
getDuration()

$("#movie").on("change",function(){
    getDuration()
})


function getDuration(){
    let id=$("#movie").val();
    $.get("api/get_duration.php",{id},function(duration){
        $("#date").html(duration)
    })
    console.log(id)    
}

</script>