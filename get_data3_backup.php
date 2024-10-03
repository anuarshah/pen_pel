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

echo '<script>
    $(document).ready(function() {
        $("#tSortable30").DataTable({
            "paging": true,         // bPaginate
            "lengthChange": true,   // bLengthChange
            "searching": true,      // bFilter
            "info": false,          // bInfo
            "autoWidth": true       // bAutoWidth
        });
    });
</script>';
    // Generate the form based on the selected value
        echo '<div><fieldset class="scheduler-border" >
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

                                    echo '
                                        
                                        <div class="col-sm-8">
                                            <b>Jenis Yuran</b> : <input type="text" class="form-control" id="jenisyuran" name="jenisyuran" value="' . htmlspecialchars($jenisyuran, ENT_QUOTES, 'UTF-8') . '" disabled />
                                            <br/>
                                        </div>';
                                        
                                      
                                        echo '<table class="table table-striped table-bordered table-hover" id="tSortable30">
                                    <thead>
                                        <tr style="background-color:yellowgreen;">
                                            <th style="width:10%" >Bil3</th>
                                            <th style="width:65%">Yuran </th>                                          
                                            <th style="width:15%">Jumlah</th>  
                                            <th style="width:10%">Tindakan </th> 
                                        
                                        </tr>
                                   ';               
                                    $sqls = "select * from yuran where delete_status='0' and grade_id = 1 and jenisyuran_id ='".$yurans[$bil_yuran]."'";
                                    $select_sql = $conn->query($sqls);
                                    $subrow=1;
                                    $total = 0;
                                    while($data_yuran = $select_sql->fetch_assoc())
                                    {   
                                     echo '<tr id="row' . $j++ . '">
                                            <td>'.$subrow.'</td>
                                            <td>'.$data_yuran['yuran'].'</td>
                                            <td>RM '.number_format($data_yuran['amount'],2).'</td>                  
                                            <td><input class="form-check-input" type="checkbox" value="'.$data_yuran['amount'].'" id="flexCheckChecked['.$j.']" name="flexCheckChecked['.$gradeSelect.']['.$yurans[$bil_yuran].']['.$data_yuran['yuran_id'].']['.$data_yuran['yuran'].'] "onclick="check('.$j.','.$bil_yuran.')" checked></td>   
                                        </tr>';
                                        $subrow++;

                                        $total_fees += $data_yuran['amount'];
                                        $total += $data_yuran['amount'];
                                    }
                            echo '<tr">
                                    <td></td>
                                    <td><b>Jumlah Yuran : </b></td>
                                    <td><input type="text" class="form-control"  id="subfees['.$bil_yuran.']" name="subfees['.$bil_yuran.']" value="'.number_format($total,2).'" disabled /></td>                  
                                    <td></td>   
                                  </tr>';
                            echo '</tbody>
                                </table>';
                  }

                 echo '<div class="form-group">
                                <label class="col-sm-3 control-label" for="Old">Jumlah Keseluruhan </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  id="fees" name="fees" value="'.number_format($total_fees,2).'" disabled />
                                </div>
                        </div> <br/><!--input type="submit" value="Submit Form 1"-->
              </fieldset></div>';

}
else
{
 echo "No record";
}
?>
