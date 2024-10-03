<?php $page='dashboard';
include("php/dbconnect.php");
include("php/checklogin.php");


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


</head>
<?php
include("php/header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Dashboard</h1>
                        

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
				
				  <div class="col-md-4">
                        <div class="main-box mb-green">
                            <a href="student.php">
                                <i class="fa fa-users fa-5x"></i>
                                <h5>Maklumat Pelajar</h5>
                                <h4>Jumlah Pelajar: <?php include 'counter/stucount.php'?></h4>
                                <h4>Pelajar Aktif: <?php include 'counter/activecount.php'?></h4>
                                <a href="inactivestd.php">
                                <h4>Pelajar Tak Aktif: <?php include 'counter/inactivecount.php'?></h4>
                            </a>
                        </div>
                    </div>
				
				
                   
					
                    <div class="col-md-4">
                        <div class="main-box mb-pink">
                            <a href="fees.php">
                                <i class="fa fa-money fa-5x"></i>
                                <h5>Maklumat Yuran </h5>
                                <h4>Jumlah Yuran : <?php include 'counter/totalfees.php'?></h4>
                                <h4>Jumlah Kutipan : <?php include 'counter/totalearncount.php'?></h4>
                                <h4>Baki : <?php include 'counter/balancefees.php'?></h4>
         
                            </a>
                        </div>
                    </div>
					
					
					 <div class="col-md-4">
                        <div class="main-box mb-secondary">
                            <a href="kelas.php">
                                <i class="fa fa-th-large fa-5x"></i>
                                <h5>Maklumat Kelas</h5>
                                <h4>Bilangan Kelas: <?php include 'counter/totalkelas.php'?></h4>
                              </div>
                    </div>
                  

                </div>

               
                    <div class="col-md-4">
                        <div class="main-box mb-maroon">
                            <a href="report.php">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                <h5>View Reports</h5>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">View Reports</div>
                          <div class="panel-body">                        
                        <center>
                            <a href="report.php">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                <h5></h5>
                            </a>
                        </center>
                    </div>

                        </div>
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

    
   
   <script src="js/jquery-1.10.2.js"></script>	
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>
    


</body>
</html>
