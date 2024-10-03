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
                                            <th width="5%" >Bil</th>
                                         <th width="35%" >Nama Pelajar</th>                                          
                                            <th width="15%">Jumlah Yuran </th>
                                            <th width="15%">Bayaran </th>
                                            <th width="15%">Baki </th>
                                            <th width="15%">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                $sql = " SELECT * FROM student,j01_year_student,fees_info WHERE 
j01_year_student.year_id = $yearSelect
and j01_year_student.student_id = fees_info.fi_student_id
and j01_year_student.student_id = student.student_id
and student.student_id = j01_year_student.student_id order by student.student_id desc ";
                $q = $conn->query($sql);
                $i = 1;
                while($r = $q->fetch_assoc())
                {
                        echo '<tr>
                                            <td >'.$i++.'</td>
                                            <td >'.$r['sname'].'</td>
                                            <td >'.$r['fi_fees'].'</td>   
                                            <td >'.$r['fi_advancefees'].'</td>     
                                            <td >'.$r['fi_balance'].'           
                                            <td width="17%">                                            <a href="detailfees.php?action=edit&student_id='.$r['student_id'].'" class="btn btn-primary btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;</a>

                                               <a href="payment.php?action=edit&student_id='.$r['student_id'].'" class="btn btn-success btn-xs" style="border-radius:3px;">&nbsp;&nbsp;RM&nbsp;&nbsp;</a>

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
