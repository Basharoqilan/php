<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$servername = "localhost";
$username = "root";
$password = "";
$database = "my_school";  

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

    echo storeTeacher($inputdata);
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

function storeTeacher($teacherInput)
{
    global $connection;

    $Name = $teacherInput['Name'] ?? '';
    $Subjects = $teacherInput['Subjects'] ?? '';
    $ContactInfo = $teacherInput['ContactInfo'] ?? '';

    if (empty(trim($Name))) {
        return error422('Enter the teacher\'s name');
    } elseif (empty(trim($Subjects))) {
        return error422('Enter the subjects taught by the teacher');
    } elseif (empty(trim($ContactInfo))) {
        return error422('Enter the contact information');
    } else {
        $sql = "INSERT INTO teachers (Name, Subjects, ContactInfo) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $Name, $Subjects, $ContactInfo);

        if ($stmt->execute()) {
            $data = [
                'status' => 201,
                'message' => 'Teacher created successfully'
            ];
            header("HTTP/1.0 201 Created");
            echo json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error: ' . $stmt->error
            ];
            header("HTTP/1.0 500 Internal Server Error");
            echo json_encode($data);
        }

        $stmt->close();
    }
}

$connection->close();
?>
