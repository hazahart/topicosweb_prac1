<?php

namespace App\Controllers;

class LoginController
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
            header('Location: index.php?route=home');
            exit;
        }

        require_once __DIR__ . '/../../views/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $validUser = $_ENV['ADMIN_USER'];
            $validPass = $_ENV['ADMIN_PASS'];

            if ($email === $validUser && $password === $validPass) {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = $email;

                header('Location: index.php?route=home');
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require_once __DIR__ . '/../../views/login.php';
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php?route=login');
        exit;
    }
}