<?php

$pdo = new PDO(
    'mysql:host=mysql;dbname=mydb;charset=utf8mb4',
    'dbuser',
    'dbpass',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

// 全件取得
$stmt = $pdo->query('SELECT * FROM todos ORDER BY created_at DESC');
$todos = $stmt->fetchAll();

// 配列($array)をJSONに変換(エンコード)する
$json = json_encode($todos);
echo $json;