<?php

namespace App\Controllers;


use App\Models\User;

class AuthController
{
    public function showLogin()
    {
        if (authenticated()) {
            addMessage('You are already logged in');
            back();
        }
        view('login');
    }

    public function login()
    {
        if (authenticated()) {
            addMessage('You are already logged in');
            redirect('/');
        }
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = (new User())->login($email, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            redirect('/');
        } else {
            addMessage('Invalid email or password');
            back();
        }
    }

    public function showRegister()
    {
        if (authenticated()) {
            addMessage('You are already logged in');
            back();
        }
        view('register');
    }

    public function register()
    {
        try {

            $error = "";
            if (authenticated()) {
                addMessage('You are already logged in');
                throw new \Exception();
            }
            $params['name'] = $_POST['name'] ?? null;
            $params['surname'] = $_POST['surname'] ?? null;
            $params['email'] = $_POST['email'] ?? null;
            $params['password'] = $_POST['password'] ?? null;

            if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
                $error .= "Invalid email <br>";
            }
            if (strlen($params['password']) < 6) {
                $error .= "Password must be at least 6 characters <br>";
            }
            if ((new User())->exists($params['email'])) {
                $error .= "User with this email already exists <br>";
            }
            foreach ($params as $key => $value) {
                $params[$key] = trim($value);
                if (!$value || $params[$key] === "") {
                    $error .= ucfirst($key) . ' can not be empty <br>';
                }
            }
            if ($error === "") {
                (new User())->register(...$params);
                redirect('/login');
            }
            throw new \Exception();
        } catch (\Exception $e) {
            addMessage($error);
            back();
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('/');
    }
}
