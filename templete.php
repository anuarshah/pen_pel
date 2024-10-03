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
  (  year_id,student_id ) VALUES (1,$student_id)") ;
  
  $sid = $conn->insert_id;


if (isset($_POST['flexCheckChecked']) && is_array($_POST['flexCheckChecked']))
{

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

}

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
  $sql = $conn->query("UPDATE  parents  SET  father_name ='$father_name',father_ic = '$father_ic', father_phone_no ='$father_phone_no', mother_name = '$mother_name', mother_ic = '$mother_ic', mother_phone_no = '$mother_phone_no', email ='$email', current_address = '$current_address', postcode = '$postcode', city = '$city', negeri = '$negeri', password = '$password''  WHERE  id  = '$id'");

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
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="parents.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="parents.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Maklumat Ibubapa/Penjaga</a>';
						?>
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


				<!--shahrul anuar <-->

          <div class="col-sm-10 col-sm-offset-1">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Isikan Maklumat Ibubapa/Penjaga": "Edit maklumat Ibubapa/Penjaga"; ?>
                        </div>
                        <div class="panel-body">   

<ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#home">Maklumat Ibubapa/Penjaga</a></li>
  <li><a data-toggle="pill" href="#menu1">Maklumat Pelajar</a></li>
  <li><a data-toggle="pill" href="#menu2">Maklumat Yuran Pelajar</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">

    <fieldset class="scheduler-border" >
        <legend  class="scheduler-border">Maklumat Ibubapa/Penjaga :</legend>
    </fieldset>
  </div>
  <div id="menu1" class="tab-pane fade">
    <fieldset class="scheduler-border" >
        <legend  class="scheduler-border">Maklumat Pelajar :</legend>
    </fieldset>
  </div>
  <div id="menu2" class="tab-pane fade">
    <fieldset class="scheduler-border" >
        <legend  class="scheduler-border">Maklumat Yuran Pelajar :</legend>
    </fieldset>
  </div>
</div>

                        </div>
               </div>

         </div>

<script type="text/javascript">
            function carian()
            {

                var selectedValue = document.getElementById('father_ic').value;

               if (selectedValue) {
                    $.ajax({
                        url: 'get_parents.php',
                        type: 'POST',
                        data: { parents_id: selectedValue },
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
		} 
        else{
		?>
		
    <link href="css/datatable/datatable.css" rel="stylesheet" />                 
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
