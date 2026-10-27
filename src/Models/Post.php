<?php

namespace App\Models;

use App\Core\Database;

class Post extends BaseModel
{
    public function __construct(Database $db)
    {
        parent::__construct($db, "posts");
    }

    public function search(string $search): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM posts
             WHERE title LIKE ?
             OR category LIKE ?",
            ["%$search%", "%$search%"]
        );
    }
    
    public function create(
    int $userId,
    string $title,
    string $body,
    string $category
): void
{
    $this->db->query(
        "INSERT INTO posts (user_id, title, body, category)
         VALUES (?, ?, ?, ?)",
        [$userId, $title, $body, $category]
    );
}

}