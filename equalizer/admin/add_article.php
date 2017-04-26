<?php
require('connection.php');
include('header.php'); 
if(isset($_POST['Subarticle'])  ){

	
	if($_FILES['image']['size'] != 0 ){
		$filen = $_FILES['image'];
		$errors= array();
		$file_name = $filen['name'];
		$file_size =$filen['size'];
		$file_tmp =$filen['tmp_name'];
		$file_type=$filen['type'];   
		$file_ext=strtolower(end(explode('.',$filen['name'])));
		$loc = "../images/article/$file_name";

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
		move_uploaded_file($filen["tmp_name"],"../images/article/$loc");
		
					
						
			$sq  = "INSERT INTO `articles_tbl` (`category_id`, `article_title`, `article_writer`, `article_photo`, `article_headline`, `article_story`, `article_date`) VALUES 
			( '".mysql_real_escape_string($_POST['category'])."', '".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['writer'])."', '".mysql_real_escape_string($file_name)."',
			'".mysql_real_escape_string($_POST['headline'])."', '".mysql_real_escape_string($_POST['story'])."', '".mysql_real_escape_string($_POST['date'])."')";
			
			
					if(mysqli_query($con, $sq)){
				echo "<script type='text/javascript'> alert('New Article Added!'); window.location.href='add_article.php';</script>";		
			
			}
			else{
				echo "<script type='text/javascript'> alert('Error please contact us1!');</script>";		
			}
			
		}
		else{
		$expensions= array("jpeg","jpg","png",""); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 2097152){
		$errors[]='File size must be at least 2 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../images/article/".$file_name);
						
						
			$sq  = "INSERT INTO `articles_tbl` (`category_id`, `article_title`, `article_writer`, `article_photo`, `article_headline`, `article_story`, `article_date`) VALUES 
			( '".mysql_real_escape_string($_POST['category'])."', '".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['writer'])."', '".mysql_real_escape_string($file_name)."',
			'".mysql_real_escape_string($_POST['headline'])."', '".mysql_real_escape_string($_POST['story'])."', '".mysql_real_escape_string($_POST['date'])."')";
			
			
			if(mysqli_query($con, $sq)){
				echo "<script type='text/javascript'> alert('New Article Added!'); window.location.href='add_article.php';</script>";		
			
			}
			else{
				echo "<script type='text/javascript'> alert('Error please contact us2!');</script>";		
			}
		}else{
			print_r($errors);
		}
		}
	}	
	
	
	
	else{

			$sq  = "INSERT INTO `articles_tbl` (`category_id`, `article_title`, `article_writer`, `article_headline`, `article_story`, `article_date`) VALUES 
			( '".mysql_real_escape_string($_POST['category'])."', '".mysql_real_escape_string($_POST['title'])."', '".mysql_real_escape_string($_POST['writer'])."',
			'".mysql_real_escape_string($_POST['headline'])."', '".mysql_real_escape_string($_POST['story'])."', '".mysql_real_escape_string($_POST['date'])."')";
	
			if(mysqli_query($con, $sq)){
			echo "<script type='text/javascript'> alert('New Article added!'); window.location.href='add_article.php';</script>";		
			
			}
			else{
				echo "<script type='text/javascript'> alert('Error please contact us3!');</script>";		
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
			<h2>Add Article<small>*All fields are required.</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />

            <form method="POST" action="" enctype="multipart/form-data" id="demo-form2" class="form-horizontal form-label-left">
                <div class="form-group">
                    <label for="Category" class="control-label col-md-3 col-sm-3 col-xs-12">
              Category <span class="required">*</span>
            </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <select name="category" class="form-control">';
								
								<?php
								$categorysql=mysqli_query($con,"SELECT * FROM category_tbl");
								while($categoryrun=mysqli_fetch_assoc($categorysql)){
							    	 echo'<option style="font-size:15px;" value="'.$categoryrun['category_id'].'">'.$categoryrun['category_name']. '&nbsp;&nbsp;</option>';
								}
								 ?>
				</select>
                    </div>
                </div>




                <div class="form-group">
                    <label for="Title" class="control-label col-md-3 col-sm-3 col-xs-12">
                Title <span class="required">*</span>
            </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="title" placeholder="Enter Title" required/>
                        <br>
                    </div>

                </div>

                <div class="form-group">
                    <label for="Title" class="control-label col-md-3 col-sm-3 col-xs-12">
                Writer/Creator <span class="required">*</span>
                  </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="writer" placeholder="Enter Writer/Creator" required/>
                    </div>

                </div>
				<br/>

                <div class="form-group">
                    <label for="uploadimage" class="control-label col-md-3 col-sm-3 col-xs-12">
                Upload Image <span class="required">*</span>
                   </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" name="image" id="uploadimage" required/>
                        <p class="help-block">
                            Allowed formats: jpeg, jpg, gif, png
                        </p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Headline" class="control-label col-md-3 col-sm-3 col-xs-12">
               Lead/Caption <span class="required">*</span>
            </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea rows="4" class="form-control" name="headline" placeholder="Enter Headline" required></textarea><br><br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Story" class="control-label col-md-3 col-sm-3 col-xs-12">
               Story <span class="required">*</span>
            </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea rows="4" class="form-control" name="story" placeholder="Enter Story" required></textarea><br><br>
                    </div>

                </div>


                <div class="form-group">
                    <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12">
                Date <span class="required">*</span>
            </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="Date" class="form-control" name="date" placeholder="yyyy/mm/dd" required/>
                    </div>

                </div>
				<br/>


			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="Subarticle" type="submit" class="btn btn-success">Submit</button>
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