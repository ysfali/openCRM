<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var jsonData = $.ajax({
          url: "getData.php",
          dataType: "json",
          async: false
          }).responseText;
      
        //alert(jsonData);
        
        // alert(jsonData);
        // Create our data table out of JSON data loaded from server.
        //alert(jsonData);
        var chartData = JSON.parse(jsonData);
        //alert(chartData);
        var data = new google.visualization.DataTable();

  
        data.addColumn('number','id'); 
        //alert("all is well");
        data.addColumn('number','numWeeks');
          

        for(i=0; i < chartData.length; i++){
           var currentObj = chartData[i];
           data.addRow([currentObj.numWeeks, currentObj.id]);
          }

          var options = {
          title: 'numWeeks vs. id comparison',
          hAxis: {title: 'numWeeks', minValue: 0, maxValue: 40},
          vAxis: {title: 'id', minValue: 0, maxValue: 715},
          legend: 'none',
          crosshair: { trigger: 'both' }
          };

        //alert(data);
        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
