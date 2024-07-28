<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

if ($requestMethod == 'POST') {
    $inputdata = json_decode(file_get_contents("php://input"), true);
    
    if (empty($inputdata)) {
        $inputdata = $_POST;
    }

    echo storeStudent($inputdata);
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

function storeStudent($studentInput)
{
    global $connection;

    $name = $studentInput['name'] ?? '';
    $date_of_birth = $studentInput['date_of_birth'] ?? '';
    $address = $studentInput['address'] ?? '';
    $contact_info = $studentInput['contact_info'] ?? '';

    if (empty(trim($name))) {
        return error422('Enter your name');
    } elseif (empty(trim($date_of_birth))) {
        return error422('Enter your date of birth');
    } elseif (empty(trim($address))) {
        return error422('Enter your address');
    } elseif (empty(trim($contact_info))) {
        return error422('Enter your contact info');
    } else {
        $sql = "INSERT INTO students (name, date_of_birth, address, contact_info) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss", $name, $date_of_birth, $address, $contact_info);

        if ($stmt->execute()) {
            $data = [
                'status' => 201,
                'message' => 'Student created successfully'
            ];
            header("HTTP/1.0 201 Created");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error'
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }

        $stmt->close();
    }
}

$connection->close();
?>
