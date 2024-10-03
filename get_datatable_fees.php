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
$jenisyuranSelect = isset($_POST['jenisyuran_id']) ? $_POST['jenisyuran_id'] : '';
$gradeSelect = isset($_POST['grade_id']) ? $_POST['grade_id'] : '';
 echo '<dev>';

                                 echo '<script>
                        $(document).ready(function() {
                            $("#tSortablefees").DataTable({
                                "paging": true,         // bPaginate
                                "lengthChange": true,   // bLengthChange
                                "searching": true,      // bFilter
                                "info": true,          // bInfo
                                "autoWidth": true,       // bAutoWidth
                                "pageLength": 5
                            });
                            });
                        </script>';

echo ' <br/>                     
                                      <div class="container col-sm-12">
  
                                        <table class="table table-striped table-bordered table-hover" id="tSortablefees">
                                    <thead>
                                        <tr>
                                            <th width="5%">Bil</th>
                                            <th width="65%">Yuran </th>
                                            <th width="15%">Jumlah</th>  
                                            <th width="15%">Tindakan </th> 
                                        
                                        </tr>
                                    </thead>

                                    <tbody>
             
                                    ';

                                                           $sqls = "select * from yuran where delete_status='0' and grade_id = 1 and jenisyuran_id ='".$jenisyuranSelect."'";
                                    $qq = $conn->query($sqls);
                                    $ii=1;
                                    $total = 0;
                                    while($rr = $qq->fetch_assoc())
                                    {
                                    
                                     echo '<tr>
                                            <td>'.$ii.'</td>
                                            <td>'.$rr['yuran'].'<input type="hidden" name="subfeesdesc[]" value="'.$rr['yuran'].'" ></td>
                                            <td>
<input type="text" class="form-control"  id="subfees" name="subfees[]" value="'.number_format($rr['amount'],2).'"/>
                                      </td>                  
                                            <td><input class="form-check-input" type="checkbox" name="yuran_id[]" value="'.$rr['yuran_id'].'"   checked></td>   
                                        </tr>';
                                        $ii++;

                                        //$total_fees += $rr['amount'];
                                        $total += $rr['amount'];
                                    }
echo '</tbody>
                                </table><button id="addRow" value="'.$ii.'">+Jenis Yuran </button>';

                                echo '<br/><br/><dev><button id="GenerateMonthFees" onclick="generate_yuran_bulanan();"><b>Generate Yuran Bulanan</b></button>
                                </dev><input type="checkbox" id="checkbox_GYB" name="checkbox_GYB" onclick="click_button()" >';

echo '
<h1 class="page-head-line"> </h1><br/>
  <div class="row">
    ';
$currentYear = date("Y");

$currentDate = new DateTime();

// Add one month to the current date
$currentDate->modify('+1 month');

// Format the date to show the year and month
$nextMonth = $currentDate->format('m');

echo '<div class="col-sm-6">
                                        <select  class="form-control" id="month_id" name="month_id" >
                                        <option value="" >Pilih Bulan</option>';
                                           
                                            $sql = "select * from month  order by month.month_id asc";
                                            $q = $conn->query($sql);
                                            
                                            while($r = $q->fetch_assoc())
                                            {
                                            echo '<option value="'.$r['month_id'].'"  '.(($nextMonth==$r['month_id'])?'selected="selected"':'').'>Bulan : '.$r['month_desc'].'</option>';
                                            }
                                          
                                        echo '</select>
                              </div>'; 

echo '<div class="col-sm-6">
                                        <select  class="form-control" id="year_id" name="year_id" >
                                        <option value="" >Pilih Sesi/Tahun</option>';
                                           
                                            $sql = "select * from year where delete_status='0' order by year.year_id asc";
                                            $q = $conn->query($sql);
                                            
                                            while($r = $q->fetch_assoc())
                                            {
                                            echo '<option value="'.$r['year_id'].'"  '.(($currentYear==$r['year'])?'selected="selected"':'').'>'
                                            .$r['year_desc'].'</option>';
                                            }
                                          
                                        echo '</select>
                              </div>'; 

    echo '
  </div><br/>

';
          

 echo '</div> ';


                                                   
                               echo '</dev>';

echo '<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $("#tSortablefees").DataTable();
        console.log(" table name :", table);

        // Initialize a count variable for position
        var count = '.$ii++.';

        $("#addRow").click(function() {
            // Define the row data
            var newRowData = [
                count++, // Increment the counter
                "<input style=\'width: 100%\' type=\'text\' name=\'fees_desc[]\' />",
                "<input style=\'width: 100%\' type=\'text\' name=\'subfees[]\' />",
                "<button class=\'deleteBtn\'>&nbsp;&nbsp;Delete&nbsp;&nbsp;</button>" // Action button
            ];
            console.log("New Row Data:", newRowData);

            // Add the row and draw the table
            try {
                table.row.add(newRowData).draw();
            } catch (e) {
                console.error("Error adding row:", e);
            }
        });

        // Handle click events on the delete button
        $("#tSortablefees").on("click", ".deleteBtn", function() {
            // Confirm deletion
            if (confirm("Are you sure you want to delete this row?")) {
                // Remove the row from the DataTable
                table.row($(this).closest("tr")).remove().draw();
            }
        });

            const button = document.getElementById("GenerateMonthFees");
            button.disabled = true;   
    });
</script>';

}
else
{
 echo "No record";
}
?>
