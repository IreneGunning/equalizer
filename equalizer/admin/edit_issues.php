<?php
require('connection.php');
include('header.php');
$email=$_SESSION['admin_email'];


if(isset($_GET['del'])){
	$id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM issue_tbl WHERE issue_id = '$id'" );
					echo  "<script>alert('Issue deleted!')</script>";
					echo  "<script>window.open('edit_issues.php','_self')</script>";
	
}
	if(isset($_POST['updateissue'])){	
	//image and file	
		if($_FILES['image']['size'] != 0 or $_FILES['files']['size'] != 0 ){

			if(
					empty($_POST['name'])  or empty($_POST['type']) or empty($_POST['date'])  
					){
					echo	"<script>alert('Please fillup all fields.')</script>";}
					
				else {			
					$type = mysqli_real_escape_string($con, $_POST['type']); 
					$name = mysqli_real_escape_string($con, $_POST['name']);
					$date = mysqli_real_escape_string($con, $_POST['date']);
					$files = mysqli_real_escape_string($con, $_FILES["files"]["name"]);
			
					$allowedExts = array("doc", "docx", "pdf", "xls", "ppt");
					$extension = end(explode(".", $_FILES["files"]["name"]));		
				$filen = $_FILES['image'];
				$errors= array();
				$file_name = $filen['name'];
				$file_size =$filen['size'];
				$file_tmp =$filen['tmp_name'];
				$file_type=$filen['type'];   
				$file_ext=strtolower(end(explode('.',$filen['name'])));
				$loc = "../files/preview/$file_name";
				$increment = 0;
				
				$filens = $_FILES['files'];
				$errorss= array();
				$file_names = $filens['name'];
				$file_sizes =$filens['size'];
				$file_tmps =$filens['tmp_name'];
				$file_types=$filens['type'];   
				$file_exts=strtolower(end(explode('.',$filens['name'])));
				$locss = "../files/$file_names";
				$increments = 0;
	//------------------image		
				if(file_exists($loc)){
					if($_FILES['image']['size'] != 0 ){
					list($names, $ext) = explode('.', $file_name);		
					while(file_exists($loc)) {		
					$increment++;
					// $loc is now "userpics/example1.jpg"
					
					$locsa = $names. $increment . '.' . $file_ext;
					$file_name = $names. $increment . '.' . $file_ext;
					$loc = "../files/preview/$file_name";
					}
				
				// Now you're trying to move the uploaded file to "userpics/$loc"
				//   which expands to "userpics/userpics/example1.jpg"
				move_uploaded_file($filen["tmp_name"],"../files/preview/$locsa");
					}
						
	//------------------------------------------------------------------image					
		
	//------------------------------------------------------------------file			
			if(file_exists($locss)){
					if($_FILES['files']['size'] != 0 ){
						list($namess, $exts) = explode('.', $file_names);		
						while(file_exists($locss)) {		
						$increments++;
						// $loc is now "userpics/example1.jpg"
						
						$locsa = $namess. $increment . '.' . $file_exts;
						$file_names = $namess. $increments . '.' . $file_exts;
						$locss = "../files/$file_names";
				}}}
			
				if (($_FILES["files"]["type"] == "application/pdf")
								|| ($_FILES["files"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
								|| ($_FILES["files"]["type"] == "application/vnd.ms-excel")
								|| ($_FILES["files"]["type"] == "application/vnd.ms-powerpointtd>")
								&& ($_FILES["files"]["size"] < 2000000)
								&& in_array($extension, $allowedExts)){
									if ($_FILES["files"]["error"] > 0){
										echo "Return Code: " . $_FILES["files"]["error"] . "<br>";
									}
									else {
										 "Upload: " . $_FILES["files"]["name"] . "<br>";
										 "Type: " . $_FILES["files"]["type"] . "<br>";
										 "Size: " . ($_FILES["files"]["size"] / 200000) . " kB<br>";
										 "Temp file: " . $_FILES["files"]["tmp_name"] . "<br>";

										if (file_exists("../files/" . $file_names)) {
											echo	"<script>alert('File already exists.')</script>";
										
										 }
										else {
										  move_uploaded_file($_FILES["files"]["tmp_name"],"../files/" . $file_names);
										  
										  
										  
										  
										  //image and file	
										if($_FILES['image']['size'] != 0 and $_FILES['files']['size'] != 0 ){
												 $query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
												issue_date='".mysqli_real_escape_string($con, $_POST['date'])."',
												issue_photo='".mysqli_real_escape_string($con, $file_name)."',
												issue_file='".mysqli_real_escape_string($con, $file_names)."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
												
												if(mysqli_query($con, $query2)){
										
												echo  "<script>alert('Issue Updated!')</script>";
												}
												else{
												echo  "<script>alert('You have an errorl!!!')</script>";
												}  
										}  
										//file			
										else if($_FILES['files']['size'] != 0 ){		
												 $query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
												issue_date='".mysqli_real_escape_string($con, $_POST['date'])."',
												
												issue_file='".mysqli_real_escape_string($con, $file_names)."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
												
												if(mysqli_query($con, $query2)){
										
												echo  "<script>alert('Issue Updated!')</script>";
												}
												else{
												echo  "<script>alert('You have an errorl!!!')</script>";
												}  
										}  
										  
										 //image			
										else if($_FILES['image']['size'] != 0 ){		
												 $query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
												issue_date='".mysqli_real_escape_string($con, $_POST['date'])."',
												issue_photo='".mysqli_real_escape_string($con, $file_name)."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
												
												if(mysqli_query($con, $query2)){
										
												echo  "<script>alert('Issue Updated!')</script>";
												}
												else{
												echo  "<script>alert('You have an errorl!!!')</script>";
												}   
										}  

										 }
									}
							 }
  
										 //image			
										 else if($_FILES['image']['size'] != 0 ){		
												 $query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
												issue_date='".mysqli_real_escape_string($con, $_POST['date'])."',
												issue_photo='".mysqli_real_escape_string($con, $file_name)."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
												
												if(mysqli_query($con, $query2)){
										
												echo  "<script>alert('Issue Updated!')</script>";
												}
												else{
												echo  "<script>alert('You have an errorl!!!')</script>";
												}   
										}  

							else {
								echo	"<script>alert('Invalid file.')</script>";
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
					move_uploaded_file($file_tmp,"../files/preview/".$file_name);

					if (($_FILES["files"]["type"] == "application/pdf")
								|| ($_FILES["files"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
								|| ($_FILES["files"]["type"] == "application/vnd.ms-excel")
								|| ($_FILES["files"]["type"] == "application/vnd.ms-powerpointtd>")
								&& ($_FILES["files"]["size"] < 2000000)
								&& in_array($extension, $allowedExts)){
									if ($_FILES["files"]["error"] > 0){
										echo "Return Code: " . $_FILES["files"]["error"] . "<br>";
									}
									else {
										 "Upload: " . $_FILES["files"]["name"] . "<br>";
										 "Type: " . $_FILES["files"]["type"] . "<br>";
										 "Size: " . ($_FILES["files"]["size"] / 200000) . " kB<br>";
										 "Temp file: " . $_FILES["files"]["tmp_name"] . "<br>";		
										if (file_exists("../files/" . $file_names)) {
											echo	"<script>alert('1File already exists.')</script>";
							
										 }
										 
										else {
										  move_uploaded_file($_FILES["files"]["tmp_name"],"../files/" . $_FILES["files"]["name"]);
										  
												 $query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
												issue_date='".mysqli_real_escape_string($con, $_POST['date'])."',
												issue_photo='".mysqli_real_escape_string($con, $file_name)."',
												issue_file='".mysqli_real_escape_string($con, $file_names)."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
												
												if(mysqli_query($con, $query2)){
										
												echo  "<script>alert('Isssue Updated!')</script>";
												}
												else{
												echo  "<script>alert('You have an errorl!!!')</script>";
												}

										 }
									}
							 }
							 	 else if($_FILES['image']['size'] != 0 ){		
												 $query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
												issue_date='".mysqli_real_escape_string($con, $_POST['date'])."',
												issue_photo='".mysqli_real_escape_string($con, $file_name)."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
												
												if(mysqli_query($con, $query2)){
										
												echo  "<script>alert('Issue Updated!')</script>";
												}
												else{
												echo  "<script>alert('You have an errorl!!!')</script>";
												}   
				}  
							 
							 
							else {
								echo	"<script>alert('1Invalid file.')</script>";
							 }

				}
				
				else{
					print_r($errors);
				}
				}
			
						
				}

		
		}
	
	else{
			$query2 = "UPDATE issue_tbl SET issue_type_id='".mysqli_real_escape_string($con, $_POST['type'])."', issue_name='".mysqli_real_escape_string($con, $_POST['name'])."',
			issue_date='".mysqli_real_escape_string($con, $_POST['date'])."' WHERE issue_id='".mysqli_real_escape_string($con, $_POST['id'])."'";
			
			if(mysqli_query($con, $query2)){
	
			echo  "<script>alert('Announcement Updated!')</script>";
			}
			else{
			echo  "<script>alert('You have an errorl!!!')</script>";
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
			<h2>View/Edit Issues</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<p class="text-muted font-13 m-b-30">
			</p><br/>
                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="background:#84b56c; color:white;"><div align="center">Name</div></th>
												<th style="background:#84b56c; color:white;"><div align="center">Issue Type</div></th>
												<th style="background:#84b56c; color:white;"><div align="center">Date</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Edit</div></th>
                                                <th style="background:#84b56c; color:white;"><div align="center">Delete</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
				<?php
				$user_sql = "SELECT * FROM issue_tbl ORDER BY issue_id desc";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
					$isql=mysqli_query($con,"SELECT * FROM issue_type_tbl WHERE issue_type_id='".$fetch_user['issue_type_id']."'");
                    $iname=mysqli_fetch_assoc($isql);
					$idate=date("M d, Y", strtotime($fetch_user['issue_date']));
						echo '<tr>';
						echo '<td><div align="center">'.ucwords($fetch_user['issue_name']).'</div></td>';
						echo '<td><div align="center">'.ucwords($iname['issue_type_name']).'</div></td>';
						echo '<td><div align="center">'.$idate.'</div></td>';
						?>  
						<td><div align="center">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#apply<?php echo  $fetch_user [0]; ?>">
										<span class="fa fa-edit"></span> Edit
				</button>
				</div>
				</td>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_issues.php?del='.$fetch_user[0].'">
						<font  style="color:black;">
						
						<button type="button" class="btn btn-primary btn-lg">
						<i style class="fa fa-trash-o"></i>
						
						</button>
						</font></a></div></td>';
				
				echo '</tr>';
				}}?>								 					   
					</tbody>
               </table><br/>
			   
		  </div>
		</div>
	  </div>
	</div>
</div>
<!-- /page content -->

<?php 
$selectuser = "SELECT * FROM issue_tbl";
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
								<h4 class="modal-title" id="myModalLabel"><b><?php  echo ucwords($rowDep ['issue_name']);?><b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="positionApplyingFor" value="czoxOiI1Ijs=" />
								<h4 class="formTitle">Information</h4>
														
														
														
														
			 <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="<?php  echo ucwords($rowDep ['issue_id']);?>" placeholder="Enter Announce Name">
               
       
	   
        <div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12">
               Issue Type <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			
              <select name="type" class="form-control col-md-7 col-xs-12"  value="2">';
								
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM issue_type_tbl");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
							    	 echo'<option style="font-size:15px;" value="'.$issuerun['issue_type_id'].'">'.$issuerun['issue_type_name']. '&nbsp;&nbsp;</option>';
								}
								 ?>
				</select>

            </div>

        </div>        
      
        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">
               Name <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" name="name"  value="<?php  echo ucwords($rowDep ['issue_name']);?>" placeholder="Enter issue name" required/>

            </div>

        </div>
	
		
		<div class="form-group">
            <label for="date" class="control-label col-md-3 col-sm-3 col-xs-12">
                Date <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" class="form-control col-md-7 col-xs-12" name="date"  value="<?php  echo ucwords($rowDep ['issue_date']);?>" placeholder="mm/dd/yyyy" required/>
            </div>
        </div> 
		<br/>
        <div class="form-group">
            <label for="uploadfile" class="control-label col-md-3 col-sm-3 col-xs-12">
                Upload File:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<input id="fileToUpload" name="files" type="file">
             
                <p class="help-block">
                    Allowed extensions: .PDF, .DOC, .DOCX, .XLS, .PPT, .PPTX<br />
					Maximum file size: 25MB
                </p>
            </div>          
        </div>
		
        <div class="form-group">
            <label for="uploadimage" class="control-label col-md-3 col-sm-3 col-xs-12">
                Upload Image:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<input id="fileToUpload" name="image" type="file">
             
                <p class="help-block">
                    Allowed extensions: jpeg, jpg, gif, png	<br />
					Maximum file size: 5MB
                </p>
            </div>          
        </div>
        
        <div class="row">
            <div class="control-label col-md-3 col-sm-3 col-xs-12">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <button name="updateissue" type="submit" class="btn btn-info">
                    Update Issue
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