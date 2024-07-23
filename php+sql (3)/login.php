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

// Variables for login
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check input errors before checking in database
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, Name, Email, password, id_roles FROM  superuser WHERE Email = ?";

        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $email, $hashed_password, $id_roles);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["Name"] = $name;
                            $_SESSION["Email"] = $email;
                            $_SESSION["id_roles"] = $id_roles; 

                            header("location: welcome.php");
                            exit;
                        } else {
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid email or password.";
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Login</h2>
        <?php
        if (!empty($login_err)) {
            echo "<div class='alert alert-danger'>$login_err</div>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
                <span class="text-danger"><?php echo $email_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Clear previous errors
            document.getElementById("email_err").textContent = "";
            document.getElementById("password_err").textContent = "";

            // Validate Email
            const email = document.getElementById("email").value.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                document.getElementById("email_err").textContent = "Please enter your email.";
                isValid = false;
            } else if (!emailPattern.test(email)) {
                document.getElementById("email_err").textContent = "Invalid email format.";
                isValid = false;
            }

            // Validate Password
            const password = document.getElementById("password").value.trim();
            if (password === "") {
                document.getElementById("password_err").textContent = "Please enter your password.";
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    </script>
</body>
</html>
