<?php
    
    //  this chart loads the second chart ,, 
    //open connection to mysql db
    // $connection = mysqli_connect("localhost","root","*****","motherbeetest") or die("Error " . mysqli_error($connection));
    $connection=mysqli_connect("localhost","root","","motherbeetest") or die("Error " . mysqli_error($connection));

    //$connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");

    //fetch table rows from mysql db
    $sql = "select numMonths, id , numMonthsChanged,name, email, phone from `contacts` where numMonths > 0";
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