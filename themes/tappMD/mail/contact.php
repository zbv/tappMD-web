<?php 
session_start();
	
if(($_REQUEST['code'] == $_SESSION['random_number']) || @strtolower($_REQUEST['code']) == strtolower($_SESSION['random_number']) )

	{
		
$to = $_REQUEST['to'];
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$message = $_REQUEST['message'];
$subject = 'Subject';
$messages = 'From site your.com: '.$fname.'</br>'.$lname.'</br>'.$email.'</br>'.$phone.'</br>'.$message.'</br>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: info@your.com' . "\r\n";

mail($to, $subject, $messages, $headers);
		
		echo 1;// submitted 
		
	}
	else
	{
		echo 0; // invalid code
	}
?>

