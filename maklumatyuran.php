<?php $page='maklumatyuran';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";


$sname='';
$grade='';
$kelas='';
$fees='';
$yuran='';
$balance = 0;
$remark = '';
$advancefees = '';



if(isset($_POST['save']))
{


 if($_POST['action']=="add")
 {
 $fees = mysqli_real_escape_string($conn,$_POST['fees']);
 $grade = mysqli_real_escape_string($conn,$_POST['grade_id']);
 $jenisyuran = mysqli_real_escape_string($conn,$_POST['jenisyuran_id']);
 $balance = $fees-$advancefees;
 $remarks = mysqli_real_escape_string($conn,$_POST['remarks']);
 $advancefees = mysqli_real_escape_string($conn,$_POST['advancefees']);

 
  $q1 = $conn->query("INSERT INTO maklumatyuran (fees, grade_id, balance, remark, advancefees) VALUES ('$fees', '$grade', '$remarks','$advancefees')") ;
  
  $sid = $conn->insert_id;
  
 $conn->query("INSERT INTO  fees_transaction (stdid,paid,submitdate,transcation_remark) VALUES ('$sid','$advancefees','$joindate','$remark')") ;
    
   echo '<script type="text/javascript">window.location="maklumatyuran.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['id']);	
  $sql = $conn->query("UPDATE  maklumatyuran  SET  joindate = '$joindate', gender = '$gender'  WHERE  id  = '$id'");
   echo '<script type="text/javascript">window.location="maklumatyuran.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  maklumatyuran set delete_status = '1'  WHERE id='".$_GET['id']."'");	
header("location: maklumatyuran.php?act=3");

}

$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM student WHERE id='".$id."'");
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
                        <h1 class="page-head-line">Yuran Pelajar 
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="maklumatyuran.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="maklumatyuran.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Edit Yuran </a>';
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
                           <?php echo ($action=="add")? "Masukkan Maklumat Yuran": "Edit maklumat yuran"; ?>
                        </div>
						<form action="maklumatyuran.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						<!--<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Maklumat Pelajar :</legend>
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
						 <legend  class="scheduler-border">Maklumat Yuran Tahunan :</legend>
					

                  <!-- text input -->
                        <div class="form-group">
                        <div class="row">
                        <div class="col-sm-5">
                            <div>
                            <div>  
                            <div>  
                            </div>
                            </div>
                            </div>
                            </div>
                  <!-- text input -->
                            <div class="row">
                            <div class="col-sm-8"> 
                            <label class="col-sm-5 control-label" for="Old">Yuran Tahunan</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" id="fees" name="fees" />
                            </div>
                    </div>
               </div>
                                  
                </div>
            </div>

              

						<?php
						if($action=="add")
						{
						?>
						<div class="form-group">
								<label class="col-sm-3 control-label" for="Old">Bayaran RM* </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="advancefees" name="advancefees"  />
								</div>
						</div>
						<?php
						}
						?>


						
						<div class="form-group">
								<label class="col-sm-3 control-label" for="Old">Baki RM </label>
								<div class="col-sm-5">
									<input type="text" class="form-control"  id="balance" name="balance" value="<?php echo $balance;?>" disabled />
								</div>
						</div>
						
										
							
							<?php
						if($action=="add")
						{
						?>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="Password">Catatan </label>
								<div class="col-sm-8">
	                        <textarea class="form-control" id="remark" name="remark"><?php echo $remark;?></textarea >
								</div>
							</div>
						<?php
						}
						?>

						</fieldset>

						<fieldset class="scheduler-border" >
						 <legend  class="scheduler-border">Maklumat Yuran Bulanan :</legend>
					

                  <!-- text input -->
                        <div class="form-group">
                        <div class="row">
                        <div class="col-sm-10">
                            <div>
                            <div>  
                            <div>  
                            </div>
                            </div>
                            </div>
                            </div>
                  <!-- text input -->
                            <div class="row">
                            <div class="col-sm-8"> 
                            <label class="col-sm-5 control-label" for="Old">Yuran Bulanan</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" id="fees" name="fees" />
                            </div>
                    </div>
               </div>
                                  
                </div>
            </div>

              

						<?php
						if($action=="add")
						{
						?>
						<div class="form-group">
								<label class="col-sm-3 control-label" for="Old">Bayaran RM* </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="advancefees" name="advancefees"  />
								</div>
						</div>
						<?php
						}
						?>


						
						<div class="form-group">
								<label class="col-sm-3 control-label" for="Old">Baki RM </label>
								<div class="col-sm-5">
									<input type="text" class="form-control"  id="balance" name="balance" value="<?php echo $balance;?>" disabled />
								</div>
						</div>
						
										
							
							<?php
						if($action=="add")
						{
						?>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="Password">Catatan </label>
								<div class="col-sm-8">
	                        <textarea class="form-control" id="remark" name="remark"><?php echo $remark;?></textarea >
								</div>
							</div>
						<?php
						}
						?>

         

         


            </fieldset>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="action" value="<?php echo $action;?>">
                
                  <button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Simpan Maklumat Yuran</button>
                 
                   
                                                   
                </div>
              </div>
							
									
						
						
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
          sname: "required",
          dob: "required",
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
		}else{
		?>
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-success">
                        <div class="panel-heading">
                          Maklumat Yuran - Senarai Pelajar 
                        </div>
                        <div class="panel-body">

					<?php 
					$currentYear = date("Y");
					?>
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
                  echo '<option value="'.$r['year_id'].'"  '.(($currentYear==$r['year'])?'selected="selected"':'').'>'.$r['year'].' / '.$r['year_desc'].'</option>';
                  }
                  ?>                
                  
                  </select>
                        </div>
                      </div>
                    </div>
             </div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
        <div class="form-group">
                  <label class="col-sm-8">Darjah</label>
                  <div class="col-sm-6">
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
<div id="com-kelas-populat">
    <div id="com-kelas-1" class="col-sm-4">
          <div class="form-group">
                  <label class="col-sm-8">Kelas</label>

                  <div class="col-sm-6">
                  <select  class="form-control" id="kelas_id" name="kelas_id" >
                  <option value="" >Pilih Kelas</option>
                                    <?php
                  $sql = "select * from kelas where delete_status='0' order by kelas_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['kelas_id'].'"  '.(($kelas_id==$r['kelas_id'])?'selected="selected"':'').'>'.$r['kelas'].'</option>';
                  }
                  ?>                  
                  
                  </select>

                  </div>
           </div>
    </div>
</div>
  </div>
</div>

<br/>

                            <div class="table-sorting table-responsive">


                                    <div id="contentContainer">
                    				</div>
                            </div>
                        </div>
                    </div>


                     
    <link href="css/datatable/datatable.css" rel="stylesheet" />                 
    <script src="js/dataTable/jquery.dataTables.min.js"></script>


    <script>
        $(document).ready(function() {
            var year_id = document.getElementById('year_id').value;
                if (year_id) {
                    $.ajax({
                        url: 'get_list_student_fees.php',
                        type: 'POST',
                        data: { year_id: year_id },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
                        }
                    });

          

                } else {
                    // Clear the contentContainer if no option is selected
                    $('#contentContainer').html('');
                }
        });
    </script>
    

    <script>
        $(document).ready(function() {
        	$('#year_id').on('change', function() {
            var year_id = document.getElementById('year_id').value;
                if (year_id) {
                    $.ajax({
                        url: 'get_list_student_fees.php',
                        type: 'POST',
                        data: { year_id: year_id },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
                        }
                    });

          

                } else {
                    // Clear the contentContainer if no option is selected
                    $('#contentContainer').html('');
                }
        });
       });
    </script>

        <script>
        $(document).ready(function() {
        	$('#grade_id').on('change', function() {
            var year_id = document.getElementById('year_id').value;
            var  grade_id = document.getElementById('grade_id').value;
            var  kelas_id = document.getElementById('kelas_id').value;
                if (grade_id) {
                    $.ajax({
                        url: 'get_list_stud_fees_grade.php',
                        type: 'POST',
                        data: { year_id: year_id,grade_id: grade_id },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#contentContainer').html(response);
                            $('#com-kelas-1').remove();
                            $('#com-kelas-populat').show();
							document.getElementById('kelas_id').value = 0;

                        }
                    });


                    $.ajax({
                        url: 'fetch_kelas_id.php',
                        type: 'POST',
                        data: { year_id: year_id,grade_id: grade_id },
                        success: function(response) {
                            // Insert the received content into the contentContainer div
                            $('#com-kelas-populat').html(response);


                        }
                    }); 
          

                } else {
                    // Clear the contentContainer if no option is selected
                    $('#contentContainer').html('');
                }
        });
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
