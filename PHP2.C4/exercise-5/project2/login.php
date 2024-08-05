<?php
session_start();
include 'db_config.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_form'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple validation (in a real application, use prepared statements to prevent SQL injection)
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Login</h2>
        <hr>

        <?php if ($message != ""): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username*</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <input type="hidden" name="login_form" value="1">
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>