<?php

	$connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");
	$query="select * from `` where week=".$_POST['week']."";
    $result=mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row=mysqli_fetch_array($result);


?>