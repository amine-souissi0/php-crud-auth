<?php

namespace Controllers;

use Models\User;

class UserController
{
    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'pays' => $_POST['pays'],
                'password' => $_POST['password']
            ];

            if ($user->create($data)) {
                header('Location: /user/dashboard');
            } else {
                echo "Failed to create user.";
            }
        } else {
            require_once __DIR__ . '/../views/auth/signup.php';
        }
    }
    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit();
        }

        $userModel = new User();
        if (method_exists($userModel, 'getAll')) {
            echo "getAll() method exists.<br>";
            $users = $userModel->getAll();
        } else {
            echo "getAll() method does not exist.<br>";
        }
        

        require_once __DIR__ . '/../views/user/dashboard.php';
    }
}
