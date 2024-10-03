<?php
DEFINE("BASE_URL", "http://localhost/SchoolFeesSystem/");
DEFINE('DB_USER', 'root');
DEFINE('DB_PSWD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'pengurusanpelajar');

date_default_timezone_set('Asia/Calcutta');
$conn = new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_NAME);

if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected form values safely
    $year_id = $_POST['year_id'] ?? '';
    $month_id = $_POST['month_id'] ?? '';
    $jenisyuran_id = $_POST['jenisyuran_id'] ?? '';
    $grade_id = $_POST['grade_id'] ?? '';

    // Prepare the SQL statement to prevent SQL injection

    $stmt = $conn->prepare("SELECT * FROM current_fees WHERE grade_id = ? AND month_id = ? AND year_id = ? AND jenisyuran_id = ? ORDER BY yuran_id ASC");
    $stmt->bind_param("iiii", $grade_id, $month_id, $year_id, $jenisyuran_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate the form based on the selected value
    echo '<script>
    $(document).ready(function() {
        $("#tSortableDescCurrentFees").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "info": false,
            "autoWidth": true
        });
    });
    </script>';

    echo '<div><br/>
          <div class="container col-sm-12">
              <div class="panel panel-default">
                  <div class="panel-heading">Senarai Yuran Baru</div>
                  <div class="panel-body">';

    echo '<div class="container col-sm-12">
            <div class="table-sorting table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tSortableDescCurrentFees">
                    <thead>
                        <tr>
                            <th>Bil</th>
                            <th>Yuran</th>
                            <th>Jumlah</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>';

    // Reuse prepared statement for the next query
    $stmt->execute();
    $result = $stmt->get_result();
    $i = 1;

    while ($r = $result->fetch_assoc()) {
        echo '<tr>
                <td width="5%">' . $i++ . '</td>
                <td width="55%">' . htmlspecialchars($r['yuran']) . '</td>
                <td width="11%">' . htmlspecialchars($r['amount']) . '</td>
                <td width="14%"></td>
              </tr>';
    }

    echo '</tbody>
            </table>';

                                                        echo '<dev><button id="GenerateMonthFeesStudent"><b>Generate Yuran Pelajar 1 &nbsp;</b></button>';

          echo'</div>
        </div>
      </div>';

    $stmt->close();
} else {
    echo "No record";
}

$conn->close();
?>
