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

// Handle form submission for adding/updating students
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_form'])) {
    $reg_no = input_filter($_POST['reg_no'] ?? '');
    $name = input_filter($_POST['name'] ?? '');
    $grade = input_filter($_POST['grade'] ?? '');
    $classroom_id = input_filter($_POST['classroom_id'] ?? '');

    // Server-side validation
    if (!preg_match("/^[a-zA-Z0-9]+$/", $reg_no)) {
        $message = "Registration No should contain only letters and numbers, no spaces.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $message = "Student Name should contain only letters and spaces.";
    } elseif (!preg_match("/^[A-F]$/", $grade)) {
        $message = "Grade should be a capital letter between A and F.";
    } elseif (!preg_match("/^[a-zA-Z0-9 ]+$/", $classroom_id)) {
        $message = "Classroom should contain only letters, numbers, and spaces.";
    } elseif (!empty($reg_no) && !empty($name) && !empty($grade) && !empty($classroom_id)) {
        if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
            $student_id = $_POST['student_id'];
            $stmt = mysqli_prepare($conn, "UPDATE students SET reg_no = ?, name = ?, grade = ?, classroom_id = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "sssii", $reg_no, $name, $grade, $classroom_id, $student_id);
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO students (reg_no, name, grade, classroom_id) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssi", $reg_no, $name, $grade, $classroom_id);
        }
        if (mysqli_stmt_execute($stmt)) {
            $message = "Student successfully saved!";
        } else {
            $message = "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "All fields are required!";
    }
}

// Handle deletion of a student
if (isset($_GET['delete_student_id'])) {
    $delete_student_id = $_GET['delete_student_id'];
    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $delete_student_id);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Student successfully deleted!";
    } else {
        $message = "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

// Fetch classroom options for the form
$classroom_options = "";
$result = mysqli_query($conn, "SELECT * FROM classrooms");
while ($row = mysqli_fetch_assoc($result)) {
    $classroom_options .= "<option value='{$row['id']}'>{$row['name']}</option>";
}
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Student Registration</h2>
        <hr>

        <?php if ($message != ""): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="index.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="reg_no">Registration No*</label>
                <input type="text" class="form-control" id="reg_no" name="reg_no" pattern="[a-zA-Z0-9]+" required>
                <small class="form-text text-muted">Numbers and letters only, no spaces.</small>
            </div>
            <div class="form-group">
                <label for="name">Student Name*</label>
                <input type="text" class="form-control" id="name" name="name" pattern="[a-zA-Z ]+" required>
                <small class="form-text text-muted">Letters and spaces only.</small>
            </div>
            <div class="form-group">
                <label for="grade">Grade*</label>
                <input type="text" class="form-control" id="grade" name="grade" pattern="[A-F]" maxlength="1" required>
                <small class="form-text text-muted">Capital letters A to F only.</small>
            </div>
            <div class="form-group">
                <label for="classroom_id">Classroom*</label>
                <select class="form-control" id="classroom_id" name="classroom_id" required>
                    <option value="">Select Classroom</option>
                    <?php echo $classroom_options; ?>
                </select>
            </div>
            <input type="hidden" name="student_id" id="student_id">
            <input type="hidden" name="student_form" value="1">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

        <hr>
        <h4>Student List</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Registration No</th>
                    <th>Student Name</th>
                    <th>Grade</th>
                    <th>Classroom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT s.id, s.reg_no, s.name, s.grade, s.classroom_id, c.name as classroom_name FROM students s JOIN classrooms c ON s.classroom_id = c.id");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['reg_no']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['grade']}</td>
                        <td>{$row['classroom_name']}</td>
                        <td>
                            <button class='btn btn-warning' onclick='editStudent({$row['id']}, \"{$row['reg_no']}\", \"{$row['name']}\", \"{$row['grade']}\", \"{$row['classroom_id']}\")'>Update</button>
                            <a href='index.php?delete_student_id={$row['id']}' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                mysqli_free_result($result);
                ?>
            </tbody>
        </table>

        <a href="classrooms.php" class="btn btn-secondary">Manage Classrooms</a>
		<a href="report.php" class="btn btn-info">Students by Classroom</a>
		<a href="logout.php" class="btn btn-danger">Logout</a>

    </div>

    <script>
    function editStudent(id, reg_no, name, grade, classroom_id) {
        document.getElementById('reg_no').value = reg_no;
        document.getElementById('name').value = name;
        document.getElementById('grade').value = grade;
        document.getElementById('classroom_id').value = classroom_id;
        document.getElementById('student_id').value = id;
    }

    function validateForm() {
        const regNo = document.getElementById('reg_no').value;
        const name = document.getElementById('name').value;
        const grade = document.getElementById('grade').value;

        const regNoPattern = /^[a-zA-Z0-9]+$/;
        const namePattern = /^[a-zA-Z ]+$/;
        const gradePattern = /^[A-F]$/;

        if (!regNoPattern.test(regNo)) {
            alert("Registration No should contain only letters and numbers, no spaces.");
            return false;
        }
        if (!namePattern.test(name)) {
            alert("Student Name should contain only letters and spaces.");
            return false;
        }
        if (!gradePattern.test(grade)) {
            alert("Grade should be a capital letter between A and F.");
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