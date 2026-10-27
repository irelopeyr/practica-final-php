<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Controllers\AuthController;
use App\Controllers\PostController;

$db = new Database();

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

if ($controller === 'auth') {

    $auth = new AuthController($db);

    if ($action === 'register') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->register();
        } else {
            $auth->showRegisterForm();
        }
    }

    if ($action === 'login') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->login();
        } else {
            $auth->showLoginForm();
        }
    }

    if ($action === 'logout') {
        $auth->logout();
    }
}

if ($controller === 'post') {

    $post = new PostController($db);

    if ($action === 'create') {
        $post->create();
    }

    if ($action === 'store') {
        $post->store();
    }

    if ($action === 'index') {
    $post->index();
    }
}