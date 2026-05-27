<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>sample_03</title>
</head>
<body>
<?php
    $db = new mysqli('mysql:3306', 'root', 'root_password', 'mydb');
    $message = 'フォームから入力した値';
    $stmt = $db->prepare('INSERT INTO memos (memo) VALUES (?);');
    if (!$stmt):
        die($db->error);
    endif;
    $stmt->bind_param('s', $message);
    // $ret = $db->query('INSERT INTO memos (memo) VALUES ("phpからのメモです");');
    $ret = $stmt->execute();
    if ($ret) :
        echo 'insert 成功';
    else: 
        $db->error;
    endif;
?>
    <h1>sample_03</h1>
</body>
</html>