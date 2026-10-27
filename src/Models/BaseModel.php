<?php

namespace App\Models;

use App\Core\Database;

abstract class BaseModel
{
    protected Database $db;
    protected string $table;

    public function __construct(Database $db, string $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    // Obtener todos los registros
    public function getAll(): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table}"
        );
    }

    // Obtener un registro por id
    public function getById(int $id): ?array
    {
        return $this->db->fetchOne(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id]
        );
    }

    // Eliminar un registro por id
    public function delete(int $id): void
    {
        $this->db->query(
            "DELETE FROM {$this->table} WHERE id = ?",
            [$id]
        );
    }
}