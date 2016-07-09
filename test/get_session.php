<?php
  session_start();
  // $link2=mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");
  
	$link2=mysqli_connect("localhost","root","","motherbeetest");
  $q = "SELECT `status` FROM `log` ORDER BY id DESC LIMIT 1";
  $qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
  if($qu)
 	{
 		 $r=mysqli_fetch_array($qu);
 		 if($r[0]=='connected')
 		 {
 		 	echo 'connected';
 		 }
 		 else
 		 {
 		 	echo 'not connected';
 		 }
	}
?>