<?php

use App\Database\MigrationInterface;

return new class implements MigrationInterface
{
    public function up(PDO $pdo): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email VARCHAR(255) NOT NULL UNIQUE,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            plan VARCHAR(255) NOT NULL,            
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $pdo->exec($sql);
    }

    public function down(PDO $pdo): void
    {
        $sql = "DROP TABLE IF EXISTS users;";
        $pdo->exec($sql);
    }
};