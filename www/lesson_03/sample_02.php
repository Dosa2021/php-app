<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>sample_02</title>
</head>
<body>
<?php
    $db = new mysqli('mysql:3306', 'root', 'root_password', 'mydb');
    // $records = $db->query('select * from my_items');
    $records = $db->query('select count(*) as cnt from my_items');
    
    if ($records) {
        while ($record = $records->fetch_assoc()) {
            // echo $record['item_name'] . '<br>';
            echo $record['cnt'] . '<br>';
            
        }
        echo 'db接続しました';
        
    } else {
        echo 'db接続失敗しました！！！';
        $db->error;
    }
?>
    <h1>sample_02</h1>
</body>
</html>