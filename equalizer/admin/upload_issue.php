<?php
require('connection.php');
include('header.php');
if(isset($_POST['submitissue'])){		
				if(
					empty($_POST['name'])  or empty($_POST['type'])  
					or empty($_FILES["files"]["name"])){
					echo	"<script>alert('Please fillup all fields.')</script>";}
					
				else {
					$type = mysql_real_escape_string($_POST['type']); 
					$name = mysql_real_escape_string($_POST['name']);
					$date = mysql_real_escape_string($_POST['date']);
					$files = mysql_real_escape_string($_FILES["files"]["name"]);
			
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
		if(file_exists($locss)){
		
			list($namess, $exts) = explode('.', $file_names);		
			while(file_exists($locss)) {		
			$increments++;
			// $loc is now "userpics/example1.jpg"
			
			$locsa = $namess. $increment . '.' . $file_exts;
			$file_names = $namess. $increments . '.' . $file_exts;
			$locss = "../files/$file_names";
		}}
		
		if(file_exists($loc)){
			
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
								  
								  $insertquest = "INSERT INTO `issue_tbl`(`issue_type_id`, `issue_name`, `issue_date`,  `issue_photo`, `issue_file`) 
									VALUES ('$type','$name','$date','".$file_name."','$file_names')";
									if(mysqli_query($con,$insertquest)){
										echo  "<script>alert('Issue Added')</script>";
									}
									
									else {
										echo  "<script>alert('Application error.')</script>";
									}

								 }
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
									echo	"<script>alert('File already exists1.')</script>";
					
								 }
								 
								else {
								  move_uploaded_file($_FILES["files"]["tmp_name"],"../files/" . $_FILES["files"]["name"]);
								  
								  $insertquest = "INSERT INTO `issue_tbl`(`issue_type_id`, `issue_name`, `issue_date`,  `issue_photo`, `issue_file`) 
									VALUES ('$type','$name','$date','".$file_name."','$files')";
									if(mysqli_query($con,$insertquest)){
										echo  "<script>alert('Issue Added')</script>";
									}
									
									else {
										echo  "<script>alert('Application error.')</script>";
									}

								 }
							}
					 }
					else {
						echo	"<script>alert('Invalid file.')</script>";
					 }	
		}
		
		else{
			print_r($errors);
		}
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
			<h2>Upload Issue<small>*All fields are required.</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />
 <form method="POST" action="" enctype="multipart/form-data" id="demo-form2" class="form-horizontal form-label-left"  >
	   
        <div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12">
               Issue Type:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			
              <select name="type" class="form-control col-md-7 col-xs-12" >';
								
								<?php
								$issuesql=mysqli_query($con,"SELECT * FROM issue_type_tbl");
								while($issuerun=mysqli_fetch_assoc($issuesql)){
							    	 echo'<option style="font-size:15px;" value="'.$issuerun['issue_type_id'].'">'.$issuerun['issue_type_name']. '&nbsp;&nbsp;</option>';
								}
								 ?>
				</select>
				
				<br>
            </div>
        </div>        
      
        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">
               Name:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" name="name" placeholder="Enter issue name" required/>
        
				<br>
            </div>
        </div>
		
		<div class="form-group">
            <label for="date" class="control-label col-md-3 col-sm-3 col-xs-12">
                Date:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" class="form-control col-md-7 col-xs-12" name="date" placeholder="yyyy/mm/dd" required/>
				<br>
            </div>

        </div> 
		<br/>
        <div class="form-group">
            <label for="uploadfile" class="control-label col-md-3 col-sm-3 col-xs-12">
                Upload File:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<input id="fileToUpload" name="files" type="file" required/>
             
                <p class="help-block">
                    Allowed extensions: .PDF, .DOC, .DOCX, .XLS, .PPT<br />
					Maximum file size: 25MB
                </p>
            </div>          
        </div>
		
        <div class="form-group">
            <label for="uploadimage" class="control-label col-md-3 col-sm-3 col-xs-12">
                Upload Image:
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<input id="fileToUpload" name="image" type="file" required/>
             
                <p class="help-block">
                    Allowed extensions: jpeg, jpg, gif, png	<br />
					Maximum file size: 3MB
                </p>
            </div>          
        </div>

			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="submitissue" type="submit" class="btn btn-success">Submit</button>
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