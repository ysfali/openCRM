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
    <style type="text/css">
        @media only screen and (min-width : 601px) and (max-width : 1260px) {
        .toast {
        border-radius: 0;
        text-align: center;} }

        @media only screen and (min-width : 1261px) {
        .toast {
        border-radius: 0;
        text-align: center; } }

        @media only screen and (min-width : 601px) and (max-width : 1260px) {
        #toast-container {
        bottom: 0%;
        top: 90%;
        right: 41%;
        left: 40%;} }

        @media only screen and (min-width : 1261px) {
        #toast-container {
        bottom: 0%;
        top: 90%;
        right: 41%;
        left: 40%; } }

    </style>
  </head>
  <!-- [END csslink] -->
  <body>
    <nav class="cyan lighten-3">
      <div class="nav-wrapper">
        <a href="index.php" class="brand-logo center">Motherbee</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li class="active"><a href="settings.php">Settings</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li class="active"><a href="settings.php">Settings</a></li>
        </ul>
      </div>
    </nav>

    <h4 class="center">Here you can manage your Database connection settings</h4>

    <div class="row container">
      <form class="col s12" id="myform" method="post">
        <p id="useralert" style="display:none" class="red center">Errors in Form</p>
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <input id="server" name="server" type="text" class="validate" value="motherbeeTest.db.8914663.hostedresource.com">
            <label for="server">Server Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <input id="userneame" name="username" type="text" class="validate" value="motherbeeTest">
            <label for="username">User Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <input id="password" name="password" type="password" class="validate" value="qwertY@12">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <input id="dbname" name="dbname" type="text" class="validate" value="motherbeeTest">
            <label for="dbname">Database Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <input id="tablename" name="tablename" type="text" class="validate" value="services_leads">
            <label for="tablename">Table Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <input id="reftime" name="reftime" type="number" class="validate" value="1">
            <label for="reftime">Refresh Time(in hrs)</label>
          </div>
        </div>
        <div class="center">
          <input id="btn_submit" type="submit" class="btn tooltipped" value="Connect" name="submit" data-position="right" data-delay="50" data-tooltip="click to connect now!"/>
        </div>
      </form>
    </div>


  </body>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.tooltipped').tooltip({delay: 50});
    });

    $(".button-collapse").sideNav();
    $("#myform").submit(function(event){
      event.preventDefault();
      //alert("submit");
      var server=$("#server").val();
      var username=$("#username").val();
      var password=$("#password").val();
      var dbname=$("#dbname").val();
      var tablename=$("#tablename").val();
      var f1=0,f2=0,f3=0,f4=0,f5=0;
      if(server==""){
        f1=1;
      }else{
        f1=0;
      }
      if(username==""){
        f2=1;
      }else{
        f2=0;
      }
      if(password==""){
        f3=1;
      }else{
        f3=0;
      }
      if(dbname==""){
        f4=1;
      }else{
        f4=0;
      }
      if(tablename==""){
        f5=1;
      }else{
        f5=0;
      }
      if(f1==0 && f2==0 && f3==0 && f4==0 && f5==0){
        //alert("post");
        $("#useralert").hide();
        var inp=$("#myform").serialize();
        $.ajax({
          type: "POST",
          url: "connection.php",
          data: inp,
          success: function(data){
            // alert(data);
            if(data=="success")
            {
              $("#useralert").hide();
              // Materialize.toast('Server database mirrored successfully!', 4000,"rounded");
              $("#btn_submit").addClass("green");
              document.getElementById("btn_submit").value = "Connected";
            }
            else
            {
              // Materialize.toast('Connection Failed!', 4000);
              $("#btn_submit").addClass("red");
              document.getElementById("btn_submit").value = "Not Connected";
            }
          }
        });
      }
    });
    function submit()
    {
      if(document.getElementById("btn_submit").value == "Connected")
      {
        $("#useralert").hide();
        var inp=$("#myform").serialize();
        $.ajax({
          type: "POST",
          url: "connection.php",
          data: inp,
          success: function(data){
            // alert(data);
            if(data=="success")
            {
              $("#useralert").hide();
              // Materialize.toast('Server database mirrored successfully!', 4000,"rounded");
              $("#btn_submit").addClass("green");
              document.getElementById("btn_submit").value = "Connected";
            }
            else
            {
              // Materialize.toast('Connection Failed!', 4000);
              $("#btn_submit").removeClass("green");
              $("#btn_submit").addClass("red");
              document.getElementById("btn_submit").value = "Not Connected";
            }
          }
        });
      }
    }
    setInterval(submit, 10000);
  </script>
</html>