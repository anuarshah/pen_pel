<?php


echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />';

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

echo '<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $("#tSortablefees").DataTable();
console.log(" table name :", table);
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
            console.log("New Row Data:", newRowData);

            // Add the row and draw the table
            try {
                table.row.add(newRowData).draw();
                alert("Row added!");
            } catch (e) {
                console.log("Available methods:", Object.keys(table));
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

echo ' <br/>                     
                                      
                                        <table class="table table-striped table-bordered table-hover" id="tSortablefees">
                                    <thead>
                                        <tr>
                                            <th style="width:10%" >Bil</th>
                                            <th style="width:62%">Yuran </th>                                          
                                            <th style="width:18%">Jumlah</th>  
                                            <th style="width:10%">Tindakan </th> 
                                        
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                     <td></td>
                                    </tr>
                                    ';
echo '</tbody>
                                </table><button id="addRow">&nbsp;<b>+</b>&nbsp;</button>';


 echo '</dev>';

?>
