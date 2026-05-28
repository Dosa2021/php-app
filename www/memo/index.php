<?php
require('db_connect.php');

// 最大ページ数を求める
$counts = $db->query('SELECT COUNT(*) as cnt FROM `memos`;'); 
$count = $counts->fetch_assoc();
$max_page = floor(($count['cnt'] + 1) / 5 + 1);

$stmt = $db->prepare('SELECT * FROM `memos` ORDER BY id DESC limit ?, 5;'); 
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
$page = ($page ? : 1);
$start = ($page - 1) * 5;

$stmt->bind_param('s', $start);
$result = $stmt->execute();
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

    <?php if (!$result): ?>
      <p>表示するリストがありません。</p>
    <?php endif; ?>

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
    <p>
      <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>"><?php echo $page - 1; ?>ページ目へ</a>
      <?php endif; ?>
      <?php if ($page < $max_page): ?>
        <a href="?page=<?php echo $page + 1; ?>"><?php echo $page + 1; ?>ページ目へ</a>
      <?php endif; ?>
    </p>
  </body>
</html>