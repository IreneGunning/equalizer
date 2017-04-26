<?php
require('connection.php');
include('header.php');
if(isset($_POST['AddAdmin'])){
	$sq="INSERT INTO `admin_tbl` (`admin_username`, `admin_email`, `admin_password`, `secret_question`, `answer`) VALUES ('".$_POST['username']."','".$_POST['email']."','".md5($_POST['pass'])."','".$_POST['secquest']."','".$_POST['answer']."')";
	if(mysqli_query($con, $sq)){
		echo "<script type='text/javascript'> alert('New admin added!'); window.location.href='add_admin.php';</script>";			
	}
	else{
		echo "<script type='text/javascript'> alert('Error Email already exists!');</script>";		
	}
}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Add New Admin<small>*All fields are required.</small></h2>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
			<br />
						
       <form method="POST" action="" enctype="multipart/form-data" id="demo-form2" class="form-horizontal form-label-left">
        <div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12">
                Username <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" name="username" placeholder="Enter Full Name" required/>
            </div>
        </div>        
        <div class="form-group">
            <label for="emailaddress" class="control-label col-md-3 col-sm-3 col-xs-12">
                Email address <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="Enter email address" required/>
                <p class="help-block">
                    Example: yourname@domain.com
                </p>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">
                Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" class="form-control col-md-7 col-xs-12" name="pass" placeholder="Enter Password" required/>
                <p class="help-block">
                    Min: 6 characters (Alphanumeric only)
                </p>
            </div>
        </div>
		 <div class="form-group">
            <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">
               Retype Password <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" class="form-control col-md-7 col-xs-12" name="confirm" placeholder="Enter Password Again" required/>     
            </div>
        </div>
		
        <div class="form-group">
            <label for="secquest" class="control-label col-md-3 col-sm-3 col-xs-12">
                Security Question <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="secquest" id="secquest" class="form-control col-md-7 col-xs-12">
				
                   
                    <?php
								

								$question=mysqli_query($con,"SELECT question FROM security_question_tbl");
								while($quest=mysqli_fetch_assoc($question)){
							    	 echo'<option style="font-size:15px;" value="'.$quest['question'].'">'.$quest['question']. '&nbsp;&nbsp;</option>';
								}
								 ?>
                </select>
            </div>            
        </div>
		
		<div class="form-group">
            <label for="firstname" class="control-label col-md-3 col-sm-3 col-xs-12">
                Answer <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" name="answer" placeholder="Enter answer" required/>
            </div>
        </div> 
            <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				  <button class="btn btn-primary" type="button">Cancel</button>
				  <button class="btn btn-primary" type="reset">Reset</button>
				  <button name="AddAdmin" type="submit" class="btn btn-success">Submit</button>
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