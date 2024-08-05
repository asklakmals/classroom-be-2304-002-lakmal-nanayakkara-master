<?php
// D:\xampp\htdocs\online-shop\app\Controllers\UserController.php

namespace App\Controllers;

use Config\Database;
use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $db = new Database();
        $this->userModel = new User($db->connect());
    }

    public function index()
    {
        $users = $this->userModel->getAll();
        include "../app/Views/users/index.php";
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if ($this->userModel->login($username, $password)) {
                $_SESSION["user"] = $username;
                header("Location: /products");
            } else {
                $error = "Invalid credentials";
                include "../app/Views/users/login.php";
            }
        } else {
            include "../app/Views/users/login.php";
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }

    public function create()
    {
        include "../app/Views/users/create.php";
    }

    public function store()
    {
        $data = [
            "username" => $_POST["username"],
            "email" => $_POST["email"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
        ];
        $this->userModel->create($data);
        header("Location: /users");
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        include "../app/Views/users/edit.php";
    }

    public function update($id)
    {
        $data = [
            "username" => $_POST["username"],
            "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
        ];
        $this->userModel->update($id, $data);
        header("Location: /users");
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        header("Location: /users");
    }
}