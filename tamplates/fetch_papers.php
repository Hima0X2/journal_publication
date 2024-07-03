<?php
include 'db.php';

$sql = "SELECT * FROM papers WHERE status='accepted'";
$result = $conn->query($sql);

$papers = array();
while ($row = $result->fetch_assoc()) {
    $papers[] = $row;
}

header('Content-Type: application/json');
echo json_encode($papers);
?>
