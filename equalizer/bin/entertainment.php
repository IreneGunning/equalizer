<?php
require('connection.php');
$hide=false;
if(isset($_SESSION['user_email'])){
  $hide=true; 
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
		  <li class="active"><a href="entertainment.php">Entertainment</a></li>
		  <li><a href="sports.php">Sports</a></li>
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
              <li><a href="entertainment.php">Entertainment</a></li>
            </ol>
<?php
$start=0;
$limit=10;

if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
}
else{
	$id=1;
}
$result3=mysqli_query($con,'SELECT* FROM articles_tbl where category_id="11" LIMIT '.$start.','.$limit.'');
while ($row3=mysqli_fetch_array($result3)){	
$art_date=$row3['article_date'];
	echo '<div class="blog-item"><div class="row"><div class="col-lg-3 col-md-3 col-sm-3">
		  <div class="entry-meta"><span id="publish_date">';
	echo date("M d, Y", strtotime($row3['article_date']));
	echo '</span></div></div><div class="col-lg-9 col-md-9 col-sm-9  blog-content">
		 <h1>
		 <a href="entertainment_item.php?id='.$row3['article_id'].'">'.$row3['article_title'].'</a>
		 </h1><div class="media"> <a href="entertainment_item.php?id='.$row3['article_id'].'" class="media-left"> <img class="img-blog" alt="" src="images/announcement/'.$row3['article_photo'].'"> </a>
							  <div class="media-body">
							  <p id="side_post">'.substr(nl2br(htmlentities($row3['article_headline'])),0,230).'...</p></div>					
							</div>';
	echo '<a class="btn btn-primary readmore" href="entertainment_item.php?id='.$row3['article_id'].'">Read More 
		  <i class="fa fa-angle-right"></i></a>
		  </div></div></div><hr>';
}
if (mysqli_num_rows($result3)<1){
					echo '<h1>NO POST YET</h1>';
				}
$rows=mysqli_num_rows(mysqli_query($con,'select * from articles_tbl where category_id="11"'));//calculate total page number for the given table in the database 
$total=ceil($rows/$limit);
?>
<br>
<ul class="pagination pagination-lg">
<?php 
if(mysqli_num_rows($result3)>0){
if($total>1){
echo "<li><a href='news.php?id=1'><i class='fa fa-chevron-circle-left'></i></a></li> "; // Goto 1st page  
for ($i=1; $i<=$total; $i++) { 
		if(isset($_GET['id'])){
			if($i==$_GET['id']){
			echo "<li class='active'><a href='news.php?id=".$i."'>".$i."</a> </li> "; 
			}
			else {
				echo "<li><a href='news.php?id=".$i."'>".$i."</a> </li> "; 
			}
		}
		else {
			if($i==1){
			echo "<li class='active'><a href='news.php?id=".$i."'>".$i."</a> </li> "; 
			}
			else {
				echo "<li><a href='news.php?id=".$i."'>".$i."</a> </li> "; 
			}
		}
		
}; 
echo "<li><a href='news.php?id=$total'><i class='fa fa-chevron-circle-right'></i></a></li> "; // Goto last page
}}
?>
</ul><!--/.pagination-->

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
				$result=mysqli_query($con,'SELECT * FROM articles_tbl where category_id="11" ORDER BY `articles_tbl`.`article_date` limit 4');
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
				if (mysqli_num_rows($result)<1){
					echo '<h1>NO POST YET</h1>';
				}
			?>
            </ul>
			
          </div>
        </div>
          </div> 
        </aside>
      </div>
      </section>
  
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