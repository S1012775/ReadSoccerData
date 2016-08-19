<?php

require_once 'Connect.php';

header("Refresh: 60; url='https://payment-annyke.c9users.io/ReadSoccerData/'");
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

    curl_setopt($ch, CURLOPT_URL, "http://www.228365365.com/app/member/FT_future/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=0&league_id=&hot_game=");
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
