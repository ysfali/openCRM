<?php
	session_start();
	// $link2=mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");
	
	$link2=mysqli_connect("localhost","root","","motherbeetest");
	//connection settings for server database coming from settings.php
	// if(isset($_POST))
	// {
		$link1=mysqli_connect($_POST['server'],$_POST['username'],$_POST['password'],$_POST['dbname']);
	// // }
	// // else
	// // {
	// $link1=mysqli_connect("motherbeeTest.db.8914663.hostedresource.com","motherbeeTest","qwertY@12","motherbeeTest");
	if (mysqli_connect_errno())
	  {
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  	$t=time();
		$q = "INSERT into `log` (`status`,`timestamp`) VALUES ('not connected','".date('Y-m-d h:m:s',$t)."')";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
	  }
	// // }
	//connection settings of local database
	
	$c=0;

	$table=$_POST['tablename'];
	// $table="services_leads";
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
			if($r AND $row['registered_date']>$r['reg_date'])
			{
			//echo "true";
				$res=mysqli_query($link2,"REPLACE INTO `contacts` (`name`,`email`,`phone`,`reg_date`,`due date`)   VALUES ('".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."','".$row['weeks']."')") or die(mysqli_error($link2)); 
			    if(!$res)
			    {
			    	echo "error";
			    	$c=1;
			    }
			}	
			if(!$r)
			{
                                //echo "error at insert";
				$res=mysqli_query($link2,"INSERT INTO `contacts` (`name`,`email`,`phone`,`reg_date`,`due date`)   VALUES ('".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."','".$row['weeks']."')") or die(mysqli_error($link2)); 
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
		$q = "INSERT into `log` (`status`,`timestamp`) VALUES ('connected','".date('Y-m-d h:m:s',$t)."')";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
		// echo "connected";
	}
	else{
		echo "fail";
		// $_SESSION['state']="not connected";
		$t=time();
		$q = "INSERT into `log` (`status`,`timestamp`) VALUES ('not connected','".date('Y-m-d h:m:s',$t)."')";
		$qu = mysqli_query($link2, $q) or die(mysqli_error($link2));
		// echo "not connected";
	}
	// echo $c;
?>