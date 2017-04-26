<?php include'connection.php';
if(!isset($_GET['artnum'])){
 $_GET['artnum'] = 0;
}

if(isset($_POST["search"])){

?>

<div class="single_page">
								<ol class="breadcrumb">						  
									<li><a > Search Result</a></li>
								</ol>
									<?php
									$start=0;
									$limit=10;

									if(isset($_GET['id']))
									{
										$id=$_GET['id'];
										$start=($id-1)*$limit;
									}
									else{
										$id=1;
									}
									$result3=mysqli_query($con, "SELECT * FROM articles_tbl where article_title LIKE '%".$_POST["search"]."%' or article_writer LIKE '%".$_POST["search"]."%' or year LIKE '%".$_POST["search"]."%' or article_date LIKE '%".$_POST["search"]."%'  LIMIT $start, $limit");

									while ($row3=mysqli_fetch_array($result3)){
										$cat=mysqli_query($con,'select * from category_tbl where category_id="'.$row3['category_id'].'"');
										$catfe= mysqli_fetch_array($cat);
											$_GET['arn'] = $catfe['category_navi'];
											$_GET['artname'] = $catfe['category_name'];
											$_GET['artnum'] = $catfe['category_id'];
									
										$art_date=$row3['article_date'];
											echo '<div class="blog-item"><div class="row"><div class="col-lg-3 col-md-3 col-sm-3">
												  <div class="entry-meta"><span id="publish_date">';
											echo date("M d, Y", strtotime($row3['article_date']));
											echo '</span></div></div><div class="col-lg-9 col-md-9 col-sm-9  blog-content">
												 <h1>
												 <a href="article_item.php?arn='.$_GET['arn'].'&artname='.$_GET['artname'].'&artnum='.$_GET['artnum'].'&id='.$row3['article_id'].'">'.$row3['article_title'].'</a>
												 </h1><div class="media"> <a href="article_item.php?arn='.$_GET['arn'].'&artname='.$_GET['artname'].'&artnum='.$_GET['artnum'].'&id='.$row3['article_id'].'" class="media-left"> <img class="img-blog" alt="" src="images/article/'.$row3['article_photo'].'"> </a>
																	  <div class="media-body">
																	  <p id="side_post">'.substr(nl2br(htmlentities($row3['article_headline'])),0,230).'...</p></div>					
																	</div>';
											echo '<a class="btn btn-primary readmore" href="article_item.php?arn='.$_GET['arn'].'&artname='.$_GET['artname'].'&artnum='.$_GET['artnum'].'&id='.$row3['article_id'].'">Read More 
												  <i class="fa fa-angle-right"></i></a>
												  </div></div></div><hr>';
									}
									if (mysqli_num_rows($result3)<1){
														echo '<h1>NO POST YET</h1>';
													}
									$rows=mysqli_num_rows(mysqli_query($con,'select * from articles_tbl where category_id="'.$_GET['artnum'].'"'));//calculate total page number for the given table in the database 
									$total=ceil($rows/$limit);
									?>
									<br>
									<ul class="pagination pagination-lg">
									<?php 
									$pagename= "article";
									if(mysqli_num_rows($result3)>0){
									if($total>1){
									echo "<li><a href='".$pagename.".php?id=1'><i class='fa fa-chevron-circle-left'></i></a></li> "; // Goto 1st page  
									for ($i=1; $i<=$total; $i++) { 
											if(isset($_GET['id'])){
												if($i==$_GET['id']){
												echo "<li class='active'><a href='".$pagename.".php?id=".$i."'>".$i."</a> </li> "; 
												}
												else {
													echo "<li><a href='".$pagename.".php?id=".$i."'>".$i."</a> </li> "; 
												}
											}
											else {
												if($i==1){
												echo "<li class='active'><a href='".$pagename.".php?id=".$i."'>".$i."</a> </li> "; 
												}
												else {
													echo "<li><a href='".$pagename.".php?id=".$i."'>".$i."</a> </li> "; 
												}
											}
											
									}; 
									echo "<li><a href='".$pagename.".php?id=$total'><i class='fa fa-chevron-circle-right'></i></a></li> "; // Goto last page
									}}
									?>
								</ul><!--/.pagination-->

							</div>


<?php
}

else {
		?>
	<div class="single_page">
								<ol class="breadcrumb">						  
									<li><a href="article.php?arn=<?php echo $_GET['arn'];?>&artname=<?php echo $_GET['artname'];?>&artnum=<?php echo $_GET['artnum']?>"> Search Result</a></li>
								</ol>
		</div>
<?php
	echo '<h1>NO POST YET</h1>';
}
	?>



 