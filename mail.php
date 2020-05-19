<?php
header('Content-Type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$values = $_POST;

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.live.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jorge_qzg@hotmail.com';                     // SMTP username
    $mail->Password   = 'Spiderman@23';                               // SMTP password
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
    $mail->Body    = 'texto';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


    $mail->send();
    $data['type'] = 'success';
    echo json_encode($data, JSON_FORCE_OBJECT);
    exit;

} catch (Exception $e) {
    $data['type'] = 'error';
    $data['details'] = 'Mailer Error: ' . $mail->ErrorInfo;
    echo json_encode($data);
    exit;
}
