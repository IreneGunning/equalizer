<?php
require('connection.php');
$hide=false;
if(isset($_SESSION['user_email'])){
  $hide=true; 
}
 $d= new DateTime();

if(isset($_POST['submits'])){
	$name=mysql_real_escape_string($_POST['name']);
	$email=mysql_real_escape_string($_POST['email']);
	$number=mysql_real_escape_string($_POST['number']);
	$subject=mysql_real_escape_string($_POST['subject']);
	$message=mysql_real_escape_string($_POST['message']);
	$date=mysql_real_escape_string($_POST['date']);
	$sqt="INSERT INTO `message_tbl` (`name`, `email`, `number`, `subject`, `message`, `date`) VALUES 
			('".$name."', '".$email."', '".$number."','".	$subject."', '".$message."', '".$date."')";
	if(mysqli_query($con,$sqt)){
		echo "<script type='text/javascript'> alert('Your message is sent!');</script>";		
	}
	else{
		echo "<script type='text/javascript'> alert('message error!'); </script>";		
	}
}

if(!isset($_GET['arn'])){
$_GET['arn']=0;

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
              <li class="dropdown" style="background-color: #61ea67;"> <a href="about.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About</a>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="staff.php">Staff</a></li>
				  <li class="active"><a href="history.php">History</a></li>
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
          <div class="logo_area"><a href="index.php" class="logo"><center><img src="images/logo.png" alt=""><center></a></div>
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
              <li class="facebook"><a href="https://www.facebook.com/officialtheequalizer/"></a></li>
              <li class="twitter"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>
              <li class="mail"><a href="mailto:equalizermcc2016@gmail.com"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="left_content">
          <div class="single_page">
		  <center>
		  <h1 id="about_head">History</h1>
		  <p id="about_p">In fulfillment to Section 2 of the Campus Journalism act of 1991, 
		  which states that, “It is the declared policy of the State to uphold and protect 
		  the freedom of the press even at the campus level and to promote the development 
		  and growth of campus journalism as a means of strengthening ethical values, 
		  encouraging critical and creative thinking, and developing moral character and 
		  personal discipline of the Filipino youth,” Mabalacat City College has approved 
		  the establishment of The Equalizer as its official student publication in the year 2009.
		  </p>
		  
		  <p id="about_p">The Publication promotes responsible journalism by providing timely news and 
		  liberating articles to distribute to everyone in the College and even to people in Mabalacat 
		  City government. By doing this, The Equalizer is serving as a channel for expressing ideas and 
		  opinions and providing relevant information with regard to the College. It also assists the College 
		  in documenting significant events and upholding freedom of speech.
		  </p>
		  <br/><br/>
		  <h1 id="about_head">Vision</h1>
		  <p id="about_p">The Equalizer envisions producing highly competent, skilled and responsible campus 
		  journalists who meet the standards of excellence, professionalism and effectiveness in the field of writing.
		  </p>
		  <br/><br/>
		  <h1 id="about_head">Mission</h1>
		  <p id="about_p">The Equalizer aims to be the voice of the students and the balancing force in the campus by 
		  providing responsive, innovative and valuable information while training student journalists in upholding 
		  the values of truth, balance and independence.
		  </p>
		  <br/><br/>
		  
		  <h1 id="about_head">Preamble</h1>
		  <p id="about_p">In lieu with the erudite, teaching and skilled welfare of its naissance members, a new mandated 
		  society committed to campus journalism is hereby created which will respond to the need of the campus solidarity.
		  </p>

		  
		  
		  <br/><br><br/><br>
		  </center>
       
          </div>
        </div>
      </div>
      </div>
      </section>
  
 <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="footer_widget wow fadeInDown">
            <h2>Send Us a Message</h2>
			<a name="contact"></a> 
                            <form  method="post" action="">
                     <div class="col-sm-5 col-sm-offset-1">
										
							 <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id'];?>">
					
							 <input type="hidden" name="date" class="form-control" value="<?php echo $d->format('Y-m-d\TH:i:s.u'); ?>">
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