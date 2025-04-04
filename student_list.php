<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registered Students</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="header">
<div class="container header-logo">
    <img src="assets/images/neuratech-logo.png" alt="Neuratech Logo" class="logo-img">
    <div>
  <h1>Registered Students</h1>
  <p>Complete list of students enrolled in the system</p>
</header>

<main class="main-section">
<?php
$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<div class='search-results'>";
  while ($row = $result->fetch_assoc()) {
    $studentId = date("Y") . str_pad($row['id'], 3, '0', STR_PAD_LEFT);
    echo "
    <div class='student-result'>
      <img src='{$row['profilePhoto']}' alt='Photo of {$row['name']}' class='result-photo'>
      <div class='result-info'>
        <h3>{$row['name']}</h3>
        <p><strong>Student ID:</strong> $studentId</p>
        <p><strong>NIC:</strong> {$row['nic']}</p>
        <p><strong>School:</strong> {$row['school']}</p>
        <p><strong>Contact:</strong> {$row['contactNo']}</p>
        <a href='generate_pdf.php?id={$row['id']}' class='btn' target='_blank'>📄 PDF Card</a>
      </div>
    </div>";
  }
  echo "</div>";
} else {
  echo "<p style='text-align:center;'>No students found in the system.</p>";
}
?>
</main>

<a href="index.php" class="btn back-btn">⬅ Home</a>


<footer class="footer">
  <p>&copy; <?php echo date("Y"); ?> Neuratech. All rights reserved.</p>
</footer>

</body>
</html>
