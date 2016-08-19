<?php
header("content-type: text/html; charset=utf-8");
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

foreach($redis as  $value) {
    $a = json_decode($redis->get("todayData"),true);
    foreach ($a as $b) {
        foreach ($b as $c) {
            echo $c;
        }
    }
}
