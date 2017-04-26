<?php
//arn---nav count          artname=News--category_name               artnum=1--category_id            id---article_id
require('connection.php');
$hide=false;
if(isset($_SESSION['user_email'])){
  $hide=true; 
}

if(isset($_POST['msg'])){
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

$d= new DateTime();
if(isset($_SESSION['user_email'])){


if(isset($_POST['comment'])){
	$comment=mysql_real_escape_string($_POST['comment']);
	$date=mysql_real_escape_string($_POST['date']);
	$name=mysql_real_escape_string($_POST['name']);
	$email=mysql_real_escape_string($_POST['email']);
	$ar_id=mysql_real_escape_string($_GET['id']);
	$link=mysql_real_escape_string("article_item.php?arn=".$_GET['id']."&artname=".$_GET['artname']."&artnum=".$_GET['artnum']."&id=".$_GET['id']."");
	
	$sqt="INSERT INTO `comment_tbl` (`user_id`, `comment`, `date`, `username`, `email`, `article_id`, `link`) VALUES 
			('".$_SESSION['user_id']."', '".$comment."', '".$date."', '".$name."','".	$email."', '".$ar_id."', '".$link."')";
	if(mysqli_query($con,$sqt)){
		echo "<script type='text/javascript'>
		//window.location.href='article_item.php?arn=".$_GET['arn']."&artname=".$_GET['artname']."&artnum=".$_GET['artnum']."&id=".$_GET['id']."';</script>";		
	}
}
}

$result3=mysqli_query($con,'SELECT article_views FROM articles_tbl where article_id="'.$_GET['id'].'"');
$row3=mysqli_fetch_array($result3);
 $views = $row3['article_views'] + '1';


$query1 = "UPDATE `articles_tbl` SET `article_views` = '".$views."' WHERE `articles_tbl`.`article_id` =  '".$_GET['id']."'; ";
			if(mysqli_query($con, $query1)){
			//echo  "<script>alert('one view added!')</script>";
			}
			else{
				//echo "View not counted";
			}



			
$viewquery = "SELECT * FROM daily_view_tbl where date='".date('Y-m-d')."'";
$viewsql = mysqli_query($con,$viewquery);
$fetchview=mysqli_fetch_assoc($viewsql);
if(mysqli_num_rows($viewsql) > 0){		
	
		$new_view = $fetchview['article_views']+ 1;
		
		
$query11 = "UPDATE `daily_view_tbl` SET `article_views` = '".$new_view."' WHERE `daily_view_tbl`.`view_id` =  '".$fetchview['view_id']."' ";
			if(mysqli_query($con, $query11)){
			//echo  "<script>alert('one view added!')</script>";
			}
			else{
				//echo "View not counted";
			}
}
else{
	$sqvv  = "INSERT INTO `daily_view_tbl`(`date`, `article_views`) VALUES ('".date('Y-m-d')."', '1')";	
			if(mysqli_query($con, $sqvv)){
				
			}
			else{
				
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
<style>
#comment_hr{
	  height: 2px;
	  color:yellow;
	  background-color:#808000;
}
td{
	 padding:2px 5px;
	 vertical-align:top;
	 text-align:justify;
}
</style>



<script src="assets/js/jquery.min.js"></script> 
<script>
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('#nav ul li a'),
            container = $('#container');
        
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.data('target');       
          
          // Load target page into container
          container.load(target + '');
          
          // Stop normal link behavior
          return false;
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
          <li ><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
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
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
		
<div id="result">
        </div>
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
               <li><a href="article.php?arn=<?php echo $_GET['arn']?>&artname=<?php echo $_GET['artname']?>&artnum=<?php echo $_GET['artnum']?>"> <?php echo $_GET['artname']?></a></li>
            </ol>
			<?php
			$art_id=$_GET['id'];

			$sql=mysqli_query($con, 'SELECT * FROM articles_tbl where article_id="'.$art_id.'"');
				$news=mysqli_fetch_assoc($sql);
				$image=$news['article_photo'];
				$dates = $news['article_date'];
				$postdate = date("D, M d, Y", strtotime($dates));
				
				
				 $coms=mysqli_query($con, 'SELECT* FROM comment_tbl where article_id="'.$_GET['id'].'"');
				
			?>
			
            <h1><?php echo "".$news['article_title']." " ?></h1>
            <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php echo "".ucwords($news['article_writer'])." " ?></a> <span><i class="fa fa-calendar"></i><?php echo $postdate; ?></span> <span> <a href="#"><i class="fa fa-comment"></i>comments ( <?php echo "". mysqli_num_rows($coms)." " ?> )</a> <a href="#"><i class="fa fa-eye"></i>Views ( <?php echo "".ucwords($news['article_views'])." " ?> )</a> </span> </div>
            <div class="single_page_content"> <img class="img-center" src="images/article/<?php echo $image;?>" alt="">
			  <p align="justify" style="text-indent:70px" class="article_content"><b><?php echo "".ucfirst($news['article_headline'])." " ?></b></p>
              <p align="justify" style="text-indent:70px" class="article_content"><?php echo "".ucfirst($news['article_story'])." " ?></p>
            </div>
          </div>

		
		
 </div>
      </div>

      <div class="fixed col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
		  <div class="single_sidebar">
			<h2><span>Search Articles</span></h2>
			<div id="search-box">
				<form action="search.php" id="search-form" method="POST">
					<input id="search-text" name="search" placeholder="Enter Search Item" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Article'" required/>
					<input id="search-button" name="submit" type="submit" value="Go">
				</form>
			</div>
		 </div>
        <div class="single_sidebar">
          <h2><span>Popular Post</span></h2>
          <div class="latest_post_container">
            <ul class="spost_nav">
			<?php
				$result=mysqli_query($con,'SELECT * FROM articles_tbl where category_id="'.$_GET['artnum'].'" ORDER BY `articles_tbl`.`article_views` desc limit 4');
				while($row= mysqli_fetch_array($result)){
					
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$row['category_id'].'"');
					while($catfe= mysqli_fetch_array($cat)){
					
					$image=$row['article_photo'];
					$title=$row['article_title'];
					$story=$row['article_headline'];
					
					$linkfea ="article_item.php?arn=".$catfe['category_navi']."&artname=".$catfe['category_name']."&artnum=".$row['category_id']."&id=".$row['article_id']."";
				 
					echo '<li>
							<div class="media"> <a href="'.$linkfea.'" class="media-left"> <img alt="" src="images/article/'.$image.'"> </a>
							  <div class="media-body"> <h4><a href="'.$linkfea.'" class="catg_title">'. strtoupper($title).'</a> </h4><br>
							  <p id="side_post">'. ucfirst(substr(nl2br(htmlentities($story)),0,120)).'....</p></div>					
							</div>
						  </li>';
				}	
				}	
			?>
            </ul>
			
          </div>
        </div>
        <div class="latest_post">
          <h2><span>Latest News Post</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
			<?php
				$result=mysqli_query($con,'SELECT * FROM articles_tbl where category_id="'.$_GET['artnum'].'" ORDER BY `articles_tbl`.`article_date` DESC limit 4');
				while($row1= mysqli_fetch_array($result)){
					
					$cat1=mysqli_query($con,'select * from category_tbl where category_id="'.$row1['category_id'].'"');
					while($catfe1= mysqli_fetch_array($cat1)){
					$linkfea ="article_item.php?arn=".$catfe1['category_navi']."&artname=".$catfe1['category_name']."&artnum=".$row1['category_id']."&id=".$row1['article_id']."";
				 
					
					$image1=$row1['article_photo'];
					$title1=$row1['article_title'];
					$story1=$row1['article_headline'];
					echo '<li>
							<div class="media"> <a href="'.$linkfea.'" class="media-left"> <img alt="" src="images/article/'.$image1.'"> </a>
							  <div class="media-body"> <h4><a href="'.$linkfea.'" class="catg_title">'. strtoupper($title1).'</a> </h4>
							  <p id="side_post">'. ucfirst(substr(nl2br(htmlentities($story1)),0,100)).'....</p></div>					
							</div>
						  </li>';
				}	
				}	
			?>
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
			
          </div>
        </div>
        </aside>
		</div>

	<div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
          <div class="footer_widget wow fadeInDown">
            <hr><h3 align="center" style="color:#46664C;">Comments</h3><hr>
		    <?php if(isset($_SESSION['user_email'])){ ?>
			<p id="comm">Your email address will not be published. Required fields are marked *</p>
             <form  method="post" action="">
                        <div class="form-group">
                            <label>Name *</label>
         <input type="text" name="name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email * (will not be published)</label>
         <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Comment *</label>
      <textarea name="comment" id="comment" required="required" class="form-control" rows="8"></textarea>
	  <input type="hidden" name="id" class="form-control" value="<?php echo $_GET['id'];?>">
	  <input type="hidden" name="date" class="form-control" value="<?php echo $d->format('Y-m-d\TH:i:s.u'); ?>">
                        </div>                        
                        <div class="form-group">
       <button type="submit" name="submits" id="submit_button" required="required">Submit Comment</button>
                        </div>
                </form>
<?php }
else{
	echo '<div id="middle"><h1 align="center">Needs user login to comment!</h1><br/></div>';
}

?>				
		   <div id="middle">
		   <h2 style="color:#46664C;">Visitor Comments</h2>

		   <?php
		   $news_comment=mysqli_query($con, 'SELECT* FROM comment_tbl where article_id="'.$_GET['id'].'"');
		   while($row_comment=mysqli_fetch_array($news_comment)){
			   $datt=$row_comment['date'];
			   echo '<table>
			   <tr>
			   <td><b>'.$row_comment['username'].'</b></td>
			   <td>'.$row_comment['comment'].'</td>
			   </tr>
			   <tr>
			   <td></td>
			   <td><i>'.date('M j,Y - H:i A', strtotime($datt)).'</i></td>
			   </tr>
			   </table><hr id="comment_hr">';
		   }
		   if (mysqli_num_rows($news_comment)<1){
					echo '<h1>NO COMMENTS YET!</h1>';
				}
		   ?>
		   </div>
		  <diV>
      </div>
          </div>
        </div>
        </div>
      </div>
      </section>
  <br><br>
 <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="footer_widget wow fadeInDown">
		  
            <h2>Send Us a Message</h2><a name="contact"></a> 
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

<script>$(document).ready(function(){ $('#search-text').keyup(function(){var txt = $(this).val(); if(txt != ''){ $.ajax({ url:"fetch.php", method:"post",  data:{search:txt},  dataType:"text",  success:function(data) {  $('#result').html(data);}});}else{$('#result').html('');}});});  </script>
   
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="assets/js/jquery.newsTicker.min.js"></script> 
<script src="assets/js/jquery.fancybox.pack.js"></script> 
<script src="assets/js/custom.js"></script>
</body>
</html>