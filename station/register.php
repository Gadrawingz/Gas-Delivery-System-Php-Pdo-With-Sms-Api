<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
  $reg_user->redirect('dashboard.php');
}


if(isset($_POST['btn-signup']))
{
  $uname = trim($_POST['txtuname']);
  $email = trim($_POST['txtemail']);
  $upass = trim($_POST['txtpass']);
  $code = md5(uniqid(rand()));
  
  $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
  $stmt->execute(array(":email_id"=>$email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() > 0)
  {
    $msg = "
          <div class='alert alert-error'>
        <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry !</strong>  email allready exists , Please Try another one
        </div>
        ";
  }
  else
  {
    if($reg_user->register($uname,$email,$upass,$code))
    {     
      $id = $reg_user->lasdID();    
      $key = base64_encode($id);
      $id = $key;
      
      $message = "          
            Hello $uname,
            <br /><br />
            Welcome To Vehicle Investigation System<br/>
            To complete your registration  please , just click following link<br/>
            <br /><br />
            <a href='http://localhost/vis/police/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
            <br /><br />
            Thanks,";
            
      $subject = "Confirm Registration";
            
      $reg_user->send_mail($email,$message,$subject); 
      $msg = "
          <div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
            </div>
          ";
    }
    else
    {
      echo "sorry , Query could no execute...";
    }   
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>GDS App</title>
  <link rel="shortcut icon" href="icon/cars-icon.png">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center><div class="card-header">Register an Account</div></center>
      <div class="card-body">
        <?php if(isset($msg)) echo $msg;  ?>
        <form method="POST">
         <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter User Name" name="txtuname"  required />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="txtemail" required />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input class="form-control" id="exampleInputEmail1" type="password" aria-describedby="emailHelp" placeholder="Enter Password" name="txtpass" required />
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="btn-signup">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.html">Login Page</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
