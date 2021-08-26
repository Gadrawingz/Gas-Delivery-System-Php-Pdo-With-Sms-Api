<?php
session_start();
require_once('library.php');
$rand = get_rand_id(8);

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
<script language="javascript">
function check()
{
  if(document.form1.plate.value=="")
  {
    alert("Please Enter customer number");
	document.form1.plate.focus();
	return false;
  }
  if(document.form1.customer_name.value=="")
  {
    alert("Please Enter Customer name");
	document.form1.customer_name.focus();
	return false;
  }
   if(document.form1.customer_name.value.length <=3)
  {
    alert("User Names must be greater than Three characters");
	document.form1.customer_name.focus();
	return false;
  } 
   if(!isNaN(document.form1.customer_name.value))
  {
    alert("Only character Allowed");
	document.form1.customer_name.focus();
	return false;
  }
 if(document.form1.id_num.value=="")
  {
    alert("Please PUT your ID photo");
	document.form1.id_num.focus();
	return false;
  }
 
  if(document.form1.phone.value=="")
  {
    alert("Please select your Telephone No");
	document.form1.phone.focus();
	return false;
  }
   if(isNaN(document.form1.phone.value))
  {
    alert("User must type numbers Not characters, character Not Allowed");
	document.form1.phone.focus();
	return false;
  }
  if(document.form1.phone.value.length!=10)
  {
    alert("User Telephone number must be equal to 10 numbers");
	document.form1.phone.focus();
	return false;
  }
  if(document.form1.province.value=="Choose Your Province")
  {
    alert("Please select your Province");
	document.form1.province.focus();
	return false;
  }
  if(document.form1.district.value=="Choose Your District")
  {
    alert("Please select your District");
	document.form1.district.focus();
	return false;
  }

  if(document.form1.sector.value=="")
  {
    alert("Please Enter your Sector");
	document.form1.sector.focus();
	return false;
  }
   if(!isNaN(document.form1.sector.value))
  {
    alert("Only character Allowed");
	document.form1.sector.focus();
	return false;
  }
   if(document.form1.vim.value=="")
  {
    alert("Enter Gas Price");
	document.form1.vim.focus();
	return false;
  }
  if(isNaN(document.form1.vim.value))
  {
    alert("Only Number Allowed");
	document.form1.vim.focus();
	return false;
  }
   if(document.form1.vmodel.value=="")
  {
    alert("Enter Gas Quantity");
	document.form1.vmodel.focus();
	return false;
  }
  if(document.form1.mnumber.value=="")
  {
    alert("Please Enter Agent name");
	document.form1.mnumber.focus();
	return false;
  }
   if(document.form1.mnumber.value.length <=3)
  {
    alert("agent Names must be greater than three characters");
	document.form1.mnumber.focus();
	return false;
  } 
   if(!isNaN(document.form1.mnumber.value))
  {
    alert("Only character Allowed");
	document.form1.mnumber.focus();
	return false;
  }
  
  if(document.form1.fnumber.value=="")
  {
    alert("Enter agent Phone");
	document.form1.fnumber.focus();
	return false;
  }
  if(isNaN(document.form1.fnumber.value))
  {
    alert("Only Number Allowed");
	document.form1.fnumber.focus();
	return false;
  }
   if(document.form1.myear.value > document.form1.byear.value)
  {
    alert("IMPOSSIBLE TO INSRET UNCOMPACTIBLE DATE!!!");
	document.form1.myear.focus();
	return false;
  }
  if(document.form1.myear.value=="Select Your GAs Manufactured Year")
  {
    alert("Please Select Your Gas Manufactured Year");
	document.form1.myear.focus();
	return false;
  }
  if(document.form1.byear.value=="Select Your Gas Bought Year")
  {
    alert("Please Select Your Gas Bought Year");
	document.form1.byear.focus();
	return false;
  }
  
  
}
</script>

<script type="text/javascript">
	function showHide(){
		var seone = document.getElementById("my");
		var setwo = document.getElementById("by");
		var hiddeninputs = document.getElementById("hidden");
		
		if(seone.value > setwo.value){
			//hiddeninputs.style.display="none";
			//alert("IMPOSSIBLE THING TRY AGAIN");
			//document.form1.seone.focus();
			//return false;
		}else{
			hiddeninputs.style.display="block";
		}
	}
</script>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
   <title>GT App</title>
  <link rel="shortcut icon" href="icon/GAS10.jpg">
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
<script type="text/javascript">
     function configureDropDownLists(ddl1,ddl2) {
    var kigali = ['Gasabo', 'Kicukiro', 'Nyarugenge'];
    var north = ['Burera', 'Gakenke', 'Gicumbi','Musanze','Rulindo'];
    var south = ['Gisagara', 'Huye', 'Kamonyi','Muhanga','Nyamagabe','Nyanza','Nyaruguru','Ruhango'];
    var east = ['Bugesera','Gatsibo','Kayonza','Kirehe','Ngoma','Nyagatare','Rwamagana'];
    var west = ['Karongi','Ngororero','Nyabihu','Nyamasheke','Rubavu','Rusizi','Rutsiro'];

    switch (ddl1.value) {
        case 'kigali':
            ddl2.options.length = 0;
            for (i = 0; i < kigali.length; i++) {
                createOption(ddl2, kigali[i], kigali[i]);
            }
            break;
        case 'north':
            ddl2.options.length = 0; 
        for (i = 0; i < north.length; i++) {
            createOption(ddl2, north[i], north[i],north[i],north[i]);
            }
            break;
        case 'south':
            ddl2.options.length = 0;
            for (i = 0; i < south.length; i++) {
                createOption(ddl2, south[i], south[i],south['i'],south['i'],south['i'],south['i']);
            }
            break;
        case 'east':
            ddl2.options.length = 0;
            for (i = 0; i < east.length; i++) {
                createOption(ddl2, east[i], east[i],east['i'],east['i'],east['i'],east['i']);
            }
            break;
         case 'west':
            ddl2.options.length = 0;
            for (i = 0; i < west.length; i++) {
                createOption(ddl2, west[i], west[i],west['i'],west['i'],west['i'],west['i']);
            }
            break;
            default:
                ddl2.options.length = 0;
            break;
    }

}

    function createOption(ddl, text, value) {
        var opt = document.createElement('option');
        opt.value = value;
        opt.text = text;
        ddl.options.add(opt);
    }
</script>
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
    <a class="navbar-brand" href="dashboard.php">Gas Agent</a>
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
          <a class="nav-link" href="requests.php">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Gas submitted</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="newgas.php">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">Register new customer</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          
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
          <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">New Gas</li>
      </ol>
      <div class="row">
        <div class="col-12">
         <div class="content-row">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-options">
                        <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
                        <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                        <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
                      </div>
                    </div>

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
//move_uploaded_file($_FILES["rratc"]["tmp_name"],"attachments/" . $_FILES["rratc"]["name"]); 
//move_uploaded_file($_FILES["insc"]["tmp_name"],"attachments/" . $_FILES["insc"]["name"]);       

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
            <a class="btn btn-primary" href="login.php">Logout</a>
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
  </div>
</body>
</html>