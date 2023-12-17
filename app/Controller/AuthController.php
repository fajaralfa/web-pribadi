<?php

namespace App\Controller;

use App\Model\User;
use App\Service\Session;
use PDOException;

class AuthController
{
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function register_page()
    {
        return view('auth/register');
    }

    public function register_act()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User($name, $username, $password);
        try {
            $user->save();
        } catch (PDOException $e) {
            $this->session->flash(['error' => 'Username telah digunakan']);
            header('location: /register');
            return;
        }

        $this->session->flash(['info' => 'Register berhasil, silakan login']);
        header('location: /login');
    }

    public function login_page()
    {
        return view('auth/login');
    }

    public function login_act()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User();
        $user_data = $user->find_by_username($username);

        if ($user_data && password_verify($password, $user_data['password'])) {
            $this->session->set('username', $username);
            header('location: /home');
            return;
        }

        $this->session->flash(['error' => 'Username atau password salah']);
        header('location: /login');
    }

    public function logout_act()
    {
        $this->session->unset('username');
        header('location: /login');
    }

    public function user_info()
    {
        $user = new User();
        return json_encode($user->find_by_username('test'));
    }
}
