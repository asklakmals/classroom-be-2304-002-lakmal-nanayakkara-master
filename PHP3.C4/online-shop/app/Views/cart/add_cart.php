<!-- D:\xampp\htdocs\online-shop\app\Views\products\index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Products</h2>
        <a href="/products/create" class="btn btn-primary">Add Product</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product["id"] ?></td>
                        <td><?= $product["name"] ?></td>
                        <td><?= $product["description"] ?></td>
                        <td><?= $product["price"] ?></td>
                        <td><?= $product["quantity"] ?></td>
                        <td>
                            <a href="/cart/add/<?php echo $product["id"]; ?>" class="btn btn-primary">Add to Cart</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>