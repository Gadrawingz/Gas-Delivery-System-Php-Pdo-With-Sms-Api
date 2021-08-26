<?php
session_start();
require_once 'class.user.php';
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
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
   <?php 
   include 'dbcon.php';
   $sql = $conn ->prepare("SELECT COUNT(id) as m FROM  customer_details");
                                          $sql -> execute();
                                          $count = $sql->fetchAll(); 
                                          foreach ($count as $field);
                                          ?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="requests.php">GAS STORED</a>
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Requests">
          <a class="nav-link" href="requests.php">
            <i class="fa fa-fw fa-envelope"></i>
                                           
            <span class="nav-link-text">SUBMITTED GAS  <span class="badge" style="background-color: darkred;"><?php echo $field['m'];?></span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Check in STORE">
          <a class="nav-link" href="newgas.php">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">New Command></span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a href="#">Second Level Item</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
                <li>
                  <a href="#">Third Level Item</a>
                </li>
              </ul>
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Granted Gas</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bell-o" style="color: green"></i><b> <font color="green">LIST OF SUBMITTED GAS</font></b></div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><i class="fa fa-sort-numeric-asc"></i>Reg ID</th>
                  <th><i class="fa fa-gas"> </i>Gas Owner(Customer)</th>
                  <th><i class="fa fa-user"></i>I.D</th>
                  <th><i class="fa fa-map-marker"></i>Telephone No.</th>
                  <th><i class="fa fa-map-marker"></i>Address</th>
                  <th colspan="2"><center><i class="fa fa-gear"></i>Action</center></th>
                </tr>
              </thead>
			  <tbody>
            <?php
                $result = $conn->prepare("SELECT * FROM  customer_details ORDER BY id DESC");
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                $id=$row['id'];
            ?>     
                <tr>
                  <td><?php echo $row ['id']; ?></td>
                  <td><?php echo $row ['customer_name']; ?></td>
                  <td><img src="attachments/<?php echo $row ['id_num']; ?>" style="width: 80px; height: 80px;"/></td>
                  <td><?php echo $row ['tel']; ?></td>
                  <td><?php echo strtoupper($row['province']); ?>/<?php echo strtoupper($row['district']);?></td>
                  <td>
                    <div class="btn-group">
                      <a href="#addPage<?php echo $row ['id'];  ?>" data-toggle="modal" class="btn btn-warning"><i class="fa fa-check"></i></a>
                      <a class="btn btn-success" href="request.php<?php echo '?id='.$id; ?>"><i class="fa fa-edit"></i>&nbsp;Edit</a> 
                    </div>
                  </form>
                  </td>
                </tr>
				

<!-- ======================================================================= Modal =================================================================================-->
<!--================================================================================================================================================================-->
	 
	<div id="addPage<?php echo $row ['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		
		  <form>
		  <div class="modal-header">
		  			<h4 class="modal-title" id="myModalLabel">GAS Information</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		  </div>
		  <div class="modal-body">
		  	
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-12 col-form-label" style="color:#000000;"><?php echo "<img src='attachments/".$row ['id_num']."' width=100% height=auto>";?></label>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Names</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $row ['customer_name']; ?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Customer Number</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $row ['plaque']; ?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Customer Location</label>
			  <label for="inputPage" class="col-sm-8 col-form-label" style="color:#000000;"><?php echo $row ['province']; ?>/<?php echo $row ['district']; ?>/<?php echo $row ['sector']; ?></label>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Telephone</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $row ['tel']; ?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Code</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $row ['vim']; ?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
		
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Quantity</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $row ['model']; ?> "class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			

			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Agent number</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $row ['fnumber']; ?> "class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-6 col-form-label" style="color:#000000;">MANIFACTURE YEAR</label>
			  <div class="col-sm-6">
				<input name="plaque"type="text" value="<?php echo $row ['myear']; ?> "class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-6 col-form-label" style="color:#000000;">BOUGHT YEAR</label>
			  <div class="col-sm-6">
				<input name="plaque"type="text" value="<?php echo $row ['byear']; ?> "class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
		</div><!--The End-->
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<!--<input type="submit" class="btn btn-primary" value="Send Request " name="submit">-->
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<!-- addPage-->

                 <?php } ?>      
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">

<?php
    $dt = new DateTime();
    echo"<B>TO DAY IS</B>"." ". $dt->format('Y-m-d H:i:s');
?></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">  </footer>
          <small>Copyright &copy; <?php echo date('Y'); ?> Gas transportation System
		</small>
        </div>
      </div>
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
	
<?php
include('dbcon.php');
$result = $conn->prepare("SELECT * FROM customer_details where id='$id'");
$result->execute();
for($i=0; $rows = $result->fetch(); $i++){
//$id=$rows['id'];
$plaque=$rows['plaque'];
$names=$rows['customer_name'];
//$id=$rows["id_num"];
$phone =$rows['tel'];
$province=$rows['province'];
$district=$rows['district'];
$sector=$rows['sector'];
$vim=$rows['vim'];
$vcategory=$rows['category'];
$vmodel=$rows['model'];
$mnumber=$rows['mnumber'];
$fnumber=$rows['fnumber'];
$myear=$rows['myear'];
$byear=$rows['byear'];
//$rratc=$rows["revenue"]["name"];
//$insc=$rows["insurance"]["name"];

?>
	 <!-- Modal-->
	<div class="modal fade" id="addPage<?php echo '?id='.$id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		
			<form>
		  <div class="modal-header">
		  			<h4 class="modal-title" id="myModalLabel">Information From Gas store</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		  </div>
		  <div class="modal-body">
		  	
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-12 col-form-label" style="color:#000000;"><?php echo "<img src='../rra/attachments/".$rows['id_num']."'width=100% height=auto>";?></label>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Telephone</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $phone;?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Gas Owner</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $names;?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Client Location</label>
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;"><?php echo $province;?>/<?php echo $district;?>/<?php echo $sector;?></label>
			</div>
			
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Model</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $vmodel;?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">BROUGHT TIME</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $fnumber;?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Manifactured year</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $myear;?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			<div class="form-group row">
			  <label for="inputPage" class="col-sm-4 col-form-label" style="color:#000000;">Bought year</label>
			  <div class="col-sm-8">
				<input name="plaque"type="text" value="<?php echo $byear;?>"class="form-control" id="inputPage" readonly="true">
			  </div>
			</div>
			
		</div><!--The End-->
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<!--<input type="submit" class="btn btn-primary" value="Send Request " name="submit">-->
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<!-- addPage-->
<?php } //End of For ?>	

	<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
	
	
    <script src="js/sb-admin.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
