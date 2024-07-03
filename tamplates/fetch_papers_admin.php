<?php
include 'db.php';

$sql = "SELECT * FROM papers";
$result = $conn->query($sql);

$papers = [];
while ($row = $result->fetch_assoc()) {
    $papers[] = $row;
}

header('Content-Type: application/json');
echo json_encode($papers);

$conn->close();
?>
