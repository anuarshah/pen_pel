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
 echo '<dev>';



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
                                      echo '<tr>
                                            <td>'.$ii.'</td>
                                            <td><b>Jumlah Yuran : </b></td>
                                            <td data-value="'.number_format($total,2).'"><input type="text" class="form-control"  id="subfees" name="subfees" value="'.number_format($total,2).'" disabled />

                                            </td>                  
                        <td><button id="addRow" value="'.$ii.'">Add New </button></td>   
                                        </tr>';
echo '</tbody>
                                </table><button id="addRow" value="'.$ii.'">Add New </button></dev>';




 echo '</dev>';

echo '<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $("#tSortablefees").DataTable();
        console.log(" table name :", table);

        // Initialize a count variable for position
        var add = '.$ii++.';
        var count = add + 1;

        $("#addRow").click(function() {
            // Define the row data
            var newRowData = [
                count++, // Increment the counter
                "<input style=\'width: 100%\' type=\'text\' name=\'fees_desc\' />",
                "<input style=\'width: 100%\' type=\'text\' name=\'subfees\' />",
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
    });
</script>';

}
else
{
 echo "No record";
}
?>
