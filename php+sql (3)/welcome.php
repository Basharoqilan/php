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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php if (isset($_SESSION["id_roles"]) && $_SESSION["id_roles"] == 1): ?>
    <div class="container my-5">
        <h2>List of users</h2>
        <a class="btn btn-primary" href="create.php" role="button">Add users</a>
        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User_image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Phone Number</th>
                    <th>Role ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Prepare the SQL statement
                $stmt = $connection->prepare("SELECT * FROM superuser");
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>" . htmlspecialchars($row['ID']) . "</td>
                            <td><img src='" . htmlspecialchars($row['User_image']) . "' alt='User Image' style='width: 50px; height: 50px;'></td>
                            <td>" . htmlspecialchars($row['Name']) . "</td>
                            <td>" . htmlspecialchars($row['Email']) . "</td>
                            <td>" . htmlspecialchars($row['date_created']) . "</td>
                            <td>" . htmlspecialchars($row['Phone_number']) . "</td>
                            <td>" . htmlspecialchars($row['id_roles']) . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='edit.php?id=" . htmlspecialchars($row['ID']) . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=" . htmlspecialchars($row['ID']) . "'>Delete</a>
                                <a class='btn btn-secondary btn-sm' href='view.php?id=" . htmlspecialchars($row['ID']) . "'>View</a>
                            </td>
                        </tr>
                    ";
                }
                $stmt->close();
                ?>
            </tbody>
        </table>
        <p><a href="logout.php" class="btn btn-danger">Logout</a></p>

    </div>
<?php else: ?>
    <div class="container my-5">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION["Name"]); ?>!</h2>
        <p><a href="logout.php" class="btn btn-danger">Logout</a></p>
    </div>
<?php endif; ?>
</body>
</html>
