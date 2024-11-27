<?php

namespace Controllers;

use Models\User;

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $userData = $user->findByEmail($email);

            if ($userData && password_verify($password, $userData['password'])) {
                // Start a session and store user data
                session_start();
                $_SESSION['user'] = $userData;
                header('Location: /user/dashboard'); // Redirect to dashboard
            } else {
                echo "Invalid email or password!";
            }
        } else {
            require_once __DIR__ . '/../views/auth/login.php';
        }
    }
    public function logout()
{
    session_start();
    session_destroy();
    header('Location: /auth/login');
}

}
