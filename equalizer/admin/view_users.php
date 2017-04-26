<?php
require('connection.php');
include('header.php');
if(isset($_GET['del'])){
	$id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM user_tbl WHERE user_id = '$id'" );
					echo  "<script>alert('User information has been deleted!')</script>";
					echo  "<script>window.open('view_users.php','_self')</script>";
	
}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">

	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Edit Announcement</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<p class="text-muted font-13 m-b-30">
			</p>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
												<th style="background:#84b56c; color:white;"><div align="center">User ID</div></th>
                                                <th style="background:#84b56c; color:white;">Username</th>
                                                <th style="background:#84b56c; color:white;">Email</th>
                                                <th style="background:#84b56c; color:white;">Name</th>
                                                <th style="background:#84b56c; color:white;">Birth Date</th>
                                                <th style="background:#84b56c; color:white;">Contact</th>
                                                <th style="background:#84b56c; color:white;">Address</th>
                                                <th style="background:#84b56c; color:white;">Gender</th>
                                                <th style="background:#84b56c; color:white;">Civil Status</th>
												<th style="background:#84b56c; color:white;">Delete</th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php
				$num_rec_per_page=10;		
				if (isset($_GET['page'])) { $page  = $_GET["page"]; } 
				else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page; 
				
				
				$user_sql = "SELECT * FROM user_tbl";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr>';
						echo '<td><div align="center">'.$fetch_user['user_id'].'</div></td>';
						echo '<td>'.$fetch_user['username'].'</td>';
						echo '<td>'.$fetch_user['user_email'].'</td>';
						echo '<td>'.ucfirst($fetch_user['fname']).'&ensp;'.ucfirst($fetch_user['mname']).'&ensp;'.ucfirst($fetch_user['lname']).'</td>';
						echo '<td>'.$fetch_user['birthdate'].'</td>';
						echo '<td>'.$fetch_user['contact'].'</td>';
						echo '<td>'.ucwords($fetch_user['address']).'</td>';
						echo '<td>'.ucfirst($fetch_user['gender']).'</td>';
						echo '<td>'.ucfirst($fetch_user['civil_status']).'</td>';
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="view_users.php?del='.$fetch_user[0].'">
						<font  style="color:black;">
						<button type="button" class="btn btn-primary btn-lg">
						<i style class="fa fa-trash-o"></i>
						</button>
						</font></a></div></td>';
				echo '</tr>';
       
				}}?>                      		   
				</tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
</div>
<!-- /page content -->

<?php
include('footer.php')
?>