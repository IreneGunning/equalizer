<?php
require('connection.php');
include('header.php');
if(isset($_POST['announce'])){
	if($_FILES['image']['size'] != 0 ){
		$filen =$_FILES['image'];
		$errors= array();
		$file_name = $filen['name'];
		$file_size =$filen['size'];
		$file_tmp =$filen['tmp_name'];
		$file_type=$filen['type'];   
		$file_ext=strtolower(end(explode('.',$filen['name'])));
		$loc = "../images/announcement/$file_name";
		if(file_exists($loc)){
			$increment = 0;
			list($name, $ext) = explode('.', $file_name);		
			while(file_exists($loc)) {		
			$increment++;
			// $loc is now "userpics/example1.jpg"
			$loc = $name. $increment . '.' . $file_ext;
			$file_name = $name. $increment . '.' . $file_ext;
			}
		// Now you're trying to move the uploaded file to "userpics/$loc"
		//   which expands to "userpics/userpics/example1.jpg"
		move_uploaded_file($filen["tmp_name"],"../images/announcement/$loc");
		
		$sq  = "INSERT INTO `announcement_tbl` (`announce_id`, `announce_name`, `announce_photo`, `announce_story`, `announce_date`) VALUES (NULL, '".$_POST['announce_name']."', '".$file_name."', '".$_POST['story']."', '".$_POST['date']."')";	
			if(mysqli_query($con, $sq)){
				echo "<script type='text/javascript'> alert('New announcement added!'); window.location.href='post_announcement.php';</script>";		
			
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
			$sq  = "INSERT INTO `announcement_tbl` (`announce_id`, `announce_name`, `announce_photo`, `announce_story`, `announce_date`) VALUES (NULL, '".mysqli_real_escape_string($con,$_POST['announce_name'])."', '".$file_name."', '".mysqli_real_escape_string($con, $_POST['story'])."', '".$_POST['date']."')";	
			if(mysqli_query($con, $sq)){
				echo "<script type='text/javascript'> alert('New announcement added!'); window.location.href='post_announcement.php';</script>";		
			
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
			$sq  = "INSERT INTO `announcement_tbl` (`announce_id`, `announce_name`,  `announce_story`, `announce_date`) 	 VALUES (NULL, '".$_POST['announce_name']."', '".$_POST['story']."', '".$_POST['date']."')";	
			if(mysqli_query($con, $sq)){
			echo "<script type='text/javascript'> alert('New announcement added!'); window.location.href='post_announcement.php';</script>";		
			
			}
			else{
				echo "<script type='text/javascript'> alert('Error please contact us!');</script>";		
			}
		}
}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Post Announcement<small>*All fields are required.</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />
			<form method="post" action="" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data">

			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Announcement Title<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="announce_name" placeholder="Enter Announcement Title" class="form-control col-md-7 col-xs-12" required>
				</div>
			  </div>
			  <div class="form-group">
				<label rows="4" class="control-label col-md-3 col-sm-3 col-xs-12" for="story">Story<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <textarea name="story" class="form-control col-md-7 col-xs-12" placeholder="Enter Story" required></textarea>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="date" name="date" required="required" class="form-control col-md-7 col-xs-12" placeholder="yyyy/mm/dd">
				</div>
			  </div>
			  <br/>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploadimage">Upload Image<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="file" name="image" id="uploadimage">
                  <p class="help-block">
                    Allowed formats: jpeg, jpg, gif, png
                  </p>
				</div>
			  </div>			  
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="announce" type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
</div>
<!-- /page content -->

<?php
include('footer.php')
?>