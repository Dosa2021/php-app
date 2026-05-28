<?php 
    require('db_connect.php');

    $stmt = $db->prepare('UPDATE memos SET memo = ? WHERE id = ?;');
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $memo = filter_input(INPUT_POST, 'memo', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $stmt->bind_param('si', $memo, $id);
    $result = $stmt->execute();

    header('Location: memo.php?id=' . $id);
?>