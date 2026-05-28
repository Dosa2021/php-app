<?php
require('db_connect.php');

// $memos = $db->query('SELECT * FROM `memos` ORDER BY id DESC limit 0, 5;'); 
// if (!$memos):
//   die($db->error);
// endif;
$stmt = $db->prepare('SELECT * FROM `memos` ORDER BY id DESC limit ?, 5;'); 
$page = 5;
$stmt->bind_param('s', $page);
$stmt->execute();

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
    <p>-> <a href="input.html">新しいメモ</a></p>

    <?php $stmt->bind_result($id, $memo, $created) ?>
    <?php while ($stmt->fetch()): ?>
      <hr />
      <div>
        <h2><a href="memo.php?id=<?php echo $id; ?>">
          <?php echo htmlspecialchars(mb_substr($memo, 0, 30) ); ?>
          
        </a></h2>
        <time datetime="">
          <?php echo htmlspecialchars($created); ?>
        </time>
      </div>
    <?php endwhile; ?>
  </body>
</html>