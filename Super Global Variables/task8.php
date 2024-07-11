<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

$cookie_name = "user";
$cookie_value = "bashar";
setcookie($cookie_name, $cookie_value, time() + 3600 , "/");
?>
</body>
</html>