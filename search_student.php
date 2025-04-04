<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Student</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="header">
  <h1>Search Students</h1>
  <p>Find registered students by name or NIC</p>
</header>

<main class="main-section">
  <form method="GET" action="" class="search-form">
    <input type="text" name="q" placeholder="Search by Name or NIC..." value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>" required>
    <button type="submit">🔍 Search</button>
  </form>

<?php
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$offset = ($page - 1) * $limit;

// Count total
$countSql = "SELECT COUNT(*) AS total FROM students WHERE name LIKE '%$q%' OR nic LIKE '%$q%'";
$countResult = $conn->query($countSql);
$total = $countResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

// Search & limit
$sql = "SELECT * FROM students WHERE name LIKE '%$q%' OR nic LIKE '%$q%' ORDER BY id DESC LIMIT $limit OFFSET $offset";
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

  // Pagination
  if ($totalPages > 1) {
    echo "<div class='pagination'>";
    if ($page > 1) {
      echo "<a href='?q=$q&page=" . ($page - 1) . "'>⬅ Prev</a>";
    }
    for ($i = 1; $i <= $totalPages; $i++) {
      $active = $i == $page ? 'active' : '';
      echo "<a href='?q=$q&page=$i' class='$active'>$i</a>";
    }
    if ($page < $totalPages) {
      echo "<a href='?q=$q&page=" . ($page + 1) . "'>Next ➡</a>";
    }
    echo "</div>";
  }

} else {
  echo "<p style='text-align:center;'>No students found for '<strong>$q</strong>'</p>";
}
?>
</main>

<footer class="footer">
  <p>&copy; <?php echo date("Y"); ?> Neuratech. All rights reserved.</p>
</footer>

</body>
</html>
