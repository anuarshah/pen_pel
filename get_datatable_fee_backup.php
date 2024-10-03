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

 //$jenisyuranSelect = 2;

    // Generate the form based on the selected value
        echo '<div>';

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
                                      
                                        <table class="table table-striped table-bordered table-hover" id="tSortablefees">
                                    <thead>
                                        <tr style="background-color:#B4C590;">
                                            <th style="width:10%" >Bil</th>
                                            <th style="width:62%">Yuran </th>                                          
                                            <th style="width:18%">Jumlah</th>  
                                            <th style="width:10%">Tindakan </th> 
                                        
                                        </tr>
                                    </thead>
                                   ';               
                                    $sqls = "select * from yuran where delete_status='0' and grade_id = 1 and jenisyuran_id ='".$jenisyuranSelect."'";
                                    $qq = $conn->query($sqls);
                                    $ii=1;
                                    $total = 0;
                                    while($rr = $qq->fetch_assoc())
                                    {
                                    
                                     echo '<tr">
                                            <td>'.$ii.'</td>
                                            <td>'.$rr['yuran'].'</td>
                                            <td>
<input type="text" class="form-control"  id="subfees" name="subfees" value="'.number_format($rr['amount'],2).'"/>
                                      </td>                  
                                            <td><input class="form-check-input" type="checkbox" value="'.$rr['amount'].'"   checked></td>   
                                        </tr>';
                                        $ii++;

                                        //$total_fees += $rr['amount'];
                                        $total += $rr['amount'];
                                    }
                                      echo '<tr">
                                            <td><button id="addRow">&nbsp;<b>+</b>&nbsp;</button></td>
                                            <td><b>Jumlah Yuran : </b></td>
                                            <td data-value="'.number_format($total,2).'"><b> '.number_format($total,2).'                 </b>

                                            </td>                  
                        <td><input type="text" class="form-control"  id="subfees" name="subfees" value="'.number_format($total,2).'" disabled /></td>   
                                        </tr>';
                                   echo '</tbody>
                                </table>';

echo '<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $("#tSortablefees").DataTable();

        // Initialize a count variable for position
        var count = 1;

        $("#addRow").click(function() {
            // Define the row data
            var newRowData = [
                count++, // Increment the counter
                "1",
                "San Francisco",
                "w" // Action button
            ];

            // Add the row and draw the table
           // table.row.add(newRowData).draw();

            // Optional: Alert for testing
            alert(newRowData));
        });

        // Handle click events on the delete button
        $("#tSortablefees").on("click", ".deleteBtn", function() {
            // Confirm deletion
            if (confirm("Are you sure you want to delete this row?")) {
                // Remove the row from the DataTable
                table.row($(this).closest("tr")).remove().draw();
            }
        });
    });
</script>';

                 echo '</div>';

}
else
{
 echo "No record";
}
?>
