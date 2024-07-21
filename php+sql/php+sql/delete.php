<?php
if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_database";

$con = new mysqli($servername, $username, $password, $dbname);

$sql = "DELETE FROM employees WHERE id = $id";
$con->query($sql);
}
header("location: index.php");
exit;
?>