<?php
    require('lib/lib.php');
    session_start();

    $db = dbConnect();

    if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
    } else {
        header('Location: login.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // メッセージ投稿
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
        $stmt = $db->prepare('INSERT INTO posts (message, member_id) VALUES (?, ?);');
        if (!$stmt) {
            die($db->error);
        }

        $stmt->bind_param('si', $message, $id);
        $result = $stmt->execute();
        if (!$result) {
            die($db->error);
        }

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
    <div id="mei">
        <img src="images/mei.webp" alt="">
    </div>
    <div id="content">
        <div style="text-align: right"><a href="logout.php">ログアウト</a></div>
        <form action="" method="post">
            <dl>
                <dt>
                    <?php echo specialChars($name); ?>さん、
                    メッセージをどうぞ
                </dt>
                <dd>
                    <textarea name="message" cols="50" rows="5"></textarea>
                </dd>
            </dl>
            <div>
                <p>
                    <input type="submit" value="投稿する"/>
                </p>
            </div>
        </form>

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
                    ? = p.member_id;
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

            while ($stmt->fetch()) :
        ?>
            <div class="msg">
                <img src="member_picture/<?php echo specialChars($picture); ?>" width="48" height="48" alt=""/>
                <p>
                    <?php echo specialChars($message); ?>
                    <span class="name">
                        <?php echo specialChars($name); ?>さん
                    </span></p>
                <p class="day">
                    <a href="view.php?id=">
                        <?php echo specialChars($created); ?>
                    </a>
                    [<a href="delete.php?id=" style="color: #F33;">削除</a>]
                </p>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>

</html>