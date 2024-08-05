<?php
// D:\xampp\htdocs\online-shop\app\Models\Cart.php

namespace App\Models;

use PDO;

class Cart
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addItem($userId, $productId, $quantity = 1)
    {
        // Check if the item already exists in the cart
        $stmt = $this->conn->prepare("SELECT * FROM carts WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":product_id", $productId);
        $stmt->execute();
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Update quantity if the item already exists
            $stmt = $this->conn->prepare("UPDATE carts SET quantity = quantity + :quantity WHERE id = :id");
            $stmt->bindParam(":quantity", $quantity);
            $stmt->bindParam(":id", $existingItem["id"]);
            $stmt->execute();
        } else {
            // Insert new item if it does not exist
            $stmt = $this->conn->prepare(
                "INSERT INTO carts (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)"
            );
            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":product_id", $productId);
            $stmt->bindParam(":quantity", $quantity);
            $stmt->execute();
        }
    }

    public function removeItem($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function getItems($userId)
    {
        $stmt = $this->conn->prepare(
            "SELECT c.*, p.name, p.description, p.price FROM carts c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id"
        );
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearCart($userId)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
    }
}