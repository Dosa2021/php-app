<?php
$db = new mysqli('mysql:3306', 'root', 'root_password', 'mydb');
$memos = $db->query('SELECT * FROM `memos` ORDER BY id DESC;'); 
if (!$memos):
  die($db->error);
endif;
?>

<!doctype html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>メモ帳</title>
  </head>
  <body>
    <h1>メモ帳</h1>
    <?php while ($memo = $memos->fetch_assoc()): ?>
      <hr />
      <div>
        <h2><a href="#">
          <?php echo htmlspecialchars($memo['memo']); ?>
        </a></h2>
        <time datetime="">
          <?php echo htmlspecialchars($memo['created']); ?>
        </time>
      </div>
    <?php endwhile; ?>
  </body>
</html>