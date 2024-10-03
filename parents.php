<?php $page='parents';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

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

if(isset($_POST['next_to_parent']))
{

 //echo "success save student <br/>";

$id="";
$student_id="";
$sname='';
$no_mykid='';
$no_cert_birth ='';
$gender ='';
$dob = '';
$joindate = '';
$grade='';
$kelas='';
$year='';
$total_fees =0;

$id = mysqli_real_escape_string($conn,$_POST['student_id']);
$sname = mysqli_real_escape_string($conn,$_POST['sname']);
$no_mykid = mysqli_real_escape_string($conn,$_POST['no_mykid']);
$no_cert_birth = mysqli_real_escape_string($conn,$_POST['no_cert_birth']);
$dob = mysqli_real_escape_string($conn,$_POST['dob']);
$gender = mysqli_real_escape_string($conn,$_POST['gender']);
$joindate = mysqli_real_escape_string($conn,$_POST['joindate']);
$grade = mysqli_real_escape_string($conn,$_POST['grade_id']);
$kelas = mysqli_real_escape_string($conn,$_POST['kelas_id']);
$year = mysqli_real_escape_string($conn,$_POST['year_id']);



$q1 = $conn->query("INSERT INTO student 
  ( sname, no_mykid, no_cert_birth, dob, gender, joindate, grade_id, kelas_id, year_id ) 
    VALUES ('$sname','$no_mykid','$no_cert_birth','$dob','$gender','$joindate', '$grade','$kelas', '$year')") ;
  
  $sid = $conn->insert_id;

$sqlEdit = $conn->query("SELECT * FROM student WHERE no_mykid='".$no_mykid."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);
  $student_id = $rowsEdit['student_id'];
}

$q1 = $conn->query("INSERT INTO j01_year_student 
  (  year_id,student_id ) VALUES ($year,$student_id)") ;
  
  $sid = $conn->insert_id;





if (isset($_POST['flexCheckChecked']) && is_array($_POST['flexCheckChecked']))
{
 
  /*print_r($_POST['flexCheckChecked']);
  $array = $_POST['flexCheckChecked'];
  echo json_encode($array);
  $json_encode = json_encode($array);
  $array = json_decode($json_encode, true);
  print_r($array);
  */

 // $selectedFees = [];

        // Loop through the nested array
        $a=1;
        foreach ($_POST['flexCheckChecked'] as $key => $group) 
        {  
           $darjah[$a] = $key;
           //echo "<br/> Darjah : ".$darjah[$a];
           //echo "<br/> Darjah : ".$key;
           $b=1;
            foreach ($group as $key_yuran => $yuran) {
              $yuran_id[$b] = $key_yuran;
              //echo "<br/> Yuran : ".$yuran_id[$b];
              //echo "<br/> Yuran : ".$key_yuran;
              $c=1;
              foreach ($yuran as $key_jenisyuran => $jenisyuran) {
                $jenisyurans[$c] = $key_jenisyuran;
               // echo "<br/> Jenis Yuran : ".$jenisyurans[$c];
                //echo "<br/> Jenis Yuran : ".$key_jenisyuran;
                $d=1;


                foreach ($jenisyuran as $key_subjenisyuran => $subjenisyuran) 
                {
                  $key_subjenisyuranss[$d] = $key_subjenisyuran; 
                 // echo "<br/> Nama Yuran  : ".$key_subjenisyuranss[$d];
                 // echo "<br/> Nama Yuran  : ".$key_subjenisyuran;
                  if (!empty($subjenisyuran)) 
                  {
                    $subjenisyuran = $conn->real_escape_string($subjenisyuran);
                    $subjenisyuranss[$d] = $subjenisyuran; 
                   // echo " RM : ".$subjenisyuranss[$d];
                    //echo " RM : ".$subjenisyuran;
                    $total_fees = $total_fees + $subjenisyuranss[$d];

                   $q1 = $conn->query("INSERT INTO fees (student_id,yuran_id,description,amount) 
                    VALUES ('$student_id','$jenisyurans[$c]','$key_subjenisyuranss[$d]','$subjenisyuranss[$d]')") ;
  
                    $sid = $conn->insert_id;
                  }
                  $d++;
                }
              $c++;
              }
              $b++;
            }
            $a++;
        }

       // echo $total_fees;

}

  $q1 = $conn->query("INSERT INTO fees_info 
  (  fi_year,fi_student_id,fi_grade_id,fi_fees,fi_balance,fi_advancefees ) 
  VALUES ($year,$student_id,$grade_id,$total_fees,$total_fees,0)") ;
  
  $sid = $conn->insert_id;

}

if(isset($_POST['save']))
{



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



 if($_POST['action']=="add")
 {
 
 
  $q1 = $conn->query("INSERT INTO parents (father_name, father_ic, father_phone_no, mother_name, mother_ic, mother_phone_no, email, current_address, postcode, city, negeri, password) VALUES ('$father_name','$father_ic', '$father_phone_no', '$mother_name', '$mother_ic', '$mother_phone_no', '$email', '$current_address', '$postcode', '$city', '$negeri', '$password')") ;
  
  $sid = $conn->insert_id;
  
    
   echo '<script type="text/javascript">window.location="parents.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['id']);	
  $sql = $conn->query("UPDATE  parents  SET  father_name ='$father_name',father_ic = '$father_ic', father_phone_no ='$father_phone_no', mother_name = '$mother_name', mother_ic = '$mother_ic', mother_phone_no = '$mother_phone_no', email ='$email', current_address = '$current_address', postcode = '$postcode', city = '$city', negeri = '$negeri', password = '$password'  WHERE  id  = '$id'");

   echo '<script type="text/javascript">window.location="parents.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  parents set delete_status = '1'  WHERE parent_id='".$_GET['parent_id']."'");	
header("location: parents.php?act=3");

}

$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['parent_id'])?mysqli_real_escape_string($conn,$_GET['parent_id']):'';

$sqlEdit = $conn->query("SELECT * FROM parents WHERE parent_id='".$id."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);
  $action = "update";
}else
{
$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Parents record has been added!</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Parents record has been updated!</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Parents record has been deleted!</div>";
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
                        <h1 class="page-head-line">Maklumat Ibubapa/Penjaga 
						</h1>
                     
<?php

echo $errormsg;
?>
                    </div>
                </div>
				
				
				
        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {

		?>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Carian Maklumat Keluarga": "Edit maklumat Ibubapa/Penjaga"; ?>
                        </div>

                        <div class="panel-body"> 
                               <div class="row">
                                <div class="col-sm-16">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label class="col-sm-9">No IC/Passport</label>
                                    <div class="col-sm-9">
                                    <input type="text" id="father_ic" name="father_ic" value="<?php echo 
                        $father_ic;?>" 
                                    class="form-control" placeholder="Masukan No IC/Passport">
                                  </div>
                                  </div>
                                </div>
                               <input type="hidden" id="student_id" name="student_id" value="<?php echo $student_id;?>" >
                               <div class="row">
                                <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                <div class="col-sm-10">
                                 <input class="btn btn-primary" type="button" value="Carian" onclick="carian()">  &nbsp;&nbsp;<input type="checkbox" id="checkbox_cari" name="checkbox_cari" value="1">                        
                               </div>
                              </div>
                            </div>
                          </div>
                          </div>
                        </div>
                    </div>
                  </div>

				<!--shahrul anuar <-->

          <div class="col-sm-10 col-sm-offset-1">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Isikan Maklumat Ibubapa/Penjaga": "Edit maklumat Ibubapa/Penjaga"; ?>
                        </div>
						<form action="student.php" method="post" id="signupForm1" class="form-horizontal">




              <div class="panel-body">					

                            <!-- Placeholder div where the content will be loaded -->
            <div id="contentContainer">
              <!-- Content will be dynamically loaded here -->
            </div>
                        
                        <div class="form-group">
                            <div class="col-sm-4 ">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="action" value="<?php echo $action;?>">
                            <input type="hidden" name="no_mykid" value="<?php echo $no_mykid;?>">
                            
                          </div>
                      </div>
                        </div>
					</form>	
			   <script type="text/javascript">
            function carian()
            {

               var fatherValue = document.getElementById('father_ic').value;
               var studentValue = document.getElementById('student_id').value;
               if (fatherValue) {
                    $.ajax({
                        url: 'get_parents.php',
                        type: 'POST',
                        data: { parents_ic:fatherValue,student_id:studentValue },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
                        }
                    });

                } else {
                    // Clear the contentContainer if no option is selected
                    alert('Taip Sebarang IC Bapa pelajar');
                    $('#contentContainer').html('');
                }
     
            }
         </script>

		<?php
		} else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                          Senarai Ibubapa/Penjaga 
                        </div>
                        <div class="panel-body">
                            <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                      <tr>
                                       <th>Bil</th>
                                       <th>Nama Bapa/Ibu/Penjaga</th> 
                                       <th>No Tel</th>  
                                       <th>Nama Anak</th>
                                       <th>Darjah / Kelas</th>
                                       <th>Tindakan</th>
                                       </tr>
                                    </thead>
                                    <tbody>
								<?php
                 

                  $sql = "select * from parents where parents.delete_status='0'";
                  $q = $conn->query($sql);
                  $i=1;
                  while($r = $q->fetch_assoc())

                  {


                  
                      echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$r['father_name'].'<br/>'.$r['mother_name'].'</td>
                            <td>'.$r['father_phone_no'].'<br/>'.$r['mother_phone_no'].'</td>';
     $sqls = "select * from student,grade,kelas where student.kelas_id = kelas.kelas_id and student.grade_id = grade.grade_id and parent_id = '".$r['parent_id']."' and student.delete_status='0'";
                  $qq = $conn->query($sqls);
                  $sname = [];
                  $grade = [];
                  $kelas = [];
                  $no=1; 
                  while($rr = $qq->fetch_assoc())
                  { 
                    $sname[$no]= $rr['sname'];
                    $grade[$no]= $rr['grade'];
                    $kelas[$no]= $rr['kelas'];
                    $no++;
                  }
                           echo '<td>';

for ($no1 = 1; $no1 < $no; $no1++) {
    if($no1 == 1)
    {
    echo $no1.'&nbsp;&nbsp;. '.$sname[$no1];
  }else
  {
    echo $no1.'&nbsp;. '.$sname[$no1];
  }
  
    if ($no1 < $no - 1) {
        echo '<br/>'; // Add a comma separator if there are more names
    }
}

                           echo '</td>';
                            echo '<td>';

for ($no1 = 1; $no1 < $no; $no1++) {
    if($no1 == 1)
    {
    echo $grade[$no1].' ( '.$kelas[$no1].' )';
  }else
  {
    echo $grade[$no1].' ( '.$kelas[$no1].' )';
  }
  
    if ($no1 < $no - 1) {
        echo '<br/>'; // Add a comma separator if there are more names
    }
}
                            '</td>';

                  
                         echo '<td>

											<a href="parentsdetail.php?action=edit&parent_id='.$r['parent_id'].'" class="btn btn-primary btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;</a>

                 
											
											<a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="parents.php?action=delete&parent_id='.$r['parent_id'].'" class="btn btn-danger btn-xs" style="border-radius:3px;">&nbsp;&nbsp;<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;</a></td>
											
                                        </tr>';
										$i++;
									}
									?>
									
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     
	<script src="js/dataTable/jquery.dataTables.min.js"></script>
    
     <script>
         $(document).ready(function () {
             $('#tSortable22').dataTable({
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
