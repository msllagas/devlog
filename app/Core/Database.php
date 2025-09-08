<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    protected PDO $connection;

    public function __construct($config)
    {
        $dsnParts = [
            'host' => $config['host'],
            'port' => $config['port'],
            'dbname' => $config['database'],
            'charset' => $config['charset'],
        ];

        $dsn = "{$config['driver']}:" . http_build_query(data: $dsnParts, arg_separator: ";");
        try {
            $this->connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function query(string $query, array $params = []): false|PDOStatement
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}
