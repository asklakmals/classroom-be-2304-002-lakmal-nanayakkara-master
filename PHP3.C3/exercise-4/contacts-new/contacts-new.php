<?php
// Database configuration
$host = "localhost"; // Change as necessary
$dbname = "contacts_db";
$username = "root"; // Change as necessary
$password = ""; // Change as necessary

// Error handling
function handleError($message)
{
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

// Function to fetch contacts with sorting and search functionality
function fetchContacts($column = "id", $order = "ASC", $search = "")
{
    global $pdo;
    $query = "SELECT * FROM contacts";

    // Add search functionality
    if (!empty($search)) {
        $query .= " WHERE name LIKE :search OR email LIKE :search OR phone LIKE :search";
    }

    // Add sorting functionality
    $query .= " ORDER BY $column $order";

    try {
        $stmt = $pdo->prepare($query);

        // Bind search parameter if present
        if (!empty($search)) {
            $stmt->bindValue(":search", "%" . $search . "%", PDO::PARAM_STR);
        }

        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    } catch (PDOException $e) {
        handleError("Query failed: " . $e->getMessage());
    }
}

// Determine sort column and order based on user selection
$column = isset($_GET["colToSort"]) ? $_GET["colToSort"] : "id";
$order = isset($_GET["sort"]) ? $_GET["sort"] : "ASC";

// Determine search term
$search = isset($_GET["search"]) ? $_GET["search"] : "";

// Fetch contacts
$contacts = fetchContacts($column, $order, $search);

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

// Display search form
echo '<form method="get" action="">
    <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone" value="' .
    htmlspecialchars($search) .
    '">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>';

// Display table headers with sort buttons
echo '<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>ID
                <a href="?colToSort=id&sort=ASC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↑</a>
                <a href="?colToSort=id&sort=DESC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↓</a>
            </th>
            <th>Name
                <a href="?colToSort=name&sort=ASC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↑</a>
                <a href="?colToSort=name&sort=DESC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↓</a>
            </th>
            <th>Email
                <a href="?colToSort=email&sort=ASC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↑</a>
                <a href="?colToSort=email&sort=DESC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↓</a>
            </th>
            <th>Phone
                <a href="?colToSort=phone&sort=ASC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↑</a>
                <a href="?colToSort=phone&sort=DESC&search=' .
    htmlspecialchars($search) .
    '" class="btn btn-sm btn-light">↓</a>
            </th>
        </tr>
    </thead>
    <tbody>';

foreach ($contacts as $contact) {
    echo '<tr>
        <td>' .
        htmlspecialchars($contact["id"]) .
        '</td>
        <td>' .
        htmlspecialchars($contact["name"]) .
        '</td>
        <td>' .
        htmlspecialchars($contact["email"]) .
        '</td>
        <td>' .
        htmlspecialchars($contact["phone"]) .
        '</td>
    </tr>';
}

echo '</tbody>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';
?>