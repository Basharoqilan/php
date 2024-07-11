<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" name="text">
        <button type="submit">Submit</button>
    </form>
    <?php
    session_start();
    
    if (!isset($_SESSION['ToDoList'])) {
        $_SESSION['ToDoList'] = array();
    }

    if (!empty($_POST["text"])) {
        $_SESSION['ToDoList'][] = $_POST["text"];
    }

    echo "<ul>";
    foreach ($_SESSION['ToDoList'] as $item) {
        echo "<li>" . htmlspecialchars($item) . "</li>";
    }
    echo "</ul>";
    ?>
</body>
</html>
