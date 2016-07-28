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

        #check{
          color: #4caf50;
          font-size: 50px;
          width: 200px;
        }

        #cross{
          color: #f44336;
          font-size: 50px;
          width: 200px;
        }

    </style>
  </head>
  <!-- [END csslink] -->
  <body>
    <nav class="black">
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
          <i class="material-icons right" id="check">check_circle</i>
          <i class="material-icons right" id="cross">warning</i>
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
            <input id="reftime" name="reftime" type="number" class="validate" value="1" min="0">
            <label for="reftime">Refresh Time(in mins)</label>
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
    $("#check").hide();
    $("#cross").hide();
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "get_session.php",
        success: function(data){
          // alert(data);
          // alert("session set");
          if(data=="connected")
          {
            $("#useralert").hide();
            $("#btn_submit").removeClass("green");
            $("#btn_submit").removeClass("red");
            $("#btn_submit").removeClass("blue");
            $("#btn_submit").addClass("green");
            document.getElementById("btn_submit").value = "Connected";
            $("#check").show();
            $("#cross").hide();
          }
          else
          {
            $("#btn_submit").removeClass("red");
            $("#btn_submit").removeClass("blue");
            $("#btn_submit").removeClass("green");
            $("#btn_submit").addClass("red");
            document.getElementById("btn_submit").value = "Not Connected";
            $("#check").hide();
            $("#cross").show();
          }
        }
      });
    });
    $(".button-collapse").sideNav();
    $("#myform").submit(function(event){
      event.preventDefault();
      submit();
    });
    $("input").change(function(){
      event.preventDefault();
        submit();
    });
    function submit()
    {
      var server=$("#server").val();
      var username=$("#username").val();
      var password=$("#password").val();
      var dbname=$("#dbname").val();
      var tablename=$("#tablename").val();
      var reftime=$("#reftime").val();
      var f1=0,f2=0,f3=0,f4=0,f5=0,f6=0;
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
      if(reftime=="")
      {
        f6=1;
      }else{
        f6=0;
      }
      if(f1==0 && f2==0 && f3==0 && f4==0 && f5==0 && f6==0){
        $("#useralert").hide();
        var inp=$("#myform").serialize();
        $.ajax({
          type: "POST",
          url: "connect.php",
          data: inp,
          success: function(data){
            //alert(data);
            if(data=="success")
            {
              $("#useralert").hide();
              // Materialize.toast('Server database mirrored successfully!', 4000,"rounded");
              $("#btn_submit").removeClass("green");
              $("#btn_submit").removeClass("red");
              $("#btn_submit").removeClass("blue");
              $("#btn_submit").addClass("green");
              document.getElementById("btn_submit").value = "Connected";
              $("#check").show();
              $("#cross").hide();

              // var input="state=connected";
              // $.ajax({
              //   type: "POST",
              //   url: "set_session.php",
              //   data:input,
              //   success: function(data){
              //     // alert(data);
              //     // alert("session set");
              //   }
              // });
            }
            else
            {
              // Materialize.toast('Connection Failed!', 4000);
              $("#btn_submit").removeClass("red");
              $("#btn_submit").removeClass("blue");
              $("#btn_submit").removeClass("green");
              $("#btn_submit").addClass("red");
              document.getElementById("btn_submit").value = "Not Connected";
              $("#check").hide();
              $("#cross").show();
              // var input="state=not connected";
              // $.ajax({
              //   type: "POST",
              //   url: "set_session.php",
              //   data:input,
              //   success: function(data){
              //     // alert(data);
              //     // alert("session set");
              //   }
              // });
              // $.ajax({
              //   type: "POST",
              //   url: "get_session.php",
              //   success: function(data){
              //     alert(data);
              //     // alert("session set");
              //   }
              // });
            }
          }
        });
      }
      else
      {
        $("#useralert").show();
        $("#btn_submit").removeClass("red");
        $("#btn_submit").removeClass("blue");
        $("#btn_submit").removeClass("green");
        $("#btn_submit").addClass("red");
        document.getElementById("btn_submit").value = "Not Connected";
        var input="state=not connected";
        $("#check").hide();
        // $.ajax({
        //   type: "POST",
        //   url: "set_session.php",
        //   data:input,
        //   success: function(data){
        //     // alert(data);
        //     // alert("session set");
        //   }
        // });
      }
    }

    var t=$("#reftime").val();
    setInterval(submit, t*60*1000);
  </script>
</html>