<?php
  session_start();
  if(isset($_SESSION['state']))
  {
  	echo $_SESSION['state'];
  }
  else{
  	$_SESSION['state']="not connected";
  	echo $_SESSION['state'];
  }
?>