<?php
// D:\xampp\htdocs\online-shop\app\Controllers\CartController.php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Config\Database;

class CartController
{
    private $cartModel;
    private $orderModel;

    public function __construct()
    {
        $db = new Database();
        $this->cartModel = new Cart($db->connect());
        $this->orderModel = new Order($db->connect());
    }

    public function index()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: /login");
            exit();
        }

        $cartItems = $this->cartModel->getItems($_SESSION["user_id"]);
        require_once "../app/Views/cart/index.php";
    }

    public function add($productId)
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: /login");
            exit();
        }

        $this->cartModel->addItem($_SESSION["user_id"], $productId);
        header("Location: /cart");
    }

    public function remove($itemId)
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: /login");
            exit();
        }

        $this->cartModel->removeItem($itemId);
        header("Location: /cart");
    }

    public function placeOrder()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: /login");
            exit();
        }

        $address = $_POST["address"];
        $paymentMethod = $_POST["payment_method"];
        $totalPrice = $_POST["total_price"];
        $userId = $_SESSION["user_id"];

        $this->orderModel->placeOrder($userId, $address, $paymentMethod, $totalPrice);
        header("Location: /orders");
    }

    public function orders()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: /login");
            exit();
        }

        $orderDetails = $this->orderModel->getOrders($_SESSION["user_id"]);
        require_once "../app/Views/cart/orders.php";
    }
}