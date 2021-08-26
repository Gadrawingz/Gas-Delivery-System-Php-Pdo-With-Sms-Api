<?php
session_start();
require_once 'class.user.php';

include 'dbcon.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
  $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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
  <link rel="shortcut icon" href="icon/GAS10.jpg">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="#">Gas Delivery System / AGENT GAS STORE</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="dashboard.php?regcust">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">Register new customer</span>
          </a>
        </li>

<!--         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="dashboard.php?viewcust">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">View customers</span>
          </a>
        </li> -->

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="dashboard.php?gassubmit">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Submit Gas Bottle</span>
          </a>
        </li>
        
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <p style="color:white;margin-top: 3px;">Welcome <?php echo $row['userName']; ?></P>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">











<?php if(isset($_GET['hello'])) { ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a> /&nbsp;Overview
        </li>     
      </ol>
	  
	<?php 
   $sql = $conn ->prepare("SELECT COUNT(id) as mv FROM  customer_details");
   $sql -> execute();
   $count = $sql->fetchAll(); 
   foreach ($count as $field);
   ?>

      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car"></i>
              </div>
              <div class="mr-5"><h1><?php echo "0";?></h1></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Total Gas Not Pay Money</span>
              <span class="float-right">
                <i class="fa fa-car"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car"></i>
              </div>
               <div class="mr-5"><h1><?php echo "0";?></h1></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Total Gas in Store Pending</span>
              <span class="float-right">
                <i class="fa fa-car"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car"></i>
              </div>
              <div class="mr-5"><h1><?php echo $field['mv'];?></h1></div>              
            </div>
            <a class="card-footer text-white clearfix small z-1" href="requests.php">
              <span class="float-left"><h6>Total Paid gas</h6></span>
              <span class="float-right">
                <i class="fa fa-car"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-car"></i>
              </div>
              <div class="mr-5"><h1><?php echo $field['mv'];?></h1></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="requests.php">
              <span class="float-left"><h6>Total Gas Registered</h6></span>
              <span class="float-right">
                <i class="fa fa-car"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
    <?php } ?>









<?php if(isset($_GET['regcust'])) { ?>
<div class="container">
  <div class="card card-register mx-auto mt-5">
      <center><div class="card-header"><font color="green" size="4"><b>Customer registration</b></font></div></center>
      <div class="card-body">
    
<?php
include_once "db.php"; 
$msg =""; 
if(isset($_POST['submit']))
{
$msg ="";     
move_uploaded_file($_FILES["id_num"]["tmp_name"],"attachments/" . $_FILES["id_num"]["name"]);

$dates = date('Y-m-d h:i:s');

$names=$_POST['customer_name'];
$id=$_FILES["id_num"]["name"];
$phone = "+25".$_POST['phone'];
$province=$_POST['province'];
$district=$_POST['district'];


if ( $names == "" || $phone == "")
    //$msg = "Please check your inputs!";
    $msg = "
        <div class='alert alert-danger'>
        <button class='close' data-dismiss='alert'>&times;</button>
        Please check your inputs!
        </div>
            ";

    else {
      $sql = "SELECT id FROM customer_details WHERE customer_name='$names'";
                $query = $conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll( PDO::FETCH_ASSOC );
        if($results){
        $msg = "
        <div class='alert alert-danger'>
        <button class='close' data-dismiss='alert'>&times;</button>
        This Customer number already exists in the database!!!!
        </div>
            ";
      } else {

      if($conn->query("INSERT INTO `customer_details`(`id`, `customer_name`, `id_num`, `tel`, `province`, `district`) VALUES(NULL,'$names','$id','$phone','$province','$district')"))
        $msg = "
        <div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        New customer registered Successfully!!!
        </div>
            ";

      else
      echo "<br><font color=red size=+1 ><center>Problem in Submitting Gas!</font>" ;
      
      }}
      }
        
      ?>

  <?php
   if(isset($_GET['error']))
    {
    ?>
                <div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong> 
                  </div>
                <?php
      }
      ?>
    <?php if ($msg != "") echo $msg . "" ?>
        <form action="newgas.php" method="POST" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return check();" class="leave-comment">
          <div class="form-group">
            <div class="form-row">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Gas Owner Full Names</label>
            <input class="form-control"  type="text" name="customer_name" />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Attach You National ID Copy</label>
            <input class="form-control"  type="file" name="id_num"/>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input class="form-control"  type="text" name="phone" />
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1"> Province </label>
              <div class="form-group">
                <select class="form-control" name="province" id="ddl" onChange="configureDropDownLists(this,document.getElementById('ddl2'))" />
                <option selected="selected" disabled="disabled">Choose Your Province</option>
                <option value="kigali">Kigali City</option>
                <option value="north">Northern</option>
                <option value="south">Southern</option>
                <option value="east">Eastern</option>
                <option value="west">Western</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">District </label>
                <div class="form-group">
                  <select class="form-control" name="district" id="ddl2"/>
                    <option  value="" selected="selected" disabled="disabled">Choose Your District</option> 
                  </select>
                </div>
              </div>
            </div>

            <div class="text-center"><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required"><span class="fa fa-send"></span> Register</button></div><br>
        </form>
                    </div>
                  </div>

                </div>
        </div>
      </div>
    </div>
  <?php } ?>











<?php if(isset($_GET['gassubmit'])) { ?>

    <!-- Example DataTables Card-->
      <div class="card mb-6">
        <div class="card-header">
          <h3><i class="fa fa-table"></i>&nbsp;Gas Submission</h3></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Customer</th>
                  <th>Tel.No</th>
                  <th>Province</th>
                  <th>District</th>
                  <th colspan="2"><center>Action</center></th>
                </tr>
              </thead>
              <?php
              $sql = "SELECT * FROM customer_details";
              $query = $conn->prepare($sql);
              $query->execute();
              while($result = $query->fetch( PDO::FETCH_ASSOC)) { ?>

              <tbody>
                <tr>
                  <td><?php echo $result['id'];?></td>
                  <td><?php echo $result['customer_name'];?></td>
                  <td><?php echo $result['tel'];?></td>
                  <td><?php echo strtoupper($result['province']);?></td>
                  <td><?php echo $result['district'];?></td>
                  <td><center><a href="dashboard.php?submitbtl=<?php echo $result['id'];?>" class="btn btn-primary">Submit Bottle</a></center></td>
                </tr>
              </tbody>
            <?php } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

















  <?php if(isset($_GET['submitbtl'])) {
    $g_id = $_GET['submitbtl'];

    $sql = "SELECT * FROM customer_details WHERE id='$g_id'";
      $query= $conn->prepare($sql);
      $query->execute();
      $result= $query->fetch(PDO::FETCH_ASSOC);

      if(isset($_POST['submitreq'])) {

      $gascom = $_POST['gascomment'];
      $qty = $_POST['gas_quantity'];
      $gasprice = $_POST['gas_price'];
      $doneby = $_SESSION['userID'];

        if($conn->query("INSERT INTO `gasrequests`(`req_id`, `gas_quantity`, `gas_price`, `comment`, `cust_id`, `doneby`, `req_date`) VALUES (null, '$qty', '$gasprice', '$g_id', '$doneby', NOW())")) {
        $msg = "
        <div class='alert alert-success'>
        <button class='close' data-dismiss='alert'>&times;</button>
        Registered Successfully!!!
        </div>
            ";
        }
      }

    ?>


  <div class="card card-register mx-auto mt-5">
      <center><div class="card-header"><font color="green" size="4"><b>&nbsp;Submit Gas of (<?php echo $result['customer_name'];?>)</b></font></div></center>
      <div class="card-body">

        <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1" onnubmit="return check();" class="leave-comment">

          <div class="form-group row">
            <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Gas to submit (in kgs)</label>
            <div class="col-sm-12">
              <input name="gas_quantity" type="text" class="form-control" id="inputPage" placeholde="Kgs..." required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Gas price in (Rwfs)</label>
            <div class="col-sm-12">
              <input name="gas_price" type="text" class="form-control" id="inputPage" placeholde="Frws..." required>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Add a comment</label>
            <div class="col-sm-12">
              <textarea name="gascomment" placeholder="Comment..." class="form-control" required></textarea>
            </div>
          </div>

          <div class="text-center"><button type="submit" name="submitreq" class="btn btn-primary btn-lg" required="required"><span class="fa fa-envelope"></span>&nbsp;Send</button></div><br>
          </form>
          </div>
          </div>
        </div>
        </div>

          </div>
        </div>
      </div>
    </div>
  <?php } ?>












      

      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          
          <!-- Card Columns Example Social Feed-->
         
           
           
            
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          
          <!-- Example Notifications Card-->
        
          </div>
        </div>
      </div>
      <!-- Example DataTables Card-->
      
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright &copy; <?php echo date('Y'); ?> Gas transportation System</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
