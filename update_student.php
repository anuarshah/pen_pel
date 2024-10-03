<link rel="stylesheet" href="jAlert-master/dist/jAlert.css" />
<script src="jquery-1.7.1.min.js"></script>
<script src="jAlert-master/dist/jAlert.min.js"></script>
<script src="jAlert-master/dist/jAlert-functions.min.js"> //optional!!</script>
<?php
// your-server-endpoint.php

DEFINE("BASE_URL","http://localhost/SchoolFeesSystem/");

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PSWD', ''); 
DEFINE ('DB_HOST', 'localhost'); 
DEFINE ('DB_NAME', 'pengurusanpelajar'); 

date_default_timezone_set('Asia/Calcutta'); 
$conn =  new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
if($conn->connect_error)
die("Failed to connect database ".$conn->connect_error );

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $sname = $_POST['sname'];
  $student_id = $_POST['stud_id'];
  $no_mykid = $_POST['no_mykid'];
  $no_cert_birth = $_POST['no_cert_birth'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $joindate = $_POST['joindate'];
  $grade_id = $_POST['grade_id'];
  $kelas_id = $_POST['kelas_id'];


  // Update your database or perform the required action here
  // For example:
  // $updateQuery = "UPDATE your_table SET your_column = '$dataField' WHERE some_condition";

    $sql = $conn->query("UPDATE  student  SET   sname = '$sname', no_mykid = '$no_mykid', no_cert_birth = '$no_cert_birth', dob = '$dob', gender = '$gender' , joindate = '$joindate',grade_id = '$grade_id',kelas_id = '$kelas_id'  WHERE  student_id  = $student_id ");
  
  // Assume the update was successful
  echo 'Data updated successfully: ' . htmlspecialchars($student_id);
} else {
  echo 'Invalid request method.';
}
?>