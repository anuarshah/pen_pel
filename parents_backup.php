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

 echo "success save student <br/>";

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
                <div class="row">
				
                    <div class="col-sm-10 col-sm-offset-1">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Masukkan Maklumat Ibubapa/Penjaga": "Edit maklumat Ibubapa/Penjaga"; ?>
                        </div>
						<form action="student.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						<!--<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Maklumat Ibubapa/Penjaga1 :</legend>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Full Name* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="sname" name="sname" value="<?php echo $sname;?>"  />
								</div>
							</div>
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Contact* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact;?>" maxlength="10" />
								</div>
							</div>
							
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Grade* </label>
								<div class="col-sm-10">
									<select  class="form-control" id="grade" name="grade" >
									<option value="" >Select Grade Level</option>
                                    <?php
									$sql = "select * from grade where delete_status='0' order by grade.grade asc";
									$q = $conn->query($sql);
									
									while($r = $q->fetch_assoc())
									{
									echo '<option value="'.$r['id'].'"  '.(($grade==$r['id'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
									}
									?>									
									
									</select>
								</div>
						</div>
						
						
						<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">DOJ* </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Date of Joining" id="joindate" name="joindate" value="<?php echo  ($joindate!='')?date("Y-m-d", strtotime($joindate)):'';?>" style="background-color: #fff;" readonly />
								</div>
							</div>
						 </fieldset>
						
								
										
						
				
<!--add by shahrul><-->
												
				<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Maklumat Ibubapa/Penjaga :</legend>


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
                  

												
										
						
            </fieldset>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="action" value="<?php echo $action;?>">
                <input type="hidden" name="no_mykid" value="<?php echo $no_mykid;?>">
                
                  <button type="submit" name="next_to_student" class="btn btn-success" style="border-radius:0%">Simpan Maklumat Ibubapa/Penjaga </button>
                 
                   
                                                   
                </div>
              </div>
							
							<!--</fieldset>
							
							 <fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Optional Information:</legend>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Password">About Student </label>
								<div class="col-sm-10">
	                        <textarea class="form-control" id="about" name="about"><?php echo $about;?></textarea >
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="Old">Email Id </label>
								<div class="col-sm-10">
									
									<input type="text" class="form-control" id="emailid" name="emailid" value="<?php echo $emailid;?>"  />
								</div>
						    </div>
							</fieldset>
						
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								
									<button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Save </button>
								 
								   
								   								 							   
								</div>
							</div>
                         
                           
                           
                         
                           
                         </div>
							</form>
							
                        </div>
                            </div>
            
			
                </div>
               

			   
			   
		<script type="text/javascript">
		

		$( document ).ready( function () {			
			
		$( "#joindate" ).datepicker({
dateFormat:"yy-mm-dd",
changeMonth: true,
changeYear: true,
yearRange: "1970:<?php echo date('Y');?>"
});	
		
        $( "#dob" ).datepicker({
dateFormat:"yy-mm-dd",
changeMonth: true,
changeYear: true,
yearRange: "1970:<?php echo date('Y');?>"
}); 

		
		if($("#signupForm1").length > 0)
         {
		 
		 <?php if($action=='add')
		 {
		 ?>
		 
			$( "#signupForm1" ).validate( {
				rules: {
          no_mykid: "required",
          no_cert_birth: "required",
          gender: "required",
          student_name: "required",
					sname: "required",
          dob: "required",
          father_name: "required",
					joindate: "required",
					emailid: "email",
					grade: "required",
					
					
					contact: {
						required: true,
						digits: true
					},
					
					fees: {
						required: true,
						digits: true
					},
					
					
					advancefees: {
						required: true,
						digits: true
					},
				
					
				},
			<?php
			}else
			{
			?>
			
			$( "#signupForm1" ).validate( {
				rules: {
          no_mykid: "required",
          no_cert_birth: "required",
          gender: "required",
          student_name: "required",
					sname: "required",
          dob: "required",father_name: "required",
          father_name: "required",
					joindate: "required",
					emailid: "email",
					grade: "required",
          
					
					
					contact: {
						required: true,
						digits: true
					}
					
				},
			
			
			
			<?php
			}
			?>
				
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-10" ).addClass( "has-feedback" );

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
					$( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
			
			}
			
		} );
		
		
		
		$("#fees").keyup( function(){
		$("#advancefees").val("");
		$("#balance").val(0);
		var fee = $.trim($(this).val());
		if( fee!='' && !isNaN(fee))
		{
		$("#advancefees").removeAttr("readonly");
		$("#balance").val(fee);
		$('#advancefees').rules("add", {
            max: parseInt(fee)
        });
		
		}
		else{
		$("#advancefees").attr("readonly","readonly");
		}
		
		});
		
		
		
		
		$("#advancefees").keyup( function(){
		
		var advancefees = parseInt($.trim($(this).val()));
		var totalfee = parseInt($("#fees").val());
		if( advancefees!='' && !isNaN(advancefees) && advancefees<=totalfee)
		{
		var balance = totalfee-advancefees;
		$("#balance").val(balance);
		
		}
		else{
		$("#balance").val(totalfee);
		}
		
		});
		
		
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
                 

                  $sql = "select * from parents, student, grade, kelas where parents.student_id=student.student_id and student.delete_status='0' and parents.grade_id=grade.grade_id and grade.delete_status = '0' and parents.kelas_id=kelas.kelas_id and parents.delete_status='0'";
                  $q = $conn->query($sql);
                  $i=1;
                  while($r = $q->fetch_assoc())

                  {


                  
                      echo '<tr>
                            <td>'.$i.'</td>
                            <td>'.$r['father_name'].'<br/>'.$r['mother_name'].'</td>
                            <td>'.$r['father_phone_no'].'<br/>'.$r['mother_phone_no'].'</td>
                            <td>'.$r['sname'].''.'</td>
                            <td>'.$r['grade'].'<br/>'.$r['kelas'].'</td>
                            <td>
                      
                      
											
											

											<a href="parents.php?action=edit&parent_id='.$r['parent_id'].'" class="btn btn-primary btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-folder-open"></span></a>

                      <a href="parents.php?action=edit&parent_id='.$r['parent_id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="parents.php?action=delete&parent_id='.$r['parent_id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a> </td>
											
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
