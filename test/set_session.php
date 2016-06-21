<?php
  session_start();
  if(isset($_POST) AND $_POST['state']=="connected")
  	$_SESSION['state']="connected";
  else
  	$_SESSION['state']="not connected";
?>