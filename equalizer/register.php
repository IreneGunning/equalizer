
<?php

include('connection.php');
$hide=false;
if(isset($_SESSION['email'])){
	$hide=true;	
}
if(!isset($_GET['arn'])){
$_GET['arn']=0;

}

	/*					
	INSERT INTO `user_tbl`(`username`, `user_email`, `user_pass`, `secret_question`, `answer`, `fname`, `mname`, `lname`, `birthdate`, `contact`, `address`, `gender`, `civil_status`) VALUES
 	('".$_POST['username']."','".$_POST['email']."','".$_POST['pass']."','".$_POST['quests']."'
 		,'".$_POST['answer']."','".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','".$_POST['bday']."'
 		,'".$_POST['contact']."','".$_POST['address']."','".$_POST['gender']."','".$_POST['email']."','".$_POST['civil']."');

*/
	if(isset($_POST['sub'])){

		if($_POST['pass']==$_POST['pass2']){

			$insertquest=mysqli_query($con, "INSERT INTO `user_tbl` (`user_id`, `username`, `user_email`, `user_pass`, `secret_question`, `answer`, `fname`, `mname`, `lname`, `birthdate`, `contact`, `address`, `gender`, `photo`, `civil_status`)
			 VALUES (NULL, '".$_POST['username']."', '".$_POST['email']."', '".md5($_POST['pass'])."', '".$_POST['quests']."', '".$_POST['answer']."', '".$_POST['fname']."', '".$_POST['mname']."', '".$_POST['lname']."', '".$_POST['bday']."', '".$_POST['contact']."', '".$_POST['address']."', '".$_POST['gender']."', '".$_POST['email']."', '".$_POST['civil']."');");
			//	echo $_POST['username'] ,$_POST['email'], $_POST['pass'],$_POST['quests'],$_POST['answer'],$_POST['fname'],$_POST['mname'],$_POST['lname'],
			//	$_POST['bday'],$_POST['contact'],$_POST['address'],$_POST['gender'],$_POST['civil'];
			echo  "<script>alert('Successfully Registered!')</script>";
			header ("location:login.php");
		}
		else{
			echo  "<script>alert('Password not match.')</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>The Equalizer</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/css/font.css">
<link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="shortcut icon" href="images/equalizerlogo.png"/>	
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="js/jquerymin.js"></script>
<script type="text/javascript">
    
</script>
<script type="text/javascript">
		$(document).ready(function(){
		$("#email").keyup(function() {
		var email = $('#email').val();
		if(email=="")
		{
		$("#disp").html("");
		}
		else
		{
		$.ajax({
		type: "POST",
		url: "user_check.php",
		data: "email="+ email ,
		success: function(html){
		$("#disp").html(html);
		}
		});
		return false;
		}
		});
		});
</script>
</head>

<body>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li class="dropdown"> <a href="about.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About</a>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="staff.php">Staff</a></li>
				  <li><a href="history.php">History</a></li>
				</ul>
			  </li>
              <li><a href="#contact">Contact</a></li>
			  
              <li <?php if ($hide===false){?>style="display:none"<?php } ?>><a href="Logout.php">Logout</a></li>
			  <li <?php if ($hide===true){?>style="display:none"<?php } ?>><a href="register.php">Register</a></li>
			  <li <?php if ($hide===true){?>style="display:none"<?php } ?>><a href="login.php">Login</a></li>
			  <li <?php if ($hide===false){?>style="display:none"<?php } ?>><a href="#">Good Day <?php echo ucwords($_SESSION['name']);?></a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <p><?php $dt = new DateTime(); echo $dt->format('l, F d, Y');?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="index.php" class="logo"><img src="images/logo.png" alt=""></a></div>
        </div>
		
      </div>
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM category_tbl where category_navi='1'");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
									$issuename = $issuerun['category_name'];
								?>
							    	<li 
									<?php if( $_GET['arn'] == 1 and $issuename == $_GET['artname'])
									{ echo 'class="active"'; }
									
									?>
									><a href="article.php?arn=1&artname=<?php echo "$issuename"?>&artnum=<?php echo $issuerun['category_id'];?>"><?php echo $issuerun['category_name'];?></a></li>
								<?php
								}
								 
								 ?>
          <li class="dropdown <?php if( $_GET['arn'] == 2  ) { echo 'active';}?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Opinion</a>
            <ul class="dropdown-menu" role="menu">
			
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM category_tbl where category_navi='2'");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
									$issuename = $issuerun['category_name'];
								?>
							    	<li
									<?php if( $_GET['arn'] == 2  and $issuename == $_GET['artname'])
									{ echo 'class="active"'; }
									
									?>
									><a href="article.php?arn=2&artname=<?php echo "$issuename"?>&artnum=<?php echo $issuerun['category_id'];?>"><?php echo $issuerun['category_name'];?></a></li>
								<?php
								}
								 
								 ?>
            </ul>
          </li>
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM category_tbl where category_navi='3'");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
								$issuename = $issuerun['category_name'];
								?>
							    	<li 
									<?php if( $_GET['arn'] == 3 and $issuename == $_GET['artname'])
									{ echo 'class="active"'; }
									
									?>
									><a href="article.php?arn=3&artname=<?php echo "$issuename"?>&artnum=<?php echo $issuerun['category_id'];?>"><?php echo $issuerun['category_name'];?></a></li>
								<?php
								}
								 
								 ?>
		  <li class="dropdown <?php if( $_GET['arn'] == 4  ) { echo 'active';}?>"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Literary</a>
            <ul class="dropdown-menu" role="menu">
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM category_tbl where category_navi='4'");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
									$issuename = $issuerun['category_name'];
								?>
							    	<li
									<?php if( $_GET['arn'] == 4 and $issuename == $_GET['artname'])
									{ echo 'class="active"'; }
									
									?>
									><a href="article.php?arn=4&artname=<?php echo "$issuename"?>&artnum=<?php echo $issuerun['category_id'];?>"><?php echo $issuerun['category_name'];?></a></li>
								<?php
								}
								 
								 ?>
            </ul>
          </li>
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM category_tbl where category_navi='5'");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
								$issuename = $issuerun['category_name'];
								?>
							    	<li 
									<?php if( $_GET['arn'] == 5 and $issuename == $_GET['artname'])
									{ echo 'class="active"'; }
									
									?> >
									<a href="article.php?arn=5&artname=<?php echo "$issuename"?>&artnum=<?php echo $issuerun['category_id'];?>"><?php echo $issuerun['category_name'];?></a></li>
								<?php
								}
								 
								 ?>
								 
								<?php
								
								// :D
								$issuesql=mysqli_query($con,"SELECT * FROM category_tbl where category_navi='6'");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
								$issuename = $issuerun['category_name'];
								?>
							    	<li 
									<?php if( $_GET['arn'] == 6 and $issuename == $_GET['artname'])
									{ echo 'class="active"'; }
									
									?>
									><a href="article.php?arn=6&artname=<?php echo "$issuename"?>&artnum=<?php echo $issuerun['category_id'];?>"><?php echo $issuerun['category_name'];?></a></li>
								<?php
								}
								 
								 ?>
		  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Issues</a>
            <ul class="dropdown-menu" role="menu">
              					<?php
								$issuesql=mysqli_query($con,"SELECT * FROM issue_type_tbl");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
									$issuename = $issuerun['issue_type_name'];
								?>
							    	<li
									<?php if( isset($_GET['name']) and $issuename == $_GET['name'])
									{ echo 'class="active"'; }
									
									?>
									
									
									><a href="issues.php?name=<?php echo "$issuename"?>&num=<?php echo $issuerun['issue_type_id'];?>"><?php echo $issuerun['issue_type_name'];?></a></li>
								<?php
								}
								 
								 ?>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </section>
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Latest News</span>
          <ul id="ticker01" class="news_sticker">
            <?php
		     $sql2=mysqli_query($con,'select* from articles_tbl where category_id="1" ORDER BY article_id DESC');
			 while($latest= mysqli_fetch_array($sql2)){
				 $nw=mysqli_query($con,'select * from category_tbl where category_id="1" limit 0,1');
				while($n= mysqli_fetch_array($nw)){
					echo "<li><a href='article_item.php?arn=".$n['category_navi']."&artname=".$n['category_name']."&artnum=".$n['category_id']."&id=".$latest['article_id']."'>".$latest['article_title']."</a></li>";
				}	
			}	
		  ?>
          </ul>
          <div class="social_area">
            <ul class="social_nav">
					<?php
					$issuesql=mysqli_query($con,"SELECT * FROM links_tbl");
					while($issuerun=mysqli_fetch_assoc($issuesql)){
						$linkname = $issuerun['link_name'];
					?>
						<li
						<?php if( isset($_GET['name']) and $issuename == $_GET['name'])
						{ echo 'class="$linkname" '; } ?> >
						
						 <li class="<?php echo "$linkname"?>"><a href="<?php echo $issuerun['link_address'];?>"></a></li>
					<?php
					}
					 
					 ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
	 <section id="sliderSection">
        <div class="container">

                    <font id="register">Register</font>


	 
	  <div class="row">
	  <form method="POST" action="register.php">
	  <div id="left_tab">
	  <table align="center">
	  <thead><tr><th colspan="2">Personal Information</th></tr></thead>
	  <tr><td>Firstname : </td>
	  <td><input type="text" name="fname" placeholder="First name"required/> </td></tr>
	  <tr><td>Middlename:</td>
	  <td><input type="text" name="mname" placeholder="Middle Name"required/></td></tr>
	  <tr><td>Lastname:</td>
	  <td><input  type="text" name="lname" placeholder="Last name"required/></td></tr>
	  <tr><td>Date of Birth:</td>
	  <td><input  type="date" name="bday"  pattern="\d{4}/\d{1,2}/\d{1,2}" title="Please input proper date format" placeholder="yyyy/mm/dd" required/></td></tr>
	  <tr><td>Present Address:</td>
	  <td><textarea  name="address" placeholder=" " required></textarea></td></tr>
	  <tr><td>Civil Status: </td>
	  <td><input type="radio" name="civil" value="Single"required/> Single</td></tr>
	  <tr><td> </td>
	  <td><input style="margin: 10px 0px" type="radio" name="civil" value="Married"required/> Married</td></tr>
	  <tr><td> </td>
	  <td><input style="margin: 10px 0px" type="radio" name="civil" value="Widdow"required/> Widow</td></tr>
	  <tr><td> </td>
	  <td><input style="margin: 10px 0px" type="radio" name="civil" value="Separated"required/> Separated</td></tr>
	  <tr><td>Contact Number:</td>
	  <td><input  type="number" min="1000000" max="1000000000000" name="contact" title="Please select valid mobile number" required/></td></tr>
	  <tr><td>Gender:</td>
	  <td><input type="radio" class="rad" name="gender" value="male"required/> Male</td></tr>
	  <tr><td> </td>
	  <td><input style="margin: 10px 0px" type="radio" name="gender" value="female"required/> Female</td></tr>
	  <tr><td> </td></tr>
	  <tr><td> </td></tr>
	  </table>	
	  </div>
	  <div id="right_tab">
	  <table align="center">
	  <thead><tr><th colspan="2">Login Information</th></tr></thead>
	  <tr><td>Username :</td>
	  <td><input type="text" name="username" placeholder="" required/></td></tr>
	  <tr><td>Email Address: </td>
	  <td><input  type="email" name="email"  id="email"  placeholder=" " required/></td></tr>
	  <tr><td>Password:</td>
	  <td><input  type="password" name="pass" pattern=".{8,20}" title=" Please 8 to 20 charcters only" placeholder="" required/></td></tr>
	  <tr><td>Re-enter Password:</td>
	  <td><input  type="password" name="pass2" pattern=".{8,20}" title=" Please 8 to 20 charcters only" placeholder="" required/></td></tr>
	  <tr><td>Security Question :</td>
	  <td><select name="quests"> 
	    <?php
		$question=mysqli_query($con,"SELECT * FROM security_question_tbl");
		while($quest=mysqli_fetch_assoc($question)){
			 echo'<option style="font-size:15px;" value="'.$quest['question'].'">'.$quest['question']. '&nbsp;&nbsp;</option>';
		}
		?>
		</select></td></tr> 
	  <tr><td>Answer:</td>
	  <td colspan="2"><input type="text" name="answer" placeholder="Answer"required/></td></tr>
	  <br> <center> 
	  <tr><td colspan="2"><input name="sub" type="submit" value="Submit" id="submit_button"></center></td></tr>
	  </table>
      <div>	  
				</form>
			  </div>
			</div>
		</section> <br><br>
  <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="footer_widget wow fadeInDown">
            <h2>Send Us a Message</h2><a name="contact"></a> 
                            <form  method="post" action="index.php">
                   
				   <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Name *</label>
         <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
         <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
         <input type="number"name="number" class="form-control">
                        </div>                     
                    </div>
					
					
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Subject *</label>
        <input type="text" name="subject" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
      <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
       <button type="submit" name="submits" id="submit_button" required="required">Submit Message</button>
                        </div>
                    </div>
                </form> 
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">
            <h2>Contact</h2>
            <p>Don't hesitate to contact us</p>
			<div><p class="fa fa-home">&ensp;Mabalacat City College: Rizal St. MacArthur Highway, Dolores, Mabalacat</p></div>
			<div><p class="fa fa-phone">&ensp;09394739793</p></div>
			<div><p class="fa fa-facebook"><a href="https://www.facebook.com/officialtheequalizer/">&ensp;Official The Equalizer - www.facebook.com/officialtheequalizer/</a></p></div>
			<div><p class="fa fa-envelope"><a href="mailto:equalizermcc2016@gmail.com">&ensp;equalizermcc2016@gmail.com</a></p></div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer_bottom">
      <p class="copyright">Copyright &copy; 2017 <a href="index.php">The Equalizer</a></p>
      <p class="developer">Developed By Team Equalizer</p>
    </div>
  </footer>
</div>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="assets/js/jquery.newsTicker.min.js"></script> 
<script src="assets/js/jquery.fancybox.pack.js"></script> 
<script src="assets/js/custom.js"></script>
</body>
</html>

