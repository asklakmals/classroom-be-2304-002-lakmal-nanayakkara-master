<?php
// Database configuration
$host = 'learn.localhost';  // Change as necessary
$dbname = 'contacts_db';
$username = 'root';   // Change as necessary
$password = '';       // Change as necessary

// Error handling
function handleError($message) {
    echo "<div class='alert alert-danger'>Error: $message</div>";
    exit();
}

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    handleError("Connection failed: " . $e->getMessage());
}

// Function to fetch contacts
function fetchContacts($fetchMode) {
    global $pdo;
    $query = "SELECT * FROM contacts";
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $contacts = $stmt->fetchAll($fetchMode);
        return $contacts;
    } catch (PDOException $e) {
        handleError("Query failed: " . $e->getMessage());
    }
}

// HTML Header
echo '<!DOCTYPE html>
<html>
<head>
    <title>Contacts List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Contacts List</h1>';

// Display buttons for different fetch modes
echo '<div class="mb-3">
    <form method="post" action="">
        <button type="submit" name="fetchMode" value="PDO::FETCH_ASSOC" class="btn btn-primary">Fetch As Associative Array</button>
        <button type="submit" name="fetchMode" value="PDO::FETCH_BOTH" class="btn btn-secondary">Fetch As Both</button>
        <button type="submit" name="fetchMode" value="PDO::FETCH_BOUND" class="btn btn-success">Fetch As Bound</button>
        <button type="submit" name="fetchMode" value="PDO::FETCH_CLASS" class="btn btn-info">Fetch As Class</button>
        <button type="submit" name="fetchMode" value="PDO::FETCH_OBJ" class="btn btn-warning">Fetch As Object</button>
    </form>
</div>';

// Determine fetch mode based on user selection
$fetchMode = PDO::FETCH_ASSOC; // Default mode
if (isset($_POST['fetchMode'])) {
    $fetchMode = intval($_POST['fetchMode']);
}

// Fetch and display contacts
$contacts = fetchContacts($fetchMode);

echo '<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>';

foreach ($contacts as $contact) {
    echo '<tr>
        <td>' . htmlspecialchars($contact['id']) . '</td>
        <td>' . htmlspecialchars($contact['name']) . '</td>
        <td>' . htmlspecialchars($contact['email']) . '</td>
        <td>' . htmlspecialchars($contact['phone']) . '</td>
    </tr>';
}

echo '</tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';
?>
