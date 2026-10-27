<?php

namespace App\Models;

use App\Core\Database;

class User extends BaseModel
{
    public function __construct(Database $db)
    {
        parent::__construct($db, "users");
    }

    public function findByEmail(string $email): ?array
    {
        return $this->db->fetchOne(
            "SELECT * FROM users WHERE email = ?",
            [$email]
        );
    }

    public function create(string $username, string $email, string $password): void
    {
    $this->db->query(
        "INSERT INTO users (username, email, password)
         VALUES (?, ?, ?)",
        [$username, $email, $password]
    );
    }
}