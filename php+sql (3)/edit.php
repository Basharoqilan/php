<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: welcome.php");
        exit;
    }

    $id = intval($_GET["id"]);
    
    $sql = "SELECT * FROM superuser WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: welcome.php");
        exit;
    }

    $Email = $row["Email"];
    $Phone_number = $row["Phone_number"];
    $Name = $row["Name"];
    $User_image = $row["User_image"];
} else {
    $id = intval($_POST["id"]);
    $Email = $con->real_escape_string($_POST["Email"]);
    $Phone_number = $con->real_escape_string($_POST["Phone_number"]);
    $Name = $con->real_escape_string($_POST["Name"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    if (isset($_FILES["User_image"]) && $_FILES["User_image"]["error"] == 0) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["User_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            $errorMessage = "Only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["User_image"]["tmp_name"], $target_file)) {
                $User_image = $target_file;
            } else {
                $errorMessage = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $User_image = $row["User_image"];
    }

    if (empty($Email) || empty($Phone_number) || empty($Name) || empty($password) || empty($confirm_password) || empty($User_image)) {
        $errorMessage = "All fields are required";
    } elseif ($password !== $confirm_password) {
        $errorMessage = "Passwords do not match";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE superuser SET Email = ?, Phone_number = ?, Name = ?, password = ?, User_image = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssi', $Email, $Phone_number, $Name, $hashed_password, $User_image, $id);

        if ($stmt->execute()) {
            $successMessage = "Client updated correctly";
            header("Location: welcome.php");
            exit;
        } else {
            $errorMessage = "Invalid query: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
</head>
<body>
<div class="container my-5">
    <h2>Edit User</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>

    <?php
    if (!empty($successMessage)) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>

    <form method="post" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="Email" value="<?php echo htmlspecialchars($Email); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Phone_number" value="<?php echo htmlspecialchars($Phone_number); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="Name" value="<?php echo htmlspecialchars($Name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Confirm Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="confirm_password">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">User Image</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="User_image">
               
            </div>
        </div>
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <input type="submit" class="btn btn-primary btn-extra-lg mx-2" value="Submit">
                <a href="welcome.php" class="btn btn-secondary btn-extra-lg mx-2" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
