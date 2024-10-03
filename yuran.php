<?php $page='yuran';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$id= '';
$grade = '';
$jenisyuran='';
$yuran = '';
$amount = '';
if(isset($_POST['save']))
{

$id = mysqli_real_escape_string($conn,$_POST['yuran_id']);
$grade = mysqli_real_escape_string($conn,$_POST['grade_id']);
$jenisyuran = mysqli_real_escape_string($conn,$_POST['jenisyuran_id']);
$yuran = mysqli_real_escape_string($conn,$_POST['yuran']);
$amount = mysqli_real_escape_string($conn,$_POST['amount']);

 if($_POST['action']=="add")
 {
 
  echo $sql = $conn->query("INSERT INTO yuran ( grade_id, jenisyuran_id,yuran, amount) 
  	               VALUES ($grade, $jenisyuran,'$yuran', '$amount')") ;
    
    echo '<script type="text/javascript">window.location="yuran.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['yuran_id']);	
   $sql = $conn->query("UPDATE  yuran  SET  grade_id  = '$grade',  jenisyuran_id  = '$jenisyuran', 
   						yuran  = '$yuran', amount  = '$amount'  WHERE  yuran_id  = '$id'");
   echo '<script type="text/javascript">window.location="yuran.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  yuran set delete_status = '1'  WHERE yuran_id='".$_GET['yuran_id']."'");
header("location: yuran.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
 $id = isset($_GET['yuran_id'])?mysqli_real_escape_string($conn,$_GET['yuran_id']):'';

$sqlEdit = $conn->query("SELECT * FROM yuran WHERE yuran_id='".$id."'");
if($sqlEdit->num_rows)
{
$rowsEdit = $sqlEdit->fetch_assoc();
extract($rowsEdit);
$action = "update";
$grade = $rowsEdit['grade_id'];
$jenisyuran_id = $rowsEdit['jenisyuran_id'];
}else
{
$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> Tambah Yuran Berjaya</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'> Kemaskini Yuran Berjaya</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'> Padam Yuran Berjaya</div>";
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Pengurusan Pelajar</title>

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
	 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">


	<script>
		function colorChanged() {
	alert('test 1');
}
	</script>
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Setup Yuran 
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="yuran.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="yuran.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Tambah Yuran </a>';
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
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
               			<div class="panel panel-success">
                        <div class="panel-heading">
                            <?php echo ($action=="add")? "Tambah Yuran": "Kemaskini Yuran"; ?>
                        </div>
						<form action="yuran.php" method="post" id="signupForm1" class="form-horizontal">
	                        <div class="panel-body">


		                       	<div class="form-group">
		                        	  	
									    <label class="col-sm-3 control-label" for="email"> Darjah </label>
									    <div class="col-sm-5">
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
								<div class="form-group">
								
									    <label class="col-sm-3 control-label"  for="email"> Jenis Yuran </label>
									    <div class="col-sm-5">
							    <select  class="form-control" id="jenisyuran_id" name="jenisyuran_id" >
									<option value="" >Pilih Jenis Yuran</option>
							                                    <?php
															   	$sql = "select * from jenisyuran where delete_status='0' order by jenisyuran.jenisyuran asc";
																$q = $conn->query($sql);
																
																while($r = $q->fetch_assoc())
																{
																echo '<option value="'.$r['jenisyuran_id'].'"  '.(($jenisyuran_id==$r['jenisyuran_id'])?'selected="selected"':'').'>'.$r['jenisyuran'].'</option>';
																}
																?>
								</select>
									  </div>	  
								</div>	
								
								<div class="form-group">
										<label class="col-sm-3 control-label" for="Old">Perkara </label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="yuran" name="yuran" value="<?php echo $yuran;?>"  />
										</div>
							    </div>
								
								<div class="form-group">
										<label class="col-sm-3 control-label" for="Old">Jumlah RM 1</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="amount" name="amount" value="<?php echo $amount;?>"  />
								
										</div>
								</div>
								
								<div class="form-group">
										<div class="col-sm-2 col-sm-offset-2">
										<input type="hidden" name="yuran_id" value="<?php echo $id;?>">
										<input type="hidden" name="action" value="<?php echo $action;?>">
										<button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Simpan </button>
							</div>
						</form>	
                        </div>
                    </div>
                </div>
               

			   
			   
		<script type="text/javascript">
		

		$( document ).ready( function () {			
			
			 if($("#signupForm1").length > 0)
         {
			$( "#signupForm1" ).validate( {
				rules: {
					yuran: "required",
					
					
				
					
				},
				messages: {
					yuran: "Please enter class name",
					
					
				},
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

				$(document).ready(function(){
			        $('#grade').change(function(){
			            var grade = $(this).val();
			            $.ajax({
			                url: 'fetch_data_fees.php',
			                type: 'POST',
			                data: { grade: grade },
			                dataType: 'json',
			                success: function(response) {
			                    $('#fees').empty();
			                    $.each(response['grade'], function(index, value) {
			                        $('#fees').append('<option value="' + value['id'] + '">' + value['yuran'] + '</option>');
			                    });
			                }
			            });
			        });
			    });

	    </script>
	</script>

		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 <script src="js/dataTable/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
         <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>	 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Pengurusan Yuran
                        </div>
                        <div class="panel-body">
						<div class="panel-body">
                        	<div class="row">
                         	<div class="col-sm-4">
							 <div class="form-group">



							    <label for="email"> Darjah </label>
							    <select  class="form-control" id="grade" name="grade" onchange="nameChanged()">
									<option value="" >Pilih darjah </option>
							                                    <?php
																$sql = "select * from grade where delete_status='0' order by grade.grade asc";
																$q = $conn->query($sql);
																
																while($r = $q->fetch_assoc())
																{
																echo '<option value="'.$r['id'].'"  '.(($grade==$r['grade'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
																}
																?>
								</select>
							  </div>
							</div>
  							<div class="col-sm-4">
                        	<div class="form-group">
							    <label for="email">  Jenis Yuran </label>
							 <select  class="form-control" id="yuran" name="yuran" onchange="fetchData()" >
									<option value="" >Pilih Jenis Yuran</option>
							                                  <?php
															   	$sql = "select * from jenisyuran where delete_status='0' order by jenisyuran.jenisyuran asc";
																$q = $conn->query($sql);
																
																while($r = $q->fetch_assoc())
																{
																echo '<option value="'.$r['id'].'"  '.(($yuran==$r['id'])?'selected="selected"':'').'>'.$r['jenisyuran'].'</option>';
																}
																?>
								</select>
							</div>
  							</div>
  						    </div>
						</div>

      	    				
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Darjah</th>
                                            <th>Jenis Yuran</th>
                                            <th>Perkara</th>
                                            <th>Amount (RM)</th>
											<th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select (select grade from grade where grade.grade_id =yuran.grade_id) grade_desc,(select jenisyuran from jenisyuran where jenisyuran.jenisyuran_id = yuran.jenisyuran_id) yuran_desc,yuran_id,yuran,amount from yuran where yuran.jenisyuran_id = yuran.jenisyuran_id and yuran.delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())

										
									{
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['grade_desc'].'</td>
                                            <td>'.$r['yuran_desc'].'</td>
                                            <td>'.$r['yuran'].'</td>
                                            <td>'.$r['amount'].'</td>
											<td>
											<a href="yuran.php?action=edit&yuran_id='.$r['yuran_id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="yuran.php?action=delete&yuran_id='.$r['yuran_id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a> </td>
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
             	"search": {
  "regex": true,
  "smart": false
},
    "bPaginate": true,
    "bLengthChange": false,
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
</div>

    
</body>
</html>
