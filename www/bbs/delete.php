<?php
    require('lib/lib.php');
    session_start();

    $id = 0;
    $name = '';

    if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
    } else {
        header('Location: login.php');
        exit();
    }

    $post_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$post_id) {
        header('Location: index.php');
        exit();
    }

    $db = dbConnect();
    $stmt = $db->prepare('DELETE FROM posts WHERE id = ? limit 1;');
    $stmt->bind_param('i', $post_id);
    $result = $stmt->execute();
    if (!$result) {
        die($db->error);
    }

    header('Location: index.php'); exit();
?>
