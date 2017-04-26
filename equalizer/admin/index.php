<?php
require('connection.php');
include('header.php');

		
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count">
				<?php  
					$viewquery = "SELECT * FROM daily_view_tbl where date='".date('Y-m-d')."'";
					$viewsql = mysqli_query($con,$viewquery);
					$fetchview=mysqli_fetch_assoc($viewsql);
					if(mysqli_num_rows($viewsql) > 0){
					echo $fetchview['article_views'];
					}
					else{
						echo "0";
					}
				?>	  
				  
				  
				  
				  </div>
                 <br> <h3>New Article Views</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count"><?php
					$sqldate=mysqli_query($con,"SELECT date FROM comment_tbl");
					 $count=0;
					while($daterun=mysqli_fetch_assoc($sqldate)){
					  $comdate = $daterun['date'];

					 $cdate =date('Y-m-d');
				
					if(strpos($comdate, $cdate) !== false){
							$count++;
						
					}
					
					}echo $count;

		?></div>
                  <h3>New Posts Comments</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                  <div class="count">
				  
				  <?php
					$sqldate=mysqli_query($con,"SELECT date FROM user_tbl");
					 $count=0;
					while($daterun=mysqli_fetch_assoc($sqldate)){
					  $comdate = $daterun['date'];

					 $cdate =date('Y-m-d');
				
					if(strpos($comdate, $cdate) !== false){
							$count++;
						
					}
					
					}echo $count;

		?>
				  
				  
				  
				  </div>
                 <br> <h3>New Sign ups</h3>
                </div>
              </div>
			  <?php  $jobrun11 = "SELECT user_id FROM user_tbl"; $jubrun2 = mysqli_query($con, $jobrun11);   $numss=mysqli_num_rows( $jubrun2); ?>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count"><?php if($numss>=1){ echo $numss; } else { echo "0";} ?></div>
                 <br> <h3>Total Number of Registered User</h3>
                </div>
              </div>

            </div>

			
			
			
			
			
			
			
			
			<script>
            var charting;

            var chartDatasss = [

		<?php
		$chek=mysqli_query($con,"SELECT distinct(year) as yea FROM articles_tbl");
		while($nums=mysqli_fetch_assoc($chek)){
			$cheksss=mysqli_query($con,"SELECT * FROM category_tbl where category_id='".$nums['yea']."'");
			$numssss=mysqli_fetch_assoc($cheksss);

		
	
		?>     
			{
                    "year":  <?php echo $nums['yea'];	 ?> ,
			<?php
		$cheks=mysqli_query($con,"SELECT * FROM category_tbl");
		while($numss=mysqli_fetch_assoc($cheks)){
				
	$cheka=mysqli_query($con,"SELECT count(category_id) as yearss FROM articles_tbl where category_id='".$numss['category_id']."'");
		$numsa=mysqli_fetch_assoc($cheka);	

		
                 echo   "\"".$numss['category_name']."\": ".$numsa['yearss'].","; 
              
		}	 ?>
                
                  
                },<?php }	 ?>
        
            ];

            AmCharts.ready(function () {
                // SERIALL CHART
                charting = new AmCharts.AmSerialChart();
                charting.dataProvider = chartDatasss;
                charting.categoryField = "year";
                charting.plotAreaBorderAlpha = 0.2;
                charting.rotate = true;

				
				
				
                // AXES
                // Category
                var categoryAxis = charting.categoryAxis;
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.stackType = "regular";
                valueAxis.gridAlpha = 0.1;
                valueAxis.axisAlpha = 0;
                charting.addValueAxis(valueAxis);

				
				
				
                // GRAPHS
                // firstgraph
				<?php
				
				 
		$cheks=mysqli_query($con,"SELECT * FROM category_tbl");
		while($numss=mysqli_fetch_assoc($cheks)){
			if($numss['category_id']==1){
				$color = "83da95";
			}
			if($numss['category_id']==2){
				$color = "97bd45";
			}
			if($numss['category_id']==3){
				$color = "adb699";
			}
			if($numss['category_id']==4){
				$color = "fff100";
			}
			if($numss['category_id']==5){
				$color = "e8e1e1";
			}
			if($numss['category_id']==6){
				$color = "e1e151";
			}
			if($numss['category_id']==7){
				$color = "e3e1e1";
			}
			if($numss['category_id']==8){
				$color = "f1e2e1";
			}
			if($numss['category_id']==9){
				$color = "e1e1e1";
			}
			if($numss['category_id']==10){
				$color = "e1e1b1";
			}
			if($numss['category_id']==11){
				$color = "e0e1e1";
			}
			if($numss['category_id']==12){
				$color = "e1e1f1";
			}
				
			
			
         // $color = dechex(rand(0x000000, 0xFFFFFF));
              
			
			  
		  echo	   'var graph = new AmCharts.AmGraph();
						graph.title = "'.$numss['category_name'].'";
						graph.labelText = "[[value]]";
						graph.valueField = "'.$numss['category_name'].'";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = "#'.$color.'";
						graph.balloonText = "<b><span style=\'color:#fffff\'>[[title]]</b></span><br><span style=\'font-size:14px\'>[[category]]: <b>[[value]]</b></span>";
						graph.labelPosition = "middle";
						charting.addGraph(graph);
						charting.depth3D = 20;
						charting.angle = 30;
						';
						
			  
			  
		}	 ?>
                // legendary
                var legendary = new AmCharts.AmLegend();
                legendary.position = "right";
                legendary.borderAlpha = 0.3;
                legendary.horizontalGap = 10;
                legendary.switchType = "v";
                charting.addLegend(legendary);

                charting.creditsPosition = "top-right";

                // WRITE
                charting.write("chartdivas");
            });

            // Make charting 2D/3D
            function setDepth() {
                if (document.getElementById("rbs1").checked) {
                    charting.depth3D = 0;
                    charting.angle = 0;
                } else {
                    charting.depth3D = 20;
                    charting.angle = 30;
                }
                charting.validateNow();
            }
        </script>
			
			

    <section id="error" class="text-center">
	<h2  class="wow fadeInDown" style="margin-bottom: -50px; color: gray;"><b>Number of Comment</b></h2>
		<br>
		<br>
		<br>
			<div id="chartdivas" style="width: 100%; height: 400px;">
			</div>
			
				<div style="margin-left:40px;">
				<input type="radio" name="groups" id="rbs1" onclick="setDepth()">2D
				<input type="radio" checked="true" name="groups" id="rbs2" onclick="setDepth()">3D
				
			</div>
	
	
			<br><br>
		
			
	</div>

		<hr>

    </section>
		

	<?php
	include('daily_view_chart.php');		
	?>		
			 
			 <font align="center"><h2  class="wow fadeInDown" style="margin-bottom: 0px; color: gray;"><b>Daily View Report</b></h2></font>
			 
			
			<div id="chartdiv" style="width: 100%; height: 400px;"></div>
			
			
			
			
			
			
			
			
			
			
			
            <div class="row">
              
            </div>



            <div class="row">
              
            </div>



            
			
          </div>
        </div>
        <!-- /page content -->

<?php


		


include('footer.php')
?>