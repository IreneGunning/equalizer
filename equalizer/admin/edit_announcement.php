<?php
require('connection.php');
include('header.php');
if(!$_SESSION['admin_email']){
header ("location:login.php");  
}
$email=$_SESSION['admin_email'];
if(isset($_GET['del'])){
	$id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM announcement_tbl WHERE announce_id = '$id'" );
					echo  "<script>alert('Announcement deleted!')</script>";
					echo  "<script>window.open('edit_announcement.php','_self')</script>";
	
}
if(isset($_POST['announce'])){
	if($_FILES['image']['size'] != 0 ){
		$filen = $_FILES['image'];
		$errors= array();
		$file_name = $filen['name'];
		$file_size =$filen['size'];
		$file_tmp =$filen['tmp_name'];
		$file_type=$filen['type'];   
		$file_ext=strtolower(end(explode('.',$filen['name'])));
		$loc = "../images/announcement/$file_name";		
		$increment = 0;
		if(file_exists($loc)){
			
			list($names, $ext) = explode('.', $file_name);		
			while(file_exists($loc)) {		
			$increment++;
			// $loc is now "userpics/example1.jpg"
			
			$locsa = $names. $increment . '.' . $file_ext;
			$file_name = $names. $increment . '.' . $file_ext;
			$loc = "../images/announcement/$file_name";
			}
		

		// Now you're trying to move the uploaded file to "userpics/$loc"
		//   which expands to "userpics/userpics/example1.jpg"
		move_uploaded_file($filen["tmp_name"],"../images/announcement/$locsa");
		
					
						
			$sq = "UPDATE announcement_tbl SET announce_name='".mysql_real_escape_string($_POST['announce_name'])."', announce_photo='".mysql_real_escape_string($file_name)."', announce_story='".mysql_real_escape_string($_POST['story'])."',
			announce_date='".mysql_real_escape_string($_POST['date'])."' WHERE announce_id='".mysql_real_escape_string($_POST['id'])."'";
			
			
					if(mysqli_query($con, $sq)){
				echo "<script type='text/javascript'> alert('Announcement Updated!'); window.location.href='edit_announcement.php';</script>";		
			
			}
			else{
				echo "<script type='text/javascript'> alert('Error please contact us!');</script>";		
			}
			
		}
		else{
		$expensions= array("jpeg","jpg","png",""); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 2097152){
		$errors[]='File size must be excately 2 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../images/announcement/".$file_name);
						
						
			$sq = "UPDATE announcement_tbl SET announce_name='".mysql_real_escape_string($_POST['announce_name'])."', announce_name='".mysql_real_escape_string($file_name)."', announce_story='".mysql_real_escape_string($_POST['story'])."',
			announce_date='".mysql_real_escape_string($_POST['date'])."' WHERE announce_id='".mysql_real_escape_string($_POST['id'])."'";
			
			
			if(mysqli_query($con, $sq)){
				echo "<script type='text/javascript'> alert('Announcement Updated!'); window.location.href='edit_announcement.php';</script>";		
			
			}
			else{
				echo "<script type='text/javascript'> alert('Error please contact us!');</script>";		
			}
		}else{
			print_r($errors);
		}
		}
	}	
	
	
	
	else{
			$query2 = "UPDATE announcement_tbl SET announce_name='".mysql_real_escape_string($_POST['announce_name'])."', announce_story='".mysql_real_escape_string($_POST['story'])."',
			announce_date='".mysql_real_escape_string($_POST['date'])."' WHERE announce_id='".mysql_real_escape_string($_POST['id'])."'";
			
			if(mysqli_query($con, $query2)){
	
			echo  "<script>alert('Announcement Updated!')</script>";
			}
			else{
			echo  "<script>alert('You have an error!!!')</script>";
			}

		}


//, announce_photo='".$_POST['email']."'
	 	
	
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
				  <th style="background:#84b56c; color:white;">Announcement ID</th>
				  <th style="background:#84b56c; color:white;">Announcement Title</th>
				  <th style="background:#84b56c; color:white;">Edit</th>
				  <th style="background:#84b56c; color:white;">Delete</th>
				</tr>
			  </thead>
			  <tbody>
			  <?php
				$user_sql = "SELECT * FROM announcement_tbl ORDER BY announce_id desc";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr>';
						echo '<td><div align="center">'.ucwords($fetch_user['announce_id']).'</div></td>';
						echo '<td><div align="center">'.ucwords($fetch_user['announce_name']).'</div></td>';
			  ?>  

				  <td><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#apply<?php echo  $fetch_user [0]; ?>">
										<span class="fa fa-edit"></span> Edit
				</button></td>
				 						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_announcement.php?del='.$fetch_user[0].'">
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
		$selectuser = "SELECT * FROM announcement_tbl";
		$resultuser = mysqli_query($con,$selectuser);
		if(mysqli_num_rows($resultuser) > 0){
		while($rowDep = mysqli_fetch_array($resultuser)){
 ?>
<!--start of apply-->
			<div class="modal fade"  id="apply<?php echo $rowDep [0]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">

				<!--FORM START-->
					<form id="demo-form2" class="form-horizontal form-label-left"  action="" method="POST" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header">
							
								<button type="submit" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel"><b><?php  echo ucwords($rowDep ['announce_name']);?><b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="positionApplyingFor" value="czoxOiI1Ijs=" />
								<h4 class="formTitle">Information</h4>
														
														
														
														
			 <input type="hidden" class="form-control" name="id" value="<?php  echo ucwords($rowDep ['announce_id']);?>" placeholder="Enter Announce Name" required/>
               
        <div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12" >
                Announce Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" name="announce_name" value="<?php  echo ucwords($rowDep ['announce_name']);?>" placeholder="Enter Announce Name" required/>
				<br>
            </div>
        </div>        
      
        <div class="form-group">
            <label for="emailaddress" class="control-label col-md-3 col-sm-3 col-xs-12" >
               Story <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<textarea rows="4" class="form-control col-md-7 col-xs-12"  name="story"  placeholder="Enter Story"  required><?php  echo $rowDep ['announce_story']; ?></textarea><br><br>
				<br>
              
            </div>
        </div>
	
		
		<div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12" >
                Date <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" class="form-control col-md-7 col-xs-12" value="<?php  echo $rowDep ['announce_date']; ?>" name="date"  required/>
				<br>
            </div>
        </div> 
		
        <div class="form-group">
            <label for="uploadimage" class="control-label col-md-3 col-sm-3 col-xs-12" >
                Upload Image 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="image" id="uploadimage">
                <p class="help-block">
                    Allowed formats: jpeg, jpg, gif, png
                </p>
            </div>          
        </div>
        
        <div class="row">
            <div class="col-md-10">
                <button name="announce" type="submit" class="btn btn-info">
                   Update Announcement
                </button>
            </div>
        </div>
		</div>
		</div>
		</form>													
	    </div>
        </div>
		 

		<?php }} ?>
<?php
include('footer.php')
?>