<?php $page='student_fees';
include("php/dbconnect.php");
include("php/checklogin.php");
$errormsg = '';
$action = "add";


$fees='';
$grade='';
$jenisyuran='';
$balance = 0;
$remark = '';
$advancefees = '';



if(isset($_POST['next_to_fees']))
{
 echo "success save parent";
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

$no_mykid = mysqli_real_escape_string($conn,$_POST['no_mykid']);
echo $father_name = mysqli_real_escape_string($conn,$_POST['father_name']);
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

$conn->query("UPDATE  student set parent_id = $parent_id  WHERE no_mykid='$no_mykid'");    

$sqlselect = $conn->query("SELECT * FROM student WHERE no_mykid='".$no_mykid."'");
if($sqlselect->num_rows)
{
  $rowsSelect = $sqlselect->fetch_assoc();
  extract($rowsSelect);
  $grade_id = $rowsSelect['grade_id'];
}

$sql = "select distinct(jenisyuran_id) yuran_id from yuran  where grade_id = 1";
$q = $conn->query($sql);
   $i = 0;               
while($r = $q->fetch_assoc())
{
    echo $yurans[$i++]=$r['yuran_id'];
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
                        <h1 class="page-head-line">Yuran Pendaftaran 
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
                           <?php echo ($action=="add")? "Yuran Pendaftaran": "Edit maklumat yuran"; ?>
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


 
                                  
                            </div>
                        </div>
      
                                <div class="form-group">
                                        
                                        <label class="col-sm-3 control-label" for="email"> Darjah </label>
                                        <div class="col-sm-5">
                                        <select  class="form-control" id="grade_id" name="grade_id" >
                                        <option value="" >Pilih darjah</option>
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

                                  <?php
                                  $j=0;
                                  $total_fees = 0;
                                     for($i=0;$i<3;$i++)
                                     {
                                        

$sqlselect = $conn->query("SELECT * FROM jenisyuran WHERE jenisyuran_id='".$yurans[$i]."'");
if($sqlselect->num_rows)
{
  $rowsSelect = $sqlselect->fetch_assoc();
  extract($rowsSelect);
  $jenisyuran = $rowsSelect['jenisyuran'];
}

                                        ?>
                                        <div class="form-group">
                                        <label class="col-sm-3 control-label" for="Old">Jenis Yuran</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="jenisyuran" name="jenisyuran" value="<?php echo $jenisyuran; ?>"/>
                                
                                        </div>
                                        </div>

                                        <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Yuran </th>                                          
                                            <th>Jumlah </th>  
                                            <th>tindakan </th> 
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $sqls = "select * from yuran where delete_status='0' and grade_id = 1 and jenisyuran_id ='".$yurans[$i]."'";
                                    $qq = $conn->query($sqls);
                                    $ii=1;
                                    while($rr = $qq->fetch_assoc())

                                        
                                    {
                                    
                                     echo '<tr id="row' . $j++ . '">
                                            <td>'.$ii.'</td>
                                            <td>'.$rr['yuran'].'</td>
                                            <td>'.$rr['amount'].'</td>                  
                                            <td><input class="form-check-input" type="checkbox" value="'.$rr['amount'].'" id="flexCheckChecked'.$j.'" onclick="check('.$j.')" checked></td>   
                                        </tr>';
                                        $ii++;

                                        $total_fees += $rr['amount'];
                                    }
                                    ?>
                                    
                                        
                                        
                                    </tbody>
                                </table>


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
                            <label class="col-sm-5 control-label" for="Old">Jumlah Yuran Pendaftaran</label>
                            <div class="col-sm-5">
                            <input type="text" class="form-control" id="fees" name="fees" value="<?php echo $total_fees;?>" disabled/>
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

                        <div class="form-group">
                                <label class="col-sm-3 control-label" for="Old">Jumlah Keseluruhan </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  id="total_fees" name="total_fees" value="<?php echo $balance;?>" disabled />
                                </div>
                        </div>  

         


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

function check(data) {
    // Construct the dynamic ID based on the passed data
    var flexCheckCheckedId = 'flexCheckChecked' + data;
    
    // Get the checkbox element by the dynamic ID
    var check = document.getElementById(flexCheckCheckedId);
    
    // Get the value of the checkbox (parse it as a number)
    var total = parseFloat(check.value) || 0;
    
    // Get the current amount from 'total_feess' and parse it as a number
    var amount = parseFloat(document.getElementById('fees').value) || 0;
    
    // Update the total amount based on the checkbox state
    var jumlah;
    if (check.checked) {
        // Subtract the value if the checkbox is checked
        jumlah = amount + total;
    } else {
        // Add the value if the checkbox is unchecked
        jumlah = amount - total;
    }

    // Update the 'total_feess' value
    document.getElementById('fees').value = jumlah.toFixed(2);
}

        

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
        
        var advancefees = parseFloat($.trim($(this).val()))|| 0;
        var totalfee = parseFloat($("#fees").val())|| 0;
        if( advancefees!='' && !isNaN(advancefees) && advancefees<=totalfee)
        {
        var balance = totalfee-advancefees;
        $("#balance").val(balance.toFixed(2));
        
        }
        else{
        $("#balance").val(totalfee.toFixed(2));
        }
        
        });
        
        
    </script>


               
        <?php
        }else{
        ?>
        
        
                        <div class="panel-body">
                            <div class="table-sorting table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Nama</th>                                          
                                            <th>Darjah/Kelas</th>
                                            <th>Jumlah Yuran</th>
                                            <th>Bayaran</th>
                                            <th>Baki</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $sql = "select * from maklumatyuran student, grade, kelas where student.student_id=student.student_id and student.delete_status='0' and student.grade_id=grade.grade_id and grade.delete_status = '0' and student.kelas_id=kelas.kelas_id and student.delete_status='0'";
                                    $q = $conn->query($sql);
                                    $i=1;
                                    while($r = $q->fetch_assoc())

                                        
                                    {
                                    
                                     echo '<tr>
                                                   <td>'.$i.'</td>
                                                   <td>'.$r['sname'].''.'</td>
                                                   <td>'.$r['grade'].'<br/>'.$r['kelas'].'</td>
                                                   <td>'.$r['fees'].''.'</td>
                                                   <td>'.$r['advancefees'].''.'</td>
                                                   <td>'.$r['balance'].''.'</td>  
                                                 
                                                        <td>
                                            
                                            

                                            <a href="maklumatyuran.php?action=edit&id='.$r['maklumatyuran_id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit"></span></a>
                                            
                                            <a onclick="return confirm(\'Are you sure you want to deactivate this record\');" href="maklumatyuran.php?action=delete&id='.$r['maklumatyuran_id'].'" class="btn btn-danger btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-remove"></span></a> </td>
                                            
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
