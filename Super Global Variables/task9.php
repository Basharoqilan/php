<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>
<body>
    <form method="get" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit">Submit</button>
    </form>

    <?php
            $password =$_GET['password'];
            $email = $_GET['email'];
            echo "<p>Email: $email</p>";
            echo "<p>Password: $password</p>";
        
    ?>
</body>
</html>
