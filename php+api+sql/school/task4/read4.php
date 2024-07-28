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
    if (isset($_GET['subject_id']) && !empty($_GET['subject_id'])) {
        $subject_id = $_GET['subject_id'];
        echo getSubjectExams($subject_id);
    } else {
        $data = [
            'status' => 422,
            'message' => 'Subject ID not provided or empty'
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

function getSubjectExams($subject_id) {
    global $connection;
    $sql = "SELECT subjects.name, exams.ExamName, exams.ExamDate
            FROM subjectexams
            JOIN subjects ON subjects.SubjectID = subjectexams.SubjectID
            JOIN exams ON exams.ExamID = subjectexams.ExamID
            WHERE subjects.SubjectID = ?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        $data = [
            'status' => 500,
            'message' => 'Failed to prepare statement: ' . $connection->error
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
    $stmt->bind_param("i", $subject_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $resp = $result->fetch_all(MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Exams Fetched Successfully',
                'data' => $resp
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No exams found for the given subject ID'
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
