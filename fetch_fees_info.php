<?php
DEFINE("BASE_URL","http://localhost/SchoolFeesSystem/");

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PSWD', ''); 
DEFINE ('DB_HOST', 'localhost'); 
DEFINE ('DB_NAME', 'pengurusanpelajar'); 

date_default_timezone_set('Asia/Calcutta'); 
$conn =  new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
if($conn->connect_error)
die("Failed to connect database ".$conn->connect_error );

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected form value

    $student_id_Select = isset($_POST['student_id']) ? $_POST['student_id'] : '';


    $sql = "SELECT * FROM fees_info WHERE fi_student_id = $student_id_Select";
    $q = $conn->query($sql);              
    while($r = $q->fetch_assoc())
    {
        $total_fees=$r['fi_fees'];
    } 
        echo $total_fees;
                  

}
else
{
 echo "No record";
}
?>
