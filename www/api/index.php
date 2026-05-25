<?php

$array =[
    [
        "id" => 0,
        "name" => "JUN",
        "drink" => "beer",
    ],
    [
        "id" => 1,
        "name" => "AOI",
        "drink" => "coffee",
    ],
];

// 配列($array)をJSONに変換(エンコード)する
$json = json_encode($array);
echo $json;