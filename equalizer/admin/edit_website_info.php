<?php
require('connection.php');
include('header.php');
if(isset($_GET['del'])){
	$id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM links_tbl WHERE link_id = '$id'" );
					echo  "<script>alert('Link deleted!')</script>";
					echo  "<script>window.open('edit_website_info.php','_self')</script>";
	
}

if(isset($_POST['sub'])){

$uno = $_POST['user_id'];

	  $query1 = "UPDATE links_tbl SET link_name='".$_POST['name']."', link_address='".$_POST['address']."'  WHERE link_id='$uno' ";
		if(mysqli_query($con, $query1)){
	
			echo  "<script>alert('Link updated Updated!')</script>";
			}
			else{
				echo "You have an error!!!";
			}	
}

if(isset($_POST['subcontact'])){

$uno = $_POST['user_id'];

	  $query1 = "UPDATE contact_tbl SET message='".$_POST['message']."'
	  ,address='".$_POST['address']."' 
	  ,contact_number='".$_POST['contact']."' 
	  ,facebook='".$_POST['fb']."' 
	  ,email='".$_POST['email']."' 
	  WHERE contact_id='$uno' ";
		if(mysqli_query($con, $query1)){
	
			echo  "<script>alert('Link updated Updated!')</script>";
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

        <!-- page content -->
		<div class="right_col" role="main">
		<div id="content">
             
            <div class="inner" style="min-height: 700px;">
		
       <div class="panel panel-default"><br><br>
         <div class="row text-center">
			<hr>
            <h2><b>  Edit Website Information</b></h2>
			<hr>
        </div>
                        




<!--contact sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss-->
		<div class="panel panel-success"  >
              <div class="panel-heading"> Edit Contact Info</div>
			  <div class="panel-body">
                  
		
		<?php 
		$selectuser = "SELECT * FROM contact_tbl";
		$resultuser = mysqli_query($con,$selectuser);
		if(mysqli_num_rows($resultuser) > 0){
		while($rowDep = mysqli_fetch_array($resultuser)){
 ?>
<!--start of apply-->
	
				<!--FORM START-->
					<form class="formPreloader form-horizontal" id="applicationForm"  action="" method="POST" enctype="multipart/form-data">
			
							
					
											
									
	
			<div class="panel-heading">
			  
			</div>
			<div class="panel-collapse ">
			  <div class="panel-body">

						
							<input  type="hidden" name="user_id"  value="<?php echo ucwords($rowDep [0]) ?>"> 
							<textarea rows="4" class="form-control"  name="message" placeholder="Enter Story"  required><?php echo ucfirst($rowDep ['message']) ?></textarea><br><br>
							Address : &ensp;<input class="form-control"    type="text" name="address" placeholder="Website name" value="<?php echo ucwords($rowDep ['address']) ?>" required/> &ensp;
							<br>
							Contact Number : <input class="form-control"   type="number" name="contact" placeholder="Website Address" value="<?php echo $rowDep ['contact_number'] ?>" required/> &ensp;<br>
							Facebook Link : <input class="form-control"   type="text" name="facebook" placeholder="Website Address" value="<?php echo  $rowDep ['facebook'] ?>" required/> &ensp;<br>
							Email : <input class="form-control"   type="email" name="email" placeholder="Website Address" value="<?php echo $rowDep ['email'] ?>" required/> &ensp;<br>
						
							<input name="subcontact" type="submit" value="Submit">
							
							<br><br>
			  </div>
			</div>
		  
		  
		  
		 </form>	
								
														

			
		

		<?php }} ?>
<!--eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee-->




<hr/>










<!--link sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss-->
		<div class="panel panel-default" width="50%" >
              <div class="panel-heading">Edit Link</div>
			  <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="background:#84b56c; color:white;"><div align="center">Name</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Name</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Edit</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Delete</div></th>
      

                                           
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php
				$user_sql = "SELECT * FROM links_tbl";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr>';
						echo '<td><div align="center">'.ucfirst($fetch_user['link_name']).'</div></td>';
						echo '<td><div align="center">'.ucfirst($fetch_user['link_address']).' </div></td>';
						?>  
						<td><div align="center">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#apply<?php echo  $fetch_user [0]; ?>">
										<span class="fa fa-edit"></span> Edit
				</button>
				</div>
				</td>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_website_info.php?del='.$fetch_user[0].'">
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
        <!-- /page content -->

		
		<?php 
		$selectuser = "SELECT * FROM links_tbl";
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
								<h4 class="modal-title" id="myModalLabel"><b><?php  echo ucwords($rowDep ['link_name']);?><b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="positionApplyingFor" value="czoxOiI1Ijs=" />
								<h4 class="formTitle">              </h4>
														
									
	  <div class="panel panel-default">
			<div class="panel-heading">
			  <h3 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
				Link Info
				  
				</a>
			  </h3>
			</div>
			<div class="panel-collapse ">
			  <div class="panel-body">

						
							<input  type="hidden" name="user_id"  value="<?php echo ucwords($rowDep [0]) ?>"> 
							Name : &ensp;<input class="form-control"    type="text" name="name" placeholder="Website name" value="<?php echo ucwords($rowDep ['link_name']) ?>" required/> &ensp;
							<br>
							Address Link : <input class="form-control"   type="text" name="address" placeholder="Website Address" value="<?php echo ucwords($rowDep ['link_address']) ?>" required/> &ensp;<br>
						
							<input name="sub" type="submit" value="Submit">
							
							<br><br>
			  </div>
			</div>
		  </div>
		  
		  
		 </form>	
								
														
														
				</div>
			</div>
			</div>
			</div>
			</div>

		<?php }} ?>

						
						
        <!-- /page content -->

		
 <?php
include('footer.php')
?>