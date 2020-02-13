<?php
include("connection.php");
if($_REQUEST["act"])
{

if($_REQUEST["act"]=="mail")
{

	$row1 =mysql_fetch_array(mysql_query("SELECT * FROM blogs WHERE sl_no=".$_REQUEST["val"]));
$post_content=$row1['content'];



$post_content=str_replace("“","\"",$post_content);
$post_content=str_replace("”","\"",$post_content);
$post_content=str_replace("‘","'",$post_content);
$post_content=str_replace("’","'",$post_content);
$post_content=str_replace("…","...",$post_content);
$post_content=str_replace("—","-",$post_content);
$post_content=str_replace("–","-",$post_content);

	require("phpmailer/class.phpmailer.php");
	/*		
	$sql = mysql_query("SELECT * FROM follow");
	while($row = mysql_fetch_array($sql))
	{	
*/
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	//$mail->Mailer="sendmail";
	$mail->FromName = strtoupper(str_replace("www.","",$_SERVER['SERVER_NAME']));
	$mail->From = "info@rapaportlaw.com";
	//$mail->AddAddress($row['email_address']);
	$mail->AddAddress("rajkumar@itechzone.com");
	$mail->IsHTML(true);
	$mail->Subject =strtoupper(str_replace("www.","",$_SERVER['SERVER_NAME']))." - ".$row1['ctitle'];


		
$content="<table border='0' style=\"font:12px verdana; width:700px; border:3px solid #3F3F3F; background:#FFFCCC\" align=\"center\" cellpadding=5><tr><td style='font-size:12px; text-align:justify'><center><b style='font:14px arial; font-weight:bold'>".$row1['ctitle']."</b></center><br><font face='verdana'>".$row1['content']."</font></td></tr>
<tr><td style='font-size:11px'><br />
<br />
This email has been sent to you as you are subscribed to the ".str_replace("www.","",$_SERVER['SERVER_NAME']).".com Newsletter.
Should you no longer wish to receive these, please <a href='http://www.".str_replace("www.","",$_SERVER['SERVER_NAME'])."/unscribed.php?FSDFSD= '>update your preferences.</a></td></tr></table>";

	$mail->Body=$content;
	if(!$mail->Send())
	echo $mail1->ErrorInfo."1";
	/*
	}
*/
}
}

echo "<script>location='list_blogs.php';</script>";
?>