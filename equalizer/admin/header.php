<?php
if(!$_SESSION['admin_email']){
header ("location:login.php");  
}
$email=$_SESSION['admin_email'];
$user_query= mysqli_query($con,"SELECT admin_username FROM admin_tbl WHERE admin_email='$email'");
$run_user= mysqli_fetch_array($user_query);
$admin_username=$run_user['admin_username'];
?>

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
	<!-- iCheck -->
    <link href="assets/css/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="assets/css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="../images/equalizerlogo.png" />
	
	<link rel="stylesheet" href="chart/style.css" type="text/css">
						<script src="chart/amcharts.js" type="text/javascript"></script>
						<script src="chart/pie.js" type="text/javascript"></script>
						<script src="chart/serial.js" type="text/javascript"></script>
  </head>
  <body class="nav-md">
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
                <span>Welcome </span>
                <h2>Admin <?php echo $admin_username; ?></h2></span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                 
                  <li><a><i class="fa fa-pencil-square-o desktop-home"></i> Announcements<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
              <li><a href="post_announcement.php">Post Announcement</a></li>
              <li><a href="edit_announcement.php">View/Edit Announcements</a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-newspaper-o desktop-home"></i> Articles <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
              <li><a href="add_article.php">Add Article</a></li>
              <li><a href="edit_article.php">View/Edit Articles</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-upload desktop-home"></i> Issues <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
              <li><a href="upload_issue.php">Upload Issue</a></li>
              <li><a href="edit_issues.php">View/Edit Issues</a></li>
                    </ul>
                  </li>
            <li><a href="view_users.php"><i class="fa fa-user desktop-home"></i>View Users</a>
            </li>
			<li><a><i class="fa fa-gears desktop-home"></i>Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
              <li><a href="edit_account.php">Edit Account</a></li>
              <li><a href="add_admin.php">Add Admin</a></li>
			  <li><a href="edit_website_info.php">Edit Wesite Info</a></li>
			  <li><a href="edit_staff.php">Edit Staff</a></li>

                    </ul>
                  </li>
				  <li><a href="../index.php"><i class="fa fa-window-restore desktop-home"></i> View Website </a>

                  </li>
                </ul>
              </div>
              <div class="menu_section">
                
                <ul class="nav side-menu">
                 
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
					
					<li><a href="message.php" class="dropdown-toggle"  role="button" aria-expanded="false" title="Messages"><?php if($msg>=1){ echo " <font color='red'><b>".$msg."</b> </font>"; } ?><i class="fa fa-envelope-o"></i></a></li>
                    <span class="badge bg-green"></span>
					
					<li><a href="notification.php" class="dropdown-toggle"  role="button" aria-expanded="false" title="Notifications"><?php if($noti>=1){ echo " <font color='red'><b>".$noti."</b> </font>"; } ?><i class="fa fa-globe desktop-home"></i></a></li>
                    <span class="badge bg-green"></span>

                  
             
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->