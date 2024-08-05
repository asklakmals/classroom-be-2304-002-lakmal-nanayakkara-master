<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'db_config.php';
$message = "";

// Function to sanitize input data
function input_filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Handle form submission for adding/updating classrooms
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['classroom_form'])) {
    $name = input_filter($_POST['name'] ?? '');

    // Server-side validation
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $name)) {
        $message = "Classroom Name should contain only letters, numbers, and spaces.";
    } elseif (!empty($name)) {
        if (isset($_POST['classroom_id']) && !empty($_POST['classroom_id'])) {
            $classroom_id = $_POST['classroom_id'];
            $stmt = mysqli_prepare($conn, "UPDATE classrooms SET name = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "si", $name, $classroom_id);
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO classrooms (name) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $name);
        }
        if (mysqli_stmt_execute($stmt)) {
            $message = "Classroom successfully saved!";
        } else {
            $message = "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "All fields are required!";
    }
}

// Handle deletion of a classroom
if (isset($_GET['delete_classroom_id'])) {
    $delete_classroom_id = $_GET['delete_classroom_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM classrooms WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $delete_classroom_id);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Classroom successfully deleted!";
    } else {
        $message = "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classrooms</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Classrooms</h2>
        <hr>

        <?php if ($message != ""): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="classrooms.php" method="POST" onsubmit="return validateClassroomForm()">
            <div class="form-group">
                <label for="name">Classroom Name*</label>
                <input type="text" class="form-control" id="name" name="name" pattern="[a-zA-Z0-9 ]+" required>
                <small class="form-text text-muted">Letters, numbers, and spaces only.</small>
            </div>
            <input type="hidden" name="classroom_id" id="classroom_id">
            <input type="hidden" name="classroom_form" value="1">
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <hr>
        <h4>Classroom List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM classrooms");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>
                            <button class='btn btn-warning' onclick='editClassroom({$row['id']}, \"{$row['name']}\")'>Update</button>
                            <a href='classrooms.php?delete_classroom_id={$row['id']}' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                mysqli_free_result($result);
                ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary">Back to Student Registration</a>
		<a href="index.php" class="btn btn-secondary">Back to Student Registration</a>
		<a href="report.php" class="btn btn-info">Students by Classroom</a>
		<a href="logout.php" class="btn btn-danger">Logout</a>

    </div>

    <script>
    function editClassroom(id, name) {
        document.getElementById('name').value = name;
        document.getElementById('classroom_id').value = id;
    }

    function validateClassroomForm() {
        const name = document.getElementById('name').value;
        const namePattern = /^[a-zA-Z0-9 ]+$/;

        if (!namePattern.test(name)) {
            alert("Classroom Name should contain only letters, numbers, and spaces.");
            return false;
        }
        return true;
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
