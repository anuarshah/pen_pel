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

$parents_idSelect = isset($_POST['parents_id']) ? $_POST['parents_id'] : '';

$father_ic = $parents_idSelect;

$sqlEdit = $conn->query("SELECT * FROM parents WHERE parent_id='".$parents_idSelect."'");
if($sqlEdit->num_rows)
{
  $rowsEdit = $sqlEdit->fetch_assoc();
  extract($rowsEdit);

}else
{

    echo "<script type='text/javascript'>alert('Tiada dalam Rekod, Sila Isi Maklumat Ibubapa/Penjaga Pelajar');</script>";
}

    // Generate the form based on the selected value

        echo '<div> <br/>  
                   <form id="formParent"><fieldset class="scheduler-border" >                 
                   <input type="hidden" name="parent_id" id="parent_id" value="'.$parent_id.'">    
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
                              </div>
                        
                               <div class="row">
                                <div class="col-sm-5">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label class="col-sm-10">No IC/Passport</label>
                                    <div class="col-sm-10">
                              <input type="text" id="father_ic" name="father_ic" value="'.$father_ic.'" 
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
                            <div class="col-sm-11">
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
                                      <option value="" >Select Negeri</option>';

                                                        $sql = "select * from state  order by state_id asc";
                  $q = $conn->query($sql);
                  
                  while($r = $q->fetch_assoc())
                  {
                  echo '<option value="'.$r['state_id'].'"  '.(($negeri==$r['state_id'])?'selected="selected"':'').'>'.$r['state_desc'].'</option>';
                  }
                            
                  
                  echo '
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
                              </fieldset> </form>
                            
       
                                                  <button onclick="update_info_parent()" id="next_to_student" name="next_to_student" class="btn btn-success" style="border-radius:0%">Kemaskini Maklumat Ibubapa/Penjaga </button>
            

                                                  </div>';
                  

}
else
{
 echo "No record";
}
?>
