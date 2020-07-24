<div class="order-form">
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

                //這裏要注意sql的語句條件要下對，才能正確取得上映中的電影資料
                $rows=$db->all(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today' ");

                foreach($rows as $row){
                    //判斷是否有帶電影的id，有的話則需選中該電影，沒有的話則照資料表撈出的順序來顯示電影列表
                    if(!empty($_GET['id'])){
                        $selected=($_GET['id']==$row['id'])?"selected":"";
                        echo "<option value='".$row['id']."' data-name=".$row['name']." $selected>".$row['name']."</option>";
                    }else{
                        echo "<option value='".$row['id']."'  data-name=".$row['name'].">".$row['name']."</option>";
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
    <div class="ct"><input type="button" value="確定" onclick='booking()'><input type="reset" value="重置"></div>
</form>
</div>

<style>
.room{
    width:320px;
    height:320px;
    display:flex;
    flex-wrap:wrap;
    margin:auto;
}

.room > div{
    width:64px;
    height:80px;
    position:relative;

}

.chkbox{
    position: absolute;
    bottom: 5px;
    right: 5px;
}

.null{
    background:url("icon/03D02.png") no-repeat center;
}
.booked{
    background:url("icon/03D03.png") no-repeat center;
}
</style>

<div class="booking-form" style="display:none">
    <div class="room"></div>

<div class="info-block">
<div class="info">
     <p id="infoMovie">您選擇的電影是：<span id="movie-name"></span></p>           
     <p id="infoSession">您選擇的時刻是：<span id="movie-date"></span> <span id="movie-session"></span></p>           
     <p>您已經勾選<span id='ticket'></span>張票，最多可以購買四張票</p>           
</div>
<button onclick="prev()">上一步</button>
<button onclick="order()">訂購</button>
</div>
</div>
<script>
//先執行一次取得電影上映期間的函式
getDuration()

//註冊電影列表的選取事件
$("#movie").on("change",function(){
    getDuration()
})

//註冊上映日期列表的選取事件
$("#date").on("change",function(){
    getSession();
})





//挑選座位函式
function booking(){
    let movie=$("#movie").val();
    let movieName=$("#movie option:selected").data("name")
    let date=$("#date").val();
    let session=$("#session").val();
    let sessionName=$("#session option:selected").data("session");
    let ticket=0;
    $("#movie-name").html(movieName);
    $("#movie-date").html(date)
    $("#movie-session").html(sessionName);

    $.get("api/get_seats.php",function(seats){
        $(".room").html(seats);
        $(".chkbox").on("change",function(){
        ticket++;
        $("#ticket").html(ticket);
})

    })

    $(".order-form").hide();
    $(".booking-form").show();
}
//上一步
function prev(){
    $(".order-form").show();
    $(".booking-form").hide();
    $(".room").html("");
}



//計算電影上映期間的函式
function getDuration(){
    let id=$("#movie").val();
    $.get("api/get_duration.php",{id},function(duration){
        $("#date").html(duration)
        getSession()
    })  
}

//計算選擇的日期有那些場次可以選擇的函式
function getSession(){
    let date=$("#date").val();
    let id=$("#movie").val();
    $.get("api/get_session.php",{date,id},function(session){
        $("#session").html(session);
    })
}
</script>