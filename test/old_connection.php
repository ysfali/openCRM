<?php
	//connection settings for server database coming from settings.php
	$link1=mysqli_connect($_POST['server'],$_POST['username'],$_POST['password'],$_POST['dbname']);
	// $link1=mysqli_connect("motherbeeTest.db.8914663.hostedresource.com","motherbeeTest","qwertY@12","motherbeeTest");
	//connection settings of local database
	$link2=mysqli_connect("localhost","root","","motherbee");
	$c=0;


	// $dblink1=mysql_connect('motherbeeTest.db.8914663.hostedresource.com', 'motherbeeTest', 'qwertY@12'); // connect server 1
	// mysql_select_db('motherbeeTest',$dblink1);  // select database 1

	// $dblink2=mysql_connect('localhost', 'root', ''); // connect server 2	
	// mysql_select_db('motherbee',$dblink2); // select database 2

	// $table='contacts';
	$table=$_POST['tablename'];

	// $query="SHOW CREATE TABLE $table";
	//echo $query;
	// $result=mysqli_query($link1, $query) or die(mysqli_error($link1));
	// if(!$result){
		//printf("Error: %s\n", mysqli_error($query));
		// echo "error";
		// $c=1;
	// }
	// else{
		// $tableinfo = mysqli_fetch_array($result); // get structure from table on server 1
		// print_r($tableinfo[1]);

		// mysqli_query($link2," $tableinfo[1] "); // use found structure to make table on server 2

		$result = mysqli_query($link1,"SELECT * FROM $table") or die(mysqli_error($link1)); // select all content	
		if(!$result)
		{
			echo "error";
			$c=1;
		}
		else
		{
			$row = mysqli_fetch_array($result);
			// print_r($row);
			while ($row = mysqli_fetch_array($result) ) {		
				print_r($row);
				// $key=array_keys($row);
				// print_r($keys);
				// $columns = implode(", ",array_keys($row));
				// echo $columns;
				// while()
				// $values="";
				// $i=0;
				// for ($i=0; $i < count($row)/2; $i++) { 
				// 	$x=($i*2)+1;
				// 	$y=$key[$x];
				// 	// echo $y;
				// 	$query1="SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS 
	  	// 					 WHERE table_name = '".$table."' AND COLUMN_NAME = '".$y."'";
	  	// 			//echo $query1;
	  	// 			$result1=mysqli_query($link2,$query1);
	  	// 			$row1=mysqli_fetch_array($result1);
	  	// 			//print_r($row1[0]);
	  	// 			//echo " ";
				// 	if($i!=count($row)/2-1)
				// 	{
				// 		// echo "<br/>";
				// 		// echo $row1[0];
				// 		// echo "<br/>";
				// 		if (strcmp($row1[0],"date")==0 OR strcmp($row1[0],"timestamp")==0) {
				// 				$values=$values."'".$row[$i]."'"." , ";
				// 		}
				// 		elseif ($row1[0]=='varchar' OR $row1[0]=='text' OR $row1[0]=='mediumtext') {
				// 			$values=$values.'"'.$row[$i].'"'." , ";
				// 		}
				// 		elseif ($row1[0]=='int' OR $row1[0]=='bigint' OR $row1[0]=='double') {
				// 			$values=$values.$row[$i]." , ";
				// 		}
				// 	}
				// 	else {
				// 		if ($row1[0]=='date' OR $row1[0]!='timestamp') {
				// 				$values=$values."'".$row[$i]."'";
				// 		}
				// 		elseif ($row1[0]=='varchar' OR $row1[0]=='text' OR $row1[0]=='mediumtext') {
				// 			$values=$values."'".$row[$i]."'";
				// 		}
				// 		elseif ($row1[0]=='int' OR $row1[0]=='bigint' OR $row1[0]=='double') {
				// 			$values=$values.$row[$i];
				// 		}
				// 	}
					// echo $values;
				}
				// echo "<br/>";
				// $values = implode(", ", array_values($row));
				// echo $values;
				// echo "<br/>";
				//print_r(implode(", ",array_keys($row)));
			    $res=mysqli_query($link2,"REPLACE INTO `contacts`   VALUES (".$row['id'].",'".$row['name']."','".$row['email']."',".$row['phone'].",'".$row['registered_date']."')") or die(mysqli_error($link2)); 
			    if(!$res)
			    {
			    	echo "error";
			    	$c=1;
			    }
			    // insert one row into new table
			}
		// }
	// }
	if($c==0)
	{
		echo "success";
	}
	else{
		echo "fail";
	}
	// echo $c;
?>