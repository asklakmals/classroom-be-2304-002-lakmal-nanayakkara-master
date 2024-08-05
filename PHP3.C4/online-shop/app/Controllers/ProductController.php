<?php
// D:\xampp\htdocs\online-shop\app\Controllers\ProductController.php

namespace App\Controllers;

use Config\Database;
use App\Models\Product;

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $db = new Database();
        $this->productModel = new Product($db->connect());
    }

    public function index()
    {
        $products = $this->productModel->getAll();
        include "../app/Views/products/index.php";
    }

    public function create()
    {
        include "../app/Views/products/create.php";
    }

    public function store()
    {
        $data = [
            "name" => $_POST["name"],
            "description" => $_POST["description"],
            "price" => $_POST["price"],
            "quantity" => $_POST["quantity"],
        ];
        $this->productModel->create($data);
        header("Location: /products");
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        include "../app/Views/products/edit.php";
    }

    public function update($id)
    {
        $data = [
            "name" => $_POST["name"],
            "description" => $_POST["description"],
            "price" => $_POST["price"],
            "quantity" => $_POST["quantity"],
        ];
        $this->productModel->update($id, $data);
        header("Location: /products");
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        header("Location: /products");
    }

    public function addCart()
    {
        $products = $this->productModel->getAll();
        include "../app/Views/products/addCart.php";
    }
}