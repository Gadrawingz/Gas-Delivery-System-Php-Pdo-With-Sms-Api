<?php
mysql_select_db('vis',  mysql_connect('localhost','root',''))or die(mysql_error());
$get_id=$_GET['Id'];
mysql_query("delete from messagein where Id='$get_id'")or die(mysql_error());
header('location:sms_request.php');
?>
