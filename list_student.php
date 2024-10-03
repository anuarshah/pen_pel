<?php
require 'vendor/autoload.php'; // Adjust this path as necessary

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database configuration
define('DB_USER', 'root');
define('DB_PSWD', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'pengurusanpelajar');

$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT student_id, sname FROM student"; // Adjust the query as necessary
$result = $conn->query($sql);

// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header row
$sheet->setCellValue('A1', 'Student ID');
$sheet->setCellValue('B1', 'Name');

// Populate the data in the spreadsheet
if ($result->num_rows > 0) {
    $row = 2; // Start from the second row
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['student_id']);
        $sheet->setCellValue('B' . $row, $data['sname']); // Use 'sname' instead of 'name'
        $row++;
    }
}

// Write the file
$writer = new Xlsx($spreadsheet);
$filename = 'student_data_' . date('Ymd') . '.xlsx'; // Updated filename for clarity

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Save the file to output
$writer->save('php://output');
exit;

$conn->close();
?>
