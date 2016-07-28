<?php

	// $connection=mysqli_connect("localhost","root","","motherbeetest") or die("Error " . mysqli_error($connection));
    $connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx") or die("Error " . mysqli_error($connection));
    $query="select * from `contacts`";
    $result=mysqli_query($connection,$query);

    while($row=mysqli_fetch_array($result))
    {
    	// print_r($row);
    	// echo "<br/><br/>";

    	$now=time();
    	$your_date=strtotime($row['due date']);
    	$datediff = $now - $your_date;
        // echo "$now $your_date $datediff<br/>";
        $numMonthnew = ceil($datediff/(60*60*24*30));
        $numMonthold = $row['numMonths'];
        if($your_date>0)
        {
            // echo "$numMonthnew";
            // echo "<br/><br/>";
            if($numMonthnew >0)
            {
                // echo "$numMonthnew $numMonthold";
                // echo "<br/><br/>";
                if($numMonthnew>$numMonthold)
                {
                    $query="UPDATE `contacts` SET `numMonths` = '".$numMonthnew."' where `id`=".$row['id']."";
                    $res=mysqli_query($connection,$query);
                    $query="UPDATE `contacts` SET `numMonthsChanged` = '1' where `id`=".$row['id']."";
                    $res=mysqli_query($connection,$query);
                }
                else if($numMonthnew==$numMonthold)
                {
                    $query="UPDATE `contacts` SET `numMonthsChanged` = '0' where `id`=".$row['id']."";
                    $res=mysqli_query($connection,$query);
                }
                else
                {
                    $query="UPDATE `contacts` SET `numMonths` = '".$numWeeksnew."' where `id`=".$row['id']."";
                    $res=mysqli_query($connection,$query);
                }

                if($row['numWeeks']>=40)
                {
                    $query="UPDATE `contacts` SET `numWeeks` = '0' where `id`=".$row['id']."";
                    $res=mysqli_query($connection,$query);
                }
            }
        }
    }

?>