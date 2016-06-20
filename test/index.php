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
     </style>
  </head>
  <!-- [END csslink] -->
  <body>
    <nav class="light-green lighten-2">
      <div class="nav-wrapper">
        <a href="index.php" class="brand-logo center">Motherbee</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="settings.php">Settings</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </div>
    </nav>
  </body>
  <script type="text/javascript">
     $(".button-collapse").sideNav();
  </script>
</html>