<?php
include 'db.php';

$q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$sql = "SELECT * FROM students WHERE name LIKE '%$q%' OR nic LIKE '%$q%' ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$students = [];
while ($row = $result->fetch_assoc()) {
  $students[] = $row;
}

header('Content-Type: application/json');
echo json_encode($students);
?>
