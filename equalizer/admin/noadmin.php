<!DOCTYPE html>
<?php include'connection.php'; 

if(isset($_GET['cancel'])){

unset($_SESSION['pass']);


}


  $jobrun1 = "SELECT * FROM admin_tbl"; $jubrun2 = mysqli_query($con, $jobrun1);   $job=mysqli_num_rows($jubrun2); 


 if($job!=0){
 	header ("location: login.php");
 }
//if(!$_SESSION['admin']){
//header ("location: ../index.php");	
//}
//$_SESSION['admin'];
//$_SESSION['adminno'];

if(isset($_POST['createadmin'])  ){
	if($_POST['pass'] == $_POST['confirm']){
	
		$sq="INSERT INTO `admin_tbl` (`admin_username`, `admin_email`, `admin_password`, `secret_question`, `answer`) VALUES ('".$_POST['name']."','".$_POST['email']."','".md5($_POST['pass'])."','".$_POST['quest']."','".$_POST['answer']."')";
		if(mysqli_query($con, $sq)){
			echo "<script type='text/javascript'> alert('New admin added!'); window.location.href='login.php';</script>";		
		unset($_SESSION['pass']);
		}
		else{
			echo "<script type='text/javascript'> alert('Error please contact my developer!');</script>";		
		}
		

	}
	else{
			echo "<script type='text/javascript'> alert('Password not matched!');</script>";		
	}
	
}

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>The Equalizer</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">
	<link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet"><script src="js/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<style>
html {
    position: relative;
    min-height: 100%;
}
body {
    margin: 0 0 100px; /* bottom = footer height */
}
footer {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 75px;
    width: 100%;
}

</style>  
</head><!--/head-->
<body>


    <section id="error" class="container text-center" style="margin-top: -50px;" >
		<div id="result"> 
		<br>
<br>	<br>	<br>	<br>
	<br>	<br>
		<br>
			<h1 style="color:gray; font-size:40px;">Manage Admin </h1>
					<br>
									<h3 style="color:gray; font-size:30px;">Add Admin</h3>
									<?php
									 if(!isset($_SESSION['pass'])){
									  ?>
									<a  href="noadmin.php?add=1"><i class="fa fa-plus"></i>Admin</a>
									<?php
									 }
								 ?>
										
								
						
						<br>
						<br>
						
					
						
					<?php
					
					if(isset($_POST['adds'])){
											
										
											
										if($_POST['adds']=="secretpass"){
												
											echo "<script type='text/javascript'> window.location.href='noadmin.php';</script>";
											$_SESSION['pass'] = "temp";
										}
										else{
											echo 'Wrong password';
											$color = "#ffd3d3";
										}
					}
					
					if(isset($_GET['add'])){ ?>
											<form href="" method='post' >
											
												 <input style="text-align:center; color:black; background-color:<?php if(isset($_POST['pass'])){ echo $color; }  else {echo "white"; } ?>;" type="password" size="35" class="fa" name="adds" placeholder="&#xf084; Enter password to continue!" required/>
												<button type="submit" class="btn btn-success">Submit</button>
											
											</form>
					<?php } ?>
							
							<br>
							
						<?php

					
					
							
						
							 if(isset($_SESSION['pass'])){ 
									echo '
					
											<form method="post">
										<div class="panel panel-default">
										<div class="panel-heading">
											
										</div>
										<div class="panel-body">
					
					
					
										<table border="0" class="table table-condensed" align="center">
										
										<tr>
										<td>
										<label style="text-align:center;">Username</label>
										<input type="text" name="name"  value="" class="fa" placeholder=" Enter name" required>
										</td>
										<td>
										
										<label>Email</label><br>
										<input type="email" name="email"  value="" class="fa" placeholder="&#xf0e0; Enter email" required>
										</td>
										<td>
										
											<label>Security Question</label> :<select name="quest">';
								
								
								

								$question=mysqli_query($con,"SELECT * FROM security_question_tbl");
								while($quest=mysqli_fetch_assoc($question)){
							    	 echo'<option style="font-size:15px;" value="'.$quest['question'].'">'.$quest['question']. '&nbsp;&nbsp;</option>';
								}
								 ?>
							</select>
							<br><br>
							 &ensp;&ensp;&ensp;  &emsp; &emsp;&ensp;&ensp;&ensp; &ensp;&ensp;&ensp;&emsp; 
							 <input type="text" name="answer" placeholder="Answer"required/> &ensp;
										</td>
										</tr>
										<tr>
										<td>
										
										<label>Password</label>
										<input type="password" name="pass" class="fa" placeholder="&#xf084; Enter password" required>
										</td><td>
										
										<label>Retype Password</label>
										<input type="password" name="confirm" class="fa" placeholder="&#xf084; Retype password" required>
										</td>
										</tr>
										
										</table>
										
										
										
										
									
								<br>
								

						

					</div>
					<div class="panel-footer">
							<button type="submit" class="btn btn-success" name ="createadmin" id ="update_user" value=''Submit">Save</button>
							<a href="noadmin.php?cancel=1" class="btn btn-danger">Cancel</a>	
			 		<?php ?>
					</div>
					</div>
					</form>
		
		
				<?php } ?>
		
		
		
		
		
		
		
          </div>
    </section><!--/#error-->
    <!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-12" >
                   <center> &copy; 2016 Mabalacat City College  Equalizer. All Rights Reserved.
                   </center>
                </div>
</div>
        </div>
    </footer><!--/#footer-->

    <script>$(document).ready(function(){ $('#search_text').keyup(function(){var txt = $(this).val(); if(txt != ''){ $.ajax({ url:"fetch.php", method:"post",  data:{search:txt},  dataType:"text",  success:function(data) {  $('#result').html(data);}});}else{$('#result').html('');}});});  </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
</body>
</html>