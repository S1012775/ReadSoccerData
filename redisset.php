<?php
ignore_user_abort();    //當瀏覽器被關掉程式依然執行
set_time_limit(0);      //修改PHP的執行時間上限為無限制，避免程式執行過久被終止
header("content-type: text/html; charset=utf-8");

require_once 'Connect.php';

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$db = new Connect;

$selectData = "SELECT * FROM `soccerData`";
$data = $db->db->prepare($selectData);
$data->execute();
$result = $data->fetchAll(PDO::FETCH_ASSOC);

$redis->set("todayData", $result);
