<?php
include_once "db.php";
$ID = $_POST['id'];
$names= $_POST['customer_name'];
$idm= $_FILES["id_num"]["name"];
$phone= $_POST['tel'];
$province= $_POST['province'];
$district= $_POST['district'];

if($idm)
{
$name=$_FILES['id_num']['name'];
$tmp=$_FILES['id_num']['tmp_name'];
$err=$_FILES['id_num']['error'];
$uploadDir="attachments";
if($err==0)
{
move_uploaded_file($tmp, "attachments/$name");
}
//$qry=mysql_query("UPDATE customer_details SET id_num='$idm' WHERE id='$ID'", $con);
$updt = $conn->query("UPDATE customer_details SET customer_name='$names', id_num='$idm', tel='$phone', province='$province'  district='$district' WHERE id='$ID'");
if(!$updt)
{
echo "<script>alert('IMPOSSIBLE TO UPDATE NATIONAL IDENTITY PHOTO');</script>";
}
}

?>

<?php
include_once "db.php";
$qry = $conn->query("UPDATE customer_details SET plaque='$plate',customer_name='$names',tel='$phone',province='$province',district='$district',sector='$sector',vim='$vim',category='$vcategory',model='$vmodel',mnumber='$mnumber',fnumber='$fnumber',myear='$myear',byear='$byear' WHERE id='$ID'")or die("IMPOSSIBLE TO UPDATE DATA".mysql_error());

if($qry) {
echo '<script type= "text/javascript">alert("Gas Record has been Successfully Upadated");window.location=\'requests.php\'</script>';
}
else{
echo "<script type= 'text/javascript'>alert('Gas Record FAILED to be Updated.');window.location=\'request.php\'</script>";
}
?>
