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
  <div class="container header-logo">
    <img src="assets/images/neuratech-logo.png" alt="Neuratech Logo" class="logo-img">
    <div>
      <h1>Search Students</h1>
      <p>Find registered students by name or NIC</p>
    </div>
  </div>
</header>

<nav class="nav-bar">
  <a href="student_list.php">Registered Student List</a>
</nav>

<!-- Search Form -->
<div class="search-form">
  <input type="text" id="liveSearchInput" class="search-input" placeholder="Search by Name or NIC...">
  <button type="button" id="scanBtn" class="btn">📷 Scan QR</button>
  <button type="button" id="exportBtn" class="btn">Export to CSV</button>
</div>

<!-- QR Scanner View -->
<div id="scanner" style="display:none; text-align:center;">
  <div id="qr-reader" style="width: 300px; margin: auto;"></div>
  <p id="scanResult" style="margin-top:10px;"></p>
</div>

<!-- Results -->
<div id="liveResults" class="search-results"></div>
<a href="index.php" class="btn back-btn" style="margin: 20px;">⬅ Back to Home</a>

<!-- QR + Search Scripts -->
<script src="https://unpkg.com/html5-qrcode@2.3.8"></script>
<script>
  const input = document.getElementById('liveSearchInput');
  const resultsDiv = document.getElementById('liveResults');
  const scanBtn = document.getElementById('scanBtn');
  const scannerDiv = document.getElementById('scanner');
  const scanResult = document.getElementById('scanResult');
  let html5QrCode;

  // Search by typing
  input.addEventListener('input', () => {
    const query = input.value.trim();
    if (!query) {
      resultsDiv.innerHTML = '';
      return;
    }
    fetchStudents(query);
  });

  // Fetch from search_api
  function fetchStudents(query) {
    fetch(`search_api.php?q=${encodeURIComponent(query)}`)
      .then(res => res.json())
      .then(data => {
        resultsDiv.innerHTML = '';
        if (data.length === 0) {
          resultsDiv.innerHTML = '<p style="text-align:center;">No matching students found.</p>';
          return;
        }

        data.forEach(student => {
          const studentId = new Date().getFullYear() + String(student.id).padStart(3, '0');
          resultsDiv.innerHTML += `
            <div class="student-result">
              <img src="${student.profilePhoto}" alt="Photo" class="result-photo" />
              <div class="result-info">
                <h3>${student.name}</h3>
                <p><strong>Student ID:</strong> ${studentId}</p>
                <p><strong>NIC:</strong> ${student.nic}</p>
                <p><strong>School:</strong> ${student.school}</p>
                <p><strong>Contact:</strong> ${student.contactNo}</p>
                <a href="generate_pdf.php?id=${student.id}" class="btn" target="_blank">Download PDF</a>
              </div>
            </div>
          `;
        });
      });
  }

  // Start QR Scan
  scanBtn.addEventListener('click', () => {
    scannerDiv.style.display = 'block';
    scanResult.textContent = "";
    document.getElementById('qr-reader').innerHTML = "";

    html5QrCode = new Html5Qrcode("qr-reader");
    const config = { fps: 10, qrbox: { width: 250, height: 250 } };

    html5QrCode.start(
      { facingMode: "environment" },
      config,
      qrCodeMessage => {
        html5QrCode.stop().then(() => {
          scannerDiv.style.display = 'none';
          scanResult.textContent = "Scanned: " + qrCodeMessage;

          // Extract NIC from URL or use full QR content as fallback
          const nic = qrCodeMessage.includes("?q=")
            ? qrCodeMessage.split("?q=")[1]
            : qrCodeMessage;
          input.value = nic;
          fetchStudents(nic);
        });
      },
      errorMessage => {
        // Optionally show errors
        console.warn("QR scan error:", errorMessage);
      }
    ).catch(err => {
      console.error("Unable to start scanning:", err);
      scanResult.textContent = "Camera not available or permission denied.";
    });
  });
</script>

<!-- Export CSV -->
<script>
  const exportBtn = document.getElementById('exportBtn');
  exportBtn.addEventListener('click', () => {
    const studentCards = document.querySelectorAll('.student-result');
    if (studentCards.length === 0) {
      alert('No student data to export.');
      return;
    }

    let csv = "Student ID,Name,NIC,School,Contact\n";
    studentCards.forEach(card => {
      const name = card.querySelector('h3').innerText;
      const studentId = card.querySelector('p strong').nextSibling.textContent.trim();
      const nic = card.querySelectorAll('p')[1].innerText.split(":")[1].trim();
      const school = card.querySelectorAll('p')[2].innerText.split(":")[1].trim();
      const contact = card.querySelectorAll('p')[3].innerText.split(":")[1].trim();
      csv += `"${studentId}","${name}","${nic}","${school}","${contact}"\n`;
    });

    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.setAttribute('download', 'neuratech_students.csv');
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
