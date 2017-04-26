<?php
require('connection.php');

if(!$_SESSION['admin_email']){
header ("location:login.php");  
}
else{
	
	$updatenoti=mysqli_query($con,"UPDATE `comment_tbl` SET `status`='seen' WHERE status='waiting' ;");

}

if(isset($_GET['del'])){
	$id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM user_tbl WHERE user_id = '$id'" );
					echo  "<script>alert('User information has been deleted!')</script>";
					echo  "<script>window.open('edit_users.php','_self')</script>";
	
}

if(isset($_POST['sub'])){

$uno = $_POST['user_id'];

	  $query1 = "UPDATE user_tbl SET username='".$_POST['username']."', user_email='".$_POST['email']."', fname='".$_POST['fname']."',
	  mname='".$_POST['mname']."', lname='".$_POST['lname']."', contact='".$_POST['contact']."', address='".$_POST['address']."' WHERE user_id='$uno' ";
		if(mysqli_query($con, $query1)){
	
			echo  "<script>alert('Account Updated!')</script>";
			}
			else{
				echo "You have an error!!!";
			}	
}

?>
<style>
			tr:nth-child(odd) {background: #e2e2e2}
			tr:nth-child(even) {background: #f8f8f8}
</style>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Equalizer</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/nprogress.css" rel="stylesheet">
    <link href="assets/css/daterangepicker.css" rel="stylesheet">
    <link href="assets/css/custom.min.css" rel="stylesheet">
	
  </head>

  <body class="nav-md">
  <table border = "0" padding="2px" width="1300px" align="center">
<tr><td bgcolor="#43814d">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="../images/equalizerlogo.png" alt="..." id="eqlog"><span>The Equalizer</span></a>
            </div>

            <div class="clearfix"></div>

            <div class="profile clearfix">
              <div class="profile_info">
                <span>Welcome</span>
                <h2> Admin<?php echo " ".ucwords($_SESSION['admin_username']); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                 
                  <li><a><i class="fa fa-pencil-square-o desktop-home"></i> Announcements<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="post_announcement.php">Post Announcement</a></li>
						<li><a href="edit_announcement.php">Edit Announcement</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-newspaper-o desktop-home"></i> Articles <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="add_article.php">Add Article</a></li>
						<li><a href="edit_article.php">Edit Article</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-upload desktop-home"></i> Issues <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="upload_issue.php">Upload Issue</a></li>
						<li><a href="edit_issues.php">Edit Issues</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-user desktop-home"></i>Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="view_users.php">View Users</a></li>
						<li><a href="edit_users.php">Edit Users</a></li>
                    </ul>
                  </li>
				<li><a><i class="fa fa-gears desktop-home"></i>Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
						<li><a href="edit_account.php">Edit Account</a></li>
						<li><a href="add_admin.php">Add Admin</a></li>
						<li><a href="edit_website_info.php">Edit Wesite Info</a></li>

                    </ul>
                 </li>
				  <li><a href="../index.php"><i class="fa fa-window-restore desktop-home"></i> View Website </a>

                  </li>
                </ul>
              </div>
              <div class="menu_section">
                
                <ul class="nav side-menu">
                 
                    </ul>
                 
                    </ul>
                  
                          
                 
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     <?php echo ucwords($_SESSION['admin_username']) ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li> </ul>  </li> <?php  $sql5 = "SELECT * FROM message_tbl WHERE notify='waiting'"; $result5 = mysqli_query($con, $sql5); $msg=mysqli_num_rows( $result5); ?> <?php  $sqlquery = "SELECT * FROM comment_tbl WHERE status='waiting'"; $com = mysqli_query($con, $sqlquery); $noti=mysqli_num_rows( $com); ?>

       
                  
					<?php  $sql5 = "SELECT * FROM message_tbl WHERE notify='waiting'";
					$result5 = mysqli_query($con, $sql5);
					$msg=mysqli_num_rows( $result5); ?>
					
					<?php  $sqlquery = "SELECT * FROM comment_tbl WHERE status='waiting'";
					$com = mysqli_query($con, $sqlquery);
					$noti=mysqli_num_rows( $com); ?>
					
					<li><a href="message.php" class="dropdown-toggle"  role="button" aria-expanded="false" title="Messages"><?php if($msg>=1){ echo " <font color='red'><b>".$msg."</b> </font>"; } ?><?php if($msg>=1){ echo " <font color='red'><b>".$msg."</b> </font>"; } ?><i class="fa fa-envelope-o"></i></a></li>
                    <span class="badge bg-green"></span>
					
					<li><a href="notification.php" class="dropdown-toggle"  role="button" aria-expanded="false" title="Notifications"><?php if($noti>=1){ echo " <font color='red'><b>".$noti."</b> </font>"; } ?><?php if($noti>=1){ echo " <font color='red'><b>".$noti."</b> </font>"; } ?><i class="fa fa-globe desktop-home"></i></a></li>
                    <span class="badge bg-green"></span>

                  
                  
             
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main">
		<div id="content">
             
            <div class="inner" style="min-height: 700px;">
		
       <div class="panel panel-default"><br><br>
         <div class="row text-center">
			<hr>
            <h2><b>  Notification <?php 
		if($noti>0){ echo "(".$noti.")"; } 
	
	?></b></h2>
			<hr>
        </div>
		
		
		
		<div id="result">
			
	
                        
	<center>

               
				
			<div class="table-responsive center">
				<table  border="0" width="100%">
					<thead>
						<tr>
							<th class="text-center" style="background:black; color:white;">Name</th>
							<th class="text-center" style="background:black; color:white;">Action</th>
							<th class="text-center" style="background:black; color:white;">Date</th>
						
							
						
						</tr>
						
					</thead>
					<tbody>
		
		
		
		
		
			 <?php 
				$num_rec_per_page=20;		
				if (isset($_GET['page'])) { $page  = $_GET["page"]; } 
				else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page; 	
				
				$messrun=mysqli_query($con,"SELECT * FROM comment_tbl  ORDER BY comment_id desc LIMIT $start_from, $num_rec_per_page");
					if(mysqli_num_rows($messrun)>0){ 
						while($updates=mysqli_fetch_assoc($messrun)){	
						$mess=$updates;
							$originalDate = $mess['date'];
							$newDate = date("m-d-Y g:i:sa", strtotime($originalDate));
							
						if($mess['status']=="waiting"){ $color="#d8d8d8";} else { $color="#f2f2f2";}
						
						
						$action=mysqli_query($con,"SELECT article_title FROM articles_tbl where article_id=".$mess['article_id']."");
						$actions=mysqli_fetch_assoc($action);
							
						
						
				?>
						<tr>
							<td style="background:<?php echo $color; ?>; "><?php echo substr(nl2br(htmlentities($mess['username'])),0,25); 
								 ?></td>
							<td style="background:<?php echo $color; ?>;text-align:center;"><a href="../<?php echo $mess['link']; ?>"><?php echo substr(nl2br(htmlentities("Added comment in ".ucwords($actions['article_title'])."")),0,33);  ?></a>
							</td>
							<td style="background:<?php echo $color; ?>;text-align:center;"><?php echo nl2br(htmlentities($newDate)); ?>
							</td>
			
							
						</tr>
		
		
				<?php 
						} }
				?>
					</tbody>
				</table>
				<br>
				 <ul class="pagination pagination-lg">
               <?php 
						$pagename = "updates";
					  if(mysqli_num_rows($messrun)>0)
                     {
					$sql = "SELECT * FROM comment_tbl "; 
					$rs_result = mysqli_query($con, $sql); //run the query
					$total_records = mysqli_num_rows($rs_result);  //count number of records
					$total_pages = ceil($total_records / $num_rec_per_page); 
					if(!isset($_GET['pick'])){
					echo "<li><a href='$pagename.php?page=1'><i class='fa fa-long-arrow-left'></i>".'First Page'."</a></li> "; // Goto 1st page  
					
					for ($i=1; $i<=$total_pages; $i++) { 
								if(isset($_GET['page'])){
									if($i==$_GET['page']){
									echo "<li class='active'><a href='$pagename.php?page=".$i."'>".$i."</a> </li> "; 
									}
									else {
										echo "<li><a href='$pagename.php?page=".$i."'>".$i."</a> </li> "; 
									}
								}
								else {
									if($i==1){
									echo "<li class='active'><a href='$pagename.php?page=".$i."'>".$i."</a> </li> "; 
									}
									else {
										echo "<li><a href='$pagename.php?page=".$i."'>".$i."</a> </li> "; 
									}
								}
								
					}; 
					echo "<li><a href='$pagename.php?page=$total_pages'>".'Last Page'."<i class='fa fa-long-arrow-right'></i></a></li> "; // Goto last page
					 }}
					
					?>
                  </ul><!--/.pagination-->
			
		
            </div>
            
  </div>
  
  
  
  
  
  
  
  
  
  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        </div>
        <ul class="pagination pagination-lg">
              

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright © 2017  <a href="index.php">The Equalizer</a>
          </div>
          <div class="clearfix"></div>
        </footer>
		
		
		</div>
		</div>
     </div>
		
        <!-- /footer content -->
      </div>
    </div>
</td>
  </tr>
  </table>
    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="assets/js/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="assets/js/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="assets/js/Flot/jquery.flot.js"></script>
    <script src="assets/js/Flot/jquery.flot.pie.js"></script>
    <script src="assets/js/Flot/jquery.flot.time.js"></script>
    <script src="assets/js/Flot/jquery.flot.stack.js"></script>
    <script src="assets/js/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="assets/js/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="assets/js/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="assets/js/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="assets/js/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>