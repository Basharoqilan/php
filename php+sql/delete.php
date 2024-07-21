<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_database";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Prepare the SQL statement
    $stmt = $con->prepare("DELETE FROM employees WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect on success
            header("Location: index.php");
            exit;
        } else {
            // Handle error
            echo "Error executing query: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing query: " . $con->error;
    }
}

$con->close();
?>
