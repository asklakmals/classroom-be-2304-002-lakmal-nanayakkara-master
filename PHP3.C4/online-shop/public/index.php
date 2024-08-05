<?php
// D:\xampp\htdocs\online-shop\public\index.php

require_once "../vendor/autoload.php";

use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\AdminController;

session_start();

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch ($uri) {
    case "/":
        header("Location: /login");
        break;
    case "/login":
        $controller = new UserController();
        $controller->login();
        break;
    case "/register":
        $controller = new UserController();
        $controller->register();
        break;
    case "/logout":
        $controller = new UserController();
        $controller->logout();
        break;
    case "/users":
        $controller = new UserController();
        $controller->index();
        break;
    case "/users/create":
        $controller = new UserController();
        $controller->create();
        break;
    case "/users/store":
        $controller = new UserController();
        $controller->store();
        break;
    case preg_match("/\/users\/edit\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new UserController();
        $controller->edit($matches[1]);
        break;
    case preg_match("/\/users\/update\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new UserController();
        $controller->update($matches[1]);
        break;
    case preg_match("/\/users\/delete\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new UserController();
        $controller->delete($matches[1]);
        break;
    case "/products":
        $controller = new ProductController();
        $controller->index();
        break;
    case "/products/create":
        $controller = new ProductController();
        $controller->create();
        break;
    case "/products/store":
        $controller = new ProductController();
        $controller->store();
        break;
    case preg_match("/\/products\/edit\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new ProductController();
        $controller->edit($matches[1]);
        break;
    case preg_match("/\/products\/update\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new ProductController();
        $controller->update($matches[1]);
        break;
    case preg_match("/\/products\/delete\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new ProductController();
        $controller->delete($matches[1]);
        break;
    case "/products/addCart":
        $controller = new ProductController();
        $controller->addCart();
        break;
    case "/cart":
        $controller = new CartController();
        $controller->index();
        break;
    case preg_match("/\/cart\/add\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new CartController();
        $controller->add($matches[1]);
        break;
    case preg_match("/\/cart\/update\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new CartController();
        $controller->update($matches[1]);
        break;
    case preg_match("/\/cart\/remove\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new CartController();
        $controller->remove($matches[1]);
        break;
    case "/cart/checkout":
        $controller = new CartController();
        $controller->checkout();
        break;
    case "/cart/placeOrder":
        $controller = new CartController();
        $controller->placeOrder();
        break;
    case "/orders":
        $controller = new CartController();
        $controller->orders();
        break;
    case preg_match("/\/orders\/(\d+)/", $uri, $matches) ? true : false:
        $controller = new CartController();
        $controller->orderDetails($matches[1]);
        break;
    case "/admin":
        $controller = new AdminController();
        $controller->addProductForm();
        break;
    case "/admin/add-product":
        $controller = new AdminController();
        $controller->addProduct();
        break;
    default:
        http_response_code(404);
        echo "Page not found";
        break;
}
?>