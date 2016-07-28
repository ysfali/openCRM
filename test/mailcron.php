<?php
    require("phpmailer/PHPMailerAutoload.php");
	// $connection=mysqli_connect("localhost","root","","motherbeetest") or die("Error " . mysqli_error($connection));
    $connection =mysqli_connect("localhost","cl56-leads-3tx","jmD^e/4-^","cl56-leads-3tx") or die("Error " . mysqli_error($connection));
    $query="select * from `contacts`";
    $result=mysqli_query($connection,$query);

    while($row=mysqli_fetch_array($result))
    {
    	// print_r($row);
    	// echo "<br/><br/>";

        $query1="select `mail-text` from `mailing-list` where week=".$row['numWeeks']."";
        $result1=mysqli_query($connection, $query1) or die(mysqli_error($connection));
        $row1=mysqli_fetch_array($result1);

    	$email = $row['email'];//"myusufali2015@gmail.com";//$_POST['email'] ;
        $message = $row1[0];//"message";//$_POST['message'] ;
        $name = $row['name'];//"Ysf";//$_POST['name'];

        echo "$email $message $name";
        echo "<br/><br/>";
      
        
        if($row['numWeeks']>0 AND $row['numWeeks']<=40 AND $row['numWeeksChanged']==1)
        {
            $mail = new PHPMailer();

            // set mailer to use SMTP
            $mail->IsSMTP();


            $mail->SMTPAuth = true;     // turn on SMTP authentication
            $mail->SMTPDebug = 1;

            $mail->SMTPSecure = "ssl";

            $mail->Host       = "smtp.gmail.com"; 

            $mail->Port       = 465;
            // When sending email using PHPMailer, you need to send from a valid email address
            // In this case, we setup a test email account with the following credentials:
            // email: send_from_PHPMailer@bradm.inmotiontesting.com
            // pass: password
            $mail->Username = "motherbeehelp@gmail.com";  // SMTP username
            $mail->Password = "Bee Mother Help"; // SMTP password

            // $email is the user's email address the specified
            // on our contact us page. We set this variable at
            // the top of this page with:
            // $email = $_REQUEST['email'] ;
            $mail->From = $email;
            $mail->SetFrom('motherbeehelp@gmail.com', 'MotherBee');
            $mail->AddReplyTo('motherbeehelp@gmail.com', 'MotherBee'); // Reply TO
            // below we want to set the email address we will be sending our email to.
            $mail->AddAddress($email, $name);

            // set word wrap to 50 characters
            $mail->WordWrap = 50;
            // set email format to HTML
            $mail->IsHTML(true);

            $mail->Subject = "You have received feedback from your website!";

            // $message is the user's message they typed in
            // on our contact us page. We set this variable at
            // the top of this page with:
            // $message = $_REQUEST['message'] ;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            if(!$mail->Send())
            {
                echo "fail";
            }

            echo "success";
            
        }
    }

?>