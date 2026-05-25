<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODO一覧</title>
</head>
<body>
    <h1>TODO一覧</h1>
    <p><a href="create.php">新規登録</a></p>

    <p id="todo-empty" style="display: none;">TODOがありません</p>
    <p id="todo-error" style="display: none; color: red;"></p>

    <table id="todo-table" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>ステータス</th>
                <th>作成日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="todo-list"></tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/todos.js"></script>
</body>
</html>
