<?php
session_start();
// $email and $message are the data that is being
// posted to this page from our html contact form
$email = $_REQUEST['email'];//"myusufali2015@gmail.com";//$_POST['email'] ;
$message = $_REQUEST['message'];//"message";//$_POST['message'] ;
$name = $_REQUEST['name'];//"Ysf";//$_POST['name'];

// When we unzipped PHPMailer, it unzipped to
// public_html/PHPMailer_5.2.0
require("phpmailer/PHPMailerAutoload.php");

$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
// $mail->Host = "localhost";  // specify main and backup server

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
   	$_SESSION['status']=1;
   	$_SESSION['sent']="false";
	$url="index.php";
   	ob_start();
	header('Location: '.$url);
	ob_end_flush();
	die();
   	exit;
}

echo "success";
$url="index.php";
$_SESSION['status']=1;
$_SESSION['sent']="true";
ob_start();
header('Location: '.$url);
ob_end_flush();
die();
?>