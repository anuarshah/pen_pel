<link href="css/datatable/datatable.css" rel="stylesheet" />                 
<script src="js/dataTable/jquery.dataTables.min.js"></script>

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


    $sql = "select distinct(jenisyuran_id) yuran_id from yuran  where grade_id = $gradeSelect ";
    $q = $conn->query($sql);
    $i = 0;               
    while($r = $q->fetch_assoc())
    {
        $yurans[$i++]=$r['yuran_id'];
    }

    // Generate the form based on the selected value
    echo '<script>
    $(document).ready(function() {
        $("#tSortable24").DataTable({
            "paging": true,         // bPaginate
            "lengthChange": true,   // bLengthChange
            "searching": true,      // bFilter
            "info": true,          // bInfo
            "autoWidth": true       // bAutoWidth
        });
        });
    </script>';

        echo '<br/><div><fieldset class="scheduler-border" >
                         <legend  class="scheduler-border">Maklumat Yuran :</legend><h4><b>&nbsp;&nbsp;&nbsp;Darjah '. htmlspecialchars($gradeSelect, ENT_QUOTES, 'UTF-8') .' </b></h4>';

                                           $j=0;
                  $total_fees = 0;
                  for($bil_yuran=0;$bil_yuran<$i;$bil_yuran++)
                  {

                        $sqlselect = $conn->query("SELECT * FROM jenisyuran 
                            WHERE jenisyuran_id='".$yurans[$bil_yuran]."'");
                        if($sqlselect->num_rows)
                        {
                          $rowsSelect = $sqlselect->fetch_assoc();
                          extract($rowsSelect);
                          $jenisyuran = $rowsSelect['jenisyuran'];
                        }
                                                           
                         echo  '<div class="col-sm-8">
                                            <b>Jenis Yuran</b> : <input type="text" class="form-control" id="jenisyuran" name="jenisyuran" value="' . htmlspecialchars($jenisyuran, ENT_QUOTES, 'UTF-8') . '" disabled />
                                            <br/>
                                        </div>';
                        echo '<div class="table-sorting table-responsive">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="tSortable24">
                                    <thead>
                                        <tr>
                                            <th width="5%">Bil</th>
                                            <th width="55%">Nama</th>                                          
                                            <th width="10%">Darjah</th>
                                            <th width="10%">Kelas</th>
                                            <th width="20%"> Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>';


                                    $parentsSelect =1;
                                       
               $sql = "select * from student,grade,year,kelas  where student.parent_id = $parentsSelect and student.grade_id =grade.grade_id and grade.delete_status='0' and student.year_id =year.year_id and year.delete_status ='0' and student.kelas_id =kelas.kelas_id and student.delete_status ='0' order by student.student_id  desc ";
                  $q = $conn->query($sql);
                    $i = 1;
                  while($r = $q->fetch_assoc())
                  {
                        echo '<tr>
                                    <td width="5%">'.$i++.'</td>
                                    <td width="55%">'.$r['sname'].'</td>
                                    <td width="11%">'.$r['grade'].'</td>   
                                    <td width="14%">'.$r['kelas'].'</td>                
                                    <td width="15%">                                            <a href="detailpelajar.php?action=edit&student_id='.$r['student_id'].'" class="btn btn-primary btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;</a>

                                            <a href="student.php?action=edit&student_id='.$r['student_id'].'" class="btn btn-success btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;</a>
                                            

                                            <a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="student.php?action=delete&student_id='.$r['student_id'].'" class="btn btn-danger btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;</a> </td>   
                                        </tr>';
                  }      

              }
        echo '</tbody> 
                </table>
<div class="form-group">
                                <label class="col-sm-3 control-label" for="Old">Jumlah Keseluruhan </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  id="fees" name="fees" value="" disabled />
                                </div>
                        </div>
                </fieldset></div>';
                  

}
else
{
 echo "No record";
}
?>
