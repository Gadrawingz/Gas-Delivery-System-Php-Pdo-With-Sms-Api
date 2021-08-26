<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
  $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM messagein WHERE userID=:uid");
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
  <link rel="shortcut icon" href="icon/cars-icon.png">
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
   <?php 
   include 'dbcon.php';
   $sql = $conn ->prepare("SELECT COUNT(seen_status) as m FROM  requests WHERE seen_status=0");
                                          $sql -> execute();
                                          $count = $sql->fetchAll(); 
                                          foreach ($count as $field);
                                          ?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">GAS DELIVERY SYSTEM</a>
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
          <a class="nav-link" href="sms_request.php">
            <i class="fa fa-fw fa-mobile"></i>
                                           
            <span class="nav-link-text"> Views SMS Request  <span class="badge" style="background-color: darkred;"><?php echo $field['m'];?></span>
          </a>
        </li>
		
        <!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Check in RRA">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">Check in RRA</span>
          </a>
        </li>-->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Send Response">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-send"></i>
            <span class="nav-link-text">View Responded SMS</span>
          </a>
        <!--</li>
		 <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Send Response">
          <a class="nav-link" href="search.php">
            <i class="fa fa-fw fa-search"></i>
            <span class="nav-link-text">Vehicle Search</span>
          </a>
        </li>-->
        
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
        <li class="breadcrumb-item active">SMS Requests</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bell-o" style="color: red"></i> GAS DELIVERY Requests</div>
        <div class="card-body">
          <div class="table-responsive">
		  <!--search of vehicle in rra --!>
		  <form method="POST" action="found.php">
                                            <div class="form-group">
                                     </div></div>
                           <div class="form-group">
                                            <input name="plaque"type="text" class="form-control" id="inputPage" placeholder="Enter Plate Number" required>
                                        </div>
                        <div class="form-group">
                          <div class="col-md-offset-2 col-md-10">
                            <button class="btn btn-info" type="submit" name="submit"><i class="fa fa-fw fa-search"></i> <i>Request Here</i> </button>
							
                          </div>
                        </div>
                      </form>
		  
		  
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
				<th><i class="fa fa-time"> </i> TIME & DATE</th>
				 <th><i class="fa fa-mobile"> </i> MESSAGE FROM</th>
				 <th><i class="fa fa-send"> </i> MESSAGE TO</th>
                  <th><i class="fa fa-envelope"></i> MESSAGE</th>
				  <th><i class="fa fa-gear"> </i> Action</th>
                </tr>
              </thead>
			  </div>
            <?php
			include 'dbcon.php';
                                $result = $conn->prepare("SELECT * FROM messagein ORDER BY Id DESC");
                                $result->execute(array("Not Responded"));
                                for($i=0; $row = $result->fetch(); $i++){
                                $id=$row['Id'];
                            ?>  <tbody>
                
               <thead>
                <tr>
				<td> </i><?php echo $row ['SendTime']; ?></td>
				<td> </i> <?php echo $row ['MessageFrom']; ?></td>
				 <td> </i> <?php echo $row ['MessageTo']; ?></td>
                 <td> </i> <?php echo $row ['MessageText']; ?></td>
				                     <td>
                       <div class="btn-group">
<a href="#orderdel<?php echo $id; ?>" role="button"  data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"></i><i class="fa fa-check"></i></a>
                       </div>
                  </td>
                </tr>
				<!-- product delete modal -->
                <div id="orderdel<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-header">
                   </div>
                <div class="modal-body">
                    <div class="alert alert-danger">Are you Sure you Want to <strong>Remove &nbsp;</strong>this item?</div>
                    </div>
                 <div class="modal-footer">
                     <a class="btn btn-danger" href="delete_message.php<?php echo '?Id=' . $id; ?>" ><i class="fa fa-check fa-large"></i>&nbsp;Yes</a>
                     <a class="btn btn-primary" href="sms_request.php"><i class="fa fa-remove fa-large"></i>&nbsp;No</a>
					</div>
                  </div>
                <!-- end delete modal -->
				
              </thead>
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
        <div class="text-center">
          <small>Copyright © <?php echo date('Y'); ?> GAS DELIVERY SYSTEM</small>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
	
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery-2.1.1.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/functions.js"></script>
  </div>
</body>

</html>
