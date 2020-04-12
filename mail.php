<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.live.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jorge_qzg@hotmail.com';                     // SMTP username
    $mail->Password   = 'Spiderman09';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('jorge_qzg@hotmail.com', 'Mailer');
    $mail->addAddress('jorge.a.qz96@gmail.com', 'Jorge Quezada');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('jorge_qzg@hotmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('es', 'phpmailer/language/phpmailer.lang-es.php');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nuevo correo | Visión Bariatrica';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
