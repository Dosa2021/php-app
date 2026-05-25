<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../src/Repository/TodoRepository.php';

try {
    $repository = new TodoRepository();
    $todos = $repository->findAll();

    echo json_encode(
        ['data' => $todos],
        JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
    );
} catch (Throwable $e) {
    error_log('TODO一覧APIエラー: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(
        ['error' => 'TODO一覧の取得に失敗しました'],
        JSON_UNESCAPED_UNICODE
    );
}
