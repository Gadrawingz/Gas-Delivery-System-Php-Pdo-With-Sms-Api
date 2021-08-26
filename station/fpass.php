<?php
session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
  $user->redirect('dashboard.php');
}

if(isset($_POST['btn-submit']))
{
  $email = $_POST['txtemail'];
  
  $stmt = $user->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
  $stmt->execute(array(":email"=>$email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);  
  if($stmt->rowCount() == 1)
  {
    $id = base64_encode($row['userID']);
    $code = md5(uniqid(rand()));
    
    $stmt = $user->runQuery("UPDATE tbl_users SET tokenCode=:token WHERE userEmail=:email");
    $stmt->execute(array(":token"=>$code,"email"=>$email));
    
    $message= "
           Hello , $email
           <br /><br />
           We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
           <br /><br />
           Click Following Link To Reset Your Password 
           <br /><br />
           <a href='http://localhost/vis/police/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
           <br /><br />
           thank you :)
           ";
    $subject = "Password Reset";
    
    $user->send_mail($email,$message,$subject);
    
    $msg = "<div class='alert alert-success'>
          <button class='close' data-dismiss='alert'>&times;</button>
          We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
          </div>";
  }
  else
  {
    $msg = "<div class='alert alert-danger'>
          <button class='close' data-dismiss='alert'>&times;</button>
          <strong>Sorry!</strong>  this email not found. 
          </div>";
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
    <div class="card card-login mx-auto mt-5">
      <center><div class="card-header">Reset Password</div></center>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form method="post">
            <?php
      if(isset($msg))
      {
        echo $msg;
      }
      else
      {
        ?>
                <div class='alert alert-info'>
        Please enter your email address. You will receive a link to create a new password via email.!
        </div>  
                <?php
      }
      ?>

          <div class="form-group">
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="txtemail">
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="btn-submit">Reset Your Lost Password</button>
        </form>
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
