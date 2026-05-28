<?php 
    require('db_connect.php');
    $stmt = $db->prepare('DELETE from memos WHERE id = ?;');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    
    header('Location: index.php');
?>