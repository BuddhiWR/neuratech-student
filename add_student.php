<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/reset.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="header">
  <h1>Neuratech Student Registration</h1>
  <p>Enter student information to register</p>
</header>

<main class="main-section">
  <form method="POST" action="" class="form" enctype="multipart/form-data">
    <label for="name">👤 Name</label>
    <input type="text" name="name" id="name" required>

    <label for="nic">🪪 NIC</label>
    <input type="text" name="nic" id="nic" required>

    <label for="birthday">🎂 Birthday</label>
    <input type="date" name="birthday" id="birthday" required>
<br>
    <label for="school">🏫 School</label>
    <input type="text" name="school" id="school" required>

    <div class="input-row">
      <div class="input-half">
        <label for="profilePhoto">🖼️ Upload Profile Photo</label>
        <input type="file" name="profilePhoto" id="profilePhoto" accept="image/*" required>
      </div>
      <div class="input-half">
        <label for="contactNo">📞 Contact Number</label>
        <input type="text" name="contactNo" id="contactNo" required>
      </div>
    </div>

    <label for="email">📧 Email</label>
    <input type="email" name="email" id="email" required>

    <button type="submit" name="submit">➕ Register Student</button>
    <button type="button" onclick="window.location.href='qrscan.php'">📷 Scan QR</button>
  </form>

<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $nic = $_POST['nic'];
  $birthday = $_POST['birthday'];
  $school = $_POST['school'];
  $contactNo = $_POST['contactNo'];
  $email = $_POST['email'];

  // File upload
  $uploadDir = 'uploads/';
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
  }

  $profilePhoto = $_FILES['profilePhoto']['name'];
  $targetFile = $uploadDir . basename($profilePhoto);
  move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $targetFile);

  // Insert into DB
  $sql = "INSERT INTO students (name, nic, birthday, school, contactNo, email, profilePhoto)
          VALUES ('$name', '$nic', '$birthday', '$school', '$contactNo', '$email', '$targetFile')";

  if ($conn->query($sql)) {
    $id = $conn->insert_id;

    // 🎓 Generate formatted ID (e.g. 2025001)
    $yearPrefix = date("Y");
    $formattedId = $yearPrefix . str_pad($id, 3, '0', STR_PAD_LEFT);

    echo "<div class='student-card'>
            <h3>🎓 Student Card</h3>
            <p><strong>Student ID:</strong> $formattedId</p>
            <p><strong>Name:</strong> $name</p>
            <p><strong>NIC:</strong> $nic</p>
            <p><strong>Birthday:</strong> $birthday</p>
            <p><strong>School:</strong> $school</p>
            <p><strong>Contact:</strong> $contactNo</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Photo:</strong><br>
              <img src='$targetFile' width='120' style='margin-top:10px;'>
            </p>
            <br>
            <a href='generate_pdf.php?id=$id' target='_blank' class='btn'>📄 Download PDF</a>
          </div>";
  } else {
    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
  }
}
?>
</main>

<footer class="footer">
  <p>&copy; <?php echo date("Y"); ?> Neuratech. All rights reserved.</p>
</footer>

</body>
</html>
