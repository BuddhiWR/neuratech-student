<?php include 'db.php'; ?>
<?php
require __DIR__ . '/vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
?>

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
  <div class="container header-logo">
    <img src="assets/images/neuratech-logo.png" alt="Neuratech Logo" class="logo-img">
    <div>
      <h1>Neuratech Student Registration</h1>
      <p>Enter student information to register</p>
    </div>
  </div>
</header>

<main class="main-section">
  <form method="POST" enctype="multipart/form-data" class="form">
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" name="name" required>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="nic">NIC</label>
        <input type="text" name="nic" required>
      </div>
      <div class="form-group">
        <label for="birthday">Date of Birth</label>
        <input type="date" name="birthday" required>
      </div>
    </div>
    <div class="form-group">
      <label for="school">School</label>
      <input type="text" name="school" required>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label for="contactNo">Contact Number</label>
        <input type="text" name="contactNo" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" required>
      </div>
    </div>

    <label>Profile Photo</label>
    <div class="form-group-radio">
      <label><input type="radio" name="photoOption" value="upload" checked> Upload</label>
      <label><input type="radio" name="photoOption" value="link"> Insert Link</label>
      <label><input type="radio" name="photoOption" value="scan"> Live Scan</label>
    </div>

    <div id="uploadBlock" class="photo-block">
      <input type="file" name="profilePhotoFile" accept="image/*">
    </div>

    <div id="linkBlock" class="photo-block" style="display:none;">
      <input type="text" name="profilePhotoLink" placeholder="Enter image URL">
    </div>

    <div id="scanBlock" class="photo-block" style="display:none;">
      <video id="video" width="300" height="225" autoplay playsinline style="border: 1px solid #ccc;"></video><br>
      <button type="button" id="snapBtn">Capture</button>
      <canvas id="canvas" width="300" height="225" style="display:none;"></canvas>
      <img id="capturedImagePreview" src="" style="display:none; margin-top:10px;" width="120">
      <input type="hidden" name="scannedImage" id="scannedImage">
      <p id="scanStatus" style="color: green;"></p>
    </div>

    <div class="form-buttons">
      <button type="submit" name="submit">Register Student</button>
      <a href="index.php" class="btn back-btn">Back to Home</a>
    </div>
  </form>

<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $nic = $_POST['nic'];
  $birthday = $_POST['birthday'];
  $school = $_POST['school'];
  $contactNo = $_POST['contactNo'];
  $email = $_POST['email'];
  $photoOption = $_POST['photoOption'];
  $photoPath = "";

  $uploadDirServer = 'D:/neuratech-students/uploads/profile_photos/';
  $uploadDirWeb = 'uploads/profile_photos/';
  if (!is_dir($uploadDirServer)) mkdir($uploadDirServer, 0755, true);

  if ($photoOption === "upload" && isset($_FILES['profilePhotoFile'])) {
    $fileName = time() . "_" . basename($_FILES['profilePhotoFile']['name']);
    $serverPath = $uploadDirServer . $fileName;
    $webPath = $uploadDirWeb . $fileName;
    move_uploaded_file($_FILES['profilePhotoFile']['tmp_name'], $serverPath);
    $photoPath = $webPath;
  } elseif ($photoOption === "link") {
    $imageUrl = $_POST['profilePhotoLink'];
    $ext = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
    $fileName = 'link_' . time() . '.' . $ext;
    $serverPath = $uploadDirServer . $fileName;
    $webPath = $uploadDirWeb . $fileName;
    file_put_contents($serverPath, file_get_contents($imageUrl));
    $photoPath = $webPath;
  } elseif ($photoOption === "scan") {
    $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $_POST['scannedImage']);
    $imageData = base64_decode($base64);
    $fileName = 'scan_' . time() . '.jpg';
    $serverPath = $uploadDirServer . $fileName;
    $webPath = $uploadDirWeb . $fileName;
    file_put_contents($serverPath, $imageData);
    $photoPath = $webPath;
  }

  $sql = "INSERT INTO students (name, nic, birthday, school, contactNo, email, profilePhoto)
          VALUES ('$name', '$nic', '$birthday', '$school', '$contactNo', '$email', '$photoPath')";

  if ($conn->query($sql)) {
    $id = $conn->insert_id;
    $yearPrefix = date("Y");
    $formattedId = $yearPrefix . str_pad($id, 3, '0', STR_PAD_LEFT);

    $qrDir = 'uploads/qrcodes/';
    if (!is_dir($qrDir)) mkdir($qrDir, 0755, true);
    $qrUrl = "http://localhost/neuratech-students/search_student.php?q=$nic";
    $qrFileName = "qr_" . $id . ".png";
    $qrFilePath = $qrDir . $qrFileName;

    $qrCode = new QrCode(data: $qrUrl, encoding: new Encoding('UTF-8'), size: 300, margin: 10);
    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    file_put_contents($qrFilePath, $result->getString());

    $conn->query("UPDATE students SET qrPath='$qrFilePath' WHERE id=$id");

    $cardDir = 'D:/neuratech-students/student_cards/';
    if (!is_dir($cardDir)) mkdir($cardDir, 0755, true);

    $studentCardHtml = "
    <html>
    <head><link rel='stylesheet' href='assets/css/style.css'></head>
    <body>
      <div class='student-card'>
        <h3>Student Card</h3>
        <div class='student-images' style='justify-content:  center;'>
          <img src='$photoPath' alt='Profile Photo'>
        </div>
        <div class='student-info'>
          <p><span class='label'>Student ID:</span> $formattedId</p>
          <p><span class='label'>NIC:</span> $nic</p>
          <p><span class='label'>Full Name:</span> $name</p>
          <p><span class='label'>Birthday:</span> $birthday</p>
          <p><span class='label'>School:</span> $school</p>
          <p><span class='label'>Contact:</span> $contactNo</p>
          <p><span class='label'>Email:</span> $email</p>
        </div>
        <div class='student-images'>
          <img src='$qrFilePath' alt='QR Code'>
        </div>
      </div>
    </body></html>";

    file_put_contents($cardDir . "card_$id.html", $studentCardHtml);
    echo $studentCardHtml;

  } else {
    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
  }
}
?>
</main>

<script>
  const radios = document.querySelectorAll('input[name="photoOption"]');
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const snapBtn = document.getElementById('snapBtn');
  const scannedImage = document.getElementById('scannedImage');
  const capturedImagePreview = document.getElementById('capturedImagePreview');
  const scanStatus = document.getElementById('scanStatus');

  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      document.querySelectorAll('.photo-block').forEach(div => div.style.display = 'none');
      document.getElementById(radio.value + 'Block').style.display = 'block';

      if (radio.value === 'scan') {
        navigator.mediaDevices.getUserMedia({ video: true })
          .then(stream => { video.srcObject = stream; video.play(); })
          .catch(() => { scanStatus.textContent = 'Unable to access camera.'; });
      } else {
        if (video.srcObject) {
          video.srcObject.getTracks().forEach(track => track.stop());
          video.srcObject = null;
        }
      }
    });
  });

  snapBtn.addEventListener('click', () => {
    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
    const dataURL = canvas.toDataURL('image/jpeg');
    scannedImage.value = dataURL;
    capturedImagePreview.src = dataURL;
    capturedImagePreview.style.display = 'block';
    scanStatus.textContent = 'Photo captured.';
  });
</script>

<footer class="footer">
  <p>&copy; <?php echo date("Y"); ?> Neuratech. All rights reserved.</p>
</footer>

</body>
</html>
