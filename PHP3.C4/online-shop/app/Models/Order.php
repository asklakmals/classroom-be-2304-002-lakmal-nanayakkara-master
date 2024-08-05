<?php
// D:\xampp\htdocs\online-shop\app\Models\Order.php

namespace App\Models;

use PDO;
use Exception;

class Order
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function placeOrder($userId, $address, $paymentMethod, $totalPrice)
    {
        $this->conn->beginTransaction();

        try {
            // Insert order into orders table
            $stmt = $this->conn->prepare(
                "INSERT INTO orders (user_id, address, payment_method, total_price) VALUES (:user_id, :address, :payment_method, :total_price)"
            );
            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":payment_method", $paymentMethod);
            $stmt->bindParam(":total_price", $totalPrice);
            $stmt->execute();

            $orderId = $this->conn->lastInsertId();

            // Get cart items for the user
            $stmt = $this->conn->prepare("SELECT * FROM carts WHERE user_id = :user_id");
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();
            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Insert each cart item into order_items table
            foreach ($cartItems as $item) {
                $stmt = $this->conn->prepare(
                    "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, 95.04)"
                );
                $stmt->bindParam(":order_id", $orderId);
                $stmt->bindParam(":product_id", $item["product_id"]);
                $stmt->bindParam(":quantity", $item["quantity"]);
                $stmt->execute();
            }

            // Clear the user's cart
            $stmt = $this->conn->prepare("DELETE FROM carts WHERE user_id = :user_id");
            $stmt->bindParam(":user_id", $userId);
            $stmt->execute();

            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    /*     public function getOrders($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } */

    public function getLastRowId()
    {
        $stmt = $this->conn->prepare("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getOrders($userId)
    {
        $orderId = $this->getLastRowId();
        $stmt = $this->conn->prepare("
            SELECT 
                o.id as order_id, 
                o.address, 
                o.payment_method, 
                o.created_at,
                oi.product_id, 
                oi.quantity,
                p.name as product_name, 
                p.price as product_price 
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            JOIN products p ON oi.product_id = p.id
            WHERE o.user_id = :user_id AND o.id = :order_id
            ORDER BY o.created_at DESC
        ");
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":order_id", $orderId["id"]);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}