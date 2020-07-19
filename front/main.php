<!---預告片-->
<style>
/*建立所需的CSS內容*/
.btns{
  display:flex;
}
.nav{
  display:flex;
  width:320px;
  overflow:hidden;
}
.icon{
  width:80px;
  flex-shrink:0;
  text-align:center;
  position:relative;
}
.icon img{
  width:50px;
  cursor:pointer;
}

.control{
  width:45px;
  font-size:45px;
  text-align:center;
  cursor:pointer;
}
.poster{
    border: 1px solid;
    width: 200px;
    height: 260px;
    margin: 0 auto 20px auto;
    position:relative;
    
}
.po{
width:100%;
height:100%;
background:white;
color:black;
position:absolute;
display:none;
}
.po img{
  width:100%;
}
</style>

<?php
$po=new DB("poster");

//取出設定為顯示並排序過的資料
$rows=$po->all(['sh'=>1]," order by `rank`");


?>
<div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
      <!--海報區-->
        <div class="poster">
        <?php
          foreach($rows as $k=>$row){
            echo "<div class='po' data-ani='".$row['ani']."'>";
            echo "<img src='img/".$row['path']."'>";
            echo "<div class='ct'>".$row['name']."</div>";
            echo "</div>";
          }

        ?>
        </div>

        <!--按鈕區-->
        <div class="btns">
          <div class='control' onclick="shift('left')">&#9664;</div>
          <div class="nav">
          <?php
          foreach($rows as $k=> $row){
            echo "<div class='icon'>";
            echo "<img src='img/".$row['path']."'>";
            echo "</div>";
          }

          ?>
          </div>
          
          <div class='control' onclick="shift('right')">&#9654;</div>


        </div>
      </div>
    </div>
      <script>
      //先顯示第一張預告片海報
      $(".po").eq(0).show();

      //設定每三秒執行一次海報轉場的函式
      let auto=setInterval(slider, 3000);
      
      //海報轉場函式
      function slider(){
        //先取得目前頁面上正顯示的海報
        let dom=$(".po:visible");

        //取得海報的轉場樣式
        let ani=$(dom).data('ani');

        //取得海報的下一張海報
        let next=$(dom).next();
        
        //計算是否有下一張海報，如果沒有下一張海報則使用第一張海報
        if(next.length<=0){
          next=$(".po").eq(0)
        }
        
        //根據轉場樣式來執行轉場動畫
        switch(ani){
          case 1:
            //淡入淡出
              $(dom).fadeOut(1000,function(){
                $(next).fadeIn(1000);
              });
            break;
          case 2:
            //放大縮小
              $(dom).hide(1000,function(){
                $(next).show(1000);
              });
            break;
          case 3:
            //滑入滑出
              $(dom).slideUp(1000,function(){
                $(next).slideDown(1000);
              });
            break;
          case 4:
            //縮放,使用animate()函式來執行較細緻的轉場動畫，需要注意各須參數的變化關係，及動畫的先後順序
            $(dom).animate({width:0,height:0,left:100,top:130},function(){
                $(next).css({width:0,height:0,left:100,top:130})
                $(next).show();
                $(next).animate({width:200,height:260,left:0,top:0})
                $(dom).hide()
                $(dom).css({width:200,height:260,left:0,top:0})
            })

        }

      }

      //註冊下方icon的點擊事件

      $(".icon").on("click",function(){

        //取得icon的索引值，並以此索引值來更換海報  
        let index=$(".icon").index($(this))
        $(".po").hide();
        $(".po").eq(index).show();
        
      })

      //註冊滑鼠移入icon取的事件，取消interval事件，當滑鼠離開時再恢復interval事件
      //以避免時間差的問題造成轉場動畫出錯
      $(".nav").hover(
        function(){
          clearInterval(auto)
        },
        function(){
          auto=setInterval(slider, 3000);
        }

      )
      
      //建立一個icon移動次數的變數
      let p=0;
      //計算有幾個icon可以點擊
      let total=$(".icon").length;

      //icon移動函式
      function shift(direct){
        switch(direct){
          case 'right':
            if(p<(total-4)){
              p++;
              $(".icon").animate({right:80*p});
            }

            break;
          case 'left':
              if(p>0){
                p--;
                $(".icon").animate({right:80*p})
              }
          break;
        }
      }
      
      
      </script>
      
<style>
  .mb{
    width:48%;
    height:160px;
    margin:0.5%;
    display:inline-block;
  }
</style>
  <!---院線片-->  
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
      <?php
        
        $db=new DB("movie");
        $today=date("Y-m-d");
        $ondate=date("Y-m-d",strtotime("-2 days"));

        $total=$db->count(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today'");
        $div=4;
        $pages=ceil($total/$div);
        $now=(!empty($_GET['p']))?$_GET['p']:1;
        $start=($now-1)*$div;
        $rows=$db->all(['sh'=>1]," && ondate >= '$ondate' && ondate <='$today' order by rank limit $start,$div");
        
        foreach($rows as $row){
      ?>
      <div class="mb">
          <table>
            <tr>
              <td rowspan="3"><a href="?do=intro&id=<?=$row['id'];?>"><img src="img/<?=$row['poster'];?>" style="width:80px;height:100px;"></a></td>
              <td><?=$row['name'];?></td>
            </tr>
            <tr>
              <td><img src="icon/<?=$row['level'];?>.png" style="width:15px"><?=$level[$row['level']];?></td>
            </tr>
            <tr>
              <td><?=$row['ondate'];?></td>
            </tr>
          </table>
          <div class="ct">
            <button onclick="location.href='?do=intro&id=<?=$row['id'];?>'">劇情簡介</button><button onclick="location.href='?do=order&id=<?=$row['id'];?>'">線上訂票</button>
          </div>

      </div>
      <?php
      }
      ?>
      <div class="ct">
      <?php

        for($i=1;$i<=$pages;$i++){
            $font=($i==$now)?'24px':'18px';
          echo "<a href='?p=$i' style='font-size:$font;text-decoration:none'> $i </a>";
        }
      
      ?>
    </div>
      </div>
    </div>