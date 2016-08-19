<?php
require_once 'GetSoccerData.php';

$showdata = getData();
foreach ($showdata as $v) {
        insertData($v);
}
?>