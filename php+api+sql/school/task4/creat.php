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
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['student_id']) && isset($input['subject_id'])) {
        $student_id = $input['student_id'];
        $subject_id = $input['subject_id'];
        echo registerStudentInSubject($student_id, $subject_id);
    } else {
        $data = [
            'status' => 422,
            'message' => 'Student ID and Subject ID are required'
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

function registerStudentInSubject($student_id, $subject_id) {
    global $connection;
    
    $check_sql = "SELECT * FROM studentsubjects WHERE StudentID = ? AND SubjectID = ?";
    $check_stmt = $connection->prepare($check_sql);
    $check_stmt->bind_param("ii", $student_id, $subject_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $data = [
            'status' => 409,
            'message' => 'Student is already registered in the subject'
        ];
        header("HTTP/1.0 409 Conflict");
        return json_encode($data);
    }

    $sql = "INSERT INTO studentsubjects (StudentID, SubjectID) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        $data = [
            'status' => 500,
            'message' => 'Failed to prepare statement: ' . $connection->error
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
    $stmt->bind_param("ii", $student_id, $subject_id);
    if ($stmt->execute()) {
        $data = [
            'status' => 201,
            'message' => 'Student registered in subject successfully'
        ];
        header("HTTP/1.0 201 Created");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Failed to register student in subject: ' . $stmt->error
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}
?>
