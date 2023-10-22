<?php

namespace App\Kernel\Database;

use App\Config\DBConfigParser;

class Database
{
    private \PDO $pdo;

    public function __construct()
    {
        $this->connect();
    }

    private function connect(): void
    {
        $config = new DBConfigParser('dbconfig');
        
        $connection = $config->get('DB_CONNECTION');
        $host = $config->get('DB_HOST');
        $port = $config->get('DB_PORT');
        $database = $config->get('DB_DATABASE');
        $username = $config->get('DB_USERNAME');
        $password = $config->get('DB_PASSWORD');

        try {
            $this->pdo = new \PDO("$connection:host=$host;port=$port;dbname=$database;", $username, $password);
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function pdo(): \PDO
    {
        return $this->pdo;
    }

    /**
     * returns user id (if he was iserted)
     * else returns false
     */
    public function insert(string $tableName, array $data): int|false 
    {
        $pdo = $this->pdo();

        $fields = array_keys($data);
        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($value) => ":$value", $fields));
        $sql = "INSERT INTO $tableName ($columns) VALUES ($binds)";
        $stmt = $pdo->prepare($sql);

        try {
            $pdo->beginTransaction();
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            $pdo->rollBack();
            throw $exception;
            return false;
        }
        $pdo->commit();

        return $pdo->lastInsertId();
    }

    /**
     * returns user id (if he was founded)
     * else returns false
     */
    public function getUserIdByEmail(string $value): int|false
    {
        $pdo = $this->pdo();

        $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$value]);
        } catch (\PDOException $exception) {
            return false;
        }

        return $stmt->fetchColumn();
    } 

    /**
     * returns first user from DB as object (if he was founded)
     * else returns false
     */
    public function getFirstUserByEmail(string $value): Object|false
    {
        $pdo = $this->pdo();

        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$value]);
        } catch (\PDOException $exception) {
            return false;
        }

        return $stmt->fetchObject();
    }
}