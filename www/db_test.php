<?php
try {
    // PDO接続
    $pdo = new PDO(
        'mysql:host=mysql;dbname=mydb;charset=utf8mb4',
        'dbuser',
        'dbpass',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
    
    echo "✅ データベース接続成功！<br><br>";
    
    // テーブル一覧を取得
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "テーブル一覧：<br>";
    foreach ($tables as $table) {
        echo "- {$table}<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ エラー: " . $e->getMessage();
}
?>