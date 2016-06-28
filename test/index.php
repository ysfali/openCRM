<html>
  <!-- [START csslink] -->
  <head>
    <script src="js/jquery.min.js"></script>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <style type="text/css">
    .marginTop{
      margin-top: 8vh;
    }
    </style>
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
          hAxis: {title: 'number of Weeks', minValue: 0, maxValue: 40,},
          vAxis: {title: 'ID', minValue: 600, maxValue: 650},
          legend: 'none',
          crosshair: { trigger: 'both' },
          backgroundColor : '#e0f2f1',
          };

        //alert(data);
        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>

         
  </head>

  <!-- [END csslink] -->
  
  <body>
    
    <nav class="light-green lighten-2">
      <div class="nav-wrapper">
        <a href="index.php" class="brand-logo center">Motherbee</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="settings.php">Settings</a></li>
          <li><a href="#" id="state"></a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </div>
    </nav>

    <div class="container center marginTop">
      <div id="chart_div"  style="width: 900px; height: 500px;">
      </div>      
    </div>

  </body>
  <script type="text/javascript">
    // $(".button-collapse").sideNav();
    function check(){
      $.ajax({
        type: "POST",
        url: "get_session.php",
        success: function(data){
          // alert(data);
          // alert("session set");
          if(data=="connected")
          {
            $("#useralert").hide();
            $("#state").removeClass("green");
            $("#state").removeClass("red");
            $("#state").removeClass("blue");
            $("#state").addClass("green");
            $("#state").html("Connected");
          }
          else
          {
            $("#state").removeClass("red");
            $("#state").removeClass("blue");
            $("#state").removeClass("green");
            $("#state").addClass("red");
            $("#state").html("Not Connected");
          }
        }
      });
    }
    setInterval(check, 2*1000);
  </script>
</html>