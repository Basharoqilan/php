<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$servername = "localhost";
$username = "root";
$password = "";
$database = "school";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die(json_encode([
        'status' => 500,
        'message' => 'Connection failed: ' . $connection->connect_error
    ]));
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'DELETE') {
    $inputdata = json_decode(file_get_contents("php://input"), true);

    if (isset($inputdata['id']) && !empty($inputdata['id'])) {
        $deletestudent = deletestudent($inputdata);
        echo $deletestudent;
    } else {
        $data = [
            'status' => 422,
            'message' => 'Student ID not provided or empty',
            'input_data' => $inputdata
        ];
        header("HTTP/1.0 422 Unprocessable Entity");
        echo json_encode($data);
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function deletestudent($studentInput)
{
    global $connection;

    if (!isset($studentInput['id'])) {
        return error422('Student ID not provided');
    } elseif ($studentInput['id'] == null) {
        return error422('Enter the student ID');
    }

    $studentId = $studentInput['id'];
    $sql = "DELETE FROM students WHERE id='$studentId' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    
    if ($result && mysqli_affected_rows($connection) > 0) {
        $data = [
            'status' => 204,
            'message' => 'Student deleted successfully'
        ];
        header("HTTP/1.0 204 No Content");
        echo json_encode($data);
    } else {
        $data = [
            'status' => 404,
            'message' => 'Student not found'
        ];
        header("HTTP/1.0 404 Not Found");
        echo json_encode($data);
    }
}

$connection->close();
?>
