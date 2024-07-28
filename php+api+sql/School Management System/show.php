<?php
header('Content-Type: application/json');
include 'db.php'; 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $connection->prepare('SELECT * FROM students WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        echo json_encode($student);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Student not found']);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid student ID']);
}
?>
