<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $product_id = $_POST['product_id'];

    $sql = "INSERT INTO reviews (review, rating, product_id) VALUES ('$review', '$rating', '$product_id')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
