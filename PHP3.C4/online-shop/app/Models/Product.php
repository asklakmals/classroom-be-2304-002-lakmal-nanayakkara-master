<?php
// D:\xampp\htdocs\online-shop\app\Models\Product.php

namespace App\Models;

use PDO;

class Product
{
    private $conn;
    private $table = "products";

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

    public function find($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query =
            "INSERT INTO " .
            $this->table .
            " (name, description, price, quantity) VALUES (:name, :description, :price, :quantity)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":price", $data["price"]);
        $stmt->bindParam(":quantity", $data["quantity"]);
        $stmt->execute();
    }

    public function update($id, $data)
    {
        $query =
            "UPDATE " .
            $this->table .
            " SET name = :name, description = :description, price = :price, quantity = :quantity WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":description", $data["description"]);
        $stmt->bindParam(":price", $data["price"]);
        $stmt->bindParam(":quantity", $data["quantity"]);
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