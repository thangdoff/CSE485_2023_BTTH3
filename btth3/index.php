<?php
require_once 'vendor/autoload.php';
require_once 'Util/MyEmailServer.php';
require_once 'Util/EmailSender.php';

$emailServer = new MyEmailServer();
$emailSender = new EmailSender($emailServer);
$emailSender->send("dovanthang444@gmail.com", "Diem danh", "dovanthang_1951061012");
