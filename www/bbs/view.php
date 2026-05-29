<?php
    require('lib/lib.php');
    session_start();

    $db = dbConnect();

    if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
        $user_id = $_SESSION['id'];
        $name = $_SESSION['name'];
    } else {
        header('Location: login.php');
        exit();
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひとこと掲示板</title>

    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>ひとこと掲示板</h1>
    </div>
    <div id="content">
        <p>&laquo;<a href="index.php">一覧にもどる</a></p>
        <?php
            $stmt = $db->prepare('
                SELECT
                    p.id,
                    p.member_id,
                    p.message,
                    p.created,
                    m.name,
                    m.picture
                FROM
                    posts as p,
                    members as m
                WHERE
                    p.id = ? AND
                    m.id = p.member_id;
            ');
            if (!$stmt) {
                die($db->error);
            }

            $stmt->bind_param('i', $id);
            $result = $stmt->execute();
            if (!$result) {
                die($db->error);
            }

            $stmt->bind_result(
                $id,
                $member_id,
                $message,
                $created,
                $name,
                $picture
            );

            if ($stmt->fetch()) :
        ?>
            <div class="msg">
                <img src="member_picture/" width="48" height="48" alt=""/>
                <p>
                    <?php echo specialChars($message); ?>
                    <span class="name">（○○）</span>
                </p>
                <p class="day"><a href="view.php?id=">2021/01/01 00:00:00</a>
                    [<a href="delete.php?id=" style="color: #F33;">削除</a>]
                </p>
            </div>
        <?php else: ?>
            <p>その投稿は削除されたか、URLが間違えています</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>