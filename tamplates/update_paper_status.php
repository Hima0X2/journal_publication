<?php
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id']);
$status = $conn->real_escape_string($data['status']);

$sql = "UPDATE papers SET status = '$status' WHERE id = $id";
$success = $conn->query($sql);

$response = ['success' => $success];
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
