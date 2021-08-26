<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
  $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
  $id = base64_decode($_GET['id']);
  $code = $_GET['code'];
  
  $stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
  $stmt->execute(array(":uid"=>$id,":token"=>$code));
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if($stmt->rowCount() == 1)
  {
    if(isset($_POST['btn-reset-pass']))
    {
      $pass = $_POST['pass'];
      $cpass = $_POST['confirm-pass'];
      
      if($cpass!==$pass)
      {
        $msg = "<div class='alert alert-block'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>Sorry!</strong>  Password Doesn't match. 
            </div>";
      }
      else
      {
        $password = md5($cpass);
        $stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
        $stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
        
        $msg = "<div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            Password Changed.
            </div>";
        header("refresh:5;index.php");
      }
    } 
  }
  else
  {
    $msg = "<div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        No Account Found, Try again
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
  <title>VIS App</title>
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
      <center><div class="card-header">Reset Your Lost Password</div></center>
      <div class="card-body">
       <div class='alert alert-success'>
      <strong>Hello !</strong>  <?php echo $rows['userName'] ?> you are here to reset your forgetton password.
    </div>
        <form>
            <?php
        if(isset($msg))
    {
      echo $msg;
    }
    ?>
          <div class="form-group">
            <input class="form-control" id="exampleInputEmail1" type="password" aria-describedby="emailHelp" placeholder="Enter New Password" name="pass" required />
          </div>
          <div class="form-group">
            <input class="form-control" id="exampleInputEmail1" type="password" aria-describedby="emailHelp" placeholder="Confirm New Password" name="confirm-pass" required />
          </div>
        <button class="btn btn-primary btn-block" type="submit" name="btn-reset-pass">Reset Your Password</button>
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
