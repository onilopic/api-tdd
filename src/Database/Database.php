<?php

declare(strict_types=1);

namespace App\Database;

class Database
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function fetchRecords(string $tableName, array $criteria): array
    {
        $placeholders = [];

        foreach($criteria as $column => $value) {
            $placeholders[] = "{$column} = :{$column}";
        }

        $sql = "SELECT * FROM {$tableName} WHERE " . implode(' AND ', $placeholders);

        try {

            $statement = $this->connection->getPdo()->prepare($sql);

            foreach($criteria as $column => &$value) {
                $statement->bindValue(":{$column}", $value);
            }

            $statement->execute();

            $result = $statement->fetchAll();

        } catch (\PDOException $PDOException) {
            $result = [];
        }

        return $result;
    }
}