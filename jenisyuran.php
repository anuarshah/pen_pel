<?php $page='jenisjenisyuran';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";

$jenisyuran='';
$id= '';
if(isset($_POST['save']))
{

$jenisyuran = mysqli_real_escape_string($conn,$_POST['jenisyuran']);

 if($_POST['action']=="add")
 {
 
  $sql = $conn->query("INSERT INTO jenisyuran (jenisyuran) VALUES ('$jenisyuran')") ;
    
    echo '<script type="text/javascript">window.location="jenisyuran.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['jenisyuran_id']);	
   $sql = $conn->query("UPDATE  jenisyuran  SET  jenisyuran  = '$jenisyuran' WHERE  jenisyuran_id  = '$id'");
   echo '<script type="text/javascript">window.location="jenisyuran.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  jenisyuran set delete_status = '1'  WHERE jenisyuran_id='".$_GET['jenisyuran_id']."'");
header("location: jenisyuran.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['jenisyuran_id'])?mysqli_real_escape_string($conn,$_GET['jenisyuran_id']):'';

$sqlEdit = $conn->query("SELECT * FROM jenisyuran WHERE jenisyuran_id='".$id."'");
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
$errormsg = "<div class='alert alert-success'> Tambah Jenis Yuran Berjaya</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'> Kemaskini Jenis Yuran Berjaya</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'> Padam Jenis Yuran Berjaya</div>";
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ePengurusan Pelajar SRA</title>

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
                        <h1 class="page-head-line">Pengurusan Jenis Yuran  
						<?php
						echo (isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")?
						' <a href="jenisyuran.php" class="btn btn-success btn-sm pull-right" style="border-radius:0%">Kembali </a>':'<a href="jenisyuran.php?action=add" class="btn btn-danger btn-sm pull-right" style="border-radius:0%"><i class="glyphicon glyphicon-plus"></i> Tambah Jenis Yuran </a>';
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
                           <?php echo ($action=="add")? "Tambah Jenis Yuran": "Kemaskini Jenis Yuran"; ?>
                        </div>
						<form action="jenisyuran.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">
						
						
						
						
						<div class="form-group">
								<label class="col-sm-4 control-label" for="Old">Jenis Yuran </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="jenisyuran" name="jenisyuran" value="<?php echo $jenisyuran;?>"  />
								</div>
							</div>
							
							
							
							
							
							</div>
						
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="jenisyuran_id" value="<?php echo $id;?>">
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
					jenisyuran: "required",
					
					
				
					
				},
				messages: {
					jenisyuran: "Masukkan Jenis Yuran",
					
					
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
		 
		
		 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Pengurusan Jenis Yuran
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Yuran</th>
											<th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$sql = "select * from jenisyuran where delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['jenisyuran'].'</td>
											<td>
											<a href="jenisyuran.php?action=edit&jenisyuran_id='.$r['jenisyuran_id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
											
											<a onclick="return confirm(\'Are you sure you want to delete this record\');" href="jenisyuran.php?action=delete&jenisyuran_id='.$r['jenisyuran_id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a> </td>
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

    
</body>
</html>
