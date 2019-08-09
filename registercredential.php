<?php
   $servername = "localhost";
   $username = "root";
   $password = "<pass>mysql</pass>@123";
   $mydb = "vulenrablesite";

   // Creating connection

   $conn = new mysqli($servername, $username,$password,$mydb);
   	     if (isset($_POST['reg_submit'])) {
   	     $r_uname1 = $_POST["uname1"];
   	     $r_uname2 = $_POST["uname2"];
           $r_email = $_POST["email"];
           $r_phno = $_POST["phoneno"];
           $r_pass = $_POST["pass"];
   	     
   	     if(Invalidcredentials($r_email,$r_pass,$r_phno,$r_uname1,$r_uname2) == 1){
               echo "Fill up all the details";
         }elseif(Invalidcredentials($r_email,$r_pass,$r_phno,$r_uname1,$r_uname2) == 0){
                 checkconnection();
                 registration($r_email,$r_pass,$r_phno,$r_uname1,$r_uname2);
         }
         else{
               echo "Not working";
         }
   }
   else{
   	        echo "wrong button";
   }

   //Check connection
   function checkconnection(){
       global $conn;      
       if($conn->connect_error){
          die("connection failed" . $conn->connect_error);
       }
   }
   function checkcredentials($Email,$Passs){
   	   $query = "SELECT email, pass FROM usersdata WHERE email LIKE '%" . $Email . "%' AND pass LIKE '%" . $Passs . "%'";
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
   function registration($Email,$Passs,$Phno,$Fname,$Lname){
   	    $rr_email = "$Email";
   	    $rr_pass = "$Passs";
        $rr_phno = "$Phno";
        $rr_fname = "$Fname";
        $rr_lname = "$Lname";
   	    global $conn;
   	   if(checkcredentials($rr_email,$rr_pass) == 0){
   	   	    echo "already registered";
   	   }elseif (checkcredentials($rr_email,$rr_pass) == 1) {
   	   	    $query = "INSERT INTO usersdata (firstname,lastname,email,phone,pass)
   	   	    VALUES ('$Fname','$Lname','$Email','$Phno','$Passs')";
   	   	    if($conn->query($query) === TRUE){
   	   	    	echo "You are registered successfully";
   	   	    }else{
   	   	    	echo "your program did not worked bruh";
   	   	    }
   	   }else{
   	   	    echo "Program did not worked properly";
   	   }
   }
   function Invalidcredentials($Email,$PASS,$PHNO,$FNAME,$LNAME){
   	      if($FNAME != "" && $PASS != "" && $PHNO != "" && $Email != "" && $LNAME != ""){
   	      	  return 0;
   	      }else{
   	      	  return 1;
   	      }
   }

   
   $conn->close();
?>