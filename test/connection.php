<?php
	session_start();
	//connection settings for server database coming from settings.php
	$link1=mysqli_connect($_POST['server'],$_POST['username'],$_POST['password'],$_POST['dbname']);
	// $link1=mysqli_connect("motherbeeTest.db.8914663.hostedresource.com","motherbeeTest","qwertY@12","motherbeeTest");
	//connection settings of local database
	$link2=mysqli_connect("localhost","root","","motherbeetest");
	$c=0;

	$table=$_POST['tablename'];
	$result = mysqli_query($link1,"SELECT * FROM $table") or die(mysqli_error($link1)); // select all content	
	if(!$result)
	{
		echo "error";
		$c=1;
	}
	else
	{
		$row = mysqli_fetch_array($result);
		$q = "SELECT `reg_date` FROM `contacts` ORDER BY id DESC LIMIT 1";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
		$r=mysqli_fetch_array($qu);
		// print_r($r);
		// print_r($row);
		while ($row = mysqli_fetch_array($result) ) {		
			// print_r($row);
			if($row['registered_date']>$r['reg_date'])
			{
				// echo "true";
				$res=mysqli_query($link2,"REPLACE INTO `contacts`   VALUES (".$row['id'].",'".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."')") or die(mysqli_error($link2)); 
			    if(!$res)
			    {
			    	echo "error";
			    	$c=1;
			    }
			}	
			if(!$r)
			{
				$res=mysqli_query($link2,"REPLACE INTO `contacts`   VALUES (".$row['id'].",'".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."')") or die(mysqli_error($link2)); 
			    if(!$res)
			    {
			    	echo "error";
			    	$c=1;
			    }
			}	    
		    // insert one row into new table
		}
	}
	if($c==0)
	{
		echo "success";
	}
	else{
		echo "fail";
	}
	// echo $c;
?>