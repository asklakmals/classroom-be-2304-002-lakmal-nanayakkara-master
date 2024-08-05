<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students by Classroom</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Students by Classroom</h2>
        <hr>

        <?php
        $result = mysqli_query($conn, "SELECT c.name as classroom_name, s.reg_no, s.name, s.grade FROM students s JOIN classrooms c ON s.classroom_id = c.id ORDER BY c.name, s.name");
        $current_classroom = "";
        while ($row = mysqli_fetch_assoc($result)) {
            if ($current_classroom != $row['classroom_name']) {
                if ($current_classroom != "") {
                    echo "</tbody></table>";
                }
                $current_classroom = $row['classroom_name'];
                echo "<h4>Classroom: {$current_classroom}</h4>";
                echo "<table class='table table-bordered'><thead><tr><th>Registration No</th><th>Student Name</th><th>Grade</th></tr></thead><tbody>";
            }
            echo "<tr><td>{$row['reg_no']}</td><td>{$row['name']}</td><td>{$row['grade']}</td></tr>";
        }
        if ($current_classroom != "") {
            echo "</tbody></table>";
        }
        mysqli_free_result($result);
        ?>

        <a href="index.php" class="btn btn-secondary">Back to Student Registration</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
