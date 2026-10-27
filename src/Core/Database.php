<?php

namespace App\Core;

use PDO;
use PDOStatement;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config.php';
        $db = $config['db'];

        $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset={$db['charset']}";

        $this->pdo = new PDO($dsn, $db['user'], $db['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Si una consulta falla , lanza una excepción
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // los resultados vienen como array asociativos
        ]);
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetchAll(string $sql, array $params = []): array
    {
    return $this->query($sql, $params)->fetchAll();
    }

    public function fetchOne(string $sql, array $params = []): ?array
    {
        $row = $this->query($sql, $params)->fetch();
        return $row === false ? null : $row;
    }
}