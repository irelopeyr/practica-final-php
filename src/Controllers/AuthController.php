<?php

namespace App\Controllers;

use App\Core\Database;
use App\Models\User;

class AuthController
{
    private User $userModel;

    public function __construct(Database $db)
    {
        $this->userModel = new User($db);
    }

    public function showRegisterForm()
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function showLoginForm()
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function register()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $this->userModel->create(
            $username,
            $email,
            $passwordHash
        );

        echo "Usuario registrado correctamente";
    }

public function login()
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $this->userModel->findByEmail($email);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: ?controller=post&action=create');
        exit;

    } else {

        echo "Email o contraseña incorrectos";
    }
}

public function logout()
{
    session_destroy();

    echo "Sesión cerrada";
}

}