<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>php crud</title>
</head>
<body>
<div class = "container my-5">
    <h2>list of employees</h2>
    <a class = "btn btn-primary" href = "create.php" role = "button">New employee</a>
    <br>
    <table class ="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "crud_database";
            $con = mysqli_connect($servername ,$username , $password , $dbname );
            if(!$con)
{
    die("connection failed" . $con->connect_error);
}
$sql = "SELECT * FROM employees";
$result = $con->query($sql);
if(!$result)
{
    die("Invalid query : " . $con->error);
}

while($row = $result->fetch_assoc())
{
  echo "
        <tr>
                <td>$row[id]</td>
                <td>$row[Name]</td>
                <td>$row[Address]</td>
                <td>$row[Salary]</td>
                <td>
                    <a class = 'btn btn-primary btn-sm' href = 'edit.php?id=$row[id]'>Edit</a>
                    <a class = 'btn btn-danger btn-sm' href = 'delete.php?id=$row[id]'>Delete</a>
                    <a class = 'btn btn-secondary btn-sm' href = 'view.php?id=$row[id]'>view</a>
                </td>
            </tr>
  ";  
}
            ?>
      
        </tbody>
    </table>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>