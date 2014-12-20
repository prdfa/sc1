<?php 
ini_set(sendmail_from,"fakhruddin.ansari@gmx.com");
ini_set(SMTP,"mail.gmx.com");
ini_set(smtp_port,"25");
//$headers ="From: services@limedomains.com";
$headers = 'MIME-Version: 1.0' . '\r\n';
$headers .= 'Content-type: text/html; charset=iso-8859-1'. '\r\n';
$headers .= 'From: services@limedomains.net' . '\r\n';
//mail("f@samruz.com","test subject","test body",$headers);

include("Mail.php");
/* mail setup recipients, subject etc */
$recipients = "fakhruddin@centerac.com";
$headers["From"] = "fakhruddin.ansari@gmx.com";
$headers["To"] = "fakhruddin@centerac.com";
$headers["Subject"] = "User feedback";
$mailmsg = "Hello, This is a test.";
/* SMTP server name, port, user/passwd */
$smtpinfo["host"] = "mail.gmx.com";
$smtpinfo["port"] = "25";
$smtpinfo["auth"] = true;
$smtpinfo["username"] = "centerac@gmx.com";
$smtpinfo["password"] = "unrpgr9t";
/* Create the mail object using the Mail::factory method */
$mail_object =Mail::factory("smtp", $smtpinfo);
/* Ok send mail */
$mail_object->send($recipients, $headers, $mailmsg);

?>