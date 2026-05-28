<?php
    require('db_connect.php');

    $memo = filter_input(INPUT_POST, 'memo', FILTER_SANITIZE_SPECIAL_CHARS);
    $stmt = $db->prepare('INSERT INTO memos (memo) VALUES (?);');
    if (!$stmt):
        die($db->error);
    endif;
    $stmt->bind_param('s', $memo);
    $ret = $stmt->execute();
    if ($ret) :
        echo 'insert 成功';
        echo '<br /><a href="index.php">トップへ戻る</a>';
    else: 
        $db->error;
    endif;
?>