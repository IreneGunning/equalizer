<?php
require('connection.php');
$hide=false;
if(isset($_SESSION['user_email'])){
  $hide=true; 
}
$d= new DateTime();

if(isset($_POST['comment'])){
	$comment=mysql_real_escape_string($_POST['comment']);
	$date=mysql_real_escape_string($_POST['date']);
	$name=mysql_real_escape_string($_POST['name']);
	$email=mysql_real_escape_string($_POST['email']);
	$ar_id=mysql_real_escape_string($_GET['id']);
	$sqt="INSERT INTO `comment_tbl` (`comment`, `date`, `username`, `email`, `article_id`) VALUES 
			('".$comment."', '".$date."', '".$name."','".	$email."', '".$ar_id."')";
	if(mysqli_query($con,$sqt)){
		echo "<script type='text/javascript'> alert('Your comment is added!'); window.location.href='sports_item.php?id=".$ar_id."';</script>";		
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
              <li><a href="contact.php">Contact</a></li>
			  
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
          <li><a href="news.php">News</a></li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Opinion</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="editorial.php">Editorial</a></li>
              <li><a href="opinion.php">Opinion</a></li>
            </ul>
          </li>
          <li><a href="feature.php">Feature</a></li>
		  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Literary</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="poem.php">Poems</a></li>
              <li><a href="essay.php">Essays</a></li>
			  <li><a href="short_story.php">Short Stories</a></li>
			  <li><a href="artwork.php">Artworks</a></li>
			  <li><a href="photo.php">Photography</a></li>
            </ul>
          </li>
		  <li><a href="entertainment.php">Entertainment</a></li>
		  <li class="active"><a href="sports.php">Sports</a></li>
		  <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Issues</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="newletter.php">Newsletter</a></li>
              <li><a href="tabloid.php">Tabloid</a></li>
			  <li><a href="broadsheet.php">Broadsheet</a></li>
			  <li><a href="balas.php">Balas</a></li>
			  <li><a href="sabulum.php">Sabulum</a></li>
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
					echo '<li><a href="news_item.php?id='.$latest['article_id'].'">'.$latest['article_title'].'</a></li>';
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
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li><a href="sports.php">Sports</a></li>
            </ol>
			<?php
			$art_id=$_GET['id'];

			$sql=mysqli_query($con, 'SELECT * FROM articles_tbl where article_id="'.$art_id.'"');
				$news=mysqli_fetch_assoc($sql);
				$image=$news['article_photo'];
				$dates = $news['article_date'];
				$postdate = date("D, M d, Y", strtotime($dates));
			?>
			
            <h1><?php echo "".$news['article_title']." " ?></h1>
            <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php echo "".$news['article_writer']." " ?></a> <span><i class="fa fa-calendar"></i><?php echo $postdate; ?></span> <span> <a href="#"><i class="fa fa-comment"></i>Comments</a> <a href="#"><i class="fa fa-eye"></i>Views</a> </span> </div>
            <div class="single_page_content"> <img class="img-center" src="images/announcement/<?php echo $image;?>" alt="">
			  <p align="justify" style="text-indent:70px" class="article_content"><b><?php echo "".$news['article_headline']." " ?></b></p>
              <p align="justify" style="text-indent:70px" class="article_content"><?php echo "".$news['article_story']." " ?></p>
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
				$result=mysqli_query($con,'SELECT * FROM articles_tbl where category_id="12" ORDER BY `articles_tbl`.`article_date` limit 4');
				while($row= mysqli_fetch_array($result)){
					$image=$row['article_photo'];
					$title=$row['article_title'];
					$story=$row['article_headline'];
					echo '<li>
							<div class="media"> <a href="#" class="media-left"> <img alt="" src="images/announcement/'.$image.'"> </a>
							  <div class="media-body"> <h4><a href="#" class="catg_title">'.$title.'</a> </h4><br>
							  <p id="side_post">'.substr(nl2br(htmlentities($story)),0,120).'....</p></div>					
							</div>
						  </li>';
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
				$result=mysqli_query($con,'SELECT * FROM articles_tbl where category_id="12" ORDER BY `articles_tbl`.`article_date` DESC limit 4');
				while($row= mysqli_fetch_array($result)){
					$image=$row['article_photo'];
					$title=$row['article_title'];
					$story=$row['article_headline'];
					echo '<li>
							<div class="media"> <a href="#" class="media-left"> <img alt="" src="images/announcement/'.$image.'"> </a>
							  <div class="media-body"> <h4><a href="#" class="catg_title">'.$title.'</a> </h4>
							  <p id="side_post">'.substr(nl2br(htmlentities($story)),0,100).'....</p></div>					
							</div>
						  </li>';
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
			<p id="comm">Your email address will not be published. Required fields are marked *</p>
             <form  method="post" action="sports_item.php?id=<?php echo $art_id;?>">
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
      </section>
  <br><br>
 <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
          <div class="footer_widget wow fadeInDown">
            <h2>Send Us a Message</h2>
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