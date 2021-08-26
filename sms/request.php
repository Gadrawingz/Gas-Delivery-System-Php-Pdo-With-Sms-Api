<?php
session_start();
//$ID=$_GET['id'];
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style>

</style>
<title>GDS App !</title>
<link rel="shortcut icon" href="icon/GAS10.jpg">
 <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="jquery.date_input.js"></script>


<script type="text/javascript">$(function() {
  $("#datefield").date_input();
   $("#due").date_input();
});</script>

<script type='text/javascript' src='jquery.autocomplete.js'></script>

<script type='text/javascript' src='localdata.js'></script>

<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
  
<script type="text/javascript">
$().ready(function() {

  function log(event, data, formatted) {
    $("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
  }
  
  function formatItem(row) {
    return row[0] + " (<strong>id: " + row[1] + "</strong>)";
  }
  function formatResult(row) {
    return row[0].replace(/(<.+?>)/gi, '');
  }
  
  
  $("#customer").autocomplete("customer.php", {
    width: 160,
    autoFill: true,
    selectFirst: false
  });
  
});




    $(document).ready(function() {
      // SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
       $("#billnumber").focus();
      
       $("#customer").blur(function()
      {
      
         $.post('check_customer_details.php', {stock_name1: $(this).val() },
        function(data){
        
                $("#customer_name").val(data.customer_name);
                $("#idnum").val(data.idnum);
                $("#tel").val(data.tel);
                $("#province").val(data.province);
                $("#district").val(data.district);
                $("#sector").val(data.sector);
                $("#vim").val(data.vim);
                $("#category").val(data.category);
                $("#model").val(data.model);
                $("#mnumber").val(data.mnumber);
                $("#fnumber").val(data.fnumber);
                $("#myear").val(data.myear);
                $("#byear").val(data.byear);
                $("#revenue").val(data.revenue);
                $("#insurance").val(data.insurance);
                $("#msg").val(data.msg);
                if(data.address!=undefined)
                $("#0").focus();

              }, 'json');
      
      });
      
    });
  </script> 
</head>

<body>

<?php
include_once "db.php"; 
$ID=$_GET['id'];
$result = $conn->prepare("SELECT * FROM  customer_details WHERE id='$ID'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['id'];
?>
        
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <center><div class="card-header">Provide Full Details Information of Stolen Gas</div></center>
      <div class="card-body">
        <form method="POST" action="update.php"enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
            </div>
          </div>
		   <div class="form-group">
            <input name="id" class="form-control"  type="hidden" id="customer" value="<?php echo $row ['id']; ?>"/>
            </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Gas Owner Full Names</label>
            <input name="customer_name" class="form-control"  type="text" name="names" id="customer_name" required value="<?php echo $row ['customer_name']; ?>" />
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">ID Photo</label>
            <?php echo "<img src='attachments/".$row['id_num']."'width=100% height=auto style='border: 3px solid blue; border-radius: 4px;'>";?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Update Your National ID Copy</label>
            <input class="form-control"  type="file" name="id_num"/>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1"><font color="red"><b>Current Tel.Number</label>
            <input name="tel" class="form-control"  type="text" name="tel" id="tel" required value="<?php echo $row ['tel']; ?>" /></b></font>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Province</label>
            <input name="province" class="form-control"  type="text" name="province" id="province" required value="<?php echo $row ['province']; ?>" />
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">District</label>
            <input name="district" class="form-control"  type="text" name="district" id="district" required value="<?php echo $row ['district']; ?>" />
          </div>


         <div class="text-center"><button type="submit" name="name" class="btn btn-primary btn-lg" required="required"><span class="fa fa-send"></span> Update Record</button></div>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Cancel</a>
        </div>

<?php } ?>   