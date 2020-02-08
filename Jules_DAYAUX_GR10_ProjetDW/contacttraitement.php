<?php use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer();
$mail->isSMTP();
$mail-> Host='smtp.gmail.com';
$mail ->SMTPAuth=true;
$mail->Username='julesdayauxphpcours@gmail.com';
$mail -> Password='motdepasse';
$mail->Port=587;
$mail->setFrom('jules@mail.com');
$mail->addAddress('julesdayauxphpcours@gmail.com');
$mail-> Subject='un mail';
$mail->Body='un corps de texte';
$mail->send();
echo'Le message a bien ete envoye';
?>