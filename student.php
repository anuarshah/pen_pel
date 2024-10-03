<?php $page='student';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$id="";
$student_id='';
$sname='';
$no_mykid='';
$no_cert_birth ='';
$gender ='';
$dob = '';
$joindate = '';
$grade='';
$kelas='';
$year='';

if(isset($_POST['next_to_student']))
{
 //echo "success save parent";

$sqlEdit = $conn->query("SELECT * FROM parents WHERE father_ic='".mysqli_real_escape_string($conn,$_POST['father_ic'])."'");
if($sqlEdit->num_rows == 0)
{

$id="";
$emailid='';

$father_name='';
$father_ic='';
$father_phone_no='';
$mother_name='';
$mother_ic='';
$mother_phone_no='';
$email='';
$current_address='';
$postcode='';
$city='';
$negeri='';
$password='';

$father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
$father_ic = mysqli_real_escape_string($conn,$_POST['father_ic']);
$father_phone_no = mysqli_real_escape_string($conn,$_POST['father_phone_no']);
$mother_name  = mysqli_real_escape_string($conn,$_POST['mother_name']);
$mother_ic = mysqli_real_escape_string($conn,$_POST['mother_ic']);
$mother_phone_no = mysqli_real_escape_string($conn,$_POST['mother_phone_no']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$current_address = mysqli_real_escape_string($conn,$_POST['current_address']);
$postcode = mysqli_real_escape_string($conn,$_POST['postcode']);
$city = mysqli_real_escape_string($conn,$_POST['city']);
$negeri = mysqli_real_escape_string($conn,$_POST['negeri']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

  $q1 = $conn->query("INSERT INTO parents (father_name, father_ic, father_phone_no, mother_name, mother_ic, mother_phone_no, email, current_address, postcode, city, negeri, password) VALUES ('$father_name','$father_ic', '$father_phone_no', '$mother_name', '$mother_ic', '$mother_phone_no', '$email', '$current_address', '$postcode', '$city', '$negeri', '$password')") ;
  
  $sid = $conn->insert_id;


    $sqlEdit = $conn->query("SELECT * FROM parents WHERE father_ic='".$father_ic."'");
    if($sqlEdit->num_rows)
    {
      $rowsEdit = $sqlEdit->fetch_assoc();
      extract($rowsEdit);
      $parent_id = $rowsEdit['parent_id'];

    }

$student_id = mysqli_real_escape_string($conn,$_POST['student_id']);
$result = $conn->query("UPDATE  student  SET  parent_id = $parent_id 
  WHERE  student_id  = '$student_id' ");

}
else
{
    $father_ic = mysqli_real_escape_string($conn,$_POST['father_ic']);
    $sqlEdit = $conn->query("SELECT * FROM parents WHERE father_ic='".$father_ic."'");
    if($sqlEdit->num_rows)
    {
      $rowsEdit = $sqlEdit->fetch_assoc();
      extract($rowsEdit);
      $parent_id = $rowsEdit['parent_id'];

    }

  $student_id = mysqli_real_escape_string($conn,$_POST['student_id']);
  $result = $conn->query("UPDATE  student  SET  parent_id = $parent_id 
  WHERE  student_id  = '$student_id' ");

      echo "<script type='text/javascript'>alert('Hanya Rekod Pelajar Sahaja yang disimpan');</script>";
}
}


if(isset($_POST['save']))
{

$id = mysqli_real_escape_string($conn,$_POST['student_id']);
//$no_stud = mysqli_real_escape_string($conn,$_POST['no_stud']);
$sname = mysqli_real_escape_string($conn,$_POST['sname']);
$no_mykid = mysqli_real_escape_string($conn,$_POST['no_mykid']);
$no_cert_birth = mysqli_real_escape_string($conn,$_POST['no_cert_birth']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);
$joindate = mysqli_real_escape_string($conn,$_POST['joindate']);
$grade = mysqli_real_escape_string($conn,$_POST['grade_id']);
$kelas = mysqli_real_escape_string($conn,$_POST['kelas_id']);
$year = mysqli_real_escape_string($conn,$_POST['year_id']);


 if($_POST['action']=="add")
 {
 
  $q1 = $conn->query("INSERT INTO student 
    ( sname, no_mykid, no_cert_birth, dob, gender, joindate, grade_id, kelas_id, year_id ) 
    VALUES ('$sname','$no_mykid','$no_cert_birth','$dob','$gender','$joindate', '$grade','$kelas', '$year')") ;
  
  $sid = $conn->insert_id;
  
     
   echo '<script type="text/javascript">window.location="student.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
  $id = mysqli_real_escape_string($conn,$_POST['student_id']);	

 $student_id = mysqli_real_escape_string($conn,$_POST['student_id']);
  $sql = $conn->query("UPDATE  student  SET  no_stud = '$no_stud' , sname = '$sname', no_mykid = '$no_mykid', no_cert_birth = '$no_cert_birth', dob = '$dob', gender = '$gender' , joindate = '$joindate',  grade_id = '$grade', kelas_id = '$kelas', year_id = '$year'  WHERE  student_id  = $id ");

   echo '<script type="text/javascript">window.location="student.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  student set delete_status = '1'  WHERE student_id='".$_GET['student_id']."'");	
header("location: student.php?act=3");

}

$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['student_id'])?mysqli_real_escape_string($conn,$_GET['student_id']):'';

$sqlEdit = $conn->query("SELECT * FROM student WHERE student_id='".$id."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);
  $sname = $rowsEdit['sname'];
  $grade = $rowsEdit['grade_id'];
  $kelas = $rowsEdit['kelas_id'];
}else
{
$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student record has been added!</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student record has been updated!</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Student has been deleted!</div>";
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ePengurusanPelajar</title>

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
	
	<link href="css/ui.css" rel="stylesheet" />
	<link href="css/datepicker.css" rel="stylesheet" />	
	
    <script src="js/jquery-1.10.2.js"></script>
	
    <script type='text/javascript' src='js/jquery/jquery-ui-1.10.1.custom.min.js'></script>
   
	
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-sm-10">
                        <h2><strong>Pengurusan Pelajar
          						<?php
          						 if (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit");
          						?>
          						</strong></h2>
                               
                      <?php

                      echo $errormsg;
                      ?>
                  </div>
                    </div>
                </div>
				
				
				
        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {

		?>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
                <div class="row">
				
                    <div class="col-sm-10 col-sm-offset-1">
               <div class="panel panel-success active">
                        <div class="panel-heading ">
                           <?php echo ($action=="add")? "Masukkan Maklumat Peribadi": "Edit maklumat pelajar"; ?> 
                        </div>
						<!--form action="student.php" method="post" id="signupForm1" class="form-horizontal"-->
      <form method="POST" action="parents.php?action=add">
                        <div class="panel-body">
						
										
            <!--add by shahrul><-->
						<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Maklumat Pelajar :</legend>

	
                  <div class="row">
                    <div class="col-sm-8">
                      <!-- text input -->
                      <div class="form-group">
                          <label class="col-sm-8">Tahun / Sesi Persekolahan</label>
                          <div class="col-sm-6">
                          <select  class="form-control" id="year_id" name="year_id" >
                				  <option value="" >Tahun / Sesi Persekolahan</option>
                                    <?php
                  $sql = "select * from year where delete_status='0' order by year.year_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['year_id'].'"  '.(($year==$r['year_id'])?'selected="selected"':'').'>'.$r['year'].'</option>';
                  }
                  ?>                
                  
                  </select>
                        </div>
                      </div>
                    </div>
             </div>

             

             
             <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                          <label class="col-sm-8">Tarikh Daftar</label>
                          <div class="col-sm-8">
                          <input type="date" id='joindate' name='joindate' value="<?php echo $joindate;?>" class="form-control" >
                        </div>
                      </div>
                    </div>

                 <div class="col-sm-5">
                       <div class="form-group">
                        <label class="col-sm-6">No Pelajar</label>
                        <div class="col-sm-10">
                        <input type="text" id='no_stud' name='no_stud' class="form-control" disabled>
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

                <div class="row">
                    <div class="col-sm-5">
                    <div class="form-group">
                    <label class="col-sm-10">Tarikh Lahir</label>
                    <div class="col-sm-8">
                          <input type="date" id='dob' name='dob' value="<?php echo $dob;?>" class="form-control" >
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                    <label class="col-sm-5">Jantina</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="gender" name="gender">
                          <option value="" >Pilih Jantina</option>
                        <option value="Lelaki">Lelaki</option>
                        <option value="Perempuan">Perempuan</option>                      
                        </select>
                   		 
                      </div>
                    </div>
                  </div>
              </div>         

                  <div class="row">
                    <div class="col-sm-5">
                      <!-- Select multiple-->
                      <div class="form-group">
                    <label class="col-sm-10">Darjah </label>
                    <div class="col-sm-10">
                  <select  class="form-control" id="grade_id" name="grade_id" >
                  <option value="" >Pilih Darjah</option>
                                    <?php
                  $sql = "select * from grade where delete_status='0' order by grade.grade_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['grade_id'].'"  '.(($grade==$r['grade_id'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
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
                          <!-- Content will be dynamically loaded here -->
                      </div>


                    
                      </div>
                    </div>
                  </div>

						 </fieldset>
						
						<!-- Placeholder div where the content will be loaded -->
            <div id="contentContainer">
              <!-- Content will be dynamically loaded here -->
            </div>

            <div class="form-group">
                <div class="col-sm-2 ">
                   <!--p>Klik Untuk Ke Maklumat Ibubapa</p-->
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="action" value="<?php echo $action;?>">
                        <input type="hidden" name="student_id" value="<?php echo $id;?>">
                        <button type="submit" name="next_to_parent" class="btn btn-primary active pull right" style="border-radius:3px;">Simpan Maklumat Pelajar <br> Isi Maklumat Ibubapa
                        </button> 
                </div>   
            </div>
       </form> 
             
			<script>
        $(document).ready(function() {


            $('#grade_id').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue) {
                    $.ajax({
                        url: 'get_data3.php',
                        type: 'POST',
                        data: { grade_id: selectedValue },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
                        }
                    });

                    $.ajax({
                        url: 'get_data6.php',
                        type: 'POST',
                        data: { grade_id: selectedValue },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentKelas').html(response);
                        }
                    });

                } else {
                    // Clear the contentContainer if no option is selected
                    $('#contentContainer').html('');
                }
            });
        });


        function check(data,bil) {
    // Construct the dynamic ID based on the passed data
    var flexCheckCheckedId = 'flexCheckChecked[' + data + ']';
    var subfees = 'subfees[' + bil+']';
    //alert(flexCheckCheckedId);
    
    // Get the checkbox element by the dynamic ID
    var check = document.getElementById(flexCheckCheckedId);
    //alert(document.getElementById(subfeess).value);

    
    // Get the value of the checkbox (parse it as a number)
    var total = parseFloat(check.value) || 0;
    
    // Get the current amount from 'total_feess' and parse it as a number
    var amount = parseFloat(document.getElementById('fees').value) || 0;
    //alert(amount);
    //var subamount = parseFloat(document.getElementById(subfees).getAttribute('data-value')) || 0;
    var subamount = parseFloat(document.getElementById(subfees).value) || 0;
    //alert(subamount);
    
    // Update the total amount based on the checkbox state
    var jumlah;
    var subjumlah;
    if (check.checked) {
        // Subtract the value if the checkbox is checked
        jumlah = amount + total;
        subjumlah = subamount + total;
        //alert(subjumlah);
    } else {
        // Add the value if the checkbox is unchecked
        jumlah = amount - total;
        subjumlah = subamount - total;
        //alert(subjumlah);
    }

    // Update the 'total_feess' value
    document.getElementById('fees').value = jumlah.toFixed(2);
    document.getElementById(subfees).value = subjumlah.toFixed(2);
}
    </script>

			   
		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		<div class="panel panel-success">
                        <div class="panel-heading">
                          <b>Senarai Pelajar</b> <a href="student.php?action=add" class="btn btn-success active btn-sm pull-right" style="border-radius:3px;"><i class="glyphicon glyphicon-plus"></i> Daftar Pelajar Baru</a>
                        </div>
                        <div class="panel-body">
<?php
$currentYear = date('Y');
//echo $currentYear;

?>
            
                      <div class="form-group">  
                      <div class="row">
                        <div class="col-sm-3">
                         <b> Tahun / Sesi Persekolahan </b>
                         <select  class="form-control" id="year_id" name="year_id" >
                          
                  <?php
                  $sql = "select * from year where delete_status='0' order by year.year_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['year_id'].'"  '.(($currentYear==$r['year'])?'selected="selected"':'').'>'.$r['year'].' / '.$r['year_desc'].'</option>';
                  }
                  ?>                
                  
                  </select>


                </div>
                </div>
                      </div>

                <div id="contentContainer">
                    <!-- Content will be dynamically loaded here -->
                </div>

                <fieldset class="scheduler-border" id="field">
                <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable223">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Nama</th>                                         
											<th>Darjah</th>
                                            <th>Kelas</th>
                                            <th>Tarikh Daftar</th>
																						<th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select * from j01_year_student,student,grade,year,kelas where  j01_year_student.year_id = 1 and j01_year_student.student_id =student.student_id and student.grade_id =grade.grade_id and grade.delete_status='0' and student.year_id =year.year_id and year.delete_status ='0' and student.kelas_id =kelas.kelas_id and student.delete_status ='0' order by j01_year_student.JYD_id  desc";

									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
                      echo '<tr>
                            <td width="5%">'.$i.'</td>
                        
														<td width="46%">'.$r['sname'].''.'</td>
														<td width="10%">'.$r['grade'].'</td>
			                      <td width="13%">'.$r['kelas'].'</td> 
                            <td width="13%">'.date('d M Y', strtotime($r['joindate'])).'</td>                    
														<td width="17%">
											
											

											<a href="detailpelajar.php?action=edit&student_id='.$r['student_id'].'" class="btn btn-primary active btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;</a>

					
											<a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="student.php?action=delete&student_id='.$r['student_id'].'" class="btn btn-danger btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;</a> </td>
											
                                        </tr>';
										$i++;
									}
									?>
									
                                        
                                        
                                    </tbody>
                                </table>
              <a href="list_student.php" class="btn btn-success active btn-sm" style="border-radius:3px;">&nbsp;&nbsp;<i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp; Excel</a>
                                </fieldset>
                            </div>
                        </div>
                    </div><button id="GenerateMonthFeesStudent"><b>Generate Yuran Pelajar 1 &nbsp;</b></button>
                     

      <link href="css/datatable/datatable.css" rel="stylesheet" />                 
  <script src="js/dataTable/jquery.dataTables.min.js"></script>


        <script>
        $(document).ready(function() {
            $('#year_id').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue) {
                    $.ajax({
                        url: 'get_data5.php',
                        type: 'POST',
                        data: { year_id: selectedValue },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
                        }
                    });

                    $("#field").remove();

                } else {
                    // Clear the contentContainer if no option is selected
                    $('#contentContainer').html('');
                }
            });
        });
    </script>

    <script>
    $(document).ready(function () {
    $('#tSortable223').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
  
         });
    </script>

      <link href="css/datatable/datatable.css" rel="stylesheet" />                 
  <script src="js/dataTable/jquery.dataTables.min.js"></script>

        <script>
    $(document).ready(function () {
    $('#tSortable40').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
  
         });
    </script>
		
		<?php
		}
		?>
				
				
            
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



    
</body>
</html>
