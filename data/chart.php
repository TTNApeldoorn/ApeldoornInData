<?php
if(!is_numeric($_REQUEST['id'])) {
	die("Invalid Id parameter");
}
?>
<html style="width: 100%; height: 100%; margin: 0;">
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
	
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      var jsonData = $.ajax({
          url: "chartdata.php?id=<?php echo addslashes($_REQUEST['id']) ?>&type=firstpriority",
          dataType: "json",
          async: false
          }).responseText;
          
		options = {
			chartArea : { left: 40, top:10, bottom: 50, width: 220, heigth: 80},
			vAxis: {format:'#.#'},			
			legend: {position: 'none'},
			hAxis: {
            format: 'HH:mm:ss',
			},
			height: 100
        };
		
		data = new google.visualization.DataTable();
		data.addColumn('datetime', 'Time');
		data.addColumn('number', 'Temperatuur');	
		data.insertRows(0, eval(jsonData));
		chart.draw(data, options);	
		
      // Create our data table out of JSON data loaded from server.
      //var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      //chart.draw(data, {width: 400, height: 240});
    }

    </script>
  </head>

  <body style="width: 100%; height: 100%; margin: 0;">
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>