<?php $page='detailpelajar';
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
                            <h1 class="page-head-line">Maklumat Pelajar
            <?php
            echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
            ' <a href="student.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="student.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Daftar Pelajar Baru</a>';
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
                      Butiran Pelajar
                  </div>
                  <form id="updateForm">
                    <div class="panel-body">
    
                      <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#home">Maklumat Pelajar</a></li>
                        <li><a data-toggle="pill" href="#menu1">Maklumat Ibubapa/Penjaga</a></li>
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
            <div id="home" class="tab-pane fade in active">
                <!-- Content for the first tab -->
          <fieldset class="scheduler-border" >
                  <br />
                  <div class="row">
                   <div class="col-sm-5">
                       <div class="form-group">
                        <label class="col-sm-6">No Pelajar</label>
                        <div class="col-sm-10">
                        <input type="text" id='no_stud' name='no_stud' value="<?php echo $no_stud; ?>" class="form-control" disabled>
                      </div>
                      </div>
                  </div>

                </div>
             <div class="row">
                    <div class="col-sm-11">
                      <!-- text input -->
                      <div class="form-group">
                          <label class="col-sm-10">Nama Penuh Pelajar</label>
                          <div class="col-sm-10">
                          <input type="text" id='sname' name='sname' value="<?php echo $sname;?>" class="form-control" placeholder="Masukan Nama Penuh Pelajar">
                        </div>
                      </div>
                    </div>
              </div>       


                  <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">No Mykid</label>
                        <div class="col-sm-10">
                        <input type="text" id='no_mykid' name='no_mykid' value="<?php echo $no_mykid;?>" class="form-control" placeholder="Masukan No Mykid">
                      </div>
                      </div>
                    </div>
                   <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">No Surat Beranak</label>
                        <div class="col-sm-10">
                        <input type="text" id='no_cert_birth' name='no_cert_birth' value="<?php echo $no_cert_birth;?>" class="form-control" placeholder="Masukan No Surat Beranak">
                      </div>
                    </div>
                  </div>
              </div>        
                <?php
                    $formattedDatedob = date('Y-m-d', strtotime($dob));
                ?>      

                <div class="row">
                    <div class="col-sm-5">
                    <div class="form-group">
                    <label class="col-sm-10">Tarikh Lahir</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="<?php echo htmlspecialchars($formattedDatedob); ?>" style="background-color: #fff;" />
                    </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                    <label class="col-sm-5">Jantina</label>
                    <div class="col-sm-10">
                       
                        <select class="form-control" id="gender" name="gender">
                          <?php

                            echo '<option value="'.$gender.'"  '.'>'.$gender.'</option>';
                            
                          ?>
                        <option value="Lelaki">Lelaki</option>
                        <option value="Perempuan">Perempuan</option>                      
                        </select>
                       
                      </div>
                    </div>
                  </div>
              </div>         

                  <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                          <label class="col-sm-10">Sesi</label>
                          <div class="col-sm-10">
                          <input type="text" id='year_id' name='year_id' value="<?php echo $year.' / '. $year_desc;?>" class="form-control" >
                        </div>
                      </div>
                    </div>
                    <?php
                     $formattedDate = date('Y-m-d', strtotime($joindate));
                    //echo  $grade_id; 
                    ?>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                          <label class="col-sm-10">Tarikh Daftar</label>
                          <div class="col-sm-10">
                          <input type="date" id='joindate' name='joindate' value="<?php echo htmlspecialchars($formattedDate); ?>" class="form-control" >
                        </div>
                      </div>
                    </div>
             </div>
             
                  <div class="row">
                    <div class="col-sm-5">
                      <!-- Select multiple-->
                      <div class="form-group">
                    <label class="col-sm-10">Darjah</label>
                    <div class="col-sm-10">
                  <select  class="form-control" id="grade_id" name="grade_id" >
                  <option value="" >Pilih Darjah</option>
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
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <div id="contentKelas">
                        </div>
            <input type="hidden" id="kelas_ids" name="kelas_ids" value="<?php echo $kelas; ?>">

                      </div>
                    </div>
                  </div>
                  <div id="response"></div>

                  <input type="hidden" name="stud_id" value="<?php echo $id;?>">
<br/>

<div class="form-group">
                <div class="col-sm-2 ">
                        <button type="submit" id="button_update_stud" name="button_update_stud" value="23" class="btn btn-primary active pull right" style="border-radius:3px;">Kemaskini Maklumat Pelajar
                        </button> 
                </div>   
            </div>'
                  <!--div id="buttonUpdateStudent">
                          <!-- Content will be dynamically loaded here -->
                  <!--/div-->


             </fieldset>
            </div>
            <div id="menu1" class="tab-pane fade">
                <!-- Content for the second tab -->
               <fieldset class="scheduler-border" >
                     <br/>         
<?php

$sqlEdit = $conn->query("SELECT * FROM parents where  parent_id='".$parent_id."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  //print_r($rowsEdit);
  extract($rowsEdit);
 // $kelas = $rowsEdit['kelas_id'];

  $action = "update";
}else
{
$father_name = '';
$father_ic = '';
$father_phone_no = '';
$mother_name  = '';
$mother_ic = '';
$mother_phone_no = '';
$email = '';
$current_address = '';
$postcode = '';
$city = '';
$negeri ='';
$password = '';
}
?>
  
                  <div class="row">
                    <div class="col-sm-11">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">Nama Penuh Bapa/Penjaga</label>
                        <div class="col-sm-10">
                        <input type="text" id="father_name" name="father_name" value="<?php echo $father_name;?>" class="form-control" placeholder="Masukan Nama Penuh Bapa/Penjaga">
                      </div>
                      </div>
                    </div>
                  </div>
                    <input type="hidden" name="parent_id" value="<?php echo $parent_id;?>">
                   <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">No IC/Passport</label>
                        <div class="col-sm-10">
                        <input type="text" id="father_ic" name="father_ic" value="<?php echo 
                         $father_ic;?>" 
                        class="form-control" placeholder="Masukan No IC/Passport">
                      </div>
                      </div>
                    </div>
                   <div class="row">
                    <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                    <label class="col-sm-10">No Telefon Bapa</label>
                    <div class="col-sm-10">
                    <input type="text" id="father_phone_no" name="father_phone_no" value="<?php echo 
                     $father_phone_no;?>" 
                    class="form-control" placeholder="Masukan No Telefon Bapa">
                </div>
                  </div>
                </div>
              </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                  <!-- text input -->
                  <div class="form-group">
                    <label class="col-sm-10">Nama Penuh Ibu/Penjaga</label>
                    <div class="col-sm-10">
                    <input type="text" id="mother_name" name="mother_name" value="<?php echo 
                     $mother_name;?>" 
                    class="form-control" placeholder="Masukan Nama Penuh Ibu/Penjaga">
                    </div>
                  </div>
                </div>
                </div>
             <div class="row">
                 <div class="col-sm-5">
                   <!-- text input -->
                   <div class="form-group">
                        <label class="col-sm-10">No IC/Passport</label>
                        <div class="col-sm-10">
                        <input type="text" id="mother_ic" name="mother_ic"  value="<?php echo 
                        $mother_ic;?>" 
                        class="form-control" placeholder="Masukan No IC/Passport">
                      </div>
                      </div>
                    </div>
                   <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">No Telefon Ibu</label>
                        <div class="col-sm-10">
                        <input type="text" id="mother_phone_no" name="mother_phone_no"   value="<?php echo 
                         $mother_phone_no;?>" 
                        class="form-control" placeholder="Masukan No Telefon Ibu">
                      </div>
                    </div>
                  </div>
               </div>
               </div>

               <div class="row">
                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">Alamat Emel</label>
                        <div class="col-sm-10">
                        <input type="text" id= "email" name="email"   value="<?php echo 
                         $email;?>" 
                        class="form-control" placeholder="Masukan Alamat Emel">
                          </div>
                    </div>
                  </div>
                  </div>

                <div class="row">
                    <div class="col-sm-10">
                      <!-- textarea -->
                      <div class="form-group">
                        <label class="col-sm-10">Alamat Semasa</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" id="current_address" name="current_address"  
                        rows="5" placeholder="Masukan Alamat Semasa"><?php echo htmlspecialchars($current_address); ?></textarea>
                      </div>
                    </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                        <label class="col-sm-5">Poskod</label>
                        <div class="col-sm-10">
                        <input type="text" id= "postcode" name="postcode"    value="<?php echo 
                         $postcode;?>" 
                        class="form-control" placeholder="Masukan Poskod">
                      </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-5">
                   <!-- text input -->
                   <div class="form-group">
                        <label class="col-sm-5">Daerah</label>
                        <div class="col-sm-10">
                        <input type="text" id= "city" name="city"    value="<?php echo 
                         $city;?>" 
                        class="form-control" placeholder="Masukan Daerah">
                      </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">Negeri</label>
                        <div class="col-sm-10">
                         <select class="form-control" id="negeri" name="negeri">
                          <option value="1">Selangor</option>
                          <option value="2">Wilayah Persekutuan Putrajaya</option>
                          <option value="3">Melaka</option>
                          <option value="4">Negeri Sembilan</option>
                          <option value="4">Johor</option>
                          <option value="5">Perak</option>
                        </select>
                       </div>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">Password</label>
                        <div class="col-sm-10">
                      <input type="password" id= "password" name="password"   value="<?php echo 
                         $password;?>" 
                      class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                    </div>
                  </div>
                  </div>
                  <br/>
     <div class="form-group">
                <div class="col-sm-2 ">
                        <button type="submit" id="button_update_parent" name="button_update_parent" value="12" class="btn btn-primary active pull right" style="border-radius:3px;">Kemaskini Maklumat Ibubapa/Penjaga
                        </button> 
                </div>   
            </div>';

                  
                  <!--div id="buttonUpdateParent">
                          <!-- Content will be dynamically loaded here -->
                  <!--/div-->                       
            
            </fieldset>
            </div>
            <div id="menu2" class="tab-pane fade">
              <fieldset class="scheduler-border" >
              <br/>
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home1">Yuran Tahunan</a></li>
    <li><a data-toggle="pill" href="#menu4">Yuran Bulanan</a></li>
    <li><a data-toggle="pill" href="#menu5">Yuran lain -lain</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="home1" class="tab-pane fade in active">

          
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
                
                      <div class="form-group">
                          <label class="col">Jumlah Yuran Tahunan     :</label>
                          <div class="col">
                          <input type="text" id='total_fees' name='total_fees' class="form-control">
                        </div>
                      </div>
             </fieldset>
         
          <div class="col col-lg-8">
             <fieldset class="scheduler-border" >
                <legend  class="scheduler-border">Maklumat Bayaran :</legend>
                    <div class="form-group">
                    <label class="col-sm-10">Tarikh Bayaran</label>
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
    <div id="menu4" class="tab-pane fade">
      <h3>Yuran Bulanan</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu5" class="tab-pane fade">
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
        $(document).ready(function() {
          //$('#fetchDataButton').click(function() {
              $.ajax({
                  url: 'fetch_fees_info.php', // The server-side script
                  method: 'POST', // or 'POST' depending on your needs
                  data: { student_id: 2345 },
                  success: function(data) {
                      $('#total_fees').val(data); // Insert the returned data into the input field
                  },
                  error: function(xhr, status, error) {
                      console.error('AJAX Error:', status, error);
                  }
              });
         // });
      });
    </script>

    </script>
    <script type="text/javascript">
       $(document).ready(function() {

                var kelasselectedValue = document.getElementById('kelas_ids').value;
                var gradeselectedValue = document.getElementById('grade_id').value;
               // alert(kelasselectedValue);
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

