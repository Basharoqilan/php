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
    if (isset($_GET['student_name']) && !empty($_GET['student_name'])) {
        $student_name = $_GET['student_name'];
        echo getSubjectList($student_name);
    } elseif (isset($_GET['subject_name']) && !empty($_GET['subject_name'])) {
        $subject_name = $_GET['subject_name'];
        echo getStudentsList($subject_name);
    } else {
        $data = [
            'status' => 422,
            'message' => 'Student Name or Subject Name not provided or empty'
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

function getSubjectList($student_name) {
    global $connection;
    $sql = "SELECT students.Name AS StudentName, subjects.name AS SubjectName
            FROM studentsubjects
            JOIN students ON students.StudentID = studentsubjects.StudentID
            JOIN subjects ON subjects.SubjectID = studentsubjects.SubjectID
            WHERE students.Name = ?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        $data = [
            'status' => 500,
            'message' => 'Failed to prepare statement: ' . $connection->error
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
    $stmt->bind_param("s", $student_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $resp = $result->fetch_all(MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Subjects Fetched Successfully',
                'data' => $resp
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No subjects found for the given student name'
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

function getStudentsList($subject_name) {
    global $connection;
    $sql = "SELECT subjects.name AS SubjectName, students.Name AS StudentName
            FROM studentsubjects
            JOIN students ON students.StudentID = studentsubjects.StudentID
            JOIN subjects ON subjects.SubjectID = studentsubjects.SubjectID
            WHERE subjects.name = ?";
    $stmt = $connection->prepare($sql);
    if (!$stmt) {
        $data = [
            'status' => 500,
            'message' => 'Failed to prepare statement: ' . $connection->error
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
    $stmt->bind_param("s", $subject_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $resp = $result->fetch_all(MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Students Fetched Successfully',
                'data' => $resp
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No students found for the given subject name'
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
