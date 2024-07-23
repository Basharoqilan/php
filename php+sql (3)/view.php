<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "admin";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

session_start();

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check if 'id' parameter is present in URL
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("location: welcome.php");
    exit;
}

$id = intval($_GET["id"]); // Safely convert to integer

// Prepare and execute the SQL statement
$stmt = $connection->prepare("SELECT * FROM superuser WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("location: welcome.php");
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <h2>View User</h2>
    <table class="table">
        <tbody>
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($row['ID']); ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($row['Name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($row['Email']); ?></td>
            </tr>
            <tr>
                <th>Date Created</th>
                <td><?php echo htmlspecialchars($row['date_created']); ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo htmlspecialchars($row['Phone_number']); ?></td>
            </tr>
            <tr>
                <th>Role ID</th>
                <td><?php echo htmlspecialchars($row['id_roles']); ?></td>
            </tr>
        </tbody>
    </table>
    <p><a href="welcome.php" class="btn btn-primary">Back to List</a></p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
