<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

class Connection
{
    private PDO $pdo;

    public function __construct(string $dsn)
    {
        try{
            $this->pdo = new PDO($dsn, "", "", [
                PDO::ATTR_PERSISTENT => true
            ]);
//            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }catch(\PDOException $e) {
            print "Error in ".$e->getMessage();
        }
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}