<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\Post;

class PostController
{
    private Post $postModel;

    public function __construct(Database $db)
    {
        $this->postModel = new Post($db);
    }

    public function create()
    {
        require __DIR__ . '/../Views/posts/create.php';
    }

  public function store()
{

    $title = $_POST['title'];
    $category = $_POST['category'];
    $body = $_POST['body'];

    $this->postModel->create(
        $_SESSION['user_id'],
        $title,
        $body,
        $category
    );

    echo "Publicación creada";
}

public function index()
{
    $posts = $this->postModel->getAll();

    require __DIR__ . '/../Views/posts/index.php';
}
}