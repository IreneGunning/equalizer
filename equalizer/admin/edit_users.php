<?php
require('connection.php');
include('header.php');
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

<!-- page content -->
<div class="right_col" role="main">
	<div class="row">

	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Manage Users</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<p class="text-muted font-13 m-b-30">
			</p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="background:#84b56c; color:white;"><div align="center">Name</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Edit</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Delete</div></th>     
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php
				$user_sql = "SELECT * FROM user_tbl";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr>';
						echo '<td><div align="center">'.ucfirst($fetch_user['fname']).' '.ucfirst($fetch_user['mname']).' '.ucfirst($fetch_user['lname']).'</div></td>';
						?>  
						<td><div align="center">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#apply<?php echo  $fetch_user [0]; ?>">
										<span class="fa fa-edit"></span> Edit
				</button>
				</div>
				</td>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_users.php?del='.$fetch_user[0].'">
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

		<?php 
		$selectuser = "SELECT * FROM user_tbl";
		$resultuser = mysqli_query($con,$selectuser);
		if(mysqli_num_rows($resultuser) > 0){
		while($rowDep = mysqli_fetch_array($resultuser)){
 ?>
<!--start of apply-->
			<div class="modal fade"  id="apply<?php echo $rowDep [0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">

				<!--FORM START-->
					<form class="formPreloader form-horizontal" id="applicationForm"  action="" method="POST" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header">
							
								<button type="submit" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel"><b><?php  echo ucwords($rowDep ['fname']." ".$rowDep ['mname']." ".$rowDep ['lname']);?><b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="positionApplyingFor" value="czoxOiI1Ijs=" />
								<h4 class="formTitle">Information</h4>
														
														
														
														
														
														
														
													
	  <div class="panel panel-default">
			<div class="panel-heading">
			  <h3 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
				Personal Information
				  
				</a>
			  </h3>
			</div>
			<div class="panel-collapse ">
			  <div class="panel-body">
					   	
					
						
							<input  type="hidden" name="user_id"  value="<?php echo ucwords($rowDep ['user_id']) ?>">  &ensp;
							Name : &ensp;<input  type="text" name="lname" placeholder="Last name" value="<?php echo ucwords($rowDep ['lname']) ?>" required/> , &ensp;
							<input type="text" name="fname" placeholder="First name" value="<?php echo ucwords($rowDep ['fname']) ?>" required/> &ensp;
							<input type="text" name="mname" placeholder="Middle Name" value="<?php echo ucwords($rowDep ['mname']) ?>" required/><br><br>
							Username : <input type="text" name="username" placeholder="" value="<?php echo ucwords($rowDep ['username']) ?>" required/> &ensp;<br><br>
						
							 Present Address: <textarea  name="address" placeholder=" " required><?php echo ucwords($rowDep ['address']) ?></textarea><br><br><br>
							 Contact Number:&emsp; <input  type="number" name="contact" value="<?php echo ucwords($rowDep ['contact']) ?>" pattern=".{10,13}" title="Please select valid mobile number"  placeholder=" " required/><br><br>
							 Email Address: &emsp;&emsp; <input  type="email" name="email"  id="email"  placeholder=" " value="<?php echo ucwords($rowDep ['user_email']) ?>" required/><font id="disp"></font><br><br>
							
							
									<br>
							<center> 

							<input name="sub" type="submit" value="Submit"></center>
							
							<br><br>
			  </div>
			</div>
		  </div>
		  
	</div>	  
		 </form>	
										
				</div>
			</div>
			</div>
			</div>

		<?php }} ?>

<?php
include('footer.php')
?>