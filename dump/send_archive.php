<?php
ini_set('display_errors',1);
error_reporting(E_ALL); 

#ini_set("SMTP", "127.0.0.1");
#ini_set("smtp_port", "25");

#phpinfo();

include "Mail.php";
include "Mail/mime.php";

$text = 'Text version of email';
$html = '<html><body>HTML version of email</body></html>';
$file = 'dumper.php';
$crlf = "\r\n";
$hdrs = array(
    'From'    => 'you@yourdomain.com',
    'Subject' => 'Test mime message'
);

$mime = new Mail_mime($crlf);

$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$mime->addAttachment($file, 'text/plain');

$body = $mime->get();
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail');
$mail->send('mihan_k@mail.ru', $hdrs, $body);

echo mail('mihan_k@mail.ru', 'head', 'text');

echo "sent\n";
