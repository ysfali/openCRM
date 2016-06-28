<?php
    
    //open connection to mysql db
    $connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");

    // now updating numweeks column  for a given lead,, 

    $numweeks = " UPDATE contacts SET numWeeks = CEILING(DATEDIFF(contacts.`due date`, CURDATE())/7)";  






    $updatenumWeeks = mysqli_query($connection, $numweeks) or die("Error updating numweeks " .mysqli_error($connection));

    //fetch table rows from mysql db
    $sql = "select numWeeks, id from `contacts`";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    
    //echo $myrow["name"];
    //create an array
    $emparray = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
   // echo json_encode($emparray);
 //   echo  $emparray[3]['weeks'];



  
    //write to json file
    $fp = fopen('chartdata.json', 'w');
    fwrite($fp, json_encode($emparray, JSON_NUMERIC_CHECK));
    fclose($fp);

    //close the db connection
    mysqli_close($connection);

    // now sending the data of  json file as response of AJAX request

    $string = file_get_contents("chartdata.json");
    echo $string;
    
?>