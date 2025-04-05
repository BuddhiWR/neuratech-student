<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registered Students</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .table-container {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    thead input {
      width: 100%;
      box-sizing: border-box;
      padding: 6px;
    }
  </style>
</head>
<body>

<header class="header">
  <div class="container header-logo">
    <img src="assets/images/neuratech-logo.png" alt="Neuratech Logo" class="logo-img">
    <div>
      <h1>Registered Student List</h1>
      <p>All students currently registered in the system</p>
    </div>
  </div>
</header>

<main class="main-section">
  <div class="table-container">
    <table border="1" cellpadding="10" cellspacing="0" id="studentTable">
      <thead>
        <tr>
          <th>ID<br><input type="text" onkeyup="filterTable(0)" placeholder="Search ID"></th>
          <th>Reg Date<br><input type="text" onkeyup="filterTable(1)" placeholder="YYYY-MM-DD"></th>
          <th>Reg Time<br><input type="text" onkeyup="filterTable(2)" placeholder="HH:MM:SS"></th>
          <th>Name<br><input type="text" onkeyup="filterTable(3)" placeholder="Search Name"></th>
          <th>NIC<br><input type="text" onkeyup="filterTable(4)" placeholder="Search NIC"></th>
          <th>Birthday<br><input type="text" onkeyup="filterTable(5)" placeholder="Search Birthday"></th>
          <th>School<br><input type="text" onkeyup="filterTable(6)" placeholder="Search School"></th>
          <th>Contact<br><input type="text" onkeyup="filterTable(7)" placeholder="Search Contact"></th>
          <th>Email<br><input type="text" onkeyup="filterTable(8)" placeholder="Search Email"></th>
          <th>Profile Photo</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM students ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $studentId = date("Y") . str_pad($row['id'], 3, '0', STR_PAD_LEFT);
            $regDate = date('Y-m-d', strtotime($row['created_at']));
            $regTime = date('H:i:s', strtotime($row['created_at']));
            
            // Convert full Windows path to relative path (just filename)
            $photoFileName = basename($row['profilePhoto']);
            $photoPath = "uploads/profile_photos/" . $photoFileName;

            echo "<tr>
                    <td>$studentId</td>
                    <td>$regDate</td>
                    <td>$regTime</td>
                    <td>{$row['name']}</td>
                    <td>{$row['nic']}</td>
                    <td>{$row['birthday']}</td>
                    <td>{$row['school']}</td>
                    <td>{$row['contactNo']}</td>
                    <td>{$row['email']}</td>
                    <td><img src='$photoPath' width='60' onerror=\"this.src='assets/images/default-profile.png';\"></td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='10' style='text-align:center;'>No students registered yet.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <br>
</main>

<div class="table-actions" style="text-align: right; margin: 10px;">
  <button id="exportCSV" class="btn">Export to CSV</button>
</div>

<a href="index.php" class="btn">Back to Home</a>

<script>
function filterTable(columnIndex) {
  const input = document.querySelectorAll('thead input')[columnIndex];
  const filter = input.value.toLowerCase();
  const table = document.getElementById("studentTable");
  const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

  for (let row of rows) {
    const cell = row.getElementsByTagName("td")[columnIndex];
    if (cell) {
      const txtValue = cell.textContent || cell.innerText;
      row.style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
    }
  }
}
</script>

<script>
  document.getElementById('exportCSV').addEventListener('click', function () {
    const table = document.getElementById('studentTable');
    const rows = table.querySelectorAll('tr');
    let csv = [];

    rows.forEach(row => {
      const cols = row.querySelectorAll('th, td');
      let rowData = [];
      cols.forEach(col => {
        rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
      });
      csv.push(rowData.join(','));
    });

    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.setAttribute("download", "neuratech_registered_students.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  });
</script>

<footer class="footer">
  <p>&copy; <?php echo date("Y"); ?> Neuratech. All rights reserved.</p>
</footer>

</body>
</html>
