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
    $kelasSelect = isset($_POST['kelas_id']) ? $_POST['kelas_id'] : '';

    // Generate the form based on the selected value

   echo '<div>

    <div id="test2" class="col-sm-4">
        <div class="form-group">
            <label class="col-sm-10">Kelas</label>
            <div class="col-sm-6">
            <select  class="form-control" id="kelas_id" name="kelas_id" >
                <option value="" >Pilih Kelas</option>';
                        
                  $sql = "select * from kelas where grade_id = $gradeSelect and  delete_status='0' order by kelas.kelas_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['kelas_id'].'"  '.(($kelas==$r['kelas_id'])?'selected="selected"':'').'>'.$r['kelas'].'</option>';
                  }
                                 
                  
echo '        </select></div>
            </div>
        </div>
   </div>';
                  

}
else
{
 echo "No record";
}
?>

    <script>
        $(document).ready(function() {
            $('#kelas_id').on('change', function() {
                var year_id = document.getElementById('year_id').value;
                var  grade_id = document.getElementById('grade_id').value;
                var  kelas_id = document.getElementById('kelas_id').value;
                        $.ajax({
                        url: 'get_list_stud_fees_kelas.php',
                        type: 'POST',
                        data: { year_id: year_id,grade_id: grade_id, kelas_id:kelas_id},
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
   

                        }
                    });
             });
        });
    </script>
