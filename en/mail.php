<?php

// RECAPTCHA
$recaptcha = $_POST["g-recaptcha-response"];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => '6LedFf0UAAAAADqTtfOvbmvzhWcEfnRUy_P3QD4q',
    'response' => $recaptcha
);

$options = array(
    'http' => array (
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success = json_decode($verify);

if ($captcha_success->success) {
  $cabeceras = 'From: contacto@visionbariatrica.com' . "\r\n" .
  'Reply-To: '.$_POST["correo"]. "\r\n" .
  'X-Mailer: PHP/' . phpversion();


  $cuerpo .= "Name: ".$_POST["nombre"] . "\n";
  $cuerpo .= "Phone: " .$_POST["telefono"] . "\n";
  $cuerpo .= "EMail: " .$_POST["correo"] . "\n";
  $cuerpo .= "\n";
  $cuerpo .= "Treatment: ".$_POST["tratamiento"] . "\n";
  $cuerpo .= "\n";
  $cuerpo .= "Age: " .$_POST["edad"] . "\n";
  $cuerpo .= "Weight: " .$_POST["pesolb"] . "\n";
  $cuerpo .= "Height: " .$_POST["estaturaft"] ."ft " .$_POST["estaturainch"] . "in"."\n";
  $cuerpo .= "BMI: " .$_POST["imc"] . "\n";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    mail("jorge_qzg@hotmail.com","Contacto VisiÃ³n BariÃ¡trica",$cuerpo,$cabeceras);
    $data['type'] = 'success';
    echo json_encode($data, JSON_FORCE_OBJECT);
    exit;
}
