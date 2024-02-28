<?php

declare(strict_types=1);

namespace App\Command;

use App\Database\Connection;
use App\Database\MigrationInterface;
use PDOException;

class Migrate implements CommandInterface
{
    public function __construct(
        private readonly Connection $connection,
        private readonly string $migrationsFolder
    ) {
    }

    public function execute(): void
    {
        // Obtain PDO
        $pdo = $this->connection->getPdo();

        // Open a try / catch - need to rollback if failures no half migrated states
        try {

            // Begin a transaction
            $pdo->beginTransaction();

            $files = scandir($this->migrationsFolder);

//            dd($pdo, $files);

            // Loop through files in migrations folder
            foreach ($files as $file) {

                if ($file === '.' || $file === '..') {
                    continue;
                }

                // Include the file
                $migration = include $this->migrationsFolder . '/' . $file;

                // Check that it is a Migration
                if (!$migration instanceof MigrationInterface) {
                    continue;
                }

                // Call up method
                $migration->up($pdo);
            }

            // Commit transaction
            $pdo->commit();
        } catch (PDOException $exception) {
            // Catch an exception and roll back
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            // Throw another exception
            throw $exception;
        }
    }
}