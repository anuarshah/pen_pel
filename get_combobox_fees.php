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
    $gradeSelect = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';

    // Generate the form based on the selected value

        echo '<div>
                    <select  class="form-control" id="jenisyuran_id" name="jenisyuran_id" onchange="jenisyuran(this.value)">
                    <option value="" >Pilih Jenis Yuran</option>';
                                                                
                 /*   $sql = "select * from jenisyuran where delete_status='0' order by jenisyuran.jenisyuran asc"; */

                    $sql = "select distinct(jenisyuran.jenisyuran_id) jenisyuran_id,jenisyuran.jenisyuran jenisyuran from yuran,jenisyuran where yuran.jenisyuran_id = 38 and yuran.jenisyuran_id = jenisyuran.jenisyuran_id and   grade_id = 1 and jenisyuran.delete_status='0' ";


    

                    $q = $conn->query($sql);
                                                                
                    while($r = $q->fetch_assoc())
                    {
                    echo '<option value="'.$r['jenisyuran_id'].'"  '.(($jenisyuran_id==$r['jenisyuran_id'])?'selected="selected"':'').'>'.$r['jenisyuran'].'</option>';
                    }
             
                                             
        echo '</select>

        </div>';
                  

}
else
{
 echo "No record";
}
?>