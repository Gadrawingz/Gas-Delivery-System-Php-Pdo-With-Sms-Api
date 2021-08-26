<?php
include'dbcon.php';
if(isset($_POST['send'])){
$rid=$_POST['id'];
$recipient=$_POST['recipient'];
$message=$_POST['msg'];

//Query for updating requests data
$query = "UPDATE requests SET status='Yes',seen_status=4 WHERE id='$rid'";
if ($conn->query($query )) {
$sql = $conn->prepare("SELECT tel,customer_name FROM requests WHERE customer_name='$recipient'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
            $telephone=$row['tel'];
            $fname=$row['customer_name'];
              $data = array(    
              "sender"=>"+250786230962",
              "recipients"=>$telephone,
              "message"=>"Muraho Neza, Kuri ".$fname.", ".$message,    
            );

            $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
            
            $data = http_build_query ($data);

            $username="benii"; 
            $password="Ben@1234";
            
            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);

            //execute post
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            //close connection
            curl_close($ch);
            
			echo"<script>alert('The Notification Has Been Sent');window.location='dashboard.php'</script>";
	}else{
		echo"<script>alert('The Notification Not Sent');window.location='dashboard.php'</script>";
	}           
}
?>