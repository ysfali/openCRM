<?php
    
    //open connection to mysql db
    // $connection = mysqli_connect("localhost","root","*****","motherbeetest") or die("Error " . mysqli_error($connection));
    $connection=mysqli_connect("localhost","root","","motherbeetest") or die("Error " . mysqli_error($connection));
    // now updating numweeks column  for a given lead,, 

    // echo $_POST['id'];
    //$connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx");
    // $id='614';
    $query="select `email` from contacts where id=".$_POST['id']."";
    $result=mysqli_query($connection, $query);
    while($row=mysqli_fetch_array($result))
    echo $row[0];
?>