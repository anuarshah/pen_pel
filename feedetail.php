<?php $page='kelas';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$grade='';
$kelas='';
$id= '';
if(isset($_POST['save']))
{

$grade = mysqli_real_escape_string($conn,$_POST['grade_id']);
$kelas = mysqli_real_escape_string($conn,$_POST['kelas']);

 if($_POST['action']=="add")
 {
 
  $sql = $conn->query("INSERT INTO kelas (kelas, grade_id) VALUES ('$kelas', '$grade')") ;
    
    echo '<script type="text/javascript">window.location="kelas.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['id']);	
   $sql = $conn->query("UPDATE  kelas  SET  kelas = '$kelas' WHERE  kelas_id  = '$id'");
   echo '<script type="text/javascript">window.location="kelas.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  kelas set delete_status = '1'  WHERE kelas_id='".$_GET['kelas_id']."'");
header("location: kelas.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['kelas_id'])?mysqli_real_escape_string($conn,$_GET['kelas_id']):'';
//echo " part edit ";
$sqlEdit = $conn->query("SELECT * FROM kelas WHERE kelas_id='".$id."'");
if($sqlEdit->num_rows)
{
    $rowsEdit = $sqlEdit->fetch_assoc();
	print_r($rowsEdit);
	extract($rowsEdit);
	$action = "update";
	$grade = $rowsEdit['grade_id'];
}else
{
	$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> Tambah Kelas Berjaya</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'> Kemaskini Kelas Berjaya</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'> Padam Kelas Berjaya</div>";
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ePenguruasan Pelajar SRA</title>

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


	
</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Yuran dan Pembayaran 
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="kelas.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="kelas.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Tambah Kelas </a>';
						?>
						</h1>
                     
						<?php

						echo $errormsg;
						?>
                    </div>
                </div>

                <div class="row" style="margin-bottom:20px;">
<div class="col-md-12">

  <div class="form-group">
    
  </div>
  
 
</form>

</fieldset>

				
				
				
        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {
		?>

		</div>
</div>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
                <div class="row">
				
                    <div class="col-sm-8 col-sm-offset-2">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Tambah Kelas": "Kemaskini Kelas"; ?>
                        </div>
						<form action="kelas.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						
						<div class="form-group">
		                        	  	
									    <label class="col-sm-2 control-label" for="email"> Darjah1 <?php echo $grade;?>  </label>
									    <div class="col-sm-5">
		    							<select  class="form-control" id="grade_id" name="grade_id" >
										<option value="" >Pilih Darjah </option>
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
								<label class="col-sm-2 control-label" for="Old">Kelas </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo $kelas;?>"  />
								</div>
							</div>
							
							
							
							
							
							</div>
						
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								
									<button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Simpan </button>
								</div>
							</div>
                         
                           
                           
                         
                           
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
					kelas: "required",
					
					
				
					
				},
				messages: {
					kelas: "Please enter class name",
					
					
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
	</script>


			   
		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-success">
                        <div class="panel-heading">
                            Butiran Yuran
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">
<div class="container">
  <ul class="nav nav-pills">
    <li class="nav nav-success active"><a data-toggle="pill" href="#home">Yuran Keseluruhan</a></li>
    <li><a data-toggle="pill" href="#menu3">Yuran Tahunan</a></li>
    <li><a data-toggle="pill" href="#menu1">Yuran Bulanan</a></li>
    <li><a data-toggle="pill" href="#menu2">Yuran Lain-lain</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    	<div class="row">
    	<div class="col-sm-9">
    	<fieldset class="scheduler-border" >
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Yuran Tahunan Perlu Dibayar :</legend>
            </fieldset>
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Yuran Bulanan Perlu Dibayar :</legend>
            </fieldset>
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Lain-lain Yuran Perlu Dibayar:</legend>
            </fieldset>
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Jumlah Keseluruhan Perlu Dibayar:</legend>
            </fieldset>
  		</fieldset>
  		</div>
  		</div>
    </div>
    <div id="menu1" class="tab-pane fade">
    	<div class="row">
    	<div class="col-sm-9">
    	<fieldset class="scheduler-border" >
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Maklumat Yuran Bulanan :</legend>
            </fieldset>
        	</fieldset>
  		</div>
  		</div>
    </div>
    <div id="menu2" class="tab-pane fade">
    	<div class="row">
    	<div class="col-sm-9">
    	<fieldset class="scheduler-border" >
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Maklumat Yuran Lain -lain :</legend>
            </fieldset>
        </fieldset>
  		</div>
  		</div>
    </div>
    <div id="menu3" class="tab-pane fade">
    	<div class="row">
    	<div class="col-sm-9">
    	<fieldset class="scheduler-border" >
            <fieldset class="scheduler-border" >
             <legend  class="scheduler-border">Maklumat Yuran Tahunan :</legend>
            </fieldset>
        </fieldset>
  		</div>
  		</div>
    </div>
  </div>
</div>
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

    
</body>
</html>
