<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>sample_03</title>
</head>
<body>
<?php
    $db = new mysqli('mysql:3306', 'root', 'root_password', 'mydb');
    $ret = $db->query('INSERT INTO memos (memo) VALUES ("phpからのメモです");');
    if ($ret) :
        echo 'insert 成功';
    else: 
        $db->error;
    endif;
?>
    <h1>sample_03</h1>
</body>
</html>