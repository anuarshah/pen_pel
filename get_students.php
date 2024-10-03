<?php
DEFINE("BASE_URL","http://localhost/SchoolFeesSystem/");

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PSWD', ''); 
DEFINE ('DB_HOST', 'localhost'); 
DEFINE ('DB_NAME', 'pengurusanpelajar'); 

date_default_timezone_set('Asia/Calcutta'); 
$conn =  new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
if($conn->connect_error)
die("Failed to connect database ".$conn->connect_error );

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected form value

$father_name = '';
$father_ic = '';
$father_phone_no = '';
$mother_name  = '';
$mother_ic = '';
$mother_phone_no = '';
$email = '';
$current_address = '';
$postcode = '';
$city = '';
$negeri ='';
$password = '';

$student_idSelect = isset($_POST['student_id']) ? $_POST['student_id'] : '';

$student_id = $student_idSelect;

$sqlEdit = $conn->query("SELECT * FROM student WHERE student_id='".$student_idSelect."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);

  $dobFormatted = !empty($dob) ? date("Y-m-d", strtotime($dob)) : '';

}else
{

    echo "<script type='text/javascript'>alert('Tiada dalam Rekod, Sila Isi Maklumat Ibubapa/Penjaga Pelajar');</script>";
}

    // Generate the form based on the selected value

        echo '<div>                     <fieldset id="fieldStudent" class="scheduler-border" >
             <legend  class="scheduler-border">Maklumat Pelajar :</legend>
  

                               <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">Sesi</label>
                        <div class="col-sm-10">
                        <input type="text" id="year_id" name="year_id" value="'; echo $year_id;

                        echo '" class="form-control" placeholder="Masukan No Mykid">
                      </div>
                      </div>
                    </div>
                   <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">Tarikh Daftar</label>
                        <div class="col-sm-10">
                        <input type="text" id="joindate" name="joindate" value="'; echo $joindate;
                        echo '" class="form-control">
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
                          <input type="text" id="sname" name="sname" value="'; echo $sname;
                          echo '" class="form-control" placeholder="Masukan Nama Penuh Pelajar">
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
                        <input type="text" id="no_mykid" name="no_mykid" value="'; echo $no_mykid;
                        echo '" class="form-control" placeholder="Masukan No Mykid">
                      </div>
                      </div>
                    </div>
                   <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label class="col-sm-10">No Surat Beranak</label>
                        <div class="col-sm-10">
                        <input type="text" id="no_cert_birth" name="no_cert_birth" value="'; echo $no_cert_birth; echo '" class="form-control" placeholder="Masukan No Surat Beranak">
                      </div>
                    </div>
                  </div>
              </div>              

                <div class="row">
                    <div class="col-sm-5">
                    <div class="form-group">
                    <label class="col-sm-10">Tarikh Lahir</label>
                    <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Tarikh Lahir" id="dob" name="dob" value="'.$dobFormatted.'" >
                    </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                    <label class="col-sm-5">Jantina</label>
                    <div class="col-sm-10">
                       
                        <select class="form-control" id="gender" name="gender">
                          

                       <option value="'.$gender.'"  '.'>'.$gender.'</option>';
                            
                        
                        echo '<option value="Lelaki">Lelaki</option>
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
                    <label class="col-sm-10">Darjah</label>
                    <div class="col-sm-10">
                  <select  class="form-control" id="grade" name="grade" >
                  <option value="" >Select Grade Level</option>';
                                
                  $sql = "select * from grade where delete_status='0' order by grade.grade asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['id'].'"  '.(($grade==$r['id'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
                  }
                            
                  
                  echo '</select>

                   </select>

                  </div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                    <label class="col-sm-10">Kelas</label>
                    <div class="col-sm-10">
                  <select  class="form-control" id="kelas" name="kelas" >
                  <option value="" >Pilih Kelas</option>';
                                 
                  $sql = "select * from kelas where delete_status='0' order by kelas.kelas asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['id'].'"  '.(($grade==$r['id'])?'selected="selected"':'').'>'.$r['kelas'].'</option>';
                  }
                                 
                  
                  echo '</select>
                    </div>
                      </div>
                    </div>
                  </div>

             </fieldset>

                                                  <!--button type="submit" name="next_to_student" class="btn btn-success" style="border-radius:0%">Kemaskini Maklumat Pelajar </button--></div>';
                  

}
else
{
 echo "No record";
}
?>
