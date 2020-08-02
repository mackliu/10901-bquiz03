<?php
include_once "../base.php";
$movies = $Movie->all();
foreach ($movies as $m) {
    $Movie->save(['id'=>$m['id'],'ondate' => date("Y-m-d"), 'sh' => 1]);
}
