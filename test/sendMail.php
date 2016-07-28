<?php
    require("phpmailer/class.phpmailer.php");

    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->SMTPAuth   = true; // SMTP authentication
    $mail->Host       = "smtp.gmail.com"; // SMTP server
    $mail->Port       = 465; // SMTP Port
    $mail->Username   = "motherbeehelp@gmail.com"; // SMTP account username
    $mail->Password   = "Bee Mother Help";        // SMTP account password

    $mail->SetFrom('motherbeehelp@gmail.com', 'MotherBee'); // FROM
    $mail->AddReplyTo('motherbeehelp@gmail.com', 'MotherBee'); // Reply TO

    $mail->AddAddress('myusufali2015@gmail.com', 'Yusuf'); // recipient email

    $mail->Subject    = "First SMTP Message"; // email subject
    $mail->Body       = "Hi! \n\n This is my first e-mail sent through Google SMTP using PHPMailer.";

    if(!$mail->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent.';
    }
?>