<?php
    $memo = filter_input(INPUT_POST, 'memo', FILTER_SANITIZE_SPECIAL_CHARS);
    $db = new mysqli('mysql:3306', 'root', 'root_password', 'mydb');
    $stmt = $db->prepare('INSERT INTO memos (memo) VALUES (?);');
    if (!$stmt):
        die($db->error);
    endif;
    $stmt->bind_param('s', $memo);
    $ret = $stmt->execute();
    if ($ret) :
        echo 'insert 成功';
    else: 
        $db->error;
    endif;
?>