<style>
.list{
    overflow:auto;
    width:100%;
    height:420px;
    background:#eee;
}
.movie-item{
    width:100%;
    background:white;
    margin:2px 0;
}
.movie-item > div{
    display:inline-block;
}

.movie-item > div:nth-child(1),
.movie-item > div:nth-child(2){
    width:10%;
}
.movie-item > div:nth-child(3){
    width:80%;
}
.movie-item > div:nth-child(3) span{
    display:inline-block;
    width:33%;
}

</style>

<button>新增電影</button>
<hr>
<div class="list">

<div class="movie-item">
    <div>縮圖</div><div>分級:</div><div>
        <div>
            <span>片名:</span>
            <span>片長:</span>
            <span>上映時間:</span>
        </div>
        <div>功能按鈕</div>
        <div>劇情簡介:</div>
    </div>
</div>
<div class="movie-item">
    <div>縮圖</div><div>分級:</div><div>
        <div>
            <span>片名:</span>
            <span>片長:</span>
            <span>上映時間:</span>
        </div>
        <div>功能按鈕</div>
        <div>劇情簡介:</div>
    </div>
</div>


</div>