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
$student_id = '';

$father_ic = isset($_POST['parents_ic']) ? $_POST['parents_ic'] : '';

$sqlEdit = $conn->query("SELECT * FROM parents WHERE father_ic='".$father_ic."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);

}else
{
    echo "<script type='text/javascript'>alert('Tiada dalam Rekod, Sila Isi Maklumat Ibubapa/Penjaga Pelajar');</script>";
}

    // Generate the form based on the selected value
        
        echo '<div><fieldset class="scheduler-border" >
                                     <legend  class="scheduler-border">Maklumat Ibubapa/Penjaga :</legend>


                              <div class="row">
                                <div class="col-sm-11">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label class="col-sm-10">Nama Penuh Bapa/Penjaga</label>
                                    <div class="col-sm-10">
                                    <input type="text" id="father_name" name="father_name" value="';echo $father_name;
                                    echo '" class="form-control" placeholder="Masukan Nama Penuh Bapa/Penjaga">
                                    </div>
                                  </div>
                                </div>
                              </div>';
                        $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
                        echo '<input type="hidden" id="student_id" name="student_id" value="'.$student_id.'" >
                               <div class="row">
                                <div class="col-sm-5">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label class="col-sm-10">No IC/Passport</label>
                                    <div class="col-sm-10">
                                    <input type="text" id="father_ic" name="father_ic" value="'; echo 
                                     $father_ic;
                                     echo ' " 
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
                                <input type="text" id="father_phone_no" name="father_phone_no" value="';echo 
                                 $father_phone_no;
                                 echo '" 
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
                                <input type="text" id="mother_name" name="mother_name" value="';
                                 echo 
                                 $mother_name; echo '" 
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
                                    <input type="text" id="mother_ic" name="mother_ic"  value="'; echo 
                                    $mother_ic;
                                    echo '" 
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
                                    <input type="text" id="mother_phone_no" name="mother_phone_no"   value="'; echo 
                                         $mother_phone_no;
                                     echo '" 
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
                                    <input type="text" id= "email" name="email"   value="'; echo 
                                     $email;
                                     echo '" 
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
                                    rows="5" placeholder="Masukan Alamat Semasa">';
                                    echo htmlspecialchars($current_address); echo '</textarea>
                                  </div>
                                </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                    <label class="col-sm-5">Poskod</label>
                                    <div class="col-sm-10">
                                    <input type="text" id= "postcode" name="postcode"    value="';
                                    echo 
                                     $postcode; echo '" 
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
                                    <input type="text" id= "city" name="city"    value="';
                                    echo $city;
                                    echo '" 
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
                                  <input type="password" id= "password" name="password"   value="'; echo 
                                     $password; echo '" 
                                  class="form-control" id="exampleInputPassword1" placeholder="Password">
                                  </div>
                                </div>
                              </div>
                              </div>    
                                    
                        </fieldset>

                                                  <button type="submit" name="next_to_student" class="btn btn-success" style="border-radius:0%">Simpan Maklumat Ibubapa/Penjaga </button>';
                                                  echo '</div>';
                  

}
else
{
 echo "No record";
}
?>
