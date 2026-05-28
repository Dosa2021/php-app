<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>メモ帳</title>
  </head>
  <body>
    <?php 
      require('db_connect.php');
      $stmt = $db->prepare('SELECT * FROM `memos` WHERE id=?;');
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      if (!$id) {
        echo '不正なidです';
        exit;
      }

      $stmt->bind_param('i', $id);
      $stmt->execute();

      $stmt->bind_result($id, $memo, $created);
      $stmt->fetch();
    ?>

    <div>
      <pre><?php echo htmlspecialchars($memo); ?></pre>
    </div>
    <a href="update.php?id=<?php echo $id; ?>">編集</a>
    <a href="delete.php?id=<?php echo $id; ?>">削除</a>
    <a href="/memo">一覧</a>
  </body>
</html>