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


  $father_name = $_POST['father_name'];
  $parent_id = $_POST['parent_id'];
  $father_ic = $_POST['father_ic'];
  $father_phone_no = $_POST['father_phone_no'];
  $mother_name = $_POST['mother_name'];
  $mother_ic = $_POST['mother_ic'];
  $mother_phone_no = $_POST['mother_phone_no'];
  $email = $_POST['email'];
  $current_address = $_POST['current_address'];
  $postcode = $_POST['postcode'];
  $city = $_POST['city'];
  $negeri = $_POST['negeri'];
  $password = $_POST['password'];


  // Update your database or perform the required action here
  // For example:
  // $updateQuery = "UPDATE your_table SET your_column = '$dataField' WHERE some_condition";

    $sql = $conn->query("UPDATE  parents  SET  father_name = '$father_name', father_ic = '$father_ic', father_phone_no = '$father_phone_no', mother_name = '$mother_name', mother_ic = '$mother_ic' , mother_phone_no = '$mother_phone_no',email = '$email',current_address = '$current_address',postcode = '$postcode',city = '$city',negeri = '$negeri',password = '$password' WHERE  parent_id  = $parent_id ");
  
  // Assume the update was successful

  //echo 'Data updated successfully: ';
} else {

echo '<script type="text/javascript">
        alert(\'test\');
    </script>';
  echo 'Invalid request method';
}
?>