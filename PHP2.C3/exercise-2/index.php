<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Product Reviews Application</h2>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <h4>Create Product</h4>
                <form action="create_product.php" method="POST">
                    <div class="form-group">
                        <label for="productName">Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="productDescription">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </form>
            </div>

            <div class="col-md-6">
                <h4>Add Review</h4>
                <form action="add_review.php" method="POST">
                    <div class="form-group">
                        <label for="reviewText">Review</label>
                        <textarea class="form-control" id="reviewText" name="review" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reviewRating">Rating</label>
                        <input type="number" class="form-control" id="reviewRating" name="rating" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label for="productId">Product</label>
                        <select class="form-control" id="productId" name="product_id" required>
                            <?php
                            include 'db_config.php';
                            $result = mysqli_query($conn, "SELECT id, name FROM products");
                            while ($product = mysqli_fetch_assoc($result)) {
                                echo "<option value=\"{$product['id']}\">{$product['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Review</button>
                </form>
            </div>
        </div>

        <hr>
        <h4>Reviews by Product</h4>
        <?php
        $products = mysqli_query($conn, "SELECT * FROM products");
        while ($product = mysqli_fetch_assoc($products)) {
            echo "<h5>{$product['name']}</h5>";
            $reviews = mysqli_query($conn, "SELECT * FROM reviews WHERE product_id = {$product['id']}");
            if (mysqli_num_rows($reviews) > 0) {
                echo "<ul class=\"list-group\">";
                while ($review = mysqli_fetch_assoc($reviews)) {
                    echo "<li class=\"list-group-item\">Rating: {$review['rating']} - {$review['review']}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No reviews yet.</p>";
            }
        }
        mysqli_close($conn);
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
