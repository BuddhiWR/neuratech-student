<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Neuratech Student Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="header">
    <div class="container">
    <div class="container header-logo">
    <img src="assets/images/neuratech-logo.png" alt="Neuratech Logo" class="logo-img">
    <div>
        <h1> Neuratech Student Portal</h1>
        <p>Welcome to the centralized student management system</p>
    </div>
</header>

<main class="main-section">
    <div class="card-container">
        <div class="card">
            <h3>Add Student</h3>
            <p>Register new student details to the system</p>
            <a href="add_student.php" class="btn">➕ Add Student</a>
        </div>

        <div class="card">
            <h3>Search Student</h3>
            <p>Find student records by NIC or name</p>
            <a href="search_student.php" class="btn">🔍 Search Student</a>
        </div>
    </div>
</main>

<footer class="footer">
    <p>&copy; <?php echo date("Y"); ?> Neuratech. All rights reserved.</p>
</footer>

</body>
</html>
