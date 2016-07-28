<?php

	// $connection=mysqli_connect("localhost","root","","motherbeetest") or die("Error " . mysqli_error($connection));
    $connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx") or die("Error " . mysqli_error($connection));
    $query="select * from `contacts`";
    $result=mysqli_query($connection,$query);

    while($row=mysqli_fetch_array($result))
    {
    	// WEEKS UPDATE

    	$now=time();
    	$your_date=strtotime($row['due date']);
    	$datediff = $your_date - $now;

    	$numWeeksnew = 40 - ceil($datediff/(60*60*24*7));
    	$numWeeksold = $row['numWeeks'];
    	if($your_date!="")
    	{
	     	if($numWeeksnew >=0 AND $numWeeksnew <=40)
	     	{
	     		// echo "$numWeeksnew $numWeeksold";
	     		// echo "<br/><br/>";
	     		if($numWeeksnew>$numWeeksold)
	     		{
	     			$query="UPDATE `contacts` SET `numWeeks` = '".$numWeeksnew."' where `id`=".$row['id']."";
	     			$res=mysqli_query($connection,$query);
	     			$query="UPDATE `contacts` SET `numWeeksChanged` = '1' where `id`=".$row['id']."";
	     			$res=mysqli_query($connection,$query);
	     		}
	     		else if($numWeeksnew==$numWeeksold)
	     		{
	     			$query="UPDATE `contacts` SET `numWeeksChanged` = '0' where `id`=".$row['id']."";
	     			$res=mysqli_query($connection,$query);
	     		}
	     		else
	     		{
	     			$query="UPDATE `contacts` SET `numWeeks` = '".$numWeeksnew."' where `id`=".$row['id']."";
	     			$res=mysqli_query($connection,$query);
	     		}
	     	}
	     }
    }

?>