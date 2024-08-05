<!-- D:\xampp\htdocs\online-shop\app\Views\product\index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Products</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product["name"]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product["description"]); ?></p>
                            <p class="card-text"><strong>Price:</strong> $<?php echo htmlspecialchars(
                                $product["price"]
                            ); ?></p>
                            <form action="/cart/add/<?php echo $product["id"]; ?>" method="POST">
                                <div class="form-group">
                                    <label for="quantity_<?php echo $product["id"]; ?>">Quantity:</label>
                                    <input type="number" id="quantity_<?php echo $product[
                                        "id"
                                    ]; ?>" name="quantity" class="form-control" value="1" min="1" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>