<?php
if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

$con = new mysqli($servername, $username, $password, $dbname);

$sql = "DELETE FROM superuser WHERE id = $id";
$con->query($sql);
}
header("location: welcome.php");
exit;
?>