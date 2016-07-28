<?php
    
    //open connection to mysql db
    // $connection = mysqli_connect("localhost","root","*****","motherbeetest") or die("Error " . mysqli_error($connection));
    $connection=mysqli_connect("localhost","root","","motherbeetest") or die("Error " . mysqli_error($connection));
    // now updating numweeks column  for a given lead,, 

    // echo $_POST['week'];
    // $week=3;
    //$connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");
    // $id='614';
    $query="select `mail-text` from `mailing-list` where week=".$_POST['week']."";
    // echo $query;
    $result=mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row=mysqli_fetch_array($result);
    echo $row[0];
?>