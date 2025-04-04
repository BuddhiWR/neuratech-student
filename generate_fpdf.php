<?php
require('fpdf/fpdf.php');

if (isset($_GET['id'])) {
    // Get student details from DB
    include 'db.php';
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM students WHERE id = $id");
    $student = $result->fetch_assoc();

    $yearPrefix = date("Y");
    $formattedId = $yearPrefix . str_pad($student['id'], 3, '0', STR_PAD_LEFT);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Header
    $pdf->SetTextColor(26, 35, 126);
    $pdf->Cell(0, 10, 'NEURATECH EDUCATION - STUDENT CARD', 0, 1, 'C');

    // Image
    $pdf->Image($student['profilePhoto'], 80, 30, 50);
    $pdf->Ln(65);

    // Info
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Name: " . $student['name'], 0, 1);
    $pdf->Cell(0, 10, "NIC: " . $student['nic'], 0, 1);
    $pdf->Cell(0, 10, "Student ID: " . $formattedId, 0, 1);
    $pdf->Cell(0, 10, "Birthday: " . $student['birthday'], 0, 1);
    $pdf->Cell(0, 10, "School: " . $student['school'], 0, 1);
    $pdf->Cell(0, 10, "Contact: " . $student['contactNo'], 0, 1);
    $pdf->Cell(0, 10, "Email: " . $student['email'], 0, 1);
    $pdf->Cell(0, 10, "Valid Until: 30.09.2025", 0, 1);

    $pdf->Output("D", "StudentCard_$formattedId.pdf");
}
?>
