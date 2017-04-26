
        <script>
            var chart;
            var chartData = [
			
			<?php
             $vieew=mysqli_query($con,"SELECT * FROM daily_view_tbl order by date asc");
			while($vieews=mysqli_fetch_assoc($vieew)){
			
			mysqli_num_rows($vieew);
					echo '{ 
						"date": "'.$vieews['date'].'",
						"price": '.$vieews['article_views'].'
					
					},';
				}
			
             
			 
			 ?>
			 
			 
            ];
		<?php
		$vieews=mysqli_query($con,"SELECT avg(article_views) as aver FROM daily_view_tbl");
			while($vieewss=mysqli_fetch_assoc($vieews)){
          echo  'var average = '.$vieewss['aver'].';'; }
		?>
            AmCharts.ready(function () {

                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();

                chart.dataProvider = chartData;
                chart.categoryField = "date";
                chart.dataDateFormat = "YYYY-MM-DD";

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.dashLength = 1;
                categoryAxis.gridAlpha = 0.15;
                categoryAxis.axisColor = "green";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisColor = "green";
                valueAxis.dashLength = 1;
                valueAxis.logarithmic = true; // this line makes axis logarithmic
                chart.addValueAxis(valueAxis);

                // GUIDE for average
                var guide = new AmCharts.Guide();
                guide.value = average;
                guide.lineColor = "gray";
                guide.dashLength = 14;
                guide.label = "average";
                guide.inside = true;
                guide.lineAlpha = 1;
                valueAxis.addGuide(guide);


                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.type = "smoothedLine";
                graph.bullet = "round";
                graph.bulletColor = "#078f00";
                graph.useLineColorForBulletBorder = true;
                graph.bulletBorderAlpha = 1;
                graph.bulletBorderThickness = 2;
                graph.bulletSize = 7;
                graph.title = "Price";
                graph.valueField = "price";
                graph.lineThickness = 2;
                graph.lineColor = "#9be6af";
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chart.addChartCursor(chartCursor);

                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chartScrollbar.graph = graph;
                chartScrollbar.scrollbarHeight = 30;
                chart.addChartScrollbar(chartScrollbar);

                chart.creditsPosition = "bottom-right";

                // WRITE
                chart.write("chartdiv");
            });
        </script>
		