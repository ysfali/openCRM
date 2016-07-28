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
    .marginBottom{
      margin-bottom: 4vh;
    }
    body{
      background-color: #e0e0e0;
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
      
        // alert(jsonData);
        
        // alert(jsonData);
        // Create our data table out of JSON data loaded from server.
        //alert(jsonData);
        var chartData = JSON.parse(jsonData);
        //alert(chartData);
        var data = new google.visualization.DataTable();
   
        data.addColumn('number','id'); 
        // alert("all is well");
        data.addColumn('number','numWeeks');
        //alert("all is well");
      
        data.addColumn( {'type': 'string', 'role': 'style'} );
        //alert("all is well part 2");
       // data.addColumn('string', 'email');
      
        
        
        // Use custom HTML content for the domain tooltip.
        data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});

        
        //alert("How Ya doing!!");
        for(var i=0; i < chartData.length; i++)
        {
            //alert("Chitta ve!");
            var currentObj = chartData[i];
           //alert(currentObj.numWeeksChanged);
           //window.alert(hello);
           if(currentObj.numWeeksChanged == 0)
              {
                //window.alert("fn executing1");
                  data.addRow([currentObj.numWeeks, currentObj.id, 'point {size: 10; fill-color: #424242;}', createCustomHTMLContent(currentObj)]);
          //       window.alert("function returned successfully");
                  continue;
                  //window.alert(currentObj.numWeeks);
              }
           
            else   
              {   
      //          window.alert("fn executing2");
                data.addRow([currentObj.numWeeks, currentObj.id, 'point {size: 10; fill-color: #b71c1c;}',createCustomHTMLContent(currentObj)]);
    //            window.alert("function returned successfully");
                  continue;
              }
            
          }

        var options = {
          title: 'Pregnancy Weeks Chart',
          hAxis: {title: 'number of Weeks', minValue: 0, maxValue: 40,},

          vAxis: {title: 'Leads', minValue: 0, maxValue: 715},
          legend: 'none',
          backgroundColor : '#e0e0e0',

          vAxis: {title: 'Leads', minValue: 600, maxValue: 650},
          legend: 'none',
          backgroundColor : '#e0e0e0',
          dataOpacity: 0.7,
          
          // This line makes the entire category's tooltip active.
          focusTarget: 'category',
          // Use an HTML tooltip.
          tooltip: { isHtml: true }
          
          };


        //alert(data);
        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));


        // The select handler. Call the chart's getSelection() method
        function selectHandler(e) {
          var selectedItem = chart.getSelection()[0];
           // alert(selectedItem.name);
            if (selectedItem) {
              var value = data.getValue(selectedItem.row, 1);
              // for getting value of y parameter do getValue(selectedItem.row, 1);
              // vary the index number to get different entities like name, email, phone etc,, 
              // insert a modal here ..
              // alert('The user selected ' + value);

              
              
              var inp="id="+value;
              var email=$.ajax({
                type: "POST",
                url: "getMail.php",
                data: inp,
                dataType: 'text',
                async: false
              }).responseText;
              // alert(email);
              var name=$.ajax({
                type: "POST",
                url: "getName.php",
                data: inp,
                dataType: 'text',
                async: false
              }).responseText;
              // alert(name);
              var week=$.ajax({
                type: "POST",
                url: "getWeek.php",
                data: inp,
                dataType: 'text',
                async: false
              }).responseText;
              // alert(week);
              var inp2="week="+week;
              var mail=$.ajax({
                type: "POST",
                url: "getMailText.php",
                data: inp2,
                dataType: 'text',
                async: false
              }).responseText;
              // alert(mail);
              var modalhtml='<div class="modal-content">'+
                              '<h4 class="center">Mail</h4>'+
                              '<form method="post" id="myform" action="email.php">'+
                              '<div class="row">'+
                              '<div class="input-field"><label for="email">To</label><input id="name" name="name" type="text" class="validate" value="'+name+'"></div>'+
                              '<div class="input-field"><label for="email">Email</label><input id="email" name="email" type="email" class="validate" value="'+email+'"></div>'+
                              '<div class="input-field"><label for="message">Mail Body</label><textarea name="message" id="message" class="materialize-textarea">'+mail+'</textarea></div>'+
                              '<div class="center"><input href="#" id="btn_submit" type="submit" class="btn" value="Send" name="submit"/></div>'+
                              '</div>'+
                              '</form>'+
                              '</div>';
              $('#modal1').html(modalhtml);
              $('#modal1').openModal();
            }
          }

      // Listen for the 'select' event, and call my function selectHandler() when
  // the user selects something on the chart.
  google.visualization.events.addListener(chart, 'select', selectHandler);

      document.getElementById("button1").disabled = true;

        chart.draw(data, options);
      
      }


        function drawChart2() {
      var jsonData = $.ajax({
          url: "getData2.php",
          dataType: "json",
          async: false
          }).responseText;
      
        // alert(jsonData);
        
        // alert(jsonData);
        // Create our data table out of JSON data loaded from server.
        //alert(jsonData);
        var chartData = JSON.parse(jsonData);
        //alert(chartData);
        var data = new google.visualization.DataTable();
   
        data.addColumn('number','id'); 
        // alert("all is well");
        data.addColumn('number','numMonths');
        //alert("all is well");
      
        data.addColumn( {'type': 'string', 'role': 'style'} );
        //alert("all is well part 2");
       // data.addColumn('string', 'email');
      
        
        
        // Use custom HTML content for the domain tooltip.
        data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});

        
        //alert("How Ya doing!!");
        for(var i=0; i < chartData.length; i++)
        {
            //alert("Chitta ve!");
            var currentObj = chartData[i];
           //alert(currentObj.numWeeksChanged);
           //window.alert(hello);
           if(currentObj.numMonthsChanged == 0)
              {
                //window.alert("fn executing1");
                  data.addRow([currentObj.numMonths, currentObj.id, 'point {size: 10; fill-color: #6d4c41;}', createCustomHTMLContent(currentObj)]);
          //       window.alert("function returned successfully");
                  continue;
                  //window.alert(currentObj.numWeeks);
              }
           
            else   
              {   
      //          window.alert("fn executing2");
                data.addRow([currentObj.numMonths, currentObj.id, 'point {size: 10; fill-color: #b71c1c;}',createCustomHTMLContent(currentObj)]);
    //            window.alert("function returned successfully");
                  continue;
              }
            
          }

        var options = {
          title: 'Birth Weeks Chart',
          hAxis: {title: 'number of Months', minValue: 0, maxValue: 40,},

          vAxis: {title: 'ID', minValue: 0, maxValue: 715},
          legend: 'none',
          backgroundColor : '#e0e0e0',
          dataOpacity: 0.7,

          
          // This line makes the entire category's tooltip active.
          focusTarget: 'category',
          // Use an HTML tooltip.
          tooltip: { isHtml: true }
          
          };


        //alert(data);
        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));


        // The select handler. Call the chart's getSelection() method
        function selectHandler(e) {
          var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
              var value = data.getValue(selectedItem.row, 3);
                // for getting value of y parameter do getValue(selectedItem.row, 1);
                // vary the index number ot get different entitie like name, email, phone etc,, 
                // insert a modal here ..
              alert('The user selected ' + value);
            }
          }

      // Listen for the 'select' event, and call my function selectHandler() when
  // the user selects something on the chart.
  google.visualization.events.addListener(chart, 'select', selectHandler);


        chart.draw(data, options);
      document.getElementById("button2").disabled = true;  
      }



      function createCustomHTMLContent(Obj) {

        // return '<div><table><tr><td>Alvin</td><td>Eclair</td><td>$0.87</td></tr></table></div>';
          return '<div>' +
          '<table class="contact_details">' + '<tr>' +
          '<td><b>' + Obj.name + '</b></td>' + '</tr>' + '<tr>' +
          '<td><b>' + Obj.phone + '</b></td>' + '</tr>' + '<tr>' +
          '<td><b>' + Obj.email + '</b></td>' + '</tr>' +  '</table>' + '</div>';
        }
    



    </script>

         
  </head>

  <!-- [END csslink] -->
  
  <body>
    
    <div class="navbar-fixed">
      <nav class="grey darken-4">
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
    </div> 
    

    <div class="container center marginTop">
      
      <div id="chart_div"  style="width: 900px; height: 500px;" class="marginBottom">
      </div>

      <a class="waves-effect waves-light btn brown darken-1" id = "button1" onclick= "drawChart()"><i class="material-icons">keyboard_arrow_left</i></a>
      <a class="waves-effect waves-light btn brown darken-1" id = "button2" onclick = "drawChart2()"><i class="material-icons">keyboard_arrow_right</i></a> 

    </div>
  
    <!-- Modal Trigger -->
      <!-- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> -->

    <!-- Modal Structure -->
      <div id="modal1" class="modal">
      </div>

    <footer class="page-footer black">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">ADD some footer content as per your wish.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
    </footer>

  </body>
  <script type="text/javascript">
   // $(".button-collapse").sideNav();
   // alert("Hello");
   
    $(document).ready(function() {
          $.ajax({
            type: "POST",
            url: "emailsent.php",
            success: function(data){
              if(data=="success")
              {
                 Materialize.toast('Mail was sent', 4000);
              }
              else if(data=="fail")
              {
                 Materialize.toast('Mail not sent', 4000);
              }
            }
          })
    });
   jQuery.noConflict();
   $('.modal-trigger').leanModal();
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
    setInterval(check, 10*1000);
    
  </script>
</html>