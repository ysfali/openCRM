<?php
	session_start();
	//connection settings for server database coming from settings.php
	// if(isset($_POST))
	// {
	// 	$link1=mysqli_connect($_POST['server'],$_POST['username'],$_POST['password'],$_POST['dbname']);
	// }
	// else
	// {
	$link2=mysqli_connect("localhost","root","","motherbeetest");
	// $link2=mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");
	$link1=mysqli_connect("motherbeeTest.db.8914663.hostedresource.com","motherbeeTest","qwertY@12","motherbeeTest");
	// }
	//connection settings of local database
	$c=0;
<<<<<<< HEAD

	$table=$_POST['tablename'];

	$latest = "SELECT `reg_date` from `contacts` ORDER BY `reg_date` DESC LIMIT 1"; // select the latest lead in mirror, 
	//echo $latest; 

	$result = mysqli_query($link1,"SELECT * FROM $table where `registered_date` > $latest") or die(mysqli_error($link1)); // select all content	
=======
if (mysqli_connect_errno())
	  {
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  	$t=time();
		$q = "INSERT into `log` (`status`,`timestamp`) VALUES ('not connected','".date('Y-m-d h:m:s',$t)."')";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
	  }
	// $table=$_POST['tablename'];
	$table="services_leads";
	$result = mysqli_query($link1,"SELECT * FROM $table") or die(mysqli_error($link1)); // select all content	
>>>>>>> 743fa5dd898baa30c683f471e5812861c450893f
	if(!$result)
	{
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
				$res=mysqli_query($link2,"REPLACE INTO `contacts`   VALUES (".$row['id'].",'".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."','".$row['weeks']."')") or die(mysqli_error($link2)); 
			    if(!$res)
			    {
			    	echo "error";
			    	$c=1;
			    }
			}	
			if(!$r)
			{
				$res=mysqli_query($link2,"REPLACE INTO `contacts`   VALUES (".$row['id'].",'".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."','".$row['weeks']."')") or die(mysqli_error($link2)); 
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
		// $_SESSION['state']="connected";
		$t=time();
		$q = "INSERT into `log` (`status`,`timestamp`) VALUES ('connected','".date("Y-m-d h:m:s",$t)."')";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
	}
	else{
		echo "fail";
		// $_SESSION['state']="not connected";
		$t=time();
		$q = "INSERT into `log` (`status`,`timestamp`) VALUES ('not connected','".date("Y-m-d h:m:s",$t)."')";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
	}
	// echo $c;
?>