<?php
try {
    $pdo = new PDO(
        'mysql:host=mysql;dbname=mydb;charset=utf8mb4',
        'dbuser',
        'dbpass',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    // 全件取得
    $stmt = $pdo->query('SELECT * FROM todos ORDER BY created_at DESC');
    $todos = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("TODO取得エラー: " . $e->getMessage());
    $todos = [];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODO一覧</title>
</head>
<body>
    <h1>TODO一覧</h1>
    <p><a href="create.php">新規登録</a></p>
    
    <?php if (empty($todos)): ?>
        <p>TODOがありません</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>ステータス</th>
                <th>作成日時</th>
                <th>操作</th>
            </tr>
            <?php foreach ($todos as $todo): ?>
                <tr>
                    <td><?php echo htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($todo['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $todo['status'] === 1 ? '完了' : '未完了'; ?></td>
                    <td><?php echo htmlspecialchars($todo['created_at'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8'); ?>">編集</a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8'); ?>" onclick="return confirm('削除しますか？')">削除</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>