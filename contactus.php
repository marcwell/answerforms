<?php

	require("phpmailer/class.phpmailer.php");		

	$mail = new PHPMailer();

	$mail->IsSMTP();

	$mail->Mailer="sendmail";

	$mail->From = $_POST["email"];

	$mail->FromName = $_POST["fullName"];

//	$mail->AddAddress("customerservice@asaplegalforms.com");

	$mail->AddAddress("rajkumar@itechzone.in");
	
	$mail->AddAddress("ponmalar@itechzone.com");

	$mail->IsHTML(true);

	$mail->Subject ="Answerforms: CONTACT INFORMATION: ".$_POST["subject"];

	



	$bodycontent="Name: ".$_POST["first_name"]."&nbsp;".$_POST["last_name"]."<br>";

	$bodycontent.="Email: ".$_POST["email"]."<br>";

	$bodycontent.="Message:<br>".$_POST["message"];

	

$mail->Body=$bodycontent;



if($mail->Send())

{

   echo "<script>alert('Your Email Has Been Sent.  We Will Contact You Soon.');location='index.php';</script>";

}	

	

?>