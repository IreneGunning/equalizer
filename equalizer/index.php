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


if(isset($_POST['comment'])){
	$comment=mysql_real_escape_string($_POST['comment']);
	$date=mysql_real_escape_string($_POST['date']);
	$name=mysql_real_escape_string($_POST['name']);
	$email=mysql_real_escape_string($_POST['email']);
	$ar_id=mysql_real_escape_string($_GET['artnum']);
	$sqt="INSERT INTO `comment_tbl` (`user_id`, `comment`, `date`, `username`, `email`, `article_id`) VALUES 
			('".$comment."', '".$date."', '".$name."','".	$email."', '".$ar_id."')";
	if(mysqli_query($con,$sqt)){
		echo "<script type='text/javascript'> alert('Your comment is added!'); window.location.href='opinion_item.php?id=".$ar_id."';</script>";		
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
          <li  class="active"><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
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
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="slick_slider">
		<?php
		     $sql3=mysqli_query($con,'select* from articles_tbl where category_id="1"');
			 while($latest2= mysqli_fetch_array($sql3)){
				 $nw=mysqli_query($con,'select * from category_tbl where category_id="1" limit 0,1');
				while($n= mysqli_fetch_array($nw)){
					
					echo '<div class="single_iteam"> <a href="article_item.php?arn='.$n['category_navi'].'&artname='.$n['category_name'].'&artnum='.$n['category_id'].'&id='.$latest2['article_id'].'"> <img src="images/article/'.$latest2['article_photo'].'" alt=""></a>
					<div class="slider_article">
					<h2><a class="slider_tittle" href="article_item.php?arn='.$n['category_navi'].'&artname='.$n['category_name'].'&artnum='.$n['category_id'].'&id='.$latest2['article_id'].'">'.$latest2['article_title'].'</a></h2>
					<p>'. ucfirst(substr(nl2br(htmlentities($latest2['article_story'])),0,100)).' ...</p>
					</div>
					</div>';
					
			}	
			}	
		  ?>
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
		
		
          <div class="single_post_content">
            <h2><span>Featuring</span></h2>
			<?php
		     $fea=mysqli_query($con,'select* from articles_tbl where article_featured="yes" limit 0,1');
			 while($feafe= mysqli_fetch_array($fea)){	
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$feafe['category_id'].'" limit 0,1');
					while($catfe= mysqli_fetch_array($cat)){
					$linkfea ="article_item.php?arn=".$catfe['category_navi']."&artname=".$catfe['category_name']."&artnum=".$feafe['category_id']."&id=".$feafe['article_id']."";
				  ?>
					<div class="single_post_content_left">
					  <ul class="business_catgnav  wow fadeInDown">
						<li>
						  <figure class="bsbig_fig"> <a href="<?php echo $linkfea; ?>" class="featured_img"> <img alt="" src="images/article/<?php echo $feafe['article_photo']; ?>"> <span class="overlay"></span> </a>
							<figcaption> <a class="slider_tittle"  href="<?php echo $linkfea; ?>"><?php echo strtoupper($feafe['article_title']); ?></a> </figcaption>
							<p><?php echo ucfirst(substr(nl2br(htmlentities($feafe['article_story'])),0,100)); ?></p>
						  </figure>
						</li>
					  </ul>
					</div>
					<?php
					}	
			}	
		  ?>
		  
            <div class="single_post_content_right">
              <ul class="spost_nav">
			  <?php
		     $fea=mysqli_query($con,'select* from articles_tbl where article_featured="yes" limit 1,5');
			 while($feafe= mysqli_fetch_array($fea)){
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$feafe['category_id'].'" limit 0,1');
					while($catfe= mysqli_fetch_array($cat)){
					$linkfea ="article_item.php?arn=".$catfe['category_navi']."&artname=".$catfe['category_name']."&artnum=".$feafe['category_id']."&id=".$feafe['article_id']."";
				  ?>
                <li>
                  <div class="media wow fadeInDown"> <a href="<?php echo $linkfea; ?>" class="media-left"> <img alt="" src="images/article/<?php echo $feafe['article_photo']; ?>"> </a>
                    <div class="media-body"> <a href="<?php echo $linkfea; ?>" class="catg_title"> <?php echo strtoupper(substr(nl2br(htmlentities($feafe['article_title'])),0,100)); ?></a> </div>
                  </div>
                </li>
                	<?php
					}	
			}	
		  ?>
              </ul>
            </div>
          </div>
		  
		  
		  
		  
		  
          <div class="fashion_technology_area">
            <div class="fashion">
              <div class="single_post_content">
                <h2><span>Entertainment</span></h2>
                <ul class="business_catgnav wow fadeInDown">
				
                  <li>
				  <?php
		     $entert=mysqli_query($con,'select* from articles_tbl where category_id="11" limit 0,1');
			 while($enterta= mysqli_fetch_array($entert)){	
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$enterta['category_id'].'" limit 0,1');
					while($entertai= mysqli_fetch_array($cat)){
					$linkenter ="article_item.php?arn=".$entertai['category_navi']."&artname=".$entertai['category_name']."&artnum=".$enterta['category_id']."&id=".$enterta['article_id']."";
				  ?>
                    <figure class="bsbig_fig"> <a href="<?php echo $linkenter; ?>" class="featured_img"> <img alt="" src="images/article/<?php echo $enterta['article_photo']; ?>"> <span class="overlay"></span> </a>
                      <figcaption> <a href="<?php echo $linkenter; ?>"><?php echo strtoupper(substr(nl2br(htmlentities($enterta['article_title'])),0,100)); ?></a> </figcaption>
                      <p><?php echo ucfirst(substr(nl2br(htmlentities($enterta['article_story'])),0,100)); ?></p>
                    </figure>
					<?php
					}	
			}	
		  ?>
                  </li>
				  
                </ul>
				
				
				
                <ul class="spost_nav">
				
				
				<?php
					$sqlen=mysqli_query($con,'select* from articles_tbl where category_id="11" limit 1,5');
					while($runen= mysqli_fetch_array($sqlen)){
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$runen['category_id'].'" limit 0,1');
					while($feen= mysqli_fetch_array($cat)){
					$linkfea ="article_item.php?arn=".$feen['category_navi']."&artname=".$feen['category_name']."&artnum=".$runen['category_id']."&id=".$runen['article_id']."";
				 ?>
						  <li>
							<div class="media wow fadeInDown"> <a href="<?php echo $linkfea; ?>" class="media-left"> <img alt="" src="images/article/<?php echo $runen['article_photo']; ?>"> </a>
							  <div class="media-body"> <a href="<?php echo $linkfea; ?>" class="catg_title"> <?php echo strtoupper(substr(nl2br(htmlentities($runen['article_title'])),0,100)); ?></a> </div>
							</div>
						  </li>
				  <?php
					}	
					}	
					?>
                 
				  
                </ul>
              </div>
            </div>
            <div class="technology">
              <div class="single_post_content">
                <h2><span>Opinion</span></h2>
				
				
                <ul class="business_catgnav">
                  <li>
				  
				  <?php
						 $opin=mysqli_query($con,'select* from articles_tbl where category_id="3" limit 0,1');
						 while($opini= mysqli_fetch_array($opin)){	
								$op=mysqli_query($con,'select * from category_tbl where category_id="'.$opini['category_id'].'" limit 0,1');
								while($opn= mysqli_fetch_array($op)){
								$linkenter ="article_item.php?arn=".$opn['category_navi']."&artname=".$opn['category_name']."&artnum=".$opini['category_id']."&id=".$opini['article_id']."";
							  ?>
								<figure class="bsbig_fig wow fadeInDown"> <a href="<?php echo $linkenter; ?>" class="featured_img"> <img alt="" src="images/article/<?php echo $opini['article_photo']; ?>"> <span class="overlay"></span> </a>
								  <figcaption> <a href="<?php echo $linkenter; ?>"><?php echo strtoupper(substr(nl2br(htmlentities($opini['article_title'])),0,100)); ?></a> </figcaption>
								  <p><?php echo ucfirst(substr(nl2br(htmlentities($opini['article_story'])),0,100)); ?></p>
								</figure>
								<?php
								}	
						}	
				 ?>
					  
                  </li>
                </ul>
				
				
                <ul class="spost_nav">
				
                  <?php
					$opin1=mysqli_query($con,'select* from articles_tbl where category_id="3" limit 1,5');
					while($opini1= mysqli_fetch_array($opin1)){
					$opn1=mysqli_query($con,'select * from category_tbl where category_id="'.$opini1['category_id'].'" limit 0,1');
					while($op1= mysqli_fetch_array($opn1)){
					$linkfea ="article_item.php?arn=".$op1['category_navi']."&artname=".$op1['category_name']."&artnum=".$opini1['category_id']."&id=".$opini1['article_id']."";
				 ?>
						  <li>
							<div class="media wow fadeInDown"> <a href="<?php echo $linkfea; ?>" class="media-left"> <img alt="" src="images/article/<?php echo $opini1['article_photo']; ?>"> </a>
							  <div class="media-body"> <a href="<?php echo $linkfea; ?>" class="catg_title"> <?php echo strtoupper(substr(nl2br(htmlentities($opini1['article_title'])),0,100)); ?></a> </div>
							</div>
						  </li>
				  <?php
					}	
					}	
					?>
				  
                  
				  
                </ul>
              </div>
            </div>
          </div>

          <div class="single_post_content">
            <h2><span>Artworks/Photography</span></h2>
		  <?php
		  $result3=mysqli_query($con,'SELECT * FROM articles_tbl where category_id IN (9,10) LIMIT 6');
			while ($row3=mysqli_fetch_array($result3)){	
			$art_date=$row3['article_date'];
				echo '            <ul class="photograph_nav  wow fadeInDown">
				  <li>
					<div class="photo_grid">
					  <figure class="effect-layla"> <a class="fancybox-buttons" data-fancybox-group="button" href="images/article/'.$row3['article_photo'].'" 
					  title="'.ucwords($row3['article_title']).' &#8226; '.ucfirst($row3['article_headline']).' &#8226; by: '.ucwords($row3['article_writer']).' &#8226; '.$row3['article_date'].'"> 
					  <img src="images/article/'.$row3['article_photo'].'" alt=""/>
					  <figcaption><div id="cap">'.$row3['article_title'].'</div></figcaption>
					  </a>
					  </figure>
					</div>
				  </li>
				</ul>';
			}
		  ?>
          </div>
		  
          <div class="single_post_content">
            <h2><span>Sports</span></h2>
			<?php
		     $fea=mysqli_query($con,'select* from articles_tbl where category_id="12" limit 0,1');
			 while($feafe= mysqli_fetch_array($fea)){	
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$feafe['category_id'].'" limit 0,1');
					while($catfe= mysqli_fetch_array($cat)){
					$linkfea ="article_item.php?arn=".$catfe['category_navi']."&artname=".$catfe['category_name']."&artnum=".$feafe['category_id']."&id=".$feafe['article_id']."";
				  ?>
					<div class="single_post_content_left">
					  <ul class="business_catgnav  wow fadeInDown">
						<li>
						  <figure class="bsbig_fig"> <a href="<?php echo $linkfea; ?>" class="featured_img"> <img alt="" src="images/article/<?php echo $feafe['article_photo']; ?>"> <span class="overlay"></span> </a>
							<figcaption> <a class="slider_tittle"  href="<?php echo $linkfea; ?>"><?php echo strtoupper($feafe['article_title']); ?></a> </figcaption>
							<p><?php echo ucfirst(substr(nl2br(htmlentities($feafe['article_story'])),0,100)); ?></p>
						  </figure>
						</li>
					  </ul>
					</div>
					<?php
					}	
			}	
		  ?>
		  
            <div class="single_post_content_right">
              <ul class="spost_nav">
			  <?php
		     $fea=mysqli_query($con,'select* from articles_tbl where category_id="12" limit 1,5');
			 while($feafe= mysqli_fetch_array($fea)){
					$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$feafe['category_id'].'" limit 0,1');
					while($catfe= mysqli_fetch_array($cat)){
					$linkfea ="article_item.php?arn=".$catfe['category_navi']."&artname=".$catfe['category_name']."&artnum=".$feafe['category_id']."&id=".$feafe['article_id']."";
				  ?>
                <li>
                  <div class="media wow fadeInDown"> <a href="<?php echo $linkfea; ?>" class="media-left"> <img alt="" src="images/article/<?php echo $feafe['article_photo']; ?>"> </a>
                    <div class="media-body"> <a href="<?php echo $linkfea; ?>" class="catg_title"> <?php echo strtoupper(substr(nl2br(htmlentities($feafe['article_title'])),0,100)); ?></a> </div>
                  </div>
                </li>
                	<?php
					}	
			}	
		  ?>
              </ul>
            </div>
          </div>  
        </div>
      </div>
	  
	  <div class="col-lg-4 col-md-4 col-sm-4">
	  <div class="single_sidebar">
		<h2><span>Search Articles</span></h2>
		<div id="search-box">
			<form action="" id="search-form" method="POST">
				<input id="search-text" name="search" placeholder="Enter Search Item" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Article'" required/>
				<input id="search-button" name="submit" type="submit" value="Go">
			</form>
		</div>
	 </div>
	 </div>
	 
	 
	 
	  <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Announcements</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
			<?php
				$result=mysqli_query($con,"SELECT* FROM announcement_tbl ORDER BY announce_id DESC limit 4");
				while($row= mysqli_fetch_array($result)){
					
					
					$image=$row['announce_photo'];
					$title=$row['announce_name'];
					$story=$row['announce_story'];
					$announce_date=$row['announce_date'];
					echo '<li>
							<div class="media"> <a href="#" class="media-left"> <img alt="" src="images/announcement/'.$image.'"> </a>
							  <div class="media-body"> <h4><a href="#" class="catg_title">'.$title.'</a> </h4>
							  <p id="side_post">'.$story.'</p></div>					
							</div>
						  </li>';
				}	
			?>
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
			
          </div>
        </div>
      </div>
	  
	  
	  
	  
	  
	  <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
		<table>
		<tr><td> <td></tr><tr><td> <td></tr>
		</table>
        </div>
      </div>
	  <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Latest Post</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
            <ul class="latest_postnav">
			<?php
				$result=mysqli_query($con,"SELECT* FROM articles_tbl limit 4");
				while($row= mysqli_fetch_array($result)){
					$ar_id=$row['article_id'];
					$sql_join=mysqli_query($con, 'SELECT* FROM articles_tbl JOIN category_tbl WHERE articles_tbl.category_id=category_tbl.category_id
					IN(SELECT category_id FROM articles_tbl where article_id="'.$ar_id.'")');
					$result_join=mysqli_fetch_assoc($sql_join);
					$image=$row['article_photo'];
					$title=$row['article_title'];
					$story=$row['article_headline'];
					

					$linklp= "article_item.php?arn=".$result_join['category_navi']."&artname=".$result_join['category_name']."&artnum=".$row['category_id']."&id=".$row['article_id']."";
					
					echo '<li>
							<div class="media"> <a href="'.$linklp.'" class="media-left"> <img alt="" src="images/article/'.$image.'"> </a>
							  <div class="media-body"> <h4><a href="'.strtolower($linklp).'" class="catg_title">'.strtoupper($title).'</a> </h4>
							  <p id="side_post">'.ucfirst(substr(nl2br(htmlentities($story)),0,100)).'....</p></div>					
							</div>
						  </li>';
				}	
			?>
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
			
          </div>
        </div>
      </div>
	  <div class="col-lg-4 col-md-4 col-sm-4 absolutely">
        <div class="latest_post">
		<table>
		<tr><td><td></tr><tr><td> <td></tr>
		</table>
        </div>
      </div>  
	  <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="single_sidebar">
          <h2><span>Popular Post</span></h2>
          <div class="latest_post_container">
            <ul class="spost_nav">
			<?php
				$resultpp=mysqli_query($con,"SELECT* FROM articles_tbl ORDER BY `article_views` DESC limit 4");
				while($rowpp= mysqli_fetch_array($resultpp)){
					
					 $ar_idpp=$rowpp['article_id'];
					$sql_joinpp=mysqli_query($con, 'SELECT* FROM articles_tbl JOIN category_tbl WHERE articles_tbl.category_id=category_tbl.category_id
					IN(SELECT category_id FROM articles_tbl where article_id="'.$ar_idpp.'")');
					$result_joinpp=mysqli_fetch_assoc($sql_joinpp);

					$linkpp= "article_item.php?arn=".$result_joinpp['category_navi']."&artname=".$result_joinpp['category_name']."&artnum=".$rowpp['category_id']."&id=".$rowpp['article_id']."";

					
					$image=$rowpp['article_photo'];
					$title=$rowpp['article_title'];
					$story=$rowpp['article_headline'];
					echo '<li>
							<div class="media"> <a href="'.$linkpp.'" class="media-left"> <img alt="" src="images/article/'.$image.'"> </a>
							  <div class="media-body"> <h4><a href="'.$linkpp.'" class="catg_title">'.strtoupper($title).'</a> </h4><br>
							  <p id="side_post">'.substr(nl2br(htmlentities($story)),0,120).'....</p></div>					
							</div>
						  </li>';
				}	
			?>
            </ul>
			
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
		  <div class="single_sidebar">
		   <h2><span>Latest Issue</span></h2>
		  <ul class="spost_nav">
			<?php
				$resultss=mysqli_query($con,"SELECT * FROM `issue_tbl` ORDER BY `issue_tbl`.`issue_id` DESC limit 1");
				while($rowa= mysqli_fetch_array($resultss)){
					
					$resultss1=mysqli_query($con,"SELECT * FROM `issue_type_tbl` where issue_type_id='".$rowa['issue_type_id']."'");
				while($rowiss= mysqli_fetch_array($resultss1)){
					$art_date=date("M d, Y", strtotime($row3['issue_date']));
				
					$linki= "issues.php?name=".$rowiss['issue_type_name'].".&num=".$rowa['issue_type_id']."";

           echo '
            <div>
			<div id="latest"><a href="'.$linki.'" class="catg_title"><img src="files/preview/'.$rowa['issue_photo'].'" alt="Latest Issue"></a></div>
			<div id="latest"><b>'.ucwords($rowa['issue_name']).'&emsp;&#8226;&emsp;'.$art_date.'</b></div>
			</div>';
         	}	
         	}	
			?>
		 </div>
        </aside>
      </div>
	  
	  
    </div>
  </section>
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