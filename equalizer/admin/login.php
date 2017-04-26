<?php
require('connection.php');

 $jobrun1 = "SELECT * FROM admin_tbl"; $jubrun2 = mysqli_query($con, $jobrun1);   $job=mysqli_num_rows($jubrun2); 


 if($job==0){
 	header ("location: noadmin.php");
 }


?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
	<link rel="shortcut icon" href="../admin/images/equalizerlogo2.png">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/style2.css">
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet">	
		
<style type="text/css">
body{
	background:url(../images/equalizerlogo.png)  no-repeat center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
 	background-size: cover;
 	position:relative;
}

input[type=email], input[type=password] {
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid #DDDDDD;
}

 
input[type=email]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(26, 44, 245, 255);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(26, 44, 245, 1);
}

input[type=password]:focus{
  box-shadow: 0 0 5px rgba(26, 44, 245, 255);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(26, 44, 245, 1);
}

input[type=submit]{
  heigt:5px;
  font-size:12pt;
  font-weight:600;
  color:white;
  background-color:green;
  padding:7px 3px;
}

a{
	text-decoration:none;
	color:red;
	font-weight:600;
}
a:hover{
	font-size:14pt;
	font-style:italic;
	color:#5C82E0;
}
	
</style>			
</head>
  
<body>
<br><br><br>
<div class="container">
  <div class="info">
    <h1>

    <br><B><font size="4px">Mabalacat City College</font></B></h1><span>Please log-in to continue</span>
  </div>
</div>
<div class="form">

<form method='post' action='login.php'>
    <input type="email" name="email" class="fa" placeholder="&#xf0e0; Enter Email" style="text-align: center;" required/><br>

    <input type="password" name="pass" class="fa" placeholder="&#xf084; Enter password" style="text-align: center;" required/><br><br>
	<input type='submit' name="login" value='Sign In'><br><br>


<br><br>
</form>
  
  
<?php

if (isset($_POST['login'])){
		$email= mysql_real_escape_string($_POST['email']);
		$pass=md5(mysql_real_escape_string($_POST['pass']));
		$query1="SELECT * FROM admin_tbl WHERE admin_email='$email'";
		$result1=mysqli_query($con, $query1) or die (mysql_error());
		$row = mysqli_fetch_array($result1);
		
		if($row['admin_password']==$pass){
		
		
			
			$query="SELECT * FROM admin_tbl WHERE admin_email='$email' AND admin_password= '$pass'";
			$result=mysqli_query($con, $query) or die (mysql_error());
			$count= mysqli_num_rows($result);
			if($count==1){
				$row1 = mysqli_fetch_array($result);
				$_SESSION['admin_username']=$row1['admin_username'];
				$_SESSION['admin_email']=$row1['admin_email'];
				$_SESSION['admin_id']=$row1['admin_id'];
			

				
				//unset($_SESSION['admin']);
				//unset($_SESSION['adminno']);
				//unset($_SESSION['insadminno']);
				//unset($_SESSION['insadmin']);
				$message="Sucess! You have have logged in.";
				echo "<script type='text/javascript'> alert('$message'); window.location.href='index.php';</script>";
			}
			else{
				$message="Email and/or Password incorrect. \\nTry again.";
				echo "<script type='text/javascript'> alert('$message'); window.location.href='login.php';</script>";		
			
			}
		}
		else{
			
			$message="Email and/or Password incorrect. \\nTry again.";
				echo "<script type='text/javascript'> alert('$message'); window.location.href='login.php';</script>";	
		}
}
	
?>
</div>


    
    
  </body>
  
</html>
