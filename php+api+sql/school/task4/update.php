<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

if ($requestMethod == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['exam_id']) && !empty($data['exam_id'])) {
        $exam_id = $data['exam_id'];
        $exam_name = isset($data['exam_name']) ? $data['exam_name'] : null;
        $exam_date = isset($data['exam_date']) ? $data['exam_date'] : null;
        $score = isset($data['score']) ? $data['score'] : null;

        echo updateExam($exam_id, $exam_name, $exam_date, $score);
    } else {
        $response = [
            'status' => 422,
            'message' => 'Exam ID not provided or empty'
        ];
        header("HTTP/1.0 422 Unprocessable Entity");
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($response);
}

function updateExam($exam_id, $exam_name, $exam_date, $score) {
    global $connection;
    $fields = [];
    $types = "";
    $params = [];

    if (!is_null($exam_name)) {
        $fields[] = "ExamName = ?";
        $types .= "s";
        $params[] = $exam_name;
    }

    if (!is_null($exam_date)) {
        $fields[] = "ExamDate = ?";
        $types .= "s";
        $params[] = $exam_date;
    }

    if (!is_null($score)) {
        $fields[] = "Score = ?";
        $types .= "i";
        $params[] = $score;
    }

    if (empty($fields)) {
        $response = [
            'status' => 422,
            'message' => 'No fields to update'
        ];
        header("HTTP/1.0 422 Unprocessable Entity");
        return json_encode($response);
    }

    $params[] = $exam_id;
    $types .= "i";

    $sql = "UPDATE exams SET " . implode(", ", $fields) . " WHERE ExamID = ?";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        $response = [
            'status' => 500,
            'message' => 'Failed to prepare statement: ' . $connection->error
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($response);
    }

    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = [
            'status' => 200,
            'message' => 'Exam updated successfully'
        ];
        header("HTTP/1.0 200 OK");
        return json_encode($response);
    } else {
        $response = [
            'status' => 404,
            'message' => 'Exam not found or no changes made'
        ];
        header("HTTP/1.0 404 Not Found");
        return json_encode($response);
    }
}
?>
