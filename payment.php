<?php $page='payment';
include("php/dbconnect.php");
include("php/checklogin.php");
$error = '';

if(isset($_POST['save']))
{



}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>School Fees Management System</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  
  <script src="js/jquery-1.10.2.js"></script>
  
  <script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
  
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                            <h1 class="page-head-line">Pembayaran Yuran
            <?php
            echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
            ' <a href="maklumatyuran.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="maklumatyuran.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Daftar Pelajar Baru</a>';
            ?>
            </h1>
                     
<?php


?>
    
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
        
              <div class="col-sm-12 ">
               <div class="panel panel-success">
                  <div class="panel-heading">
                      
                  </div>
                  <form id="updateForm">
                    <div class="panel-body">
    
                      <ul class="nav nav-pills">
                        <!--li class="active"><a data-toggle="pill" href="#home">Maklumat Pelajar</a></li-->
                        <!--li><a data-toggle="pill" href="#menu1">Maklumat Ibubapa/Penjaga</a></li-->
                        <li><a data-toggle="pill" href="#menu2">Pembayaran Yuran</a></li>
                      </ul>      

<div class="tab-content">
<?php

$id = mysqli_real_escape_string($conn,$_GET['student_id']);

$sqlEdit = $conn->query("SELECT * FROM student WHERE student_id='".$id."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
 // print_r($rowsEdit);
  extract($rowsEdit);
  $kelas = $rowsEdit['kelas_id'];

  $action = "update";
}

$id = mysqli_real_escape_string($conn,$_GET['student_id']);

$sqlEdit = $conn->query("SELECT * FROM student where  student_id='".$id."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
 // print_r($rowsEdit);
  extract($rowsEdit);
  $kelas = $rowsEdit['kelas_id'];
  //echo $student_id = $rowsEdit['student_id'];
 // $grade_id = $rowsEdit['grade_id'];

  $action = "update";
}

$sqlYear = $conn->query("SELECT * FROM year WHERE year_id ='".$year_id."'");
if($sqlYear->num_rows)
{
  $rowsYear = $sqlYear->fetch_assoc();
  //print_r($rowsEdit);
  extract($rowsYear);
  $year = $rowsYear['year'];

  $action = "update";
}

?>

<input type="hidden" id='student_id' name='student_id' value="<?php echo $student_id; ?>" class="form-control" disabled>
            <div id="home" class="tab-pane fade in active">
                <!-- Content for the first tab -->
          <fieldset class="scheduler-border" >


                  
                  <!--div id="buttonUpdateParent">
                          <!-- Content will be dynamically loaded here -->
                  <!--/div-->                       
            
            </fieldset>
            </div>
            <div id="menu2" class="tab-pane fade">
              <fieldset class="scheduler-border" >
              <br/>
  <ul class="nav nav-pills">

    <li class="active"><a data-toggle="pill" href="#home1">Yuran Keseluruhan</a></li>
   
  </ul>
  
  <div class="tab-content">

        <div id="home1" class="tab-pane fade in active">
          
             <fieldset class="scheduler-border col-lg-4" >
                <legend  class="scheduler-border">Maklumat Yuran :</legend>

                  <?php
                  $currentYear = date("Y");
                  ?>
                                        <!-- text input -->
                  <div class="form-group">
                  <label class="col">Tahun / Sesi Persekolahan</label>
                  <div class="col">
                    <select  class="form-control" id="year_id" name="year_id" onchange="">
                    <option value="" >Tahun / Sesi Persekolahan</option>
                                      <?php
                    $sql = "select * from year where delete_status='0' order by year.year_id asc";
                    $q = $conn->query($sql);
                    
                    while($r = $q->fetch_assoc())
                    {
                    echo '<option value="'.$r['year_id'].'"  '.(($currentYear==$r['year'])?'selected="selected"':'').'>'.$r['year'].'/'.$r['year_desc'].'</option>';
                    }
                    ?>                
                    
                    </select>
                  </div>
                  </div>
                               
                
                  <div class="form-group">
                  <label class="col">Darjah</label>
                  <div class="col">
                  <select  class="form-control" id="grade_id" name="grade_id" >
                  <option value="" >Pilih Darjah 1</option>
                                    <?php
                  $sql = "select * from grade where delete_status='0' order by grade.grade_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['grade_id'].'"  '.(($grade_id==$r['grade_id'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
                  }
                  ?>                  
                  
                  </select>

                  </div>
                  </div>


                      <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
                      <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
             </fieldset>
<div class="col col-sm-8">
<fieldset class="scheduler-border" >
  <legend  class="scheduler-border">Maklumat Yuran Tahunan  :</legend>

<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Jumlah Yuran (RM)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Jumlah Yuran" id="total_fees_year" name="total_fees_year"  style="background-color: #fff;" disabled />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;"/>
                    </div>

                    </div>
    </div>

</div> 

<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Yuran Tunggakan (RM)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Jumlah Yuran" id="balance_fees_year" name="balance_fees_year" style="background-color: #fff;" disabled />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Baki (RM)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" id="curr_balance_fees_year" name="curr_balance_fees_year"  style="background-color: #fff;" disabled/>
                    </div>

                    </div>
    </div>

</div> 

<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Pembayaran (RM)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Pembayaran" id="payment_fees_year" name="payment_fees_year"  style="background-color: #fff;" />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">*</label>
                    <div class="col-sm-10">
              
                     <button type="button" style="width: 150px; height:35px; " class="btn btn-warning active btn-xs" onclick="method_payment_fees_year()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bayar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
    
                    </div>

                    </div>
    </div>

</div> 

</fieldset>
</div>
<div class="col col-lg-8">
<fieldset class="scheduler-border" >
  <legend  class="scheduler-border">Maklumat Yuran Bulanan :</legend>


<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Jumlah Yuran (RM)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Jumlah Yuran" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>

</div> 

<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Yuran Tunggakan (RM)</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Jumlah Yuran" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Baki (RM)</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>

</div> 

<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Pembayaran (RM)</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Buttang Pembayaran</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>

</div> 

</fieldset>
          </div>

<div class="col col-lg-8">
<fieldset class="scheduler-border" >
  <legend  class="scheduler-border">Maklumat Bayaran :</legend>

  
<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran 1</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran 1</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>

</div> 

<div class="row"> 
  <div class="col col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran 1</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>
    <div class="col col-sm-6">
                       <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran 1</label>
                    <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>

                    </div>
    </div>

</div> 

</fieldset>
          </div>



    </div>
    <div id="menu4" class="tab-pane fade">

          
             <fieldset class="scheduler-border col-lg-4" >
                <legend  class="scheduler-border">Maklumat Yuran Tahunan :</legend>

                  <?php
                  $currentYear = date("Y");
                  ?>
                                        <!-- text input -->
                  <div class="form-group">
                  <label class="col">Tahun / Sesi Persekolahan</label>
                  <div class="col">
                    <select  class="form-control" id="year_id" name="year_id" onchange="">
                    <option value="" >Tahun / Sesi Persekolahan</option>
                                      <?php
                    $sql = "select * from year where delete_status='0' order by year.year_id asc";
                    $q = $conn->query($sql);
                    
                    while($r = $q->fetch_assoc())
                    {
                    echo '<option value="'.$r['year_id'].'"  '.(($currentYear==$r['year'])?'selected="selected"':'').'>'.$r['year'].'/'.$r['year_desc'].'</option>';
                    }
                    ?>                
                    
                    </select>
                  </div>
                  </div>
                               
                
                  <div class="form-group">
                  <label class="col">Darjah</label>
                  <div class="col">
                  <select  class="form-control" id="grade_id" name="grade_id" >
                  <option value="" >Pilih Darjah 1</option>
                                    <?php
                  $sql = "select * from grade where delete_status='0' order by grade.grade_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['grade_id'].'"  '.(($grade_id==$r['grade_id'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
                  }
                  ?>                  
                  
                  </select>

                  </div>
                  </div>
                
                      <!--div class="form-group">
                          <label class="col">Jumlah Yuran Tahunan     :</label>
                          <div class="col">
                          <input type="text" id='total_fees' name='total_fees' class="form-control">
                        </div>
                      </div-->

             </fieldset>
         
          <div class="col col-lg-8">
             <fieldset class="scheduler-border" >
                <legend  class="scheduler-border">Maklumat Bayaran :</legend>
                    <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran 1</label>
                    <div class="col-sm-4">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-10">Tarikh Lahir</label>
                    <div class="col-sm-4">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>
                    </div>
             </fieldset>
          </div>
    </div>
    <div id="menu5" class="tab-pane fade">
      <h3>Yuran Bulanan</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu6" class="tab-pane fade">
      <h3>Yuran lain - lain</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>

</fieldset>
            </div>
        </div>     
                         
                           
                    </div>
                  </form>
              
                </div>
              </div>
            
      
                </div>
                <!-- /. ROW  -->

            
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
  
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>

    <link rel="stylesheet" href="jAlert-master/dist/jAlert.css" />
    <script src="jquery-1.7.1.min.js"></script>
    <script src="jAlert-master/dist/jAlert.min.js"></script>
    <script src="jAlert-master/dist/jAlert-functions.min.js"> //optional!!</script>

    <script type="text/javascript">
      
      function method_payment_fees_year()
      {
    var balance_fees_year = parseFloat(document.getElementById('balance_fees_year').value) || 0;
    var payment_fees_year = parseFloat(document.getElementById('payment_fees_year').value) || 0;

    var curr_balance_fees_year = balance_fees_year - payment_fees_year; 
    // Format the balance to two decimal places
    var nilai = curr_balance_fees_year.toFixed(2);
    
    document.getElementById('curr_balance_fees_year').value = nilai;

      }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
          var studentselectedValue = document.getElementById('student_id').value;
              $.ajax({
                  url: 'fetch_fees_year.php',
                  method: 'POST', 
                  data: { student_id: studentselectedValue },
                  dataType:'json',
                  success: function(response) {
                alert('Data fetched successfully!');
                console.log('Response:', response);

                // Update input fields with the response data
                $('#total_fees_year').val(response.total_fees_year); 
                $('#balance_fees_year').val(response.balance_fees_year); 
                $('#payment_fees_year').val(response.balance_fees_year);
                  },
                  error: function(xhr, status, error) {
                      console.error('AJAX Error:', status, error);
                  }
              }); 
         

      });
    </script>

    <script type="text/javascript">
       $(document).ready(function() {
                var studentselectedValue = document.getElementById('student_id').value;
                var kelasselectedValue = document.getElementById('kelas_ids').value;
                var gradeselectedValue = document.getElementById('grade_id').value;
                //alert(studentselectedValue);
                    $.ajax({
                        url: 'get_kelas.php',
                        type: 'POST',
                        data: { grade_id: gradeselectedValue,kelas_id: kelasselectedValue },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentKelas').html(response);
                        }
                    });
         

            $('#grade_id').on('change', function() {
              //$('#kelas').empty().append('<option value="">Select</option>');
             // var gradeselectedValue = document.getElementById('grade_id').value;
              var kelasselectedValue = document.getElementById('kelas_id').value;
             // alert(kelasselectedValue);
              //$('#kelas_id').remove();
             // $('#kelas2').remove();
                var gradeselectedValue = $(this).val();
                    $.ajax({
                        url: 'get_kelas.php',
                        type: 'POST',
                        data: { grade_id: gradeselectedValue,kelas_id: kelasselectedValue },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentKelas').html(response);
                        }
                    });
            });
            });    
    </script>
    <script type="text/javascript">

        $(document).ready(function() {
                    $.ajax({
                        url: 'button_update_student.php',
                        type: 'POST',
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#buttonUpdateStudent').html(response);
                        }
                    });

                    $.ajax({
                        url: 'button_update_parent.php',
                        type: 'POST',
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#buttonUpdateParent').html(response);
                        }
                    });
        });

      $(document).ready(function() {
            $('#button_update_stud').on('click', function() {
                // Display an alert when the button is clicked
              event.preventDefault();
            // Prevent the default form submission
              // Collect data from the form
              var formData = $('#updateForm').serialize();
              var kelasselectedValue = document.getElementById('kelas_id').value;
              // $('#kelas_id').remove();
             // alert(formData);

          if(kelasselectedValue != '')
          {
              // Perform the AJAX request
              $.ajax({
                url: 'update_student.php', // Replace with your server endpoint
                type: 'POST',
                data: formData,
                success: function(response) {
                  // Handle the response from the server
                   successAlert('Maklumat Pelajar', 'Maklumat Berjaya dikemaskini.');
                  //$('#response').html('<p>Update successful: ' + response + '</p>');

                },
                error: function(xhr, status, error) {
                  // Handle any errors
                  errorAlert('Error!', 'Maklumat Tidak Berjaya dikemaskini.');
                 // $('#response').html('<p>Error: ' + error + '</p>');
                }
              });
              }
              else
              { 
                  warningAlert('Warning', 'Sila Pilih Kelas Yang baru!');
              }        
            });




            $('#button_update_parent').on('click', function() {
                // Display an alert when the button is clicked
              event.preventDefault();
            // Prevent the default form submission
              // Collect data from the form
              var formData = $('#updateForm').serialize();
              // Perform the AJAX request
              $.ajax({
                url: 'update_parent.php', // Replace with your server endpoint
                type: 'POST',
                data: formData,
                success: function(response) {
                  // Handle the response from the server
                   successAlert('Maklumat Ibubapa/Penjaga', 'Maklumat Berjaya dikemaskini.');
                  //$('#response').html('<p>Update successful: ' + response + '</p>');

                },
                error: function(xhr, status, error) {
                  // Handle any errors
                  errorAlert('Error!', 'Maklumat Tidak Berjaya dikemaskini.');
                 // $('#response').html('<p>Error: ' + error + '</p>');
                }
              });
            });
        });

      
    $( document ).ready( function () {      
      
      $( "#signupForm1" ).validate( {
        rules: {
          oldpassword: "required",
        
          newpassword: {
            required: true,
            minlength: 6
          },
          
          confirmpassword: {
            required: true,
            minlength: 6,
            equalTo: "#newpassword"
          }
        },
        messages: {
          oldpassword: "Please enter your old password",
          
          newpassword: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
          },
          confirmpassword: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long",
            equalTo: "Please enter the same password as above"
          }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          // Add `has-feedback` class to the parent div.form-group
          // in order to add icons to inputs
          element.parents( ".col-sm-5" ).addClass( "has-feedback" );

          if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
          } else {
            error.insertAfter( element );
          }

          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !element.next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
          }
        },
        success: function ( label, element ) {
          // Add the span element, if doesn't exists, and apply the icon classes to it.
          if ( !$( element ).next( "span" )[ 0 ] ) {
            $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
          }
        },
        highlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
          $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
          $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        }
      } );
    } );
  </script>


</body>
</html>

