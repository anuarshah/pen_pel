<?php
DEFINE("BASE_URL", "http://localhost/SchoolFeesSystem/");
DEFINE('DB_USER', 'root');
DEFINE('DB_PSWD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'pengurusanpelajar');

date_default_timezone_set('Asia/Calcutta');
$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected form values safely
    $year_id = $_POST['year_id'] ?? '';
    $month_id = $_POST['month_id'] ?? '';
    $jenisyuran_id = $_POST['jenisyuran_id'] ?? '';
    $grade_id = $_POST['grade_id'] ?? '';

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT student.student_id FROM student 
                             JOIN j01_year_student ON student.student_id = j01_year_student.student_id 
                             WHERE student.grade_id = ? AND j01_year_student.year_id = ? 
                             ORDER BY student.student_id ASC");
    $stmt->bind_param("ii", $grade_id, $year_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare the insert statement for current_student_fees
    $stmt_scf = $conn->prepare("INSERT INTO current_student_fees (student_id, yuran_id, year_id, month_id, jenisyuran_id, grade_id, amount, yuran) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if statement is prepared successfully
    if (!$stmt_scf) {
        die("Error preparing insert statement: " . htmlspecialchars($conn->error));
    }

    // Loop through students
    while ($r = $result->fetch_assoc()) {
        $student_id = $r['student_id'];

        // Get the current fees for the student
        $stmt_cf = $conn->prepare("SELECT * FROM current_fees WHERE grade_id = ? AND year_id = ? AND month_id = ? AND jenisyuran_id = ?");
        $stmt_cf->bind_param("iiii", $grade_id, $year_id, $month_id, $jenisyuran_id);
        $stmt_cf->execute();
        $result_cf = $stmt_cf->get_result();  

        // Loop through current fees
        while ($rs = $result_cf->fetch_assoc()) {
            $current_fee = $rs['amount']; // Adjust based on your actual column name
            $yuran_id = $rs['yuran_id']; // Assuming you have a field for this

            // Bind parameters and execute
            $stmt_scf->bind_param("iiiiiiss", $student_id, $yuran_id, $year_id, $month_id, $jenisyuran_id, $grade_id, $current_fee, $rs['yuran']);

            // Execute the statement and check for errors
            if (!$stmt_scf->execute()) {
                echo "Error inserting data for student ID $student_id: " . htmlspecialchars($stmt_scf->error) . "<br>";
            }
        }

        $stmt_cf->close();
    }

    $stmt->close();
    $stmt_scf->close();
} else {
    echo "No record";
}

$conn->close();
?>
