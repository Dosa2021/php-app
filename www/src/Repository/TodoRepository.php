<?php

declare(strict_types=1);

require_once __DIR__ . '/../../config/database.php';

class TodoRepository
{
    public function findAll(): array
    {
        $stmt = getPdo()->query(
            'SELECT id, title, status, created_at FROM todos ORDER BY created_at DESC'
        );

        return $stmt->fetchAll();
    }
}
