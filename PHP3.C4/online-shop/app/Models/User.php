<?php
// D:\xampp\htdocs\online-shop\app\Models\User.php

namespace App\Models;

use PDO;

class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user["password"])) {
            return true;
        }
        return false;
    }

    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $data["username"]);
        $stmt->bindParam(":password", $data["password"]);
        $stmt->bindParam(":email", $data["email"]);
        $stmt->execute();
    }

    public function find($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query =
            "UPDATE " . $this->table . " SET username = :username, password = :password, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $data["username"]);
        $stmt->bindParam(":password", $data["password"]);
        $stmt->bindParam(":email", $data["email"]);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}