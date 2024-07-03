<?php
include 'db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM papers WHERE id = $id";
$result = $conn->query($sql);

$paper = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($paper);

$conn->close();
?>
