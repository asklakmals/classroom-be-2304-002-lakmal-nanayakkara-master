<?php
// D:\xampp\htdocs\online-shop\app\Controllers\AdminController.php

namespace App\Controllers;

use App\Models\Product;
use Config\Database;

class AdminController
{
    private $productModel;

    public function __construct()
    {
        $db = new Database();
        $this->productModel = new Product($db->connect());
    }

    public function addProductForm()
    {
        require_once "../app/Views/admin/add_product.php";
    }

    public function addProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [];
            $data["name"] = $_POST["name"];
            $data["description"] = $_POST["description"];
            $data["price"] = $_POST["price"];
            $data["quantity"] = $_POST["quantity"];

            $this->productModel->create($data);
            header("Location: /admin/add-product");
        } else {
            $this->addProductForm();
        }
    }
}