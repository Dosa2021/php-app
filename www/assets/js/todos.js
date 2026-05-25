$(function () {
    const $list = $('#todo-list');
    const $empty = $('#todo-empty');
    const $error = $('#todo-error');
    const apiUrl = 'api/todos/index.php';

    function statusLabel(status) {
        return Number(status) === 1 ? '完了' : '未完了';
    }

    function renderTodos(todos) {
        $list.empty();
        $empty.hide();
        $error.hide();

        if (!todos.length) {
            $empty.show();
            return;
        }

        const $tbody = $('<tbody></tbody>');

        todos.forEach(function (todo) {
            const $row = $('<tr></tr>');
            $row.append($('<td></td>').text(todo.id));
            $row.append($('<td></td>').text(todo.title));
            $row.append($('<td></td>').text(statusLabel(todo.status)));
            $row.append($('<td></td>').text(todo.created_at));

            const $actions = $('<td></td>');
            $actions.append(
                $('<a></a>')
                    .attr('href', 'edit.php?id=' + encodeURIComponent(todo.id))
                    .text('編集')
            );
            $actions.append(document.createTextNode(' '));
            $actions.append(
                $('<a></a>')
                    .attr('href', 'delete.php?id=' + encodeURIComponent(todo.id))
                    .text('削除')
                    .on('click', function () {
                        return confirm('削除しますか？');
                    })
            );
            $row.append($actions);
            $tbody.append($row);
        });

        $list.append($tbody);
    }

    function showError(message) {
        $list.empty();
        $empty.hide();
        $error.text(message).show();
    }

    $.ajax({
        url: apiUrl,
        method: 'GET',
        dataType: 'json',
    })
        .done(function (response) {
            if (response.error) {
                showError(response.error);
                return;
            }
            renderTodos(response.data || []);
        })
        .fail(function () {
            showError('TODO一覧の取得に失敗しました');
        });
});
