
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "admin";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$Name = $Email = $password = $confirm_password = $Phone_number = $User_image = "";
$Name_err = $Email_err = $password_err = $confirm_password_err = $Phone_number_err = $user_image_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Email
    if (empty(trim($_POST["Email"]))) {
        $Email_err = "Please enter your Email.";
    } elseif (!filter_var(trim($_POST["Email"]), FILTER_VALIDATE_EMAIL)) {
        $Email_err = "Invalid Email format.";
    } else {
        $Email = trim($_POST["Email"]);
    }

    // Validate Phone Number
    if (empty(trim($_POST["Phone_number"]))) {
        $Phone_number_err = "Please enter a Phone number.";
    } elseif (strlen(trim($_POST["Phone_number"])) != 10) {
        $Phone_number_err = "Phone number must have exactly 10 characters.";
    } else {
        $Phone_number = trim($_POST["Phone_number"]);
    }

    // Validate Name
    if (empty(trim($_POST["Name"]))) {
        $Name_err = "Please enter your Name.";
    } else {
        $Name = trim($_POST["Name"]);
        $Name_parts = explode(" ", $Name);
        if (count($Name_parts) != 4) {
            $Name_err = "Please enter a Name with exactly 4 parts.";
        } else {
            $Name = implode(" ", $Name_parts);
        }
    }

    // Validate Password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate Confirm Password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirm_password_err = "Passwords did not match.";
        }
    }

    // Handle file upload
    if (isset($_FILES["User_image"]) && $_FILES["User_image"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "img/";
        $targetFile = $targetDir . basename($_FILES["User_image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate image file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            $user_image_err = "Only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["User_image"]["tmp_name"], $targetFile)) {
                $User_image = $targetFile;
            } else {
                $user_image_err = "There was an error uploading your file.";
            }
        }
    } else {
        $user_image_err = "Please upload an image.";
    }

    // Check for errors and insert into database
    if (empty($Name_err) && empty($Email_err) && empty($password_err) && empty($confirm_password_err) && empty($Phone_number_err) && empty($user_image_err)) {
        $date_created = date("Y-m-d H:i:s");
        $id_roles = isset($_POST["id_roles"]) ? intval($_POST["id_roles"]) : 2;

        $sql = "INSERT INTO superuser (User_image, Name, Email, date_created, Phone_number, id_roles, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $connection->prepare($sql)) {
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $stmt->bind_param("sssssis", $User_image, $Name, $Email, $date_created, $Phone_number, $id_roles, $param_password);

            if ($stmt->execute()) {
                header("location: welcome.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .btn-danger {
            border-color: #007bff; 
        }
        .btn-extra-lg {
            font-size: 24px;
            padding: 15px 100px;
            border: 2px solid #007bff; 
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h2>Sign Up</h2>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id = "signupForm">

            <div class="mb-3">
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" class="form-control" value="<?php echo htmlspecialchars($Email); ?>">
                <span class="text-danger"><?php echo $Email_err; ?></span>
            </div>

            <div class="mb-3">
                <label for="Phone_number">Phone Number</label>
                <input type="text" id="Phone_number" name="Phone_number" class="form-control" value="<?php echo htmlspecialchars($Phone_number); ?>">
                <span class="text-danger"><?php echo $Phone_number_err; ?></span>
            </div>

            <div class="mb-3">
                <label for="Name">Name</label>
                <input type="text" id="Name" name="Name" class="form-control" value="<?php echo htmlspecialchars($Name); ?>">
                <span class="text-danger"><?php echo $Name_err; ?></span>
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>

            <div class="mb-3">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                <span class="text-danger"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="mb-3">
                <label for="User_image">User Image</label>
                <input type="file" id="User_image" name="User_image" class="form-control">
                <span class="text-danger"><?php echo $user_image_err; ?></span>
            </div>

          
<div class="row mb-3">
    <div class="col d-flex justify-content-center">
        <input type="submit" class="btn btn-primary btn-extra-lg mx-2" value="Submit">
        <a  href="welcome.php" class="btn btn-primary btn-extra-lg mx-2" role="button" >cancel</a>
    </div>
</div>

        </form>
    </div>

    <script>
        document.getElementById("signupForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Clear previous errors
            document.getElementById("Email_err").textContent = "";
            document.getElementById("Phone_number_err").textContent = "";
            document.getElementById("Name_err").textContent = "";
            document.getElementById("password_err").textContent = "";
            document.getElementById("confirm_password_err").textContent = "";
            document.getElementById("user_image_err").textContent = "";

            // Validate Email
            const email = document.getElementById("Email").value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                document.getElementById("Email_err").textContent = "Please enter your Email.";
                isValid = false;
            } else if (!emailPattern.test(email)) {
                document.getElementById("Email_err").textContent = "Invalid Email format.";
                isValid = false;
            }

            // Validate Phone Number
            const phoneNumber = document.getElementById("Phone_number").value.trim();
            if (phoneNumber === "") {
                document.getElementById("Phone_number_err").textContent = "Please enter a Phone number.";
                isValid = false;
            } else if (phoneNumber.length !== 10) {
                document.getElementById("Phone_number_err").textContent = "Phone number must have exactly 10 characters.";
                isValid = false;
            }

            // Validate Name
            const name = document.getElementById("Name").value.trim();
            const nameParts = name.split(" ");
            if (name === "") {
                document.getElementById("Name_err").textContent = "Please enter your Name.";
                isValid = false;
            } else if (nameParts.length !== 4) {
                document.getElementById("Name_err").textContent = "Please enter a Name with exactly 4 parts.";
                isValid = false;
            }

            // Validate Password
            const password = document.getElementById("password").value.trim();
            if (password === "") {
                document.getElementById("password_err").textContent = "Please enter a password.";
                isValid = false;
            } else if (password.length < 8) {
                document.getElementById("password_err").textContent = "Password must have at least 8 characters.";
                isValid = false;
            }

            // Validate Confirm Password
            const confirmPassword = document.getElementById("confirm_password").value.trim();
            if (confirmPassword === "") {
                document.getElementById("confirm_password_err").textContent = "Please confirm your password.";
                isValid = false;
            } else if (password !== confirmPassword) {
                document.getElementById("confirm_password_err").textContent = "Passwords did not match.";
                isValid = false;
            }

            // Validate User Image
            const userImage = document.getElementById("User_image").files[0];
            if (!userImage) {
                document.getElementById("user_image_err").textContent = "Please upload an image.";
                isValid = false;
            } else {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(userImage.type)) {
                    document.getElementById("user_image_err").textContent = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    isValid = false;
                }
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>











