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
    $yearSelect = isset($_POST['year_id']) ? $_POST['year_id'] : '';


    $sql = "select * from j01_year_student  where year_id = $yearSelect ";
    $q = $conn->query($sql);
    $i = 0;               
    while($r = $q->fetch_assoc())
    {
        $yurans[$i++]=$r['year_id'];
    }

    // Generate the form based on the selected value

    echo '<script>
    $(document).ready(function() {
        $("#tSortable22").DataTable({
            "paging": true,         // bPaginate
            "lengthChange": true,   // bLengthChange
            "searching": true,      // bFilter
            "info": false,          // bInfo
            "autoWidth": true       // bAutoWidth
        });
    });
</script>';
        echo '<div><fieldset class="scheduler-border" >
                                                           
                            <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Nama</th>                                          
                                            <th>Darjah</th>
                                            <th>Kelas</th>
                                            <th>Tarikh Daftar</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                $sql = "select * from j01_year_student,student,grade,year,kelas  where j01_year_student.year_id = $yearSelect and j01_year_student.student_id =student.student_id and student.grade_id =grade.grade_id and grade.delete_status='0' and student.year_id =year.year_id and year.delete_status ='0' and student.kelas_id =kelas.kelas_id and student.delete_status ='0' order by j01_year_student.JYD_id  desc";
                $q = $conn->query($sql);
                $i = 1;
                while($r = $q->fetch_assoc())
                {
                        echo '<tr>
                                            <td width="5%">'.$i++.'</td>
                                            <td width="46%">'.$r['sname'].'</td>
                                            <td width="10%">'.$r['grade'].'</td>   
                                            <td width="13%">'.$r['kelas'].'</td>     
                                            <td width="13%">'.date('d M Y', strtotime($r['joindate'])).'           
                                            <td width="17%">                                            <a href="detailpelajar.php?action=edit&student_id='.$r['student_id'].'" class="btn btn-primary btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;</a>

                                            <a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="student.php?action=delete&student_id='.$r['student_id'].'" class="btn btn-danger btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;</a> </td>   
                                        </tr>';
                                       
                }
        echo '</tbody> 
                </table><div>
              <a href="list_student.php" class="btn btn-success active btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-open"> Excel</span>&nbsp;&nbsp;</a>
                </fieldset></div>';
                  

}
else
{
 echo "No record";
}
?>
