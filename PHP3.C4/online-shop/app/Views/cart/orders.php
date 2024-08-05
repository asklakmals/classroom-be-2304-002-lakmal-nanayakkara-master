<!-- D:\xampp\htdocs\online-shop\app\Views\cart\orders.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Order Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
				<?php $total = []; ?>
                <?php foreach ($orderDetails as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item["product_name"]); ?></td>
                        <td><?php echo htmlspecialchars($item["quantity"]); ?></td>
                        <td><?php echo htmlspecialchars($item["product_price"]); ?></td>
						<?php $total[] = $item["quantity"] * $item["product_price"]; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total Price</th>
                    <th><?php echo htmlspecialchars($totalPrice = array_sum($total)); ?></th>
                </tr>
            </tfoot>
        </table>
        <a href="/" class="btn btn-primary">Continue Shopping</a>
    </div>
</body>
</html>