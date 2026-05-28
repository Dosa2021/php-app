<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>sample_01</title>
</head>
<body>
<?php
    $db = new mysqli('mysql:3306', 'root', 'root_password', 'mydb');
    echo 'db接続しました';
?>
    <h1>sample_01</h1>
</body>
</html>