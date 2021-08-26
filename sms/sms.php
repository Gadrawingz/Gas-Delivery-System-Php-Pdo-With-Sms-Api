<?php
include'dbcon.php';
if(isset($_POST['send'])){
         $names=$_POST['names'];
         $phone=$_POST['phone'];
         $message=$_POST['Ikibazo Cyanyu Cyakiriwe Kigiye Gukurikiranwa Muzajya Mumenyeshwa Aho Kigeze Hakoreshejwe Ubutumwa Bugufi Kuri Telefoni Ngendanwa'];
          $sql = $conn->prepare("SELECT phone,names FROM requestees WHERE names='$names'");
          $sql->execute();
          $rem=$sql->fetchAll();
          foreach ($rem as $row);
            $phone=$row['phone'];
            $names=$row['names'];
              $data = array(    
              "sender"=>"KIGALIGAS",
              "names"=>$phone,
              "phone"=>"Muraho Neza, ".$names.", ".$message,    
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
            
            echo"<script>alert('The Notification Has Been Sent');window.location='sms.php'</script>";
           
          }

?>