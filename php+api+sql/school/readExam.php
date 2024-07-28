<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$servername = "localhost";
$username = "root";
$password = "";
$database = "my_school";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'GET') {

  

        echo getExamList();
    
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}




function getExamList() {
    global $connection;
    $sql = "SELECT * FROM exams";
    $sql_run = mysqli_query($connection, $sql);

    if ($sql_run) {
        if (mysqli_num_rows($sql_run) > 0) {
            $resp = mysqli_fetch_all($sql_run, MYSQLI_ASSOC);
            $data = [
                'status' => 201,
                'message' => 'exams Fetched Successfully',
                'data' => $resp
            ];
            header("HTTP/1.0 201 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No exams Found'
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
