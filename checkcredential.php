<?php
   $servername = "localhost";
   $username = "root";
   $password = "<pass>mysql</pass>@123";
   $mydb = "vulenrablesite";

   //creating connection
   $conn = new mysqli($servername, $username,$password,$mydb);
   if(isset($_POST['login'])){
   	     $UNAME = $_POST['uname'];
   	     $UPASS = $_POST['pass'];
   	      if(Invalidcredentials($UNAME,$UPASS) == 1){
   	           echo "Invalid username and password";
   	     }elseif(Invalidcredentials($UNAME,$UPASS) == 0){
               checkconnection();
   	           if(checkdata($UNAME,$UPASS) == 0){
   	           	   echo "welcome to vulnerable site";
   	           	}else
   	           	{
   	           		echo "Sorry Username and Password not found";
   	           	}
   	     }else{
   	     	echo "Not working";
   	     } 
   }


   //checking connection connectivity
   function checkconnection(){
       global $conn;      
       if($conn->connect_error){
          die("connection failed" . $conn->connect_error);
       }
   }
   //function for checking users data
   function checkdata($name,$Passs){
   	   $query = "SELECT username, password FROM registereduser WHERE username LIKE '%" . $name . "%' AND password LIKE '%" . $Passs . "%'";
   	   global $conn;
   	   $result = $conn->query($query);
   	   if($result->num_rows == 1){
   	   	   //echo "Welcome to Vulnerable sites";
   	   	   return 0;
   	   }else{
   	   	   //echo "Not registered";
   	   	   return 1;
   	   }

   }
   //function for validation
   function Invalidcredentials($UNAME,$UPASS){
   	      if($UNAME != "" && $UPASS != ""){
   	      	  return 0;
   	      }else{
   	      	  return 1;
   	      }
   }

?>
    