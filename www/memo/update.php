<?php 
  require('db_connect.php');

  $stmt = $db->prepare('SELECT * FROM `memos` WHERE id=?;');
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $stmt->bind_result($id, $memo, $created);
  $stmt->fetch(); 
?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>メモの編集</title>
  </head>
  <body>
    <br />
    <a href="index.php">トップへ戻る</a>
    <form action="update_do.php" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <textarea
        name="memo"
        cols="50"
        rows="10"
        placeholder="メモを入力してください"
      ><?php echo htmlspecialchars($memo); ?></textarea>
      <button type="submit">編集する</button>
    </form>
  </body>
</html>