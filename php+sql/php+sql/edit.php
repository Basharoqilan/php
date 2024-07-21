<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_database";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = "";
$name = "";
$address = "";
$salary = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: index.php");
        exit;
    }

    $id = $_GET["id"];
    
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: index.php");
        exit;
    }

    $name = $row["Name"];
    $address = $row["Address"];
    $salary = $row["Salary"];
} else {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $salary = $_POST["salary"];
    $id = $_POST["id"];

    do {
        if (empty($id) || empty($name) || empty($address) || empty($salary)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE employees SET name = '$name', address = '$address', salary = '$salary' WHERE id = $id";
        $result = $con->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $con->error;
            break;
        }

        $successMessage = "Client updated correctly";
        header("Location: index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>PHP CRUD</title>
</head>
<body>
<div class="container my-5">
    <h2>Edit Employee</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>

    <form method="post"> 
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Salary</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="salary" value="<?php echo htmlspecialchars($salary); ?>">
            </div>
        </div>

        <?php
        if (!empty($successMessage)) {
            echo "<div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                  </div>";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="offset-sm-3 col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
