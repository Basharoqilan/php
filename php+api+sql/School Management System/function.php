<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "school";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

function getstudentList() {
    global $connection;
    $sql = "SELECT * FROM students";
    $sql_run = mysqli_query($connection, $sql);

    if ($sql_run) {
        if (mysqli_num_rows($sql_run) > 0) {
            $resp = mysqli_fetch_all($sql_run, MYSQLI_ASSOC);
            $data = [
                'status' => 201,
                'message' => 'Users Fetched Successfully',
                'data' => $resp
            ];
            header("HTTP/1.0 201 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Users Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }


}
?>
