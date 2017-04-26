<?php
require('connection.php');
include('header.php');

if(isset($_POST['editorial_board'])){
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['editor_chief'])."' WHERE staff_position='Editor-in-Chief'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['associate_editor'])."' WHERE staff_position='Associate Editor'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['managing_editor'])."' WHERE staff_position='Managing Editor'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['news_editor'])."' WHERE staff_position='News Editor'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['feature_editor'])."' WHERE staff_position='Feature Editor'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['sports_editor'])."' WHERE staff_position='Sports Editor'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['circulation_manager'])."' WHERE staff_position='Circulation Manager'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['layout_artist'])."' WHERE staff_position='Layout Artist'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['editorial_artist'])."' WHERE staff_position='Editorial Artist'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['head_photojourn'])."' WHERE staff_position='Head Photojournalist'");
mysqli_query($con,"UPDATE staff_tbl SET staff_name= '".mysqli_real_escape_string($con,$_POST['tech_adviser'])."' WHERE staff_position='Technical Adviser'");
echo  "<script>alert('Editorial Board Edited!')</script>";
echo  "<script>window.open('edit_staff.php','_self')</script>";
}

if(isset($_POST['writers'])){
	mysqli_query($con,"INSERT INTO staff_tbl (staff_name, staff_position, staff_group) VALUES
	('".mysqli_real_escape_string($con,$_POST['writer_name'])."','Writer','3')");
	echo  "<script>alert('Writer Added!')</script>";
	echo  "<script>window.open('edit_staff.php#writers','_self')</script>";
}

if(isset($_POST['edit_writer'])){
	mysqli_query($con,"UPDATE staff_tbl SET staff_name='".mysqli_real_escape_string($con,$_POST['writer_edit'])."' 
	WHERE staff_id='".mysqli_real_escape_string($con,$_POST['staff_id'])."'");
	echo  "<script>alert('Writer Edited!')</script>";
	echo  "<script>window.open('edit_staff.php#writers','_self')</script>";
}

if(isset($_GET['del'])){
	 $id = $_GET['del'];
	$run2 = mysqli_query($con, "DELETE FROM staff_tbl WHERE staff_id = '$id'" );
					echo  "<script>alert('Deleted!')</script>";
					echo  "<script>window.open('edit_staff.php','_self')</script>";
	
}

if(isset($_POST['cartoonists'])){
	mysqli_query($con,"INSERT INTO staff_tbl (staff_name, staff_position, staff_group) VALUES
	('".mysqli_real_escape_string($con,$_POST['cartoonist_name'])."','Cartoonist','4')");
	echo  "<script>alert('Cartoonist Added!')</script>";
	echo  "<script>window.open('edit_staff.php#cartoonist','_self')</script>";
}

if(isset($_POST['edit_cartoonist'])){
	mysqli_query($con,"UPDATE staff_tbl SET staff_name='".mysqli_real_escape_string($con,$_POST['cartoonist_edit'])."' 
	WHERE staff_id='".mysqli_real_escape_string($con,$_POST['staff_id'])."'");
	echo  "<script>alert('Cartoonist Edited!')</script>";
	echo  "<script>window.open('edit_staff.php#cartoonist','_self')</script>";
}

if(isset($_POST['photojourn'])){
	mysqli_query($con,"INSERT INTO staff_tbl (staff_name, staff_position, staff_group) VALUES
	('".mysqli_real_escape_string($con,$_POST['photojourn_name'])."','Photojournalist','5')");
	echo  "<script>alert('Photojournalist Added!')</script>";
	echo  "<script>window.open('edit_staff.php#photojourn','_self')</script>";
}

if(isset($_POST['edit_photojourn'])){
	mysqli_query($con,"UPDATE staff_tbl SET staff_name='".mysqli_real_escape_string($con,$_POST['photojourn_edit'])."' 
	WHERE staff_id='".mysqli_real_escape_string($con,$_POST['staff_id'])."'");
	echo  "<script>alert('Photojournalist Edited!')</script>";
	echo  "<script>window.open('edit_staff.php#photojourn','_self')</script>";
}


?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Editorial Board<small>*All fields are required.</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />
			<form method="post" action="" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data">
			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Editor-in-Chief"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Editor-in-Chief<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="editor_chief" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>
			  
			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Associate Editor"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Associate Editor<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="associate_editor" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>

			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Managing Editor"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Managing Editor<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="managing_editor" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>			  

			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="News Editor"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">News Editor<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="news_editor" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>	
			  
			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Feature Editor"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Feature Editor<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="feature_editor" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>			  

			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Sports Editor"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Sports Editor<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="sports_editor" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>	

			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Circulation Manager"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Circulation Manager<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="circulation_manager" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>				  

			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Layout Artist"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Layout Artist<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="layout_artist" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>	
			  
			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Editorial Artist"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Editorial Artist<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="editorial_artist" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>

			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Head Photojournalist"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Head Photojournalist<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="head_photojourn" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>				  
			  
			  <div class="form-group">
			  <?php
				$sql=mysqli_query($con,'SELECT* FROM staff_tbl WHERE staff_position="Technical Adviser"');
				$row=mysqli_fetch_assoc($sql);
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Technical Adviser<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="tech_adviser" class="form-control col-md-7 col-xs-12" value="'.($row['staff_name']).'" required>
				</div>';
			  ?>
			  </div>				  
			   
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="editorial_board" type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>
			</form>
			</div>
		</div>
		  <div class="x_panel">
		   <h2>Edit Writers <small>*All fields are required.</small></h2>
		   <a name="writers"></a>
		   <form method="post" action="" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data">

			  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Add Writer<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="writer_name" class="form-control col-md-7 col-xs-12" placeholder="writer name here" required>
				</div>
			  </div>  
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="writers" type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>
			</form>
			<div class="ln_solid"></div><br/>			
			<table id="datatable-fixed-header" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th style="background:#84b56c; color:white;">Writer Name</th>
				  <th style="background:#84b56c; color:white;">Edit</th>
				  <th style="background:#84b56c; color:white;">Delete</th>
				</tr>
			  </thead>
			  <tbody>
			  <a name="writers"></a>
				<?php				
				$user_sql = "SELECT staff_id,staff_name FROM staff_tbl WHERE staff_position='Writer'";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr><form method="post" action="" id="demo-form2" class="form-horizontal form-label-left">';
						echo '<td align="center"><input type="text" size="70" name="writer_edit" class="form-control" value="'.ucwords($fetch_user['staff_name']).'" required>
							<input type="hidden" name="staff_id" value="'.$fetch_user['staff_id'].'">
						</td>';
						?>  
						<td><div align="center">
						<button type="submit" name="edit_writer" class="btn btn-primary btn-lg">
										<span class="fa fa-edit desktop-home"></span> Edit
				</button>
				</div>
				</td></form>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_staff.php?del='.$fetch_user['staff_id'].'">
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
	
	
		  <div class="x_panel">
		   <h2>Edit Cartoonists <small>*All fields are required.</small></h2>
		   <form method="post" action="edit_staff.php#cartoonists" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data">

			  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Add Cartoonist<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="cartoonist_name" class="form-control col-md-7 col-xs-12" placeholder="cartoonist name here" required>
				</div>
			  </div>  
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="cartoonists" type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>
			</form>
			<div class="ln_solid"></div><br/>			
			<table id="datatable-fixed-header" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th style="background:#84b56c; color:white;">Cartoonist Name</th>
				  <th style="background:#84b56c; color:white;">Edit</th>
				  <th style="background:#84b56c; color:white;">Delete</th>
				</tr>
			  </thead>
			  <tbody>
				<a name="cartoonists"></a>			  
				<?php				
				$user_sql = "SELECT staff_id,staff_name FROM staff_tbl WHERE staff_position='Cartoonist'";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr><form method="post" action="edit_staff.php#cartoonists" id="demo-form2" class="form-horizontal form-label-left">';
						echo '<td align="center"><input type="text" size="70" name="cartoonist_edit" class="form-control" value="'.ucwords($fetch_user['staff_name']).'" required>
							<input type="hidden" name="staff_id" value="'.$fetch_user['staff_id'].'">
						</td>';
						?>  
						<td><div align="center">
						<button type="submit" name="edit_cartoonist" class="btn btn-primary btn-lg">
										<span class="fa fa-edit desktop-home"></span> Edit
				</button>
				</div>
				</td></form>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_staff.php?del='.$fetch_user['staff_id'].'">
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

		
		
		  <div class="x_panel">
		   <h2>Edit Photojournalists <small>*All fields are required.</small></h2>
		   <form method="post" action="edit_staff.php#cartoonists" id="demo-form2" class="form-horizontal form-label-left" enctype="multipart/form-data">

			  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Add Photojournalist<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="photojourn_name" class="form-control col-md-7 col-xs-12" placeholder="photojourn name here" required>
				</div>
			  </div>  
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="photojourn" type="submit" class="btn btn-success">Submit</button>
				</div>
			  </div>
			</form>
			<div class="ln_solid"></div><br/>			
			<table id="datatable-fixed-header" class="table table-striped table-bordered">
			  <thead>
				<tr>
				  <th style="background:#84b56c; color:white;">Photojournalist Name</th>
				  <th style="background:#84b56c; color:white;">Edit</th>
				  <th style="background:#84b56c; color:white;">Delete</th>
				</tr>
			  </thead>
			  <tbody>
				<a name="photojourn"></a>			  
				<?php				
				$user_sql = "SELECT staff_id,staff_name FROM staff_tbl WHERE staff_position='Photojournalist'";
				$run_user = mysqli_query($con,$user_sql);
				if(mysqli_num_rows($run_user) > 0){
				while($fetch_user = mysqli_fetch_array($run_user)){
                        echo '<tr><form method="post" action="edit_staff.php#photojourn" id="demo-form2" class="form-horizontal form-label-left">';
						echo '<td align="center"><input type="text" size="70" name="photojourn_edit" class="form-control" value="'.ucwords($fetch_user['staff_name']).'" required>
							<input type="hidden" name="staff_id" value="'.$fetch_user['staff_id'].'">
						</td>';
						?>  
						<td><div align="center">
						<button type="submit" name="edit_photojourn" class="btn btn-primary btn-lg">
										<span class="fa fa-edit desktop-home"></span> Edit
				</button>
				</div>
				</td></form>
						
						<?php
						echo '<td><div align="center"><a onClick=\'javascript: return confirm("Are you sure you want to delete?");\' href="edit_staff.php?del='.$fetch_user['staff_id'].'">
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
<!-- /page content -->

<?php
include('footer.php')
?>