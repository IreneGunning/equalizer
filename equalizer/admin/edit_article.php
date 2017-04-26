<?php
require('connection.php');
include('header.php');
if(!$_SESSION['admin_email']){
header ("location:login.php");  
}
if(isset($_GET['fea'])){
	 $id = $_GET['fea'];
	  $query1 = "UPDATE `articles_tbl` SET `article_featured` = 'yes' WHERE `articles_tbl`.`article_id` = $id;";
		if(mysqli_query($con, $query1)){
	
			
			}
			else{
			
			}	
	
}


if(isset($_GET['nofea'])){
	 $id = $_GET['nofea'];
	  $query1 = "UPDATE `articles_tbl` SET `article_featured` = 'no' WHERE `articles_tbl`.`article_id` = $id;";
		if(mysqli_query($con, $query1)){
	
			
			}
			else{
			
			}	
	
}

if(isset($_GET['del'])){
	 $id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM articles_tbl WHERE article_id = '$id'" );
					echo  "<script>alert('Article deleted!')</script>";
					echo  "<script>window.open('edit_article.php','_self')</script>";
	
}

if(isset($_POST['editarticle'])){

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
		
					
						
			$query2 = "UPDATE articles_tbl SET 
			
			category_id='".mysql_real_escape_string($_POST['category'])."', 
			article_title='".mysql_real_escape_string($_POST['title'])."',
			article_writer='".mysql_real_escape_string($_POST['writer'])."',
			article_photo='".mysql_real_escape_string($file_name)."',
			
			article_headline='".mysql_real_escape_string($_POST['headline'])."',
			article_story='".mysql_real_escape_string($_POST['story'])."',
			article_date='".mysql_real_escape_string($_POST['date'])."' 
			
			WHERE article_id='".mysql_real_escape_string($_POST['id'])."'";
			
		
		
		
			if(mysqli_query($con, $query2)){
				echo "<script type='text/javascript'> alert('Article Updated!'); window.location.href='edit_article.php';</script>";		
			
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
			move_uploaded_file($file_tmp,"../images/article/".$file_name);
						
						
			$query2 = "UPDATE articles_tbl SET 
			
			category_id='".mysql_real_escape_string($_POST['category'])."', 
			article_title='".mysql_real_escape_string($_POST['title'])."',
			article_writer='".mysql_real_escape_string($_POST['writer'])."',
			article_photo='".mysql_real_escape_string($file_name)."',
			article_headline='".mysql_real_escape_string($_POST['headline'])."',
			article_story='".mysql_real_escape_string($_POST['story'])."',
			article_date='".mysql_real_escape_string($_POST['date'])."' 
			
			WHERE article_id='".mysql_real_escape_string($_POST['id'])."'";
			
		
		
		
			if(mysqli_query($con, $query2)){
				echo "<script type='text/javascript'> alert('Article Updated!'); window.location.href='edit_article.php';</script>";		
			
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
		
		
			$query2 = "UPDATE articles_tbl SET 
			
			category_id='".mysql_real_escape_string($_POST['category'])."', 
			article_title='".mysql_real_escape_string($_POST['title'])."',
			article_writer='".mysql_real_escape_string($_POST['writer'])."',
			article_headline='".mysql_real_escape_string($_POST['headline'])."',
			article_story='".mysql_real_escape_string($_POST['story'])."',
			article_date='".mysql_real_escape_string($_POST['date'])."' 
			
			WHERE article_id='".mysql_real_escape_string($_POST['id'])."'";
			
		
		
		
			if(mysqli_query($con, $query2)){
	
			echo  "<script>alert('Article Updated!')</script>";
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
			<h2>Edit Article</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<p class="text-muted font-13 m-b-30">
			</p>
			<table id="datatable-fixed-header" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th style="background:#84b56c; color:white;">ID</th>
				  <th style="background:#84b56c; color:white;">Title</th>
				  <th style="background:#84b56c; color:white;">Category</th>
				  <th style="background:#84b56c; color:white;">Edit</th>
				  <th style="background:#84b56c; color:white;">Featured</th>
				  <th style="background:#84b56c; color:white;">Delete</th>
				</tr>
			  </thead>
			  <tbody>
				<?php				
				$user_sql = "SELECT * FROM articles_tbl ORDER BY `articles_tbl`.`article_id` DESC";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
					$sqlcat=mysqli_query($con,"SELECT category_name FROM category_tbl WHERE category_id='".$fetch_user['category_id']."'");
					$cat=mysqli_fetch_assoc($sqlcat);
                        echo '<tr>';
						echo '<td><div align="center">'.ucwords($fetch_user['article_id']).'</div></td>';
						echo '<td><div align="center">'.ucwords($fetch_user['article_title']).'</div></td>';
						echo '<td><div align="center">'.ucwords($cat['category_name']).'</div></td>';
						?>  
						<td><div align="center">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#apply<?php echo  $fetch_user [0]; ?>">
										<span class="fa fa-edit desktop-home"></span> Edit
				</button>
				</div>
				</td>
						
						<?php
						
						if($fetch_user['article_featured'] == "no"){
							echo '<td><div align="center"><a onClick=\'javascript: return confirm("Make featured?");\' href="edit_article.php?fea='.$fetch_user[0].'">
							<font  style="color:red;">
							
							<button type="button" class="btn btn-primary btn-lg">
							<i class="fa fa-ban"  style="color:red;"></i>
							
							</button>
							</font></a></div></td>';
						}
						else {
							echo '<td><div align="center"><a onClick=\'javascript: return confirm("Remove from featured?");\' href="edit_article.php?nofea='.$fetch_user[0].'">
							<font  style="color:red;">
							
							<button type="button" class="btn btn-primary btn-lg">
							<i class="fa fa-check"  style="color:#93ea9d;"></i>
							
							</button>
							</font></a></div></td>';
						}
						
						
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_article.php?del='.$fetch_user[0].'">
						<font  style="color:black;">
						
						<button type="button" class="btn btn-primary btn-lg">
						<i class="fa fa-trash-o" ></i>
						
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
$selectuser = "SELECT * FROM articles_tbl";
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
								<h4 class="modal-title" id="myModalLabel"><b><?php  echo ucwords($rowDep ['article_title']);?><b></h4>
							</div>
							<div class="modal-body">
								<input type="hidden" name="positionApplyingFor" value="czoxOiI1Ijs=" />
								<h4 class="formTitle">Information</h4>
			
        <div class="form-group">
            <label for="Category" class="control-label col-md-3 col-sm-3 col-xs-12">
              Category <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			
			<select name="category" class="form-control col-md-7 col-xs-12" >';
								
								<?php
								$categorysql=mysqli_query($con,"SELECT * FROM category_tbl");
								while($categoryrun=mysqli_fetch_assoc($categorysql)){
							    	 echo'<option style="font-size:15px;" value="'.$categoryrun['category_id'].'">'.$categoryrun['category_name']. '&nbsp;&nbsp;</option>';
								}
								 ?>
				</select>
		
              
				<br>
            </div>

        </div>        
        <div class="form-group">
            <label for="Title" class="control-label col-md-3 col-sm-3 col-xs-12">
                Title <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="<?php  echo ucwords($rowDep ['article_id']);?>" placeholder="Enter Title" required/>
                <input type="text" class="form-control col-md-7 col-xs-12" name="title" value="<?php  echo ucwords($rowDep ['article_title']);?>" placeholder="Enter Title" required/>
				<br>
            </div>

        </div>    
		
        <div class="form-group">
            <label for="Title" class="control-label col-md-3 col-sm-3 col-xs-12">
                Writer/Creator <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" name="writer" value="<?php  echo ucwords($rowDep ['article_writer']);?>" placeholder="Enter Writer/Creator" required/>
				<br>
            </div>
        </div>    
		<br/>
      
	         <div class="form-group">
            <label for="uploadimage" class="control-label col-md-3 col-sm-3 col-xs-12">
                Upload Image 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" name="image" id="uploadimage">
                <p class="help-block">
                    Allowed formats: jpeg, jpg, gif, png
                </p>
            </div>          
        </div>
	  
        <div class="form-group">
		
			
            <label for="Headline" class="control-label col-md-3 col-sm-3 col-xs-12">
               Headline <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<textarea rows="4" class="form-control col-md-7 col-xs-12"  name="headline" placeholder="Enter Headline"  required><?php  echo ucwords($rowDep ['article_headline']);?></textarea><br><br>
        
				<br>
              
            </div>
        </div>
	
		
        <div class="form-group">
            <label for="Story" class="control-label col-md-3 col-sm-3 col-xs-12">
               Story <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
			<textarea rows="4" class="form-control col-md-7 col-xs-12"  name="story" placeholder="Enter Story"   required><?php  echo ucwords($rowDep ['article_story']);?></textarea><br><br>
        
				<br>
              
            </div>
        </div>
	
		
		<div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12">
                Date <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="Date" class="form-control col-md-7 col-xs-12" value="<?php  echo ucwords($rowDep ['article_date']);?>" name="date" required/>
				<br>
            </div>
        </div> 
		
 
        
        <div class="row">
            <div class="col-md-10">
                <button name="editarticle" type="submit" class="btn btn-info">
                    Edit Article
                </button>
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