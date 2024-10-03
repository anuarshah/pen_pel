<?php
    include("php/dbconnect.php");

    $error = '';
    if(isset($_POST['login']))
    {

    $username =  mysqli_real_escape_string($conn,trim($_POST['username']));
    $password =  mysqli_real_escape_string($conn,$_POST['password']);

    if($username=='' || $password=='')
    {
    $error='All fields are required';
    }

    $sql = "select * from user where username='".$username."' and password = '".md5($password)."'";

    $q = $conn->query($sql);
    if($q->num_rows==1)
    {
    $res = $q->fetch_assoc();
    $_SESSION['rainbow_username']=$res['username'];
    $_SESSION['rainbow_uid']=$res['id'];
    $_SESSION['rainbow_name']=$res['name'];
    echo '<script type="text/javascript">window.location="index.php"; </script>';

    }else
    {
    $error = 'Invalid Username or Password';
    }

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
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>
body, html {
  height: 100%;
}

* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url("photographer.jpg");

  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 2px solid #f1f1f1;
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 90%;
  padding: 5px;
  text-align: left;
}body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("sekolah.jpeg");

    /* Add the blur effect */
  filter: blur(2px);
  -webkit-filter: blur(2px);

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
    @font-face {
  font-family: Poppins;
  src: url("fonts/Poppins-Regular.ttf");
}

html * {
  font-family: "Poppins", sans-serif;
}
.myhead{
margin-top:0px;
margin-bottom:0px;
text-align:center;
}

</style>

</head>
<body >
<div class="bg">

</div>

<div class="bg-text">
    <div class="container">
        
         <div class="row ">
<div class="col-md-4">
                    <br/>
                    <div class="panel panel-success">
                                  <div class="panel-heading">ePengurusan Pelajar SRA</div>
                                  <div class="panel-body">                                <form role="form" action="login.php" method="post">
                                        
                                        <?php
                                        if($error!='')
                                        {                                   
                                        echo '<h5 class="text-danger text-center">'.$error.'</h5>';
                                        }
                                        ?>
                                        
                                       
                                         <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                                <input type="text" class="form-control" placeholder="Username " name="username" required />
                                            </div>
                                            
                                        <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                                <input type="password" class="form-control"  placeholder="Password" name="password" required />
                                            </div>
                                            
                                       
                                         
                                         <button class="btn btn-success active" style="border-radius:5%" type= "submit" name="login">Login</button>
                                       
                                        </form></div>
                                </div> 
                    
            </div>
                            <div class="col-md-8">
                    <br/>
                            <div class="panel panel-success">
                                  <div class="panel-heading">Maklumat Terkini</div>
                                  <div class="panel-body">  
                                  <br/>      
                                  <br/> 
                                  <br/> 
                                  <br/> 
                                  <br/> 
                                  <br/> 

                                  </div>
                                </div>    
            </div>
            </div>

        </div>
    </div>
</div>




</body>
</html>
