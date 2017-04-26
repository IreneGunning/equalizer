<?php
require('connection.php');
include('header.php');
if(isset($_GET['del'])){
	$id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM admin_tbl WHERE admin_id = '$id'" );
					echo  "<script>alert('User information has been deleted!')</script>";
					echo  "<script>window.open('edit_account.php','_self')</script>";
	
}
				
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Edit Account</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<p class="text-muted font-13 m-b-30">
			</p>
			<?php 
		$selectuser = "SELECT * FROM admin_tbl";
		$resultuser = mysqli_query($con,$selectuser);
		if(mysqli_num_rows($resultuser) > 0){
		while($rowDep = mysqli_fetch_array($resultuser)){
 ?><?php $uno =  $rowDep [0]; ?>										
		<?php $cpass =  $rowDep ['admin_password']; ?>	
                <?php
                if(isset($_POST['subpass'])){
                    $oldpass = mysqli_real_escape_string($con, md5($_POST['oldpass']));
                    $user_pass = mysqli_real_escape_string($con, md5($_POST['newpass']));
                    $retype = mysqli_real_escape_string($con, md5($_POST['retype']));
                        
                        
                        if($user_pass=='d41d8cd98f00b204e9800998ecf8427e'){
                          echo "Please enter your password!";
						
                            }
                        else{
                            if($oldpass==$cpass){
                                if($user_pass!=$retype){
                                  echo "Password not match!";									
                                }                                                          
                                else{
                                    $query1 = "UPDATE admin_tbl SET admin_password='$user_pass' WHERE admin_id='$uno' ";
                                        if(mysqli_query($con, $query1)){?></font><font color="green">
                                            <?php
                                            echo "New Password Saved!";
                                            ?></font>
                                            <font color="red">
                                            <?php
                                            }
                                            else{
                                             echo "You have an error!";
									
                                            }
                                }
                            }
                            else{
                             echo "Wrong Password!";
				
                            }
                        }
                    
                   // echo  "<script>window.open('edit_account.php','_self')</script>";
                }
		}} 
	
		?></font>	
		<font color="red">
                <?php
                    if(isset($_POST['subemail'])){
                        $pass = md5($_POST['pass']);
                        $new_email = $_POST['newemail'];

                            if($new_email==''){
                                echo	$msg = "Please enter your new email!";
                                }
                            else{
                                if (!preg_match("/@/",$new_email)|!preg_match("/.com/",$new_email)){
                                    echo	$msg = "Please select valid email address!";
                                }
                                else{
                                    if($pass==$cpass){
                                        
                                                $query1 = "UPDATE admin_tbl SET admin_email='$new_email' WHERE admin_id='$uno' ";
                                                    if(mysqli_query($con, $query1)){
                                                        ?></font>
														<font color="green">
                                                        <?php
                                                        echo "New Email Saved!";
                                                        ?>
                                                        </font>
                                                        <font color="red">
                                                        <?php
                                                    }
                                                    else{
                                                        echo "You have an error!!!";
                                                    }
                                        
                                    }
                                    else{
                                        echo "Wrong password";
                                    }
                        
                                }
                            }
                        
                        
                    }
                    ?>
					</font>
				
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="background:#84b56c; color:white;"><div align="center">Name</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Edit</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Delete</div></th> 
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php		
				$user_sql = "SELECT * FROM admin_tbl";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr>';
						echo '<td><div align="center">'.ucwords($fetch_user['admin_username']).'</div></td>';
						?>  
						<td><div align="center">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#apply<?php echo  $fetch_user [0]; ?>">
										<span class="fa fa-edit"></span> Edit
				</button>
				</div>
				</td>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_account.php?del='.$fetch_user[0].'">
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
$selectuser = "SELECT * FROM admin_tbl";
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
								<h4 class="modal-title" id="myModalLabel"><b><?php  echo ucwords($rowDep ['admin_username']);?><b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="positionApplyingFor" value="czoxOiI1Ijs=" />
								<h4 class="formTitle">Information</h4>																							
				<?php $uno =  $rowDep [0]; ?>										
				<?php $cpass =  $rowDep ['admin_password']; ?>																			
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
							<table align="center" border="5px" padding="21px" width="70%" >
                    <tr>
                  <td colspan="2" style="font-size: 20px;"><b> Basic information:</b></td>
                  </tr>
                  <tr>
                 <td>User Name: </td><td>
                   <input  style="width:100%; background-color:#e6e6e6; " name="usernames" type="text" disabled="disabled" value="<?php  echo ucwords($rowDep ['admin_username']);?>" size="29"></td> 
                 </tr>
                  <tr>
                 <td>E-mail:   </td><td>
                   <input style=" width:100%; background-color:#e6e6e6; " name="emails" type="text" disabled="disabled" value="<?php  echo ucwords($rowDep ['admin_email']);?>" size="33"></td> 
                 </tr>
                  <tr>
                
                  </tr>
                   
                  
                  
                  
                 
                    <form action="changepass.php" method="post">
                  <td colspan="2" style="font-size:20px;"><b>Change Password:</b></td>
                  
                  <tr>
                 <td>Old Password:   </td><td><input style="width:100%; background-color:#e6e6e6; " name="oldpass" type="password" value="" size="27"></td> 
                 </tr>
                  <tr>
                 <td>New password:   </td><td><input style="width:100%; background-color:#e6e6e6; " name="newpass" type="password" value="" size="26"></td> 
                 </tr>
                  <tr>
                 <td>Retype password:   </td><td><input style="width:100%; background-color:#e6e6e6; " name="retype" type="password" value="" size="24"></td> 
                 </tr>
                  <tr>
                <td>  <input style=" style="width:100%; background-color:#e6e6e6; " type="submit" name="subpass" value="Save"> </td><td>
                </td>
                  </tr>
                  </form>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  <form action="" method="post">
                  <td colspan="2" style="font-size:20px; "><b>Change Email:</b></td>
                
                  <tr>
                 <td>New Email:   </td><td><input style="width:100%; background-color:#e6e6e6; " name="newemail" type="email" value="" size="29"></td> 
                 </tr>
                  <tr>
                 <td>Password:   </td><td><input style="width:100%; background-color:#e6e6e6; "  name="pass" type="password" value="" size="31"></td> 
                 </tr>
                 
                  <tr>
                <td>  <input type="submit" name="subemail" value="Save"> </td><td>
                
                
                
                
                
                
                
                </td>
                  </tr>
                  </form>
	
	
	</table>
							
									<br>
							
							
							<br><br>
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