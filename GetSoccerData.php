<?php

require_once 'Connect.php';

header("Refresh: 60; url='https://payment-annyke.c9users.io/SoccerData/'");
header("content-type: text/html; charset=utf-8");

function getData()
{
    // 1. 初始設定
    $ch = curl_init();

    // 2. 設定 / 調整參數
    curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/sports.php");
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."cookie.txt");
    //CURL 收到的 HTTP Response 中的 Set-Cookie 要先存放
    //取得 到此目錄前的完整 PATH
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $pageContent = curl_exec($ch);

    curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=0&league_id=&hot_game=");
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."cookie.txt");
    //CURL 要發出的 HTTP Request 的 Cookie
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $pageContent = curl_exec($ch);

    // 4. 關閉與釋放資源
    curl_close($ch);
    $str = explode('parent.GameFT',$pageContent);
    for ($i = 1;$i <= count($str);$i ++) {
    $showdata[] = explode("'", $str[$i]);
    }

    return $showdata;
}

function insertData($v)
{
    $connect = new Connect;

    $sql =  "DELETE FROM `soccerData`";
    $result = $connect->db->prepare($sql);
    $result->execute();

    $league = $v[5];
    $time = $v[3];
    $event = $v[11]."<br>".$v[13];
    $whole_win = $v[31].",".$v[33].",".$v[35];
    $whole_ball = $v[19].",".$v[21];
    $whole_bs = $v[27].",".$v[29];
    $single_double = $v[37].",".$v[41].",".$v[39].",".$v[43];
    $half_win = $v[63].",".$v[65].",".$v[67];
    $half_ball =  $v[51].",".$v[53];
    $half_bs = $v[61].",".$v[59];
    $sql = "INSERT INTO `soccerData`(
        `league`,
        `starttime`,
        `event`,
        `whole_win`,
        `whole_ball`,
        `whole_bs`,
        `single_double`,
        `half_win`,
        `half_ball`,
        `half_bs`)
        VALUES (
        '$league',
        '$time',
        '$event',
        '$whole_win',
        '$whole_ball',
        '$whole_bs',
        '$single_double',
        '$half_win',
        '$half_ball',
        '$half_bs')";
    $result = $connect->db->prepare($sql);
    $result->execute();
}
