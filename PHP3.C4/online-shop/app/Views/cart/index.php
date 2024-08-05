<!-- D:\xampp\htdocs\online-shop\app\Views\cart\index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Your Shopping Cart</h2>
        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
					<?php $total = []; ?>
                    <?php foreach ($cartItems as $item): ?>
					<?php $total[] = $itemsValue = htmlspecialchars($item["price"] * $item["quantity"]); ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item["name"]); ?></td>
                            <td><?php echo htmlspecialchars($item["description"]); ?></td>
                            <td><?php echo htmlspecialchars($item["price"]); ?></td>
                            <td><?php echo htmlspecialchars($item["quantity"]); ?></td>
                            <td><?php echo $itemsValue; ?></td>
                            <td>
                                <a href="/cart/remove/<?php echo $item[
                                    "id"
                                ]; ?>" class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="/cart/placeOrder" method="POST">
				<div class="form-group">
                    <label for="total">Total Price: <?php echo $sum = array_sum($total); ?></label>
                    <input type="hidden" class="form-control" id="total_price" name="total_price" value="<?php echo $sum; ?>" required>
                </div>			
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="Credit Card">Credit Card</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>