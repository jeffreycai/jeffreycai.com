<?php

$to = 'jeffreycaizhenyuan@gmail.com';
$business = 'Jeffrey Cai - Under Maintainence';
$subject = 'New Contact From '.$business;

$name = trim(strip_tags($_POST['name']));
$email = trim(strip_tags($_POST['email']));
$body = str_replace("\n", '<br />', trim(strip_tags($_POST['message'])));

// validation
if ($name == '' || $email == '' || trim(strip_tags($_POST['message'])) == '')
    die('invalid input');

$message =
"
<html>
<head>
</head>
<body>
<p>Hi Jeffrey,</p>
<p>There is a new contact from <strong>$business</strong>:<p>
<ul>
<li>Name: <strong>$name</strong></li>
<li>Email: <strong>$email</strong></li>
<li>Message:<br />
$body
</li>
</ul>
<p>Thanks,<br />
$business
</p>
</body>
</html>
";


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

// Additional headers
$headers .= 'To: Jeffrey Cai <'.$to.'>' . "\r\n";
$headers .= 'From: Jeffrey Cai Website <'.$to.'>' . "\r\n";

mail($to, $subject, $message, $headers);

?>
