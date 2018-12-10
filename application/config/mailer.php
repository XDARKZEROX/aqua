<?php
require dirname(__FILE__) . '/../../' . 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require dirname(__FILE__) . '/../../' . 'vendor/autoload.php';

$mail = new PHPMailer;
//PRODUCCION

$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = ' mail.clicdominio.com';  // Specify main and backup SMTP servers
$mail->Username = 'tienda@aquaph9.com';                 // SMTP username
$mail->Password = '3T2XD1BM2Z';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to
$mail->CharSet = "UTF-8";
//$mail->From = 'tienda@aquaph9.com';
//$mail->FromName = 'AquaFit PH9';



